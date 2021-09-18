<?php
// mengdewei@dankegongyu.com
namespace App\Http\Controllers\Api\Payload;

use App\School;
use App\Student;
use App\Teacher;
use Illuminate\Database\Eloquent\Collection;

class ToDto implements \JsonSerializable
{
    static function schoolList(array $schoolList)
    {
        return [
            'items' => array_map(function (School $school) {
                return [
                    'id' => $school->id,
                    'name' => $school->name,
                ];
            }, $schoolList)
        ];
    }

    static function studentList(array $studentList)
    {
        return [
            'items' => array_map(function (Student $student) {
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                ];
            }, $studentList)
        ];
    }

    static function teachersList(Collection $teachersList, $subscribeTeacherIds = [])
    {

        return [
            'items' => $teachersList->map(function (Teacher $teacher) use ($subscribeTeacherIds) {
                return [
                    'id' => $teacher->id,
                    'name' => $teacher->name,
                    'following' => in_array($teacher->id, $subscribeTeacherIds),
                ];
            })
        ];
    }


    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}