<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers\Api\Payload;

use App\Student;
use App\Teacher;
use App\User;

class UserDto implements \JsonSerializable
{
    public function __construct(User $user, string $access_token, int $expires_at)
    {
        $this->id = $user->id;
        $this->name = $user->name;
        $this->access_token = $access_token;
        $this->expires_at = $expires_at;
        $this->lineBinded = !empty(trim($user->line_id));

        Teacher::checkRole($user) && $this->role = 'teacher';
        Student::checkRole($user) && $this->role = 'student';
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