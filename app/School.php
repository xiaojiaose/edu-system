<?php
// mengdewei@dankegongyu.com
namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * App\School
 *
 * @property int $id
 * @property string $name         学校名称
 * @property int $creator_id      申请人
 * @property string $approve_time 审批时间
 * @property int|null $approve_id 审批人
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class School extends Model
{
    protected $table = "schools";


    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'school_teachers', 'school_id', 'teacher_id');
    }

    public function managers()
    {
        return $this->teachers()->where('is_manager', '=', 1);
    }

    public function creator()
    {
        return $this->belongsTo(Teacher::class, 'creator_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'school_id');
    }
}