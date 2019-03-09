<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // TODO Identify which methods apply to convert to rest method in to API methods !!!!

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:enter_admin')          ->  only(['index']);
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

