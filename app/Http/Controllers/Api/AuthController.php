<?php
// mengdewei@dankegongyu.com

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Api\Payload\ErrorMessage;
use App\Http\Controllers\Api\Payload\UserDto;
use App\Http\Controllers\Controller;
use App\Teacher;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only(['email', 'password'])) === false) {
            throw new ErrorMessage('邮箱或密码错误');
        }
        return $this->createToken($request->user());
    }


    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ]);

        $teachVo = $request->json();
        $teacher = new Teacher();
        $teacher->name = $teachVo->get('name');
        $teacher->email = $teachVo->get('email');
        $teacher->password = bcrypt($teachVo->get('password'));
        $teacher->is_teacher = 1;
        $teacher->save();

        return $this->createToken($teacher);
    }


    private function createToken(User $user)
    {
        $tokenResult = $user->createToken('Personal Access Token');
        /** @var \Laravel\Passport\Token expires_at */
        $tokenResult->token->expires_at = new Carbon('+7 day');
        $tokenResult->token->save();
        return new UserDto(
            $user,
            $tokenResult->accessToken,
            $tokenResult->token->expires_at->timestamp
        );
    }
}