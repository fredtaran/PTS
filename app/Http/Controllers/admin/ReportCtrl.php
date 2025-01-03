<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ReportCtrl extends Controller
{
    /**
     * Online accounts
     */
    public function online1()
    {
        $date = Session::get('dateReportOnline');
        if(!$date) {
            $date = date('Y-m-d');
        }

        $start = Carbon::parse($date)->startOfDay();
        $end = Carbon::parse($date)->endOfDay();

        $data = DB::connection('mysql')->select("call AttendanceFunc('$start', '$end')");

        return view('admin.online', [
            'title' => 'Online Users',
            'data' => $data
        ]);
    }

    /**
     * Search by date
     */
    public function filterOnline1(Request $req)
    {
        Session::put('dateReportOnline', $req->date);
        return self::online1();
    }

    /**
     * Get online facility
     */
    public function onlineFacility(Request $request){
        if($request->isMethod('post') && isset($request->day_date)) {
            $day_date = date('Y-m-d', strtotime($request->day_date));
        } else {
            $day_date = date('Y-m-d');
        }
        $stored_name = "online_facility('$day_date')";
        $data = DB::connection('mysql')->select("call $stored_name");

        return view('admin.report.online_facility', [
            'title' => 'ONLINE FACILITY',
            "data" => $data,
            'day_date' => $day_date
        ]);
    }

    /**
     * Offline facility
     */
    public function offlineFacility(Request $request) {
        if($request->isMethod('post') && isset($request->day_date)) {
            $day_date = date('Y-m-d', strtotime($request->day_date));
        } else {
            $day_date = date('Y-m-d');
        }
        //return $day_date;
        $stored_name = "offline_facility('$day_date')";
        $data = DB::connection('mysql')->select("call $stored_name");

        return view('admin.report.offline_facility', [
            'title' => 'Offline Facility',
            "data" => $data,
            'day_date' => $day_date
        ]);
    }

    /**
     * Onboard facility
     */
    public function onboardFacility(){
        $data = DB::connection('mysql')->select("call onboard_facility()");

        dd($data);

        return view('admin.report.onboard_facility', [
            'title' => 'ONBOARD FACILITY',
            "data" => $data
        ]);
    }

    /**
     * Onboard user
     */
    public function onboardUsers(){
        $onboard_users = DB::connection('mysql')->select("call onboard_users()");
        return view('admin.report.onboard_users', [
            "onboard_users" => $onboard_users
        ]);
    }

    /**
     * 
     */
    public function weeklyReport(Request $request) {
        if($request->isMethod('post') && isset($request->date_range)) {
            $date_start = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[0]));
            $date_end = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[1]));
        } else {
            $date_start = date('Y-m-d', strtotime(Carbon::now()->subDays(31)));
            $date_end = date('Y-m-d');
        }

        $facility = DB::connection('mysql')->select("call weekly_report()");
        $generate_weeks = DB::connection('mysql')->select("call generate_weeks('$date_start', '$date_end')");

        return view('admin.report.offline_facility_weekly', [
            'title' => 'Login Status',
            'facility' => $facility,
            'generate_weeks' => $generate_weeks,
            'date_start' => $date_start,
            'date_end' => $date_end
        ]);
    }
}
