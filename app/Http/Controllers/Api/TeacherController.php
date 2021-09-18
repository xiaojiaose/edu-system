<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\StudentFollow;
use App\Subscribe;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // 哪些学生关注了老师
    public function subscribe(Request $request)
    {
        $pageNum = (int)$request->query('pageNum');
        $page = $pageNum > 0 ? $pageNum : 1;
        $offset = self::PAGE_SIZE * ($page - 1);

        $studentIds = Subscribe::whereTeacherId($request->user()->id)->offset($offset)->limit(self::PAGE_SIZE)
            ->pluck('student_id', 'id');
        dd($studentIds);

    }

    public function list(Request $request)
    {

    }
}