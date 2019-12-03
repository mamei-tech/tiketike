<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Raffle;
use App\WelcomePoster;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:enter_admin')          ->  only(['index']);
    }

    /**
     * Show the admin section dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sharedRaffles = Raffle::sharedRaffles();
        $welcome_poster = WelcomePoster::all()->first;

        return view('admin.index',
            [
                'li_activeDash' => 'active',
                'netGain' => round(Raffle::rafflesNetGain(), 2),
                'usersCount' => User::usersCount(),
                'sharedRaffles' => $sharedRaffles,
                'welcome_poster' => $welcome_poster,

            ]);
    }


    public function updatePoster(Request $request, $id)
    {
        $welcome_poster = WelcomePoster::find($id);

        $welcome_poster->title = $request->get('title');
        $welcome_poster->subtitle = $request->get('subtitle');
        $welcome_poster->save();

        Log::log('INFO', trans('aLogs.welcome_poster_updated'), [
            'title' => $welcome_poster->title,
            'subtitle'   => $welcome_poster->subtitle
        ]);

        return redirect()->route('poster.update',
            [
                'title' => $welcome_poster->title,
                'subtitle' => $welcome_poster->subtitle,

            ],
            '303')
            ->with('success', 'Poster updated successfully');
    }
}

