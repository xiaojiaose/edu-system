<?php
// mengdewei@dankegongyu.com
namespace App\Http\Controllers\Api\Payload;

use App\School;
use App\SchoolTeacher;
use App\Student;
use App\Teacher;
use Illuminate\Database\Eloquent\Collection;

class ToDto implements \JsonSerializable
{
    static function schoolList(array $schoolList, $uid)
    {
        return [
            'items' => array_map(function (School $school) use ($uid) {
                return [
                    'id' => $school->id,
                    'name' => $school->name,
                    'approve_at' => $school->approve_time,
                    'created_at' => $school->created_at->toDateTimeString(),
                    'is_manager' => SchoolTeacher::isManager($school->id, $uid) ?: false,
                ];
            }, $schoolList)
        ];
    }

    static function studentList(Collection $studentList)
    {
        return [
            'items' => $studentList->map(function (Student $student){
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'school_name' => $student->school->name,
                ];
            })
        ];
    }

    static function teachersList(Collection $teachersList, $subscribe = false)
    {

        return [
            'items' => $teachersList->map(function (Teacher $teacher) use ($subscribe) {
                return [
                    'id' => $teacher->id,
                    'name' => $teacher->name,
                    'following' => !$subscribe ?: in_array($teacher->id, $subscribe),
                ];
            })
        ];
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}