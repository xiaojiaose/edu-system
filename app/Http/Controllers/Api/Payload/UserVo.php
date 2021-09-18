<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers\Api\Payload;

use App\User;

class UserVo implements \JsonSerializable
{
    public function __construct(User $user, string $access_token, int $expires_at)
    {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->access_token = $access_token;
        $this->expires_at = $expires_at;
        //$this->lineBinded = $user->line_id !== '';

//        SystemAdmin::checkIdentity($user) && $this->role = 'system_admin';
//        Teacher::checkIdentity($user) && $this->role = 'teacher';
//        Student::checkIdentity($user) && $this->role = 'student';
    }
    public $access_token;
    public $expires_at;
    public $id;
    public $name;
    public $role;
    public $lineBinded = false;

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}