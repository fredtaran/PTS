<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Tracking;
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

        die(print_r("<h1>Under Maintenance</h1>"));

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

    /**
     * Graph Report
     */
    public function bar_chart() {
        return view('admin.report.bar_chart');
    }

    /**
     * Referral
     */
    public function referral()
    {
        $start = Session::get('startDateReportReferral');
        $end = Session::get('endDateReportReferral');
        if(!$start)
            $start = date('Y-m-d');
        if(!$end)
            $end = date('Y-m-d');

        $start = Carbon::parse($start)->startOfDay();
        $end = Carbon::parse($end)->endOfDay();

        $data = Tracking::whereBetween('updated_at', [$start, $end])
                        ->orderBy('updated_at', 'desc')
                        ->paginate(20);
        return view('admin.referral', [
            'title' => 'Referral Status',
            'data' => $data
        ]);
    }

    /**
     * Referral filter
     */
    public function filterReferral(Request $req)
    {
        $range = explode('-', str_replace(' ', '', $req->date));
        $tmp1 = explode('/', $range[0]);
        $tmp2 = explode('/', $range[1]);

        $start = $tmp1[2] . '-' . $tmp1[0] . '-' . $tmp1[1];
        $end = $tmp2[2] . '-' . $tmp2[0] . '-' . $tmp2[1];

        Session::put('startDateReportReferral', $start);
        Session::put('endDateReportReferral', $end);
        return self::referral();
    }

    /**
     * Statistics Report Incoming
     */
    public function statisticsReportIncoming(Request $request) {
        if($request->isMethod('post') && isset($request->date_range)) {
            $date_start = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[0])) . ' 00:00:00';
            $date_end = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[1])) . ' 23:59:59';
        } else {
            $date_start = Carbon::now()->startOfYear()->format('Y-m-d') . ' 00:00:00';
            $date_end = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';
        }

        $stored_name = "statistics_report_incoming('$date_start', '$date_end')";
        $data = DB::connection('mysql')->select("call $stored_name");

        return view('admin.report.statistics_incoming', [
            'title' => 'STATISTICS REPORT INCOMING',
            "data" => $data,
            'date_range_start' => $date_start,
            'date_range_end' => $date_end
        ]);
    }

    /**
     * Statistics Report Outgoing
     */
    public function statisticsReportOutgoing(Request $request) {
        if($request->isMethod('post') && isset($request->date_range)) {
            $date_start = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[0])) . ' 00:00:00';
            $date_end = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[1])) . ' 23:59:59';
        } else {
            $date_start = Carbon::now()->startOfYear()->format('Y-m-d') . ' 00:00:00';
            $date_end = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';
        }

        $stored_name = "statistics_report_outgoing('$date_start', '$date_end')";
        $data = DB::connection('mysql')->select("call $stored_name");

        return view('admin.report.statistics_outgoing', [
            'title' => 'STATISTICS REPORT OUTGOING',
            "data" => $data,
            'date_range_start' => $date_start,
            'date_range_end' => $date_end
        ]);
    }
    
    /*
     * ER OB Report
     */
    public function erobReport(Request $request) {
        if($request->isMethod('post') && isset($request->date_range)) {
            $date_start = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[0])) . ' 00:00:00';
            $date_end = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[1])) . ' 23:59:59';
        } else {
            $date_start = Carbon::now()->startOfYear()->format('Y-m-d') . ' 00:00:00';
            $date_end = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';
        }

        $stored_name = "er_ob_report('$date_start', '$date_end')";
        $data = DB::connection('mysql')->select("call $stored_name");

        return view('admin.report.er_ob',[
            'title' => 'ER OB REPORT',
            "data" => $data,
            'date_range_start' => $date_start,
            'date_range_end' => $date_end
        ]);
    }

    /**
     * User online
     */
    public function averageUsersOnline() {
        $date_start = Carbon::now()->startOfYear()->format('Y-m-d') . ' 00:00:00';
        $date_end = Carbon::now()->endOfYear()->format('Y-m-d') . ' 23:59:59';

        $data = DB::connection('mysql')->select("call average_login_month('$date_start', '$date_end')");
        return view('admin.report.average_users_online', [
            "data" => $data
        ]);
    }

}
