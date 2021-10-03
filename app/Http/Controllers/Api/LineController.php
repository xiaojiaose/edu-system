<?php

namespace App\Http\Controllers\Api;

use App\Externals\LineService;
use App\Http\Controllers\Api\Payload\ErrorMessage;
use App\Http\Controllers\Api\Payload\UserDto;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LineController extends Controller
{
    public function bind(Request $request, LineService $line)
    {
        $this->validate($request, [
            'token' => 'required|string',
        ]);

        $lineUserId = $line->verify($request->json('token'));
        $user = $request->user();
        $user->line_id = $lineUserId;
        $user->save();
    }

    public function unbind(Request $request)
    {
        $user = $request->user();
        $user->line_id = '';
        $user->save();
    }

    public function users(Request $request, LineService $line)
    {
        $this->validate($request, [
            'token' => 'required|string',
        ]);

        $jwt = $request->json('token');
        $lineUserId = $line->verify($jwt);
        $users = User::whereLineId($lineUserId)->get();
        $result = [];
        foreach ($users as $user) {
            $result[] = new UserDto($user, '', 0);
        }
        return $result;
    }

    public function login(Request $request, LineService $line)
    {
        $this->validate($request, [
            'token' => 'required|string',
            'userId' => 'required|integer',
        ]);

        $jwt = $request->json('token');
        $lineUserId = $line->verify($jwt);

        $user = User::whereLineId($lineUserId)->whereId($request->json('userId'))->first();
        if (!$user) {
            throw new ErrorMessage('非法请求');
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $tokenResult->token->expires_at = new Carbon('+7 day');
        $tokenResult->token->save();
        return new UserDto(
            $user,
            $tokenResult->accessToken,
            $tokenResult->token->expires_at->timestamp,
        );
    }
}
