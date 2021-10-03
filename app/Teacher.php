<?php
// mengdewei@dankegongyu.com

namespace App;

/**
 * App\Teacher
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
class Teacher extends User
{
    static $roleColumn = 'is_teacher';

    public function subscribe_students()
    {
        return $this->belongsToMany(Student::class, 'subscribes', 'teacher_id', 'student_id');
    }

    public function schools()
    {
        return $this->belongsToMany(School::class, 'school_teachers', 'teacher_id', 'school_id');
    }
}
