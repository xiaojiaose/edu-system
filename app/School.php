<?php
// mengdewei@dankegongyu.com
namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * App\School
 *
 * @property int $id
 * @property string $name 学校名称
 * @property int $creator_id 申请人
 * @property string $approve_time 审批时间
 * @property int|null $approve_id 审批人
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Teacher $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[] $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Teacher[] $teachers
 * @property-read int|null $teachers_count
 * @method static \Illuminate\Database\Eloquent\Builder|School newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|School newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|School query()
 * @method static \Illuminate\Database\Eloquent\Builder|School whereApproveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereApproveTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|School whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class School extends Model
{
    protected $table="schools";


    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'school_teachers', 'school_id', 'teacher_id');
    }

    public function managers()
    {
        return $this->teachers()->where('is_manager', '>', 0);
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