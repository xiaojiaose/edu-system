<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * App\User
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
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    // 多角色共有
    protected $table = 'users';

    protected static $roleColumn = '';

    protected static function boot()
    {
        parent::boot();

        if (static::$roleColumn) {
            static::addGlobalScope('role', function (Builder $builder) {
                $builder->where(static::$roleColumn, '>', 0);
            });
            static::creating(function (User $user) {
                $user->setAttribute(static::$roleColumn, 1);
            });
        }
    }

    public static function checkRole(User $user)
    {
        return static::$roleColumn && $user->getAttribute(static::$roleColumn) > 0;
    }

    // 自定义通知通道
    public function receivesBroadcastNotificationsOn()
    {
        return 'siteMsg.' . $this->id;
    }

}
