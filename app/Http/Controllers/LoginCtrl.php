<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LoginCtrl extends Controller
{   
    /**
     * Login page
     */
    public function index()
    {
        if($login = Session::get('auth')){
            return redirect($login->level);
        }

        return view('login');
    }

    /**
     * Validate login credentials
     */
    public function validateLogin(Request $req)
    {
        // Get username and password from form
        $credentials = $req->validate([
            'username'  =>  ['required'],
            'password'  =>  ['required']
        ]);

        // Attempt to check if the user does exist, and username & password is correct
        if (Auth::attempt($credentials)) {
            // Generate session
            $req->session()->regenerate();

            //
            $last_login = date('Y-m-d H:i:s');
            User::where('id', Auth::user()->id)
                ->update([
                    'last_login' => $last_login,
                    'login_status' => 'login'
                ]);

            $checkLastLogin = self::checkLastLogin(Auth::user()->id);

            $l = new Login();
            $l->userId = Auth::user()->id;
            $l->login = $last_login;
            $date = Carbon::now();
            $l->logout = $date->format('Y-m-d 23:59:59');
            $l->status = 'login';
            $l->save();

            if($checkLastLogin > 0 ) {
                Login::where('id',$checkLastLogin)
                    ->update([
                        'logout' => $last_login
                    ]);
            }

            if(Auth::user()->level =='doctor')
                return redirect('doctor');
            else if(Auth::user()->level =='chief')
                return redirect('chief');
            else if(Auth::user()->level =='support')
                return redirect('support');
            else if(Auth::user()->level =='mcc')
                return redirect('mcc');
            else if(Auth::user()->level =='admin')
                return redirect('admin');
            else if(Auth::user()->level =='eoc_region')
                return redirect('eoc_region');
            else if(Auth::user()->level =='eoc_city')
                return redirect('eoc_city');
            else if(Auth::user()->level =='opcen')
                return redirect('opcen');
            else if(Auth::user()->level =='bed_tracker')
                return redirect('bed_tracker');
            else if(Auth::user()->level =='midwife')
                return redirect('midwife');
            else if(Auth::user()->level =='medical_dispatcher')
                return redirect('medical_dispatcher');
            else if(Auth::user()->level =='nurse')
                return redirect('nurse');
            else if(Auth::user()->level =='vaccine')
                return redirect('vaccine');
            else{
                Session::forget('auth');
                return Redirect::back()->with('error','You don\'t have access in this system.')->with('username', $req->username);
            }
        }
        
        return Redirect::back()->with('error','These credentials do not match our records')->with('username', $req->username);
    }

    /**
     * Check user last login timestamp
     */
    function checkLastLogin($id)
    {
        $start = Carbon::now()->startOfDay();
        $end = Carbon::now()->endOfDay();
        $login = Login::where('userId',$id)
                    ->whereBetween('login',[$start,$end])
                    ->orderBy('id','desc')
                    ->first();
        if($login && (!$login->logout>=$start && $login->logout<=$end)){
            return true;
        }

        if(!$login){
            return false;
        }

        return $login->id;
    }

    /**
     * Change/Reset password
     */
    public function resetPassword(Request $req)
    {
        $user = Auth::session();

        if (Hash::check($req->current, $user->password))
        {
            if ($req->newPass == $req->confirm) {
                $lenght = strlen($req->newPass);

                if($lenght >= 6)
                {
                    $password = bcrypt($req->newPass);
                    User::where('id',$user->id)
                        ->update([
                        'password' => $password
                        ]);

                    return 'changed';
                } else {
                 return 'length';
                }
            } else {
                return 'not_match';
            }
        } else {
            return 'error';
        }
    }
}
