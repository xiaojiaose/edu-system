<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Payload\ToDto;
use App\Http\Controllers\Controller;
use App\Student;
use App\StudentFollow;
use App\Subscribe;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // 哪些学生关注了老师
    public function subscribe(Request $request)
    {
        $pageNumber = (int)$request->query('pageNumber');
        $page = $pageNumber > 0 ? $pageNumber : 1;
        $offset = self::PAGE_SIZE * ($page - 1);

        $studentIds = Subscribe::whereTeacherId($request->user()->id)->offset($offset)->limit(self::PAGE_SIZE)
            ->pluck('student_id');

        $studentList = Student::with('school')->whereIn('id', $studentIds)->get();
        return ToDto::studentList($studentList);
    }

    public function list(Request $request)
    {
    }
}
