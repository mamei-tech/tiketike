<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class LangController extends Controller
{

    public function localizator(){
        if (!Session::has('locale'))
            Session::put('locale', input::get('locale'));
        else
            session(['locale' => input::get('locale')]);

        return redirect()->back()->withInput();
    }
}
