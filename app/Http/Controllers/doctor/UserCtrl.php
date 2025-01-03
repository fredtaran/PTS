<?php

namespace App\Http\Controllers\doctor;

use DB;
use Carbon\Carbon;
use App\Models\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\ParamCtrl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class UserCtrl extends Controller
{
    /**
     * Landing page
     */
    public function index()
    {
        ParamCtrl::lastLogin();
        
        $start = Carbon::now()->startOfDay();
        $end = Carbon::now()->endOfDay();

        $data = Login::select(
            'users.id as id',
            'users.fname as fname',
            'users.lname as lname',
            'users.mname as mname',
            'users.level as level',
            'users.contact',
            'facility.name as facility',
            'facility.abbr as abbr',
            'department.description as department',
            'login.login as login',
            'login.status as status'
        );

        $data = $data->where(function($q) {
            $q->where('login.status', 'login')
                ->orwhere('login.status', 'login_off');
        });

        $data = $data->join('users', 'users.id', '=', 'login.userId')
                ->join('facility', 'facility.id', '=', 'users.facility_id')
                ->leftJoin('department', 'department.id', '=', 'users.department_id');

        $data = $data->whereBetween('login.login', [$start, $end])
                    ->where('login.logout', '0000-00-00 00:00:00')
                    ->orderBy('login.id', 'desc')
                    ->get();

        $date_start = Carbon::now()->startOfDay();
        $date_end = Carbon::now()->endOfDay();
        $hospitals = DB::connection('mysql')->select("call online_facility_view('$date_start', '$date_end')");

        return view('doctor.list', [
            'title' => 'Online Users',
            'data' => $data,
            'hospitals' => $hospitals
        ]);
    }

    /**
     * Set logout time
     */
    public function setLogoutTime(Request $request){
        $user = Auth::user();
        $input_time_logout = date('Y-m-d H:i:s',strtotime($request->input_time_logout));
        Login::where("userId",$user->id)->orderBy("id","desc")->first()->update([
            "logout" => $input_time_logout
        ]);
        Session::put('logout_time',true);
        return Redirect::back();
    }
}
