<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Api\Payload\ErrorMessage;
use Closure;

class IdentityFilter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$identities)
    {
        $user = $request->user();
        foreach ($identities as $identity) {
            /**@var \App\User $identity*/
            if ($identity::checkRole($user)) {
                return $next($request);
            }
        }

        throw new ErrorMessage('无权操作');
    }
}
