<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserCtrl extends Controller
{
    /**
     * Change duty status
     */
    public function duty($option)
    {
        $user = Auth::user();
        $option = ($option == 'onduty') ? 'login' : 'login_off';
        User::where('id', $user->id)
            ->update([
                'login_status' => $option
            ]);

        Login::where('userId', $user->id)
            ->orderBy('id', 'desc')
            ->first()
            ->update([
                'status' => $option
            ]);
        Session::put('duty',true);
    }
}
