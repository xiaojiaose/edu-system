<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\Mapping\Mapping;
use App\Http\Controllers\Api\Payload\ErrorMessage;
use App\Http\Controllers\Api\Payload\ToDto;
use App\Http\Controllers\Controller;
use App\School;
use App\SchoolTeacher;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SchoolController extends Controller
{
    // 老师所在学校的列表
    public function schools(Request $request)
    {
        $user = $request->user();
        //学校列表
        if ($request->method() == Request::METHOD_GET) {
            $schoolList = School::whereHas('teachers', function ($query) use ($user) {
                $query->where('teacher_id', $user->id);
            })->get()->all();

//            $schoolIds = $schoolList->pluck("id");
//            SchoolTeacher::whereIn('school_id', $schoolIds)->whereIsMananger(1)
            return ToDto::schoolList($schoolList, $user->id);
        }
        //创建学校
        if ($request->method() == Request::METHOD_POST) {
            $this->validate($request, [
                'name' => 'required|string',
            ]);
            $school = new School();
            $school->name = $request->json('name');
            $school->creator_id = $user->id;
            $school->save();
            SchoolTeacher::create([
                'teacher_id' => $user->id,
                'school_id' => $school->id,
                'is_manager' => 1,
            ]);
        }
    }

    // 查询创建学生
    public function students(Request $request, $schoolId = null)
    {
        if ($request->method() == Request::METHOD_POST && $schoolId) {
            if (SchoolTeacher::isManager($schoolId, $request->user()->id) === false) {
                throw new ErrorMessage('您不是该学校管理员');
            }
            $this->validate($request, [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string'
            ]);
            $student = new Student();
            $student->name = $request->json('name');
            $student->email = $request->json('email');
            $student->password = bcrypt($request->json('password'));
            $student->is_student = 1;
            $student->school_id = $schoolId;
            $student->save();
        }
        // 查询出该学校所有的学生
        if ($request->method() == Request::METHOD_GET) {
            if ($schoolId) {
                $studentList = Student::whereSchoolId($schoolId)->whereIsStudent(1)->get();
            } else {
                $managerSchools = School::whereHas('teachers', function ($query) use ($request) {
                    $query->where("is_manager", '1')->where('teacher_id', $request->user()->id);
                })->pluck("name","id")->toArray();
//                dd($managerSchools);
                $studentList = Student::whereIn('school_id', array_keys($managerSchools))->whereIsStudent(1)->get();
            }
            return ToDto::studentList($studentList);
        }
    }

    public function invites(int $schoolId, Request $request)
    {
        if (SchoolTeacher::isManager($schoolId, $request->user()->id) === false) {
            throw new ErrorMessage('您不是该学校管理员');
        }
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        // 判定用户是否存在,不存在就新建用户
        if (!$user = User::whereEmail($request->json('email'))->first()) {
            $user = new Teacher();
            $user->name = $request->json('name');
            $user->email = $request->json('email');
            $user->password = bcrypt($request->json('password'));
        }
        // 学生做助教
        $user->is_teacher = 1;
        $user->save();
        // 绑定老师和学校
        SchoolTeacher::firstOrCreate(['school_id' => $schoolId, 'teacher_id' => $user->id]);
    }
}