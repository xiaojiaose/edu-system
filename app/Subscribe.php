<?php
// mengdewei@dankegongyu.com

namespace App;


use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table = 'subscribes';
    protected $fillable = [
        'student_id',
        'teacher_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

}