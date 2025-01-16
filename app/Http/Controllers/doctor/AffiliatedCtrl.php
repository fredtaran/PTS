<?php

namespace App\Http\Controllers\doctor;

use Carbon\Carbon;
use App\Models\Facility;
use App\Models\Tracking;
use App\Models\Affiliated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ParamCtrl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AffiliatedCtrl extends Controller
{
    /**
     * Landing page
     */
    public function index(Request $req)
    {
        $user = Auth::user();
        $keyword = $req->searchKeyword;

        $data = Affiliated::select('*', 'facility.*', 'affiliated.id as main_id')
              ->leftJoin('facility', 'facility.id', '=', 'affiliated.facility_id')
              ->where(function($q) use($keyword) {
                $q->where('facility.name', "like", "%$keyword%")
                    ->orWhere('facility.chief_hospital', 'like', "%$keyword%");
                })
                ->where('user_id', $user->id)
                ->paginate(10);

        return view('doctor.affiliated', [
            'data' => $data
        ]);
    }

    static function countAffiReferral()
    {
        $user = Auth::user();
        $id = $user->id;

        $data = Tracking::select(
            'tracking.id',
            'tracking.type',
            'tracking.code',
            'facility.name',
            DB::raw('CONCAT(patients.fname, " ", CONCAT(patients.mname, " "), " "), patients.lname) as patient_name'),
            DB::raw("DATE_FORMAT(tracking.date_accepted,'%M %d, %Y %h:%i %p') as date_accepted")
        )
            ->join('facility', 'facility.id', '=', 'tracking.referred_from')
            ->join('patients', 'patients.id', '=', 'tracking.patient_id')
            ->join('patient_form', 'patient_form.patient_id', '=', 'tracking.patient_id')
            ->where('patient_form.referred_md', $user->id)
            ->whereExists(function($query) use($id)
            {
                $query->select(DB::raw(1))
                ->from('affiliated')
                        ->whereRaw('tracking.referred_to = affiliated.facility_id')
                    ->where('affiliated.user_id', $id);
            }) 
            ->where(function($q){
                $q->where('tracking.status', 'referred')
                ->orwhere('tracking.status', 'seen')
                ->orWhere('tracking.status', 'transferred');
            })
            ->where(DB::raw("TIMESTAMPDIFF(MINUTE,date_referred,now())"), "<=",4320)
            ->count();
        return $data;
    }

    /**
     * Affiliated facility body
     */
    public function AfiiliatedBody(Request $req)
    {
        $user = Auth::user();
        $keyword = $req->keyword;
        $id = $user->id;
        $facility = Facility::select('facility.*')
                            ->where('id', '<>', $user->facility_id)
                            ->where('facility.status', 1)
                            ->where(function($q) use($keyword) {
                                $q->where('facility.name', "like", "%$keyword%")
                                    ->orWhere('facility.chief_hospital', 'like', "%$keyword%");
                                 })
                            ->whereNotExists(function($query) use($id) {
                                $query->select(DB::raw(1))
                                    ->from('affiliated')
                                    ->whereRaw('affiliated.facility_id = facility.id')
                                    ->where('affiliated.user_id', $id);
                            })  
                            ->paginate(10);

        return view('doctor.affiliated_body', [
            'facility' => $facility
        ]);
    }

    /**
     * Save affiliated facility
     */
    public function AffiliatedOptions(Request $req)
    {
        if($req->id) {
            Affiliated::find($req->id)->delete();
            Session::put('affi_delete',true);
        } else {
            $user = Auth::user();

            foreach($req->facility_checkbox as $fac) {
                $data = array(
                    'user_id' => $user->id,
                    'facility_id' => $fac,
                    'status' => 1
                );

                Affiliated::create($data);
            }

            Session::put('affi_add',true);
            return Redirect::back();
         }
    }

    /**
     * Referral from affiliated facility
     */
    public function AffiReferral(Request $request)
    {
        ParamCtrl::lastLogin();
        $user = Auth::user();
        $keyword = '';
        $dept = '';
        $fac = '';
        $option = '';
        $id = $user->id;

        $start = Carbon::now()->startOfYear()->format('m/d/Y');
        $end = Carbon::now()->endOfYear()->format('m/d/Y');

        $start_date = Carbon::parse($start)->startOfDay();
        $end_date = Carbon::parse($end)->endOfDay();
    

        $data = Tracking::select(
            'tracking.*', 
            DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), " "), patients.lname) as patient_name'),
            DB::raw("TIMESTAMPDIFF(YEAR, patients.dob, CURDATE()) AS age"),
            'patients.sex',
            'facility.name as facility_name',
            DB::raw('CONCAT(if(users.level="doctor", "Dr. ", ""), users.fname, " ", users.mname, " ", users.lname) as referring_md'),
            DB::raw('CONCAT(action.fname, " ", action.mname, " ", action.lname) as action_md')
        )
        ->join('patients', 'patients.id', '=', 'tracking.patient_id')
        ->join('patient_form', 'patient_form.patient_id', '=', 'tracking.patient_id')
        ->join('facility', 'facility.id', '=', 'tracking.referred_from')
        ->leftJoin('users', 'users.id', '=', 'tracking.referring_md')
        ->leftJoin('users as action', 'action.id', '=', 'tracking.action_md')
        ->whereExists(function($query) use($id) {
            $query->select(DB::raw(1))
            ->from('affiliated')
                ->whereRaw('tracking.referred_to = affiliated.facility_id')
                ->where('affiliated.user_id', $id);
        }) 
        ->where('patient_form.referred_md', $user->id);
        
        if($request->search) {
            $keyword = $request->search;
            $data = $data->where(function($q) use ($keyword) {
                $q->where('patients.lname', "$keyword")
                    ->orwhere('patients.fname', "$keyword")
                    ->orwhere('tracking.code', "$keyword");
            });
        }

        if($request->facility_filter) {
            $fac = $request->facility_filter;
            $data = $data->where('tracking.referred_to', $fac);
        }

        if($request->department_filter) {
            $dept = $request->department_filter;
            $data = $data->where('tracking.department_id', $dept);
        }

        if($request->date_range) {
            $date = $request->date_range;
            $range = explode('-', str_replace(' ', '', $date));
            $start = $range[0];
            $end = $range[1];
        } else {
            $start = Carbon::now()->startOfYear()->format('m/d/Y');
            $end = Carbon::now()->endOfYear()->format('m/d/Y');
        }

        $start_date = Carbon::parse($start)->startOfDay();
        $end_date = Carbon::parse($end)->endOfDay();

        if($request->option_filter) {
            $option = $request->option_filter;
            if($option == 'referred') {
                $data = $data->where(function($q) {
                    $q->where('tracking.status', 'referred')
                        ->orwhere('tracking.status', 'seen');
                });
            } else if ($option=='accepted') {
                $data = $data->where(function($q) {
                    $q->where('tracking.status','accepted');
                });
            }
        } else {
            $data = $data->where(function($q) {
                $q->where('tracking.status', 'referred')
                    ->orwhere('tracking.status', 'seen')
                    ->orwhere('tracking.status', 'accepted')
                    ->orwhere('tracking.status', 'redirected')
                    ->orwhere('tracking.status', 'rejected')
                    ->orwhere('tracking.status', 'arrived')
                    ->orwhere('tracking.status', 'admitted')
                    ->orwhere('tracking.status', 'discharged')
                    ->orwhere('tracking.status', 'transferred')
                    ->orwhere('tracking.status', 'archived')
                    ->orwhere('tracking.status', 'cancelled');
            });
        }

        $data = $data->whereBetween('tracking.date_referred', [$start_date, $end_date]);

        $data = $data->orderBy("tracking.date_referred","desc")->paginate(15);

        return view('doctor.affi_referral', [
            'title' => 'Affiliated Incoming Patients',
            'data' => $data,
            'start' => $start,
            'end' => $end,
            'keyword' => $keyword,
            'department' => $dept,
            'facility' => $fac,
            'option' => $option
        ]);

    }
}
