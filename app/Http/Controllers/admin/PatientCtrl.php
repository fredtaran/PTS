<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PatientCtrl extends Controller
{
    /**
     * Consolidated incoming
     */
    public function consolidatedIncomingv2(Request $request)
    {
        if($request->isMethod('post') && isset($request->date_range)) {
            $date_start = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[0])) . ' 00:00:00';
            $date_end = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[1])) . ' 23:59:59';
        } else {
            $date_start = Carbon::now()->startOfYear()->format('Y-m-d') . ' 00:00:00';
            $date_end = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';
        }

        $facility_id = Auth::user()->facility_id;
        $stored_name = "consolidatedIncomingMcc('$date_start', '$date_end', '$facility_id')";
        $incomingData = \DB::connection('mysql')->select("call $stored_name");

        Session::put('data', $incomingData);
        return view('admin.report.consolidated_incomingv2', [
            'title' => 'REFERRAL CONSOLIDATION TABLE (Within Province Wide Health System)',
            'data' => $incomingData,
            'date_range_start' => $date_start,
            'date_range_end' => $date_end
        ]);
    }
}
