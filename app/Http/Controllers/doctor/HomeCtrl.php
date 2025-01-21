<?php

namespace App\Http\Controllers\doctor;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ParamCtrl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeCtrl extends Controller
{
    public function index()
    {
        ParamCtrl::lastLogin();

        $user = Auth::user();
        $group_by_department = $user->level == 'admin' ?
            User::
            select(DB::raw("count(users.id) as y"), DB::raw("coalesce(department.description, 'NO DEPARTMENT') as label"))
                ->leftJoin("department", "department.id", "=", "users.department_id")
                ->where("users.level", "!=", "admin")
                ->where("users.level", "!=", "support")
                ->groupBy("users.department_id", "department.description")
                ->get()
        :
            User::
            select(DB::raw("count(users.id) as y"), DB::raw("coalesce(department.description, 'NO DEPARTMENT') as label"))
                ->leftJoin("department", "department.id", "=", "users.department_id")
                ->where("users.facility_id", $user->facility_id)
                ->where("users.level", "!=", "admin")
                ->where("users.level", "!=", "support")
                ->groupBy("users.department_id", "department.description")
                ->get()
        ;

        $date_start = Carbon::now()->startOfYear()->format('Y-m-d') . ' 00:00:00';
        $date_end = Carbon::now()->endOfYear()->format('Y-m-d') . ' 23:59:59';

        $incoming_statistics = DB::connection('mysql')->select("call statistics_report_facility('$date_start', '$date_end', '$user->facility_id', '$user->level')")[0];

        $referred_query = DB::connection('mysql')->select("call doctor_monthly_report('$date_start', '$date_end', '$user->facility_id', 'referred', '$user->level')");
        $accepted_query = DB::connection('mysql')->select("call doctor_monthly_report('$date_start', '$date_end', '$user->facility_id', 'accepted', '$user->level')");
        $redirected_query = DB::connection('mysql')->select("call doctor_monthly_report('$date_start', '$date_end', '$user->facility_id', 'redirected', '$user->level')");

        //for past 15 days
        $date_start_past = date('Y-m-d', strtotime(Carbon::now()->subDays(15))) . ' 00:00:00';
        $date_end_past = date('Y-m-d', strtotime(Carbon::now()->subDays(1))) . ' 23:59:59';
        $referred_past = DB::connection('mysql')->select("call doctor_past_transaction('$date_start_past', '$date_end_past', '$user->facility_id', 'referred', '$user->level')");
        $accepted_past = DB::connection('mysql')->select("call doctor_past_transaction('$date_start_past', '$date_end_past', '$user->facility_id', 'accepted', '$user->level')");
        $redirected_past = DB::connection('mysql')->select("call doctor_past_transaction('$date_start_past', '$date_end_past', '$user->facility_id', 'redirected', '$user->level')");

        $index = 0;
        foreach($referred_query as $row){
            $data['referred'][] = $row->value;
            $data['accepted'][] = $accepted_query[$index]->value;
            $data['redirected'][] = $redirected_query[$index]->value;
            $index++;
        }

        return view('doctor.home', [
            "group_by_department" => $group_by_department,
            "doctor_monthly_report" => $data,
            "referred_past" => $referred_past,
            "accepted_past" => $accepted_past,
            "redirected_past" => $redirected_past,
            "incoming_statistics" => $incoming_statistics,
            "date_start" => $date_start,
            "date_end" => Carbon::now()->format('Y-m-d')
        ]);
    }
}
