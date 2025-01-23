<?php

namespace App\Http\Controllers\support;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReportCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Users List Report
     */
    public function users()
    {
        $user = Auth::user();
        $data = User::where('facility_id', $user->facility_id)
                ->where('level', 'doctor')
                ->orderBy('lname', 'asc')
                ->paginate(20);

        return view('support.report.users', [
            'title' => "Daily Users",
            'data' => $data
        ]);
    }

    /**
     * Get login logs
     */
    static function getLoginLog($id)
    {
        $date = Session::get('dateReportUsers');
        if(!$date) {
            $date = date('Y-m-d');
        }

        $start = Carbon::parse($date)->startOfDay();
        $end = Carbon::parse($date)->endOfDay();

        $data = array(
            'login' => '',
            'logout' => '',
            'status' => ''
        );

        $tmp = Login::where('userId', $id)
            ->whereBetween('login', [$start, $end])
            ->first();

        if($tmp) {
            $data['login'] = $tmp->login;
        }

        $tmp = Login::where('userId', $id)
            ->whereBetween('logout', [$start, $end])
            ->orderBy('id', 'desc')
            ->first();

        if($tmp) {
            $data['logout'] = $tmp->logout;
        }

        $tmp = Login::where('userId', $id)
            ->whereBetween('logout', [$start, $end])
            ->orderBy('id', 'desc')
            ->first();

        if(!$tmp) {
            $tmp = Login::where('userId', $id)
                ->whereBetween('login', [$start, $end])
                ->orderBy('id', 'desc')
                ->first();

            if(!$tmp) {
                $data['status'] = 'offline';
            } else {
                $data['status'] = $tmp->status;
            }
        } else {
            $data['status'] = $tmp->status;
        }

        $data = (object)$data;
        return $data;
    }
    
    /**
     * Filter login log by date
     */
    public function usersFilter(Request $req)
    {
        Session::put('dateReportUsers', $req->date);

        return self::users();
    }
}
