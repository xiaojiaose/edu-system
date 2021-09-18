<?php
// mengdewei@dankegongyu.com
namespace App;


use Illuminate\Database\Eloquent\Model;
// 学校和老师的映射表
/**
 * App\SchoolTeacher
 *
 * @property int $id
 * @property int $school_id 学校id
 * @property int $teacher_id 教师id
 * @property int $is_manager 1为学校管理员
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTeacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTeacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTeacher query()
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTeacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTeacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTeacher whereIsManager($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTeacher whereSchoolId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTeacher whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SchoolTeacher whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SchoolTeacher extends Model
{
    protected $table = 'school_teachers';

    protected $fillable = [
        'school_id',
        'teacher_id',
        'is_manager',
    ];

    public static function isManager(int $schoolId, int $teacherId)
    {
        return self::query()
                ->where('teacher_id', $teacherId)
                ->where('school_id', $schoolId)
                ->where('is_manager', '>', 0)
                ->count() > 0;
    }
}