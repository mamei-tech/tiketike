<?php

namespace App\Http\Middleware;

use Closure;
use Mockery\Exception;

class AdminPermsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        if (! $request->user()->can($permission)) {
            abort(403);                                         // Forbbiden
        }

        return $next($request);
    }
}
