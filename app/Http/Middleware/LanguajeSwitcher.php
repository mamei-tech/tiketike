<?php

namespace App\Http\Middleware;

use App\Facades\Loc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Closure;

class LanguajeSwitcher
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
        //If the user is logged has a lang configuration setup
        if(Auth::check())
        {
            //The lang configuration setup hasn't been checked
            if(!Session::get('locale_checked'))
            {
                $userLang = DB::table('usersprofiles')
                    ->where('usersprofiles.user', Auth::id())
                    ->value('langcode');

                Loc::set($userLang);

                Session::put('locale_checked', true);
                Session::put('locale', $userLang);

            }
            else {
                Loc::set(Session::get('locale'));
            }
        }
        else {
            Loc::set(Session::get('locale'));
        }

        return $next($request);
    }
}

