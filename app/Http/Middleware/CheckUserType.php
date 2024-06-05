<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  array|string  ...$types
     * @return mixed
     */
    public function handle($request, Closure $next, ...$types)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->tipo_users, $types)) {
            return redirect('/');
        }

        return $next($request);
    }
}
