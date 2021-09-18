<?php
// mengdewei@dankegongyu.com
namespace App\Http\Controllers\Api\Payload;

use App\School;
use App\Student;
use App\Teacher;

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

    static function teachersList(array $teachersList)
    {
        return [
            'items' => array_map(function (Teacher $teachers) {
                return [
                    'id' => $teachers->id,
                    'name' => $teachers->name,
                ];
            }, $teachersList)
        ];
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}