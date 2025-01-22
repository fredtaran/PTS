<?php

namespace App\Http\Controllers\doctor;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Muncity;
use App\Models\Activity;
use App\Models\Barangay;
use App\Models\Facility;
use App\Models\Patients;
use App\Models\Province;
use App\Models\Tracking;
use App\Models\LabResult;
use App\Models\Antepartum;
use App\Models\SignSymptoms;
use Illuminate\Http\Request;
use App\Events\PregnantNotif;
use App\Models\PregVitalSign;
use App\Models\PregnantFormv2;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ParamCtrl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;

class PatientCtrl extends Controller
{
    public function searchProfile(Request $req)
    {
        $data = array(
            'keyword' => $req->keyword,
            'brgy' => $req->brgy,
            'muncity' => $req->muncity,
            'others' => $req->others,
            'source' => $req->source,
            'province' => $req->province
        );
        
        Session::put('profileSearch',$data);
        return self::index();
    }

    /**
     * Landing page
     */
    public function index()
    {
        ParamCtrl::lastLogin();

        $user = Auth::user();
        $muncity = Muncity::where('province_id', $user->province)->orderby('description', 'asc')->get();

        $keyword = '';
        $brgy = '';
        $mun = '';
        $others = '';
        $session = Session::get('profileSearch');
        
        if(isset($session))
        {
            $keyword = $session['keyword'];
            $brgy = $session['brgy'];
            $mun = $session['muncity'];
            $others = $session['others'];
            $province = $session['province'];
        }

        $source='referral';

        $data = array();
        
        $facility_id = $user->facility_id;
        $user = Auth::user();

        $data = Patients::select('patients.*', 'patients.id as patient_id', 'facility.name as facility_name')
                        ->leftjoin('facility', 'facility.id', '=', 'patients.facility_id')
                        ->orderBy('patients.lname', 'asc')
                        ->where(function($q) use($keyword){     
                            $q->where('patients.lname', "like", "%$keyword%")
                                ->orWhere('patients.fname', 'like', "%$keyword%")
                                ->orWhere('patients.mname', 'like', "%$keyword%")
                                ->orwhere(DB::raw('concat(patients.fname, " ", patients.lname)'), "like", "%$keyword%");
                        });

        // Check if the profile is empty or not
        if (!empty($keyword) || !empty($mun) || !empty($brgy)) {
            $data = $data;
        } else {
            $data = $data->where('patients.facility_id', $facility_id);
        }

        // Check if there is a brgy set for the search
        if (!empty($brgy)) {
            $data = $data->where('patients.brgy', $brgy);
        }

        // Check if there is a city/municipality set for the search
        if (!empty($mun) && $mun!='others') {
            $data = $data->where('patients.muncity', $mun);
        }

        // Check if there is a province set for the search
        if (!empty($province)) {
            $data = $data->where('patients.province', $province);
        }

        // Check if there is a others set for the search
        if (!empty($others)) {
            $data = $data->where('patients.address', 'like', "%$others%");
        }

        // Set a 10 items per pagination
        $data = $data->paginate(20);

        $province = Province::all();

        return view('doctor.patient', [
            'title' => 'Patient List',
            'data' => $data,
            'province' => $province,
            'mun' => $mun,
            'muncity' => $muncity,
            'brgy' => $brgy,
            'source' => $source,
            'sidebar' => 'filter_profile'
        ]);
    }

    /**
     * Search patient
     */
    public function searchAccepted(Request $req)
    {
        $range = explode('-', str_replace(' ', '', $req->daterange));

        $start = $range[0];
        $end = $range[1];

        Session::put('startAcceptedDate', $start);
        Session::put('endAcceptedDate', $end);
        Session::put('keywordAccepted', $req->keyword);

        return redirect('/doctor/accepted');
    }

    /**
     * Add patient
     */
    public function addPatient()
    {
        $user = Auth::user();
        $muncity = Muncity::where('province_id', $user->province)->where(function($q) {
            $q->WhereNull("vaccine_used")
            ->orWhere("vaccine_used", "No");
        })
        ->orderby('description', 'asc')
        ->get();

        $province = Province::all();

        return view('doctor.addPatient', [
            'title' => 'Add New Patient',
            'muncity' => $muncity,
            'province' => $province,
            'method' => 'store'
        ]);
    }
    
    /**
     * Store patient to database
     */
    public function storePatient(Request $req)
    {
        $user = Auth::user();
        $facility_id = $user->facility_id;
        $dob = date('Ymd', strtotime($req->dob));
        $unique = array(
            $req->fname,
            $req->mname,
            $req->lname,
            date('Ymd', strtotime($req->dob)),
            $req->brgy
        );
        $unique = implode($unique);

        $match = array('unique_id' => $unique);
        $data = array(
            'phic_status' => $req->phic_status,
            'phic_id' => ($req->phicID) ? $req->phicID: '',
            'fname' => $req->fname,
            'mname' => $req->mname,
            'lname' => $req->lname,
            'contact' => $req->contact,
            'dob' => $dob,
            'sex' => $req->sex,
            'civil_status' => $req->civil_status,
            'facility_id' => $facility_id,
            'muncity' => $req->muncity,
            'province' => $req->province,
            'brgy' => ($req->brgy) ? $req->brgy : '' ,
            'address' => ($req->others) ? $req->others : '',
            'consent' => $req->consent
        );

        $create = Patients::updateOrCreate($match,$data);
            
        if($create->wasRecentlyCreated)
        {
            Session::put('cssAdd', true);
        }

        $data = array(
            'keyword' => $req->fname . ' ' . $req->lname,
            'brgy' => $req->brgy,
            'muncity' => $req->muncity,
            'province' => $req->province,
            'others' => '',
            'source' => 'referral'
        );
 
        Session::put('profileSearch', $data);
        return redirect('doctor/patient');
    }

    /**
     * Update patient details
     */
    public function updatePatient(Request $request){
        $data = Patients::find($request->patient_id);

        if($request->patient_update_button){
            $data_update = $request->all();
            unset($data_update['_token']);
            unset($data_update['patient_update_button']);
            unset($data_update['patient_id']);
            $data->update($data_update);
            Session::put('patient_update_save',true);
            Session::put('patient_message','Successfully updated patient');
            return Redirect::back();
        }
        
        return view('doctor.patient_body',[
            "data" => $data
        ]);
    }

    /**
     * Show patient profile
     */
    public function showPatientProfile($id)
    {
        $data = Patients::find($id);

        if ($data->brgy) {
            $brgy = Barangay::find($data->brgy)->description;
            $muncity = Muncity::find($data->muncity)->description;
            $province = Province::find($data->province)->description;
            $data->address = "$brgy, $muncity, $province";
        } else {
            $data->address = $data->address;
        }
        
        $data->patient_name = "$data->fname $data->mname $data->lname";
        $data->age = ParamCtrl::getAge($data->dob);
        
        $sign = SignSymptoms::select('*')->where('patient_woman_id', $id)->orderby('created_at', 'desc')->first();

        $form = PregnantFormv2::select('*')->where('patient_woman_id', $id)->orderby('created_at', 'desc')->first();
        
        $ante = Antepartum::select('*')->where('patient_woman_id', $id)->latest()->first();

        $lab = LabResult::select('*')->where('patient_woman_id', $id)->wherenotnull('blood_type')->latest()->first();

        return response()->json([
            'data' => $data,
            'sign' => $sign,
            'form' => $form,
            'ante' => $ante,
            'lab' => $lab,
        ]);
    }

