<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\Payload\ErrorMessage;
use App\Http\Controllers\Api\Payload\ToDto;
use App\Http\Controllers\Controller;
use App\School;
use App\Subscribe;
use App\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // 关注的老师列表
    public function subscribeList(Request $request)
    {
        $pageNum = (int)$request->query('pageNum');
        $page = $pageNum - 1;
        $page = $page > 0 ? self::PAGE_SIZE * $page : 0;
        $limit = self::PAGE_SIZE * $page;

        $teacherIds = Subscribe::query()
            ->whereStudentId($request->user()->id)
            ->offset($page)->limit($limit)
            ->pluck('teacher_id', 'id');
        $teachers = Teacher::query()
            ->findMany($teacherIds, ['id', 'name', 'email', 'created_at'])
            ->keyBy('id')
            ->all();

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
    public function unsubscribe(int $teacherId, Request $request)
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

    public function teachers(Request $request)
    {

    }

}