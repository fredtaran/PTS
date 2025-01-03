<?php

namespace App\Http\Controllers\Opcen;

use Carbon\Carbon;
use App\Models\ItCall;
use App\Models\Muncity;
use App\Models\Barangay;
use App\Models\Facility;
use App\Models\Province;
use App\Models\Department;
use App\Models\OpcenClient;
use Illuminate\Http\Request;
use App\Models\ReferenceNumber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OpcenController extends Controller
{
    /**
     * Dashboard
     */
    public function opcenDashboard(){
        //for past 10 days
        $date_start = date('Y-m-d',strtotime(Carbon::now()->subDays(15))).' 00:00:00';
        $date_end = date('Y-m-d',strtotime(Carbon::now()->subDays(1))).' 23:59:59';
        $past_days = \DB::connection('mysql')->select("call opcen_past_report_call('$date_start','$date_end')");
        ///

        for($i=1; $i<=12; $i++)
        {
            $date = date('Y').'/'.$i.'/01';
            $startdate = Carbon::parse($date)->startOfMonth();
            $enddate = Carbon::parse($date)->endOfMonth();

            $new_call = OpcenClient::where("call_classification","new_call")
                ->whereBetween('time_started',[$startdate,$enddate])
                ->count();
            $data['new_call'][] = $new_call;

            $repeat_call = OpcenClient::where("call_classification","repeat_call")
                ->whereBetween('time_started',[$startdate,$enddate])
                ->count();
            $data['repeat_call'][] = $repeat_call;
        }

        $transaction_complete = OpcenClient::where("transaction_complete","!=",null)
            ->count();

        $transaction_incomplete = OpcenClient::where("transaction_incomplete","!=",null)
            ->count();

        $inquiry = OpcenClient::where("reason_calling","inquiry")
            ->count();

        $referral = OpcenClient::where("reason_calling","referral")
            ->count();

        $others = OpcenClient::where("reason_calling","others")
            ->count();

        $call_total = OpcenClient::count();
        $call_new = OpcenClient::where("call_classification","new_call")->count();
        $call_repeat = OpcenClient::where("call_classification","repeat_call")->count();
        $no_classification = OpcenClient::whereNull("call_classification")->count();

        return view('opcen.opcen',[
            "data" => $data,
            "transaction_complete" => $transaction_complete,
            "transaction_incomplete" => $transaction_incomplete,
            "inquiry" => $inquiry,
            "referral" => $referral,
            "others" => $others,
            "past_days" => $past_days,
            "call_total" => $call_total,
            "call_new" => $call_new,
            "call_repeat" => $call_repeat,
            "no_classification" => $no_classification
        ]);
    }

    /**
     * Client
     */
    public function opcenClient(Request $request) {
        if(isset($request->date_range)) {
            $date_start = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[0])) . ' 00:00:00';
            $date_end = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[1])) . ' 23:59:59';
        } else {
            $date_start = Carbon::now()->startOfYear()->format('Y-m-d') . ' 00:00:00';
            $date_end = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';
        }

        $search = $request->search;
        $client = OpcenClient::where(function($q) use ($search) {
                $q->where('reference_number', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->orderBy("time_started", "desc");
        $client_call = $client->get();
        Session::put("client_call", $client_call);
        $client = $client->paginate(15);

        $call_total = OpcenClient::where(function($q) use ($search) {
            $q->where('reference_number', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();

        $call_new = OpcenClient::where("call_classification", "new_call")->where(function($q) use ($search){
            $q->where('reference_number', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();

        $call_repeat = OpcenClient::where("call_classification", "repeat_call")->where(function($q) use ($search){
            $q->where('reference_number', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();

        $no_classification = OpcenClient::whereNull("call_classification")->where(function($q) use ($search){
            $q->where('reference_number', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();


        $call_inquiry = OpcenClient::where("reason_calling", "inquiry")
            ->where(function($q) use ($search){
                $q->where('reference_number', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();

        $call_referral = OpcenClient::where("reason_calling", "referral")
            ->where(function($q) use ($search){
                $q->where('reference_number', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();

        $call_others = OpcenClient::where("reason_calling", "others")
            ->where(function($q) use ($search){
                $q->where('reference_number', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();

        $no_reason_for_calling = OpcenClient::whereNull("reason_calling")
            ->where(function($q) use ($search){
                $q->where('reference_number', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();

        $call_complete = OpcenClient::whereNotNull("transaction_complete")
            ->where(function($q) use ($search){
                $q->where('reference_number', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();

        $call_incomplete = OpcenClient::whereNotNull("transaction_incomplete")
            ->where(function($q) use ($search){
                $q->where('reference_number', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();

        $no_transaction = OpcenClient::whereNull("transaction_complete")
            ->whereNull("transaction_incomplete")
            ->where(function($q) use ($search){
                $q->where('reference_number', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();


        return view('opcen.client',[
            "client" => $client,
            "search" =>$search,
            'date_range_start' => $date_start,
            'date_range_end' => $date_end,
            "call_total" => $call_total,
            "call_new" => $call_new,
            "call_repeat" => $call_repeat,
            "no_classification" => $no_classification,
            "call_inquiry" => $call_inquiry,
            "call_referral" => $call_referral,
            "call_others" => $call_others,
            "no_reason_for_calling" => $no_reason_for_calling,
            "call_complete" => $call_complete,
            "call_incomplete" => $call_incomplete,
            "no_transaction" => $no_transaction
        ]);
    }

    /**
     * Export client call
     */
    public function exportClientCall(){
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=client_call.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $client = Session::get("client_call");

        return view('opcen.export_call',[
            "client" => $client
        ]);
    }

    /**
     * New call
     */
    public function newCall(){
        $province = Province::get();
        $facility = Facility::where("id", "!=", "63")->orderBy("name", "asc")->get();
        Session::put("client", false); //from repeat call so that need to flush session
        return view('opcen.call',[
            "province" => $province,
            "facility" => $facility,
            "reference_number" => str_pad($this->supplyReferenceNumber(), 5, '0', STR_PAD_LEFT)
        ]);
    }

    /**
     * Supply Reference Number
     */
    public function supplyReferenceNumber() {
        $encoded_by = Auth::user()->id;
        $reference_number = new ReferenceNumber();
        $reference_number->encoded_by = $encoded_by;
        $reference_number->save();
        return $reference_number->id;
    }

    /**
     * Incomplete
     */
    public function transactionInComplete(){
        return view('opcen.transaction_incomplete');
    }

    /**
     * IT client
     */
    public function itClient(Request $request){
        if(isset($request->date_range)) {
            $date_start = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[0])) . ' 00:00:00';
            $date_end = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[1])) . ' 23:59:59';
        } else {
            $date_start = Carbon::now()->startOfYear()->format('Y-m-d') . ' 00:00:00';
            $date_end = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';
        }

        $search = $request->search;
        $client = ItCall::where(function($q) use ($search){
                $q->where('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->orderBy("time_started", "desc");

        $client_call = $client->get();
        Session::put("it_call_excel", $client_call);
        $client = $client->paginate(15);

        $call_total = ItCall::where(function($q) use ($search){
                $q->where('name', 'like', "%$search%");
            })
            ->whereBetween("time_started", [$date_start,$date_end])
            ->count();

        return view('it.client', [
            "client" => $client,
            "search" =>$search,
            'date_range_start' => $date_start,
            'date_range_end' => $date_end,
            "call_total" => $call_total
        ]);
    }

    /**
     * Export IT call
     */
    public function exportItCall(){
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment;filename=it_call.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $client = Session::get("it_call_excel");
        return view('it.export_call', [
            "client" => $client
        ]);
    }

    /**
     * IT new call
     */
    public function itNewCall(){
        $province = Province::get();
        $facility = Facility::where("id", "!=" , "63")->orderBy("name", "asc")->get();
        $department = Department::get();
        Session::put("client", false); //from repeat call so that need to flush session
        return view('it.call', [
            "province" => $province,
            "facility" => $facility,
            "department" => $department
        ]);
    }

    /**
     * IT incomplete
     */
    public function itTransactionInComplete(){
        return view('it.transaction_incomplete');
    }

    /**
     * Retrieve municipalities/cities
     */
    public function onChangeProvince($province_id) {
        return Muncity::select("id", "description")->where("province_id", "=", $province_id)->get();
    }

    /**
     * Retrieve barangays
     */
    public function onChangeMunicipality($municipality_id){
        return Barangay::select("id", "description")->where("muncity_id", "=", $municipality_id)->get();
    }

    /**
     * Reason of calling (Client)
     */
    public function reasonCalling($reason) {
        return view('opcen.reason_calling', [
            "reason" => $reason,
        ]);
    }

    /**
     * Reason of calling (IT)
     */
    public function itReasonCalling($reason) {
        return view('it.reason_calling', [
            "reason" => $reason,
        ]);
    }

}
