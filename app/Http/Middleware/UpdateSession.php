<?php

namespace App\Http\Middleware;

use App\SessionCounter;
use Closure;

class UpdateSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        SessionCounter::updateCurrent();
        return $next($request);
    }
}