    /**
     * Accepted patient
     */
    function accepted(Request $request)
    {
        $user = Auth::user();
        $keyword = Session::get('keywordAccepted');
        $start = Session::get('startAcceptedDate');
        $end = Session::get('endAcceptedDate');
        $id = $user->id;

        $data1 = Tracking::select(
            'tracking.id',
            'tracking.type',
            'tracking.code',
            'facility.name',
            'pregnant_formv2.unique_id',
            'tracking.patient_id',
            DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), ""), patients.lname) as patient_name'),
            DB::raw("DATE_FORMAT(tracking.date_accepted, '%M %d, %Y %h:%i %p') as date_accepted")
        )
        ->join('facility', 'facility.id', '=', 'tracking.referred_from')
        ->join('patients', 'patients.id', '=', 'tracking.patient_id')
        ->join('pregnant_formv2', 'pregnant_formv2.id', '=', 'tracking.form_id')
        ->where('tracking.referred_to', $user->facility_id)
        ->where(function($q) {
            $q->where('tracking.status', 'accepted')
                ->orwhere('tracking.status', 'admitted')
                ->orwhere('tracking.status', 'arrived')
                ->orwhere('tracking.status', 'monitored');
            });

        if($keyword) {
            $data1 = $data1->where(function($q) use ($keyword) {
                $q->where('patients.fname', 'like', "%$keyword%")
                    ->orwhere('patients.mname', 'like', "%$keyword%")
                    ->orwhere('patients.lname', 'like',"%$keyword%")
                    ->orwhere('tracking.code', 'like', "%$keyword%");
            });
        }

        if($start && $end) {
            $start = Carbon::parse($start)->startOfDay();
            $end = Carbon::parse($end)->endOfDay();
            $data1 = $data1->whereBetween('tracking.date_accepted', [$start, $end]);
        } else {
            $start = \Carbon\Carbon::now()->startOfYear();
            $end = \Carbon\Carbon::now()->endOfYear();
            $data1 = $data1->whereBetween('tracking.date_accepted', [$start, $end]);
        }

        $data = Tracking::select(
            'tracking.id',
            'tracking.type',
            'tracking.code',
            'facility.name',
            'pregnant_formv2.unique_id',
            'tracking.patient_id',
            DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), ""), patients.lname) as patient_name'),
            DB::raw("DATE_FORMAT(tracking.date_accepted, '%M %d, %Y %h:%i %p') as date_accepted")
        )
        ->join('facility', 'facility.id', '=', 'tracking.referred_from')
        ->join('patients', 'patients.id', '=', 'tracking.patient_id')
        ->join('patient_form', 'patient_form.patient_id', '=', 'tracking.patient_id')
        ->join('pregnant_formv2', 'pregnant_formv2.id', '=', 'tracking.form_id')
        ->where('patient_form.referred_md', $user->id)
        ->whereExists(function($query) use($id) {
            $query->select(DB::raw(1))
                    ->from('affiliated')
                    ->whereRaw('affiliated.facility_id = facility.id')
                    ->where('affiliated.user_id', $id);
            }) 
            ->where(function($q) {
                $q->where('tracking.status', 'accepted')
                    ->orwhere('tracking.status', 'admitted')
                    ->orwhere('tracking.status', 'arrived');
            });

        if($keyword) {
            $data = $data->where(function($q) use ($keyword) {
                $q->where('patients.fname', 'like', "%$keyword%")
                    ->orwhere('patients.mname', 'like', "%$keyword%")
                    ->orwhere('patients.lname', 'like', "%$keyword%")
                    ->orwhere('tracking.code', 'like', "%$keyword%");
            });
        }

        if($start && $end) {
            $start = Carbon::parse($start)->startOfDay();
            $end = Carbon::parse($end)->endOfDay();
            $data = $data->whereBetween('tracking.date_accepted', [$start, $end]);
        } else {
            $start = \Carbon\Carbon::now()->startOfYear();
            $end = \Carbon\Carbon::now()->endOfYear();
            $data = $data->whereBetween('tracking.date_accepted', [$start, $end]);
        }
 
        $data = $data->union($data1)->orderBy('id', 'desc')->get();
        $patient_count = count($data);

        $data = $this->MyPagination($data, 10, $request);

        return view('doctor.accepted',[
            'title' => 'Accepted Patients',
            'data' => $data,
            'start' => $start,
            'end' => $end,
            'patient_count' => $patient_count
        ]);
    }

    /**
     * MyPagination function
     */
    public function MyPagination($list, $perPage, Request $request)
    {
        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        $itemCollection = collect($list);

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());

        return $paginatedItems;
    }

    /**
     * Walkin patient monitoring
     */
    public function walkinPatient(Request $request) {
        $user = Auth::user();
        if(isset($request->date_range)) {
            $date_start = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[0])) . ' 00:00:00';
            $date_end = date('Y-m-d', strtotime(explode(' - ', $request->date_range)[1])) . ' 23:59:59';
        } else {
            $date_start = Carbon::now()->startOfYear()->format('Y-m-d') . ' 00:00:00';
            $date_end = Carbon::now()->endOfMonth()->format('Y-m-d') . ' 23:59:59';
        }

        $walkin_patient = DB::connection('mysql')->select("call walkin('$date_start', '$date_end', '$user->facility_id')");
        return view('doctor.walkin', [
            "walkin_patient" => $walkin_patient,
            "user_level" => $user->level,
            "date_start" => $date_start,
            "date_end" => $date_end
        ]);
    }

    /**
     * Doctor discharge
     */
    function discharge()
    {
        $keyword = Session::get('keywordDischarged');
        $start = Session::get('startDischargedDate');
        $end = Session::get('endDischargedDate');

        $user = Auth::user();
        $data = Tracking::select(
                    'tracking.id',
                    'tracking.type',
                    'tracking.code',
                    'facility.name',
                    'tracking.status',
                    DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), " "), patients.lname) as patient_name'),
                    DB::raw("DATE_FORMAT(tracking.updated_at, '%M %d, %Y %h:%i %p') as date_accepted")
                )
                ->join('facility', 'facility.id', '=', 'tracking.referred_from')
                ->join('patients', 'patients.id', '=', 'tracking.patient_id')
                ->where('tracking.referred_to', $user->facility_id);

        if($keyword) {
            $data = $data->where(function($q) use ($keyword) {
                $q->where('patients.fname', 'like', "%$keyword%")
                    ->orwhere('patients.mname', 'like', "%$keyword%")
                    ->orwhere('patients.lname', 'like', "%$keyword%")
                    ->orwhere('tracking.code', 'like', "%$keyword%");
            });
        }

        if($start && $end) {
            $start = Carbon::parse($start)->startOfDay();
            $end = Carbon::parse($end)->endOfDay();
            $data = $data
                    ->leftJoin('activity', 'activity.code', '=', 'tracking.code')
                    ->where(function ($q) {
                        $q->where('activity.status', 'discharged')
                            ->orwhere('activity.status', 'transferred');
                    })
                    ->whereBetween('activity.date_referred', [$start, $end]);
        } else {
            $data = $data->where(function($q) {
                $q->where('tracking.status', 'discharged')
                    ->orwhere('tracking.status', 'transferred');
            });
        }

        $data = $data->orderBy('tracking.updated_at', 'desc')->paginate(15);

        return view('doctor.discharge', [
            'title' => 'Discharged',
            'data' => $data
        ]);
    }

    /**
     * Discharge search
     */
    public function searchDischarged(Request $req)
    {
        $range = explode('-', str_replace(' ', '', $req->daterange));
        $tmp1 = explode('/', $range[0]);
        $tmp2 = explode('/', $range[1]);

        $start = $tmp1[2] . '-' . $tmp1[0] . '-' . $tmp1[1];
        $end = $tmp2[2] . '-' . $tmp2[0] . '-' . $tmp2[1];

        Session::put('startDischargedDate', $start);
        Session::put('endDischargedDate', $end);
        Session::put('keywordDischarged', $req->keyword);

        return redirect('/doctor/discharge');
    }

    /**
     * Transfer patient
     */
    function transferred()
    {
        $keyword = Session::get('keywordTransferred');
        $start = Session::get('startTransferredDate');
        $end = Session::get('endTransferredDate');

        $user = Auth::user();
        $data = Activity::select(
                    'tracking.id',
                    'tracking.type',
                    'activity.code',
                    'facility.name',
                    'activity.status',
                    DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), " "), patients.lname) as patient_name'),
                    DB::raw("DATE_FORMAT(tracking.updated_at, '%M %d, %Y %h:%i %p') as date_accepted")
                )
                ->leftJoin('tracking', 'activity.code', '=', 'tracking.code')
                ->join('facility', 'facility.id', '=', 'activity.referred_from')
                ->join('patients', 'patients.id', '=', 'activity.patient_id')
                ->where('activity.status', 'transferred')
                ->where('activity.referred_from', $user->facility_id)
                ->distinct();

        if($keyword) {
            $data = $data->where(function($q) use ($keyword) {
                $q->where('patients.fname', 'like', "%$keyword%")
                    ->orwhere('patients.mname', 'like', "%$keyword%")
                    ->orwhere('patients.lname', 'like', "%$keyword%")
                    ->orwhere('tracking.code', 'like', "%$keyword%");
            });
        }

        $data = $data->orderBy('activity.updated_at', 'desc')->paginate(15);

        return view('doctor.transferred', [
            'title' => 'Transferred Patients',
            'data' => $data
        ]);
    }

    /**
     * Transfer search
     */
    public function searchTransferred(Request $req)
    {
        $range = explode('-', str_replace(' ', '', $req->daterange));
        $tmp1 = explode('/', $range[0]);
        $tmp2 = explode('/', $range[1]);

        $start = $tmp1[2] . '-' . $tmp1[0] . '-' . $tmp1[1];
        $end = $tmp2[2] . '-' . $tmp2[0] . '-' . $tmp2[1];

        Session::put('startTransferredDate', $start);
        Session::put('endTransferredDate', $end);
        Session::put('keywordTransferred', $req->keyword);

        return redirect('/doctor/transferred');
    }

    /**
     * Cancel patient transfer
     */
    function cancel()
    {
        $user = Auth::user();
        $keyword = Session::get('keywordCancelled');
        $start = Session::get('startCancelledDate');
        $end = Session::get('endCancelledDate');

        $data = Tracking::select(
            'tracking.id',
            'tracking.type',
            'tracking.code',
            'facility.name',
            DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), " "), patients.lname) as patient_name'),
            DB::raw("DATE_FORMAT(tracking.updated_at, '%M %d, %Y %h:%i %p') as date_accepted")
        )
            ->join('facility', 'facility.id', '=', 'tracking.referred_from')
            ->join('patients', 'patients.id', '=', 'tracking.patient_id')
            ->where('referred_to', $user->facility_id)
            ->where('tracking.status', 'cancelled');

        if($keyword) {
            $data = $data->where(function($q) use ($keyword) {
                $q->where('patients.fname', 'like', "%$keyword%")
                    ->orwhere('patients.mname', 'like', "%$keyword%")
                    ->orwhere('patients.lname', 'like', "%$keyword%")
                    ->orwhere('tracking.code', 'like', "%$keyword%");
            });
        }

        if($start && $end) {
            $start = Carbon::parse($start)->startOfDay();
            $end = Carbon::parse($end)->endOfDay();
            $data = $data->whereBetween('tracking.updated_at', [$start, $end]);
        }

        $data = $data->orderBy('date_referred', 'asc')->paginate(15);

        return view('doctor.cancel', [
            'title' => 'Cancelled Patients',
            'data' => $data
        ]);
    }

    /**
     * Search cancelled patient
     */
    public function searchCancelled(Request $req)
    {
        $range = explode('-', str_replace(' ', '', $req->daterange));
        $tmp1 = explode('/', $range[0]);
        $tmp2 = explode('/', $range[1]);

        $start = $tmp1[2] . '-' . $tmp1[0] . '-' . $tmp1[1];
        $end = $tmp2[2] . '-' . $tmp2[0] . '-' . $tmp2[1];

        Session::put('startCancelledDate', $start);
        Session::put('endCancelledDate', $end);
        Session::put('keywordCancelled', $req->keyword);

        return redirect('/doctor/cancelled');
    }

    /**
     * Archieved Patients
     */
    function archived()
    {
        $user = Auth::user();
        $keyword = Session::get('keywordArchived');
        $start = Session::get('startArchivedDate');
        $end = Session::get('endArchivedDate');

        $data = Tracking::select(
            'tracking.id',
            'tracking.type',
            'tracking.code',
            'facility.name',
            DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), " "), patients.lname) as patient_name'),
            DB::raw("DATE_FORMAT(tracking.updated_at, '%M %d, %Y %h:%i %p') as date_accepted")
        )
            ->join('facility', 'facility.id', '=', 'tracking.referred_from')
            ->join('patients', 'patients.id', '=', 'tracking.patient_id')
            ->where('referred_to', $user->facility_id)
            ->where(function($q) {
                $q->where('tracking.status', 'referred')
                    ->orwhere('tracking.status', 'seen');
            })
            ->where(DB::raw("TIMESTAMPDIFF(MINUTE, tracking.date_referred,now())"), ">", 4320);

        if($keyword) {
            $data = $data->where(function($q) use ($keyword) {
                $q->where('patients.fname', 'like', "%$keyword%")
                    ->orwhere('patients.mname', 'like', "%$keyword%")
                    ->orwhere('patients.lname', 'like', "%$keyword%")
                    ->orwhere('tracking.code', 'like', "%$keyword%");
            });
        }

        if($start && $end) {
            $start = Carbon::parse($start)->startOfDay();
            $end = Carbon::parse($end)->endOfDay();
            $data = $data->whereBetween('tracking.updated_at', [$start, $end]);
        }
        $data = $data->orderBy('date_referred', 'desc')->paginate(15);

        return view('doctor.archive', [
            'title' => 'Archived Patients',
            'data' => $data
        ]);
    }

    /**
     * Search archieve patient
     */
    public function searchArchived(Request $req)
    {
        $range = explode('-', str_replace(' ', '', $req->daterange));
        $tmp1 = explode('/', $range[0]);
        $tmp2 = explode('/', $range[1]);

        $start = $tmp1[2] . '-' . $tmp1[0] . '-' . $tmp1[1];
        $end = $tmp2[2] . '-' . $tmp2[0] . '-' . $tmp2[1];

        Session::put('startArchivedDate', $start);
        Session::put('endArchivedDate', $end);
        Session::put('keywordArchived', $req->keyword);

        return redirect('/doctor/archived');
    }

    /**
     * Refer a patient
     */
    function referPatient(Request $req, $type)
    {
        $user = Auth::user();
        $patient_id = $req->patient_id;
        $user_code = str_pad($user->facility_id, 3, 0, STR_PAD_LEFT);

        $code = $req->code ? $req->code : date('ymd') . '-' . $user_code . '-' . date('His');

        $tracking_id = 0;
            
        if($req->source == 'tsekap') {
            $patient_id = self::importTsekap($req->patient_id, $req->patient_status, $req->phic_id, $req->phic_status);
        }

        $unique_id = $req->unique_id ? $req->unique_id : "$patient_id-$user->facility_id-" . date('ymdH');
        
        $match = array(
            'unique_id' => $unique_id
        );

        if($type === 'normal') {
            $case_summary = implode(" , ", $req->case_summary) || '';

            foreach ($req->diagnosis as $value) {
                $diagnosis .= $value . " ,";
            }

            Patients::where('id', $patient_id)
                ->update([
                    'sex' => $req->patient_sex,
                    'civil_status' => $req->civil_status,
                    'phic_status' => $req->phic_status,
                    'phic_id' => $req->phic_id
                ]);

            $data = array(
                'referring_facility' => $user->facility_id,
                'referred_to' => $req->referred_facility,
                'department_id' => $req->referred_department,
                'covid_number' => $req->covid_number,
                'refer_clinical_status' => $req->clinical_status,
                'refer_sur_category' => $req->sur_category,
                'time_referred' => date('Y-m-d H:i:s'),
                'time_transferred' => '',
                'patient_id' => $patient_id,
                // 'case_summary' => $case_summary,
                // 'reco_summary' => $req->reco_summary,
                // 'diagnosis' => $diagnosis,
                //'icd_code' => $req->icd_code,
                'reason' => $req->reason,
                'referring_md' => $user->id,
                'referred_md' => ($req->reffered_md) ? $req->reffered_md: 0,
            );

            $fac = Facility::find($user->facility_id);
            $referring_md = User::find($user->id);
            $fac_to = Facility::find($req->referred_facility);
            
            // event(new PreferredNotif($data,$fac,$referring_md,$fac_to));
            $form = PatientForm::updateOrCreate($match,$data);
            if($form->wasRecentlyCreated) {
                PatientForm::where('unique_id',$unique_id)
                    ->update([
                        'code' => $code
                    ]);

                $tracking_id = self::addTracking($code, $patient_id, $user, $req, $type, $form->id, 'refer');
            }
        } else if($type === 'pregnant') {

            $lmp = $req->lmp ? date('Ymd', strtotime($req->lmp)) : '';
            $edc_edd = date('Ymd', strtotime($req->edc_edd));

            $td1 = ($req->td1) ? date('Ymd', strtotime($req->td1)) : NULL;
            $td2 = ($req->td2) ? date('Ymd', strtotime($req->td1)) : NULL;
            $td3 = ($req->td3) ? date('Ymd', strtotime($req->td1)) : NULL;
            $td4 = ($req->td4) ? date('Ymd', strtotime($req->td1)) : NULL;
            $td5 = ($req->td5) ? date('Ymd', strtotime($req->td1)) : NULL;

            $data = array(
                'unique_id'             => $unique_id,
                'referring_facility'    => ($user->facility_id) ? $user->facility_id : NULL,
                'referred_by'           => ($user->id) ? $user->id : NULL,
                'record_no'             => ($req->record_no) ? $req->record_no : NULL,
                'referred_date'         => date('Y-m-d H:i:s'),
                'referred_to'           => ($req->referred_facility) ? $req->referred_facility : NULL,
                'department_id'         => ($req->referred_department) ? $req->referred_department : NULL,
                'covid_number'          => $req->covid_number,
                'health_worker'         => ($req->health_worker) ? $req->health_worker : NULL,
                'patient_woman_id'      => $patient_id,
                'gravidity'             => ($req->gravidity) ? $req->gravidity : NULL,
                'parity'                => ($req->parity || $req->parity == 0) ? $req->parity : NULL,
                'ftpal'                 => ($req->ftpal || $req->ftpal == 0) ? $req->ftpal : NULL,
                'bmi'                   => ($req->bmi) ? $req->bmi : NULL,
                'fundic_height'         => ($req->fundic_height) ? $req->fundic_height : NULL,
                'hr'                    => ($req->hr) ? $req->hr : NULL,
                'lmp'                   => ($lmp) ? $lmp : NULL,
                'edc_edd'               => ($edc_edd) ? $edc_edd : NULL,
                'height'                => ($req->height) ? $req->height : NULL,
                'weigth'                => ($req->weigth) ? $req->weigth : NULL,
                'bp'                    => ($req->bp) ? $req->bp : NULL,
                'temp'                  => ($req->temp) ? $req->temp : NULL,
                'rr'                    => ($req->rr) ? $req->rr : NULL,
                'td1'                   => ($td1) ? $td1 : NULL,
                'td2'                   => ($td2) ? $td2 : NULL,
                'td3'                   => ($td3) ? $td3 : NULL,
                'td4'                   => ($td4) ? $td4 : NULL,
                'td5'                   => ($td5) ? $td5 : NULL,
                'status'                => 1,
                'educ_attainment'       => ($req->educ_attainment) ? $req->educ_attainment : NULL,
                'family_income'         => ($req->family_income) ? $req->family_income : NULL,
                'religion'              => ($req->religion) ? $req->religion : NULL,
                'ethnicity'             => ($req->ethnicity) ? $req->ethnicity : NULL,
                'sibling_rank'          => ($req->sibling_rank) ? $req->sibling_rank : NULL,
                'out_of'                => ($req->out_of) ? $req->out_of : NULL,
            );

            $fac = Facility::find($user->facility_id);
            $referring_md = User::find($user->id);
            $fac_to = Facility::find($req->referred_facility);
            $status = $req->pregnant_status;
            
            $form = PregnantFormv2::Create($data);
            if($form->wasRecentlyCreated) {
                PregnantFormv2::where('unique_id', $unique_id)
                    ->update([
                        'code' => $code
                    ]);

                $tracking_id = self::addTracking($code, $patient_id, $user, $req, $type, $form->id);
            }

            $data1 = array(
                'unique_id'                 => $unique_id,
                'patient_woman_id'          => $patient_id,
                'hypertension'              => ($req->hypertension) ? $req->hypertension : NULL,
                'anemia'                    => ($req->anemia) ? $req->anemia : NULL,
                'malaria'                   => ($req->malaria) ? $req->malaria : NULL,
                'cancer'                    => ($req->cancer) ? $req->cancer : NULL,
                'allergies'                 => ($req->allergies) ? $req->allergies : NULL,
                'renal_disease'             => ($req->renal_disease) ? $req->renal_disease : NULL,
                'typhoid_disorders'         => ($req->typhoid_disorders) ? $req->typhoid_disorders : NULL,
                'hypo_hyper'                => ($req->hypo_hyper) ? $req->hypo_hyper : NULL,
                'tuberculosis'              => ($req->tuberculosis) ? $req->tuberculosis : NULL,
                'diabetes_mellitus'         => ($req->diabetes_mellitus) ? $req->diabetes_mellitus : NULL,
                'hepatatis_b'               => ($req->hepatatis_b) ? $req->hepatatis_b : NULL,
                'hiv_sti'                   => ($req->hiv_sti) ? $req->hiv_sti : NULL,
                'seizure_disorder'          => ($req->seizure_disorder) ? $req->seizure_disorder : NULL,
                'cardiovascular_disease'    => ($req->cardiovascular_disease) ? $req->cardiovascular_disease : NULL,
                'malnutrition'              => ($req->malnutrition) ? $req->malnutrition : NULL,
                'hemotilgic_disorder'       => ($req->hemotilgic_disorder) ? $req->hemotilgic_disorder : NULL,
                'substance_abuse'           => ($req->substance_abuse) ? $req->substance_abuse : NULL,
                'anti_phospholipid'         => ($req->anti_phospholipid) ? $req->anti_phospholipid : NULL,
                'restrictive_pulmonary'     => ($req->restrictive_pulmonary) ? $req->restrictive_pulmonary : NULL,
                'mental_retardation'        => ($req->mental_retardation) ? $req->mental_retardation : NULL,
                'habitual_abortion'         => ($req->habitual_abortion) ? $req->habitual_abortion : NULL,
                'fetus_congenital'          => ($req->fetus_congenital) ? $req->fetus_congenital : NULL,
                'previous_caesarean'        => ($req->previous_caesarean) ? $req->previous_caesarean : NULL,
                'preterm_delivery'          => ($req->preterm_delivery) ? $req->preterm_delivery : NULL,
                'subjective'                => ($req->ante_subjective) ? $req->ante_subjective : NULL,
                'bp'                        => ($req->ante_bp) ? $req->ante_bp : NULL,
                'temp'                      => ($req->ante_temp) ? $req->ante_temp : NULL,
                'hr'                        => ($req->ante_hr) ? $req->ante_hr : NULL,
                'rr'                        => ($req->ante_rr) ? $req->ante_rr : NULL,
                'fh'                        => ($req->ante_fh) ? $req->ante_fh : NULL,
                'fht'                       => ($req->ante_fht || $req->ante_fht == 0) ? $req->ante_fht : NULL,
                'others'                    => ($req->others) ? $req->others : NULL,
                'other_physical_exam'       => ($req->ante_other_physical_exam) ? $req->ante_other_physical_exam : NULL,
                'assessment_diagnosis'      => ($req->ante_assessment_diagnosis) ? $req->ante_assessment_diagnosis : NULL,
                'plan_intervention'         => ($req->ante_plan_intervention) ? $req->ante_plan_intervention : NULL,
            );

            $antepartum = Antepartum::Create($data1);
            if($antepartum->wasRecentlyCreated) {
                Antepartum::where('unique_id', $unique_id)
                    ->update([
                        'code' => $code
                    ]);
            }

            $date_of_visit = date('Y-m-d', strtotime($req->date_of_visit));
            $data2 = array(
                'unique_id'                 => $unique_id,
                'patient_woman_id'          => $patient_id,
                'no_trimester'              => ($req->no_trimester) ? $req->no_trimester : NULL,
                'no_visit'                  => ($req->no_visit) ? $req->no_visit : NULL,
                'date_of_visit'             => ($date_of_visit) ? $date_of_visit : NULL,
                'vaginal_spotting'          => ($req->vaginal_spotting) ? $req->vaginal_spotting : NULL,
                'severe_nausea'             => ($req->severe_nausea) ? $req->severe_nausea : NULL,
                'significant_decline'       => ($req->significant_decline) ? $req->significant_decline : NULL,
                'persistent_contractions'   => ($req->persistent_contractions) ? $req->persistent_contractions : NULL,
                'premature_rupture'         => ($req->premature_rupture) ? $req->premature_rupture : NULL,
                'fetal_pregnancy'           => ($req->fetal_pregnancy) ? $req->fetal_pregnancy : NULL,
                'severe_headache'           => ($req->severe_headache) ? $req->severe_headache : NULL,
                'abdominal_pain'            => ($req->abdominal_pain) ? $req->abdominal_pain : NULL,
                'edema_hands'               => ($req->edema_hands) ? $req->edema_hands : NULL,
                'fever_pallor'              => ($req->fever_pallor) ? $req->fever_pallor : NULL,
                'seizure_consciousness'     => ($req->seizure_consciousness) ? $req->seizure_consciousness : NULL,
                'difficulty_breathing'      => ($req->difficulty_breathing) ? $req->difficulty_breathing : NULL,
                'painful_urination'         => ($req->painful_urination) ? $req->painful_urination : NULL,
                'subjective'                => ($req->sign_subjective) ? $req->sign_subjective : NULL,
                'bp'                        => ($req->sign_bp) ? $req->sign_bp : NULL,
                'temp'                      => ($req->sign_temp) ? $req->sign_temp : NULL,
                'hr'                        => ($req->sign_hr) ? $req->sign_hr : NULL,
                'rr'                        => ($req->sign_rr) ? $req->sign_rr : NULL,
                'fh'                        => ($req->sign_fh) ? $req->sign_fh : NULL,
                'fht'                       => ($req->sign_fht) ? $req->sign_fht : NULL,
                'other_physical_exam'       => ($req->sign_other_physical_exam) ? $req->sign_other_physical_exam : NULL,
                'assessment_diagnosis'      => ($req->sign_assessment_diagnosis) ? $req->sign_assessment_diagnosis : NULL,
                'elevated_bp'               => ($req->elevated_bp) ? $req->elevated_bp : NULL,
                'plan_intervention'         => ($req->sign_plan_intervention) ? $req->sign_plan_intervention : NULL,
                'aog'                       => ($req->sign_aog) ? $req->sign_aog : NULL,
            );

            $signsymptoms = SignSymptoms::Create($data2);
            if($signsymptoms->wasRecentlyCreated) {
                SignSymptoms::where('unique_id', $unique_id)
                    ->update([
                        'code' => $code
                    ]);
            }
            
            // foreach ($req->date_of_lab as $key => $lab) {
            //     if($lab != null) {
            //         $date_of_lab = date('Ymd', strtotime($lab));
            //         $data3 = array(
            //             'unique_id' => $unique_id,
            //             'patient_woman_id' => $patient_id,
            //             'date_of_lab' => ($date_of_lab) ? $date_of_lab : NULL,
            //             'cbc_hgb' => ($req->cbc_hgb[$key]) ? $req->cbc_hgb[$key] : NULL,
            //             'cbc_wbc' => ($req->cbc_wbc[$key]) ? $req->cbc_wbc[$key] : NULL,
            //             'cbc_rbc' => ($req->cbc_rbc[$key]) ? $req->cbc_rbc[$key] : NULL,
            //             'cbc_platelet' => ($req->cbc_platelet[$key]) ? $req->cbc_platelet[$key] : NULL,
            //             'cbc_hct' => ($req->cbc_hct[$key]) ? $req->cbc_hct[$key] : NULL,
            //             'ua_pus' => ($req->ua_pus[$key]) ? $req->ua_pus[$key] : NULL,
            //             'ua_rbc' => ($req->ua_rbc[$key]) ? $req->ua_rbc[$key] : NULL,
            //             'ua_sugar' => ($req->ua_sugar[$key]) ? $req->ua_sugar[$key] : NULL,
            //             'ua_gravity' => ($req->ua_gravity[$key]) ? $req->ua_gravity[$key] : NULL,
            //             'ua_albumin' => ($req->ua_albumin[$key]) ? $req->ua_albumin[$key] : NULL,
            //             'utz' => ($req->utz[$key]) ? $req->utz[$key] : NULL,
            //             'blood_type' => ($req->blood_type) ? $req->blood_type : NULL,
            //             'hbsag_result' => ($req->hbsag_result) ? $req->hbsag_result : NULL,
            //             'vdrl_result' => ($req->vdrl_result) ? $req->vdrl_result : NULL,
            //             'lab_remarks' => ($req->lab_remarks[$key]) ? $req->lab_remarks[$key ]: NULL,
            //         );

            //         $lab_result = LabResult::Create($data3);
            //         if($lab_result->wasRecentlyCreated) {
            //             LabResult::where('unique_id', $unique_id)
            //                 ->update([
            //                     'code' => $code
            //                 ]);
            //         }
            //     } else {
            //         continue;
            //     }
            // }
              
            $data4 = array(
                'unique_id'         => $unique_id,
                'patient_woman_id'  => $patient_id,
                'bp_15'             => ($req->bp_15) ? $req->bp_15 : NULL,
                'bp_30'             => ($req->bp_30) ? $req->bp_30 : NULL,
                'bp_45'             => ($req->bp_45) ? $req->bp_45 : NULL,
                'bp_60'             => ($req->bp_60) ? $req->bp_60 : NULL,
                'bp_remarks'        => ($req->bp_remarks) ? $req->bp_remarks : NULL,
                'temp_15'           => ($req->temp_15) ? $req->temp_15 : NULL,
                'temp_30'           => ($req->temp_30) ? $req->temp_30 : NULL,
                'temp_45'           => ($req->temp_45) ? $req->temp_45 : NULL,
                'temp_60'           => ($req->temp_60) ? $req->temp_60 : NULL,
                'temp_remaks'       => ($req->temp_remaks) ? $req->temp_remaks : NULL,
                'hr_15'             => ($req->hr_15) ? $req->hr_15 : NULL,
                'hr_30'             => ($req->hr_30) ? $req->hr_30 : NULL,
                'hr_45'             => ($req->hr_45) ? $req->hr_45 : NULL,
                'hr_60'             => ($req->hr_60) ? $req->hr_60 : NULL,
                'hr_remarks'        => ($req->hr_remarks) ? $req->hr_remarks : NULL,
                'rr_15'             => ($req->rr_15) ? $req->rr_15 : NULL,
                'rr_30'             => ($req->rr_30) ? $req->rr_30 : NULL,
                'rr_45'             => ($req->rr_45) ? $req->rr_45 : NULL,
                'rr_60'             => ($req->rr_60) ? $req->rr_60 : NULL,
                'rr_remarks'        => ($req->rr_remarks) ? $req->rr_remarks : NULL,
                'o2sat_15'          => ($req->o2sat_15) ? $req->o2sat_15 : NULL,
                'o2sat_30'          => ($req->o2sat_30) ? $req->o2sat_30 : NULL,
                'o2sat_45'          => ($req->o2sat_45) ? $req->o2sat_45 : NULL,
                'o2sat_60'          => ($req->o2sat_45) ? $req->o2sat_45 : NULL,
                'o2sat_remaks'      => ($req->o2sat_remaks) ? $req->o2sat_remaks : NULL,
                'fht_15'            => ($req->fht_15) ? $req->fht_15 : NULL,
                'fht_30'            => ($req->fht_30) ? $req->fht_30 : NULL,
                'fht_45'            => ($req->fht_45) ? $req->fht_45 : NULL,
                'fht_60'            => ($req->fht_60) ? $req->fht_60 : NULL,
                'fht_remarks'       => ($req->fht_remarks) ? $req->fht_remarks : NULL,
            );

            $pregvitalsign = PregVitalSign::Create($data4);
            if($pregvitalsign->wasRecentlyCreated) {
                PregVitalSign::where('unique_id', $unique_id)
                    ->update([
                        'code' => $code
                    ]);
            }

            broadcast(new PregnantNotif($data, $fac, $referring_md, $fac_to, $status))->toOthers();
            
            Session::put("refer_patient", true);

            return Redirect::back();
        }

        Session::put("refer_patient", true);

        return array(
            'id' => $tracking_id,
            'patient_code' => $code,
            'referred_date' => date('M d, Y h:i A')
        );
    }

    /**
     * Function: Add Tracking
     */
    function addTracking($code, $patient_id, $user, $req, $type, $form_id, $status='')
    {
        $match = array(
            'code' => $code
        );

        $track = array(
            'patient_id' => $patient_id,
            'date_referred' => date('Y-m-d H:i:s'),
            'referred_from' => ($status=='walkin') ? $req->referring_facility_walkin : $user->facility_id,
            'referred_to' => ($status=='walkin') ? $user->facility_id : $req->referred_facility,
            'department_id' => $req->referred_department,
            'referring_md' => ($status=='walkin') ? 0 : $user->id,
            'action_md' => NULL,
            'type' => $type,
            'form_id' => $form_id,
            'remarks' => ($req->reason) ? $req->reason: '',
            'status' => ($status=='walkin') ? 'accepted' : 'referred',
            'walkin' => 'no',
            'pregnant_status' => ($req->pregnant_status) ? $req->pregnant_status: NULL,
        );

        if($status == 'walkin') {
            $track['date_seen'] = date('Y-m-d H:i:s');
            $track['date_accepted'] = date('Y-m-d H:i:s');
            $track['action_md'] = $user->id;
            $track['walkin'] = 'yes';
        }

        $tracking = Tracking::updateOrCreate($match, $track);

        $activity = array(
            'code' => $code,
            'patient_id' => $patient_id,
            'date_referred' => date('Y-m-d H:i:s'),
            'date_seen' => ($status == 'walkin') ? date('Y-m-d H:i:s') : NULL,
            'referred_from' => ($status=='walkin') ? $req->referring_facility_walkin : $user->facility_id,
            'referred_to' => ($status=='walkin') ? $user->facility_id : $req->referred_facility,
            'department_id' => $req->referred_department,
            'referring_md' => ($status=='walkin') ? 0 : $user->id,
            'action_md' => NULL,
            'remarks' => ($req->reason) ? $req->reason: '',
            'status' => 'referred'
        );

        Activity::create($activity);

        if($status == 'walkin') {
            $activity['date_seen'] = date('Y-m-d H:i:s');
            $activity['status'] = 'accepted';
            $activity['remarks'] = 'Walk-In Patient';
            $activity['action_md'] = $user->id;
            Activity::create($activity);
        }

        $tracking_id = $tracking->id;

        return $tracking_id;
    }

    /**
     * Get discharge date
     */
    static function getDischargeDate($status, $code)
    {
        $date = Activity::where('code', $code)
                    ->where('status', $status)
                    ->first();
        if($date)
            $date = $date->date_referred;
        else
            return false;

        return date('F d, Y h:i A', strtotime($date));
    }

    /**
     * Get cancellation reason
     */
    static function getCancellationReason($status, $code)
    {
        $act = Activity::where('code', $code)
                    ->where('status', $status)
                    ->first();
        if($act)
            return $act->remarks;
        return 'No Reason';
    }
}
