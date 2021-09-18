<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\Payload\ErrorMessage;
use App\Http\Controllers\Api\Payload\ToDto;
use App\Http\Controllers\Controller;
use App\School;
use App\SchoolTeacher;
use App\Subscribe;
use App\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // 关注的老师列表
    public function subscribeList(Request $request)
    {
        $pageNum = (int)$request->query('pageNum');

        $page = $pageNum > 0 ? $pageNum : 1;
        $offset = self::PAGE_SIZE * ($page - 1);

        $teacherIds = Subscribe::query()
            ->whereStudentId($request->user()->id)
            ->offset($offset)->limit(self::PAGE_SIZE)
            ->pluck('teacher_id', 'id');
        $teachers = Teacher::query()
            ->findMany($teacherIds, ['id', 'name', 'email', 'created_at'])
            ->keyBy('id');

        return ToDto::teachersList($teachers);

    }

    // 关注
    public function subscribe(int $teacherId, Request $request)
    {
        Subscribe::firstOrCreate([
            'student_id' => $request->user()->id,
            'teacher_id' => $teacherId,
        ]);
    }

    // 取消关注
    public function deleteSubscribe(int $teacherId, Request $request)
    {
        Subscribe::where([
            'student_id' => $request->user()->id,
            'teacher_id' => $teacherId,
        ])->delete();
    }

    public function schoolInfo(Request $request)
    {
        $school = School::find($request->user()->school_id);
        if (!$school) {
            throw new ErrorMessage('查询失败');
        }
        return [
            'id' => $school->id,
            'name' => $school->name,
        ];
    }

    // 学生学校的老师们
    public function teachers(Request $request)
    {
        $student = $request->user();
        if (!$schoolId = $student->school_id) {
            throw new ErrorMessage('查询失败');
        }

        $teacherIds = SchoolTeacher::whereSchoolId($schoolId)->pluck('teacher_id')->all();
        if (!$teacherIds) {
            return ['items' => []];
        }
        $teachers = Teacher::findMany($teacherIds);

        $subscribeTeacherIds = Subscribe::whereStudentId($student->id)->pluck('teacher_id')->all();

        return ToDto::teachersList($teachers, $subscribeTeacherIds);

    }

}