<?php
// mengdewei@dankegongyu.com

namespace App;


/**
 * App\Student
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_student 不等于0时为学生
 * @property int $school_id  所属学校
 * @property int $is_teacher 不等于0时为老师
 */
class Student extends User
{
    static $roleColumn = 'is_student';

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

}