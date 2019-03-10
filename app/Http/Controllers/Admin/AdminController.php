<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // I think this is not needed because I have this in the route middleware
        $this->middleware('auth');
    }

    /**
     * Show the admin section dashboard page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index', [ 'li_activeDash' => 'active']);
    }
}

