<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if ($login = Auth::user()) {
            return redirect($login->level);
        } else {
            Session::flush();
            return redirect('/');
        }
    }
}
