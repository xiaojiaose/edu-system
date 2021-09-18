<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Student;
use App\StudentFollow;
use App\Subscribe;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // 被关注的学生列表
    public function subscribe(Request $request)
    {
        $pageNum = (int)$request->query('pageNum');
        $page = $pageNum - 1;
        $page = $page > 0 ? self::PAGE_SIZE * $page : 0;
        $limit = self::PAGE_SIZE * $page;

        $studentIds = Subscribe::whereTeacherId($request->user()->id)->offset($page)->limit($limit)
            ->pluck('student_id', 'id');
        dd($studentIds);

    }

    public function list(Request $request)
    {

    }
}