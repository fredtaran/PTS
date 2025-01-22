<?php

namespace App\Http\Controllers\doctor;

use Carbon\Carbon;
use App\Models\Seen;
use App\Models\User;
use App\Models\Activity;
use App\Models\Facility;
use App\Models\Feedback;
use App\Models\Tracking;
use App\Models\LabResult;
use App\Models\Antepartum;
use App\Models\PregOutcome;
use App\Models\PregnantForm;
use App\Models\SignSymptoms;
use Illuminate\Http\Request;
use App\Models\PregVitalSign;
use App\Models\PregnantFormv2;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ParamCtrl;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\DeviceTokenCtrl;

class ReferralCtrl extends Controller
{
    /**
     * Landing page
     */
    public function index(Request $request)
    {
        ParamCtrl::lastLogin();
        $keyword = '';
        $dept = '';
        $fac = '';
        $option = '';
      
        $user = Auth::user();
        $data = Tracking::select(
                    'tracking.*', 
                    DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), " "), patients.lname) as patient_name'),
                    DB::raw("TIMESTAMPDIFF(YEAR, patients.dob, CURDATE()) AS age"),
                    'patients.sex',
                    'facility.name as facility_name',
                    DB::raw('CONCAT(if(users.level = "doctor", "Dr. ", ""), users.fname, " ", IFNULL(CONCAT(users.mname, " "), ""), users.lname) as referring_md'),
                    DB::raw('CONCAT(action.fname, " ", IFNULL(CONCAT(users.mname, " "), ""), " ", action.lname) as action_md')
                )
                ->join('patients', 'patients.id', '=', 'tracking.patient_id')
                ->join('facility', 'facility.id', '=', 'tracking.referred_from')
                ->leftJoin('users', 'users.id', '=', 'tracking.referring_md')
                ->leftJoin('users as action', 'action.id', '=', 'tracking.action_md')
                ->where('referred_to', $user->facility_id);

        if($request->search) {
            $keyword = $request->search;
            $data = $data->where(function($q) use ($keyword) {
                $q->where('patients.lname', "$keyword")
                    ->orwhere('patients.fname', "$keyword")
                    ->orwhere('tracking.code', "$keyword");
            });
        }

        if($request->department_filter) {
            $dept = $request->department_filter;
            $data = $data->where('tracking.department_id', $dept);
        }

        if($request->facility_filter) {
            $fac = $request->facility_filter;
            $data = $data->where('tracking.referred_from', $fac);
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
            } else if ($option == 'accepted') {
                $data = $data->where(function($q){
                    $q->where('tracking.status', 'accepted');
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

        $data = $data->orderBy("tracking.date_referred", "desc")->paginate(15);

        return view('doctor.referral', [
            'title' => 'Incoming Patients',
            'data' => $data,
            'start' => $start,
            'end' => $end,
            'keyword' => $keyword,
            'department' => $dept,
            'facility' => $fac,
            'option' => $option
        ]);
    }
    
    /**
     * Count referral
     */
    static function countReferral()
    {
        $user = Auth::user();
        $count = Tracking::where('referred_to', $user->facility_id)
            ->where(function($q) {
                $q->where('status', 'referred')
                    ->orwhere('status', 'seen')
                    ->orWhere('status', 'transferred');
            })
            ->where(DB::raw("TIMESTAMPDIFF(MINUTE,date_referred,now())"), "<=", 4320)
            ->count();
        return $count;
    }

    /**
     * Pregnant Form v2
     */
    static function pregnantFormv2($id)
    {
        $form = PregnantFormv2::select(
                DB::raw("'$id' as tracking_id"),
                'pregnant_formv2.code',
                'pregnant_formv2.unique_id',
                'pregnant_formv2.record_no',
                'pregnant_formv2.lmp',
                DB::raw("DATE_FORMAT(pregnant_formv2.referred_date,'%M %d, %Y %h:%i %p') as referred_date"),
                DB::raw("DATE_FORMAT(pregnant_formv2.referred_date,'%M %d, %Y') as referred_date_name"),
                DB::raw("DATE_FORMAT(pregnant_formv2.arrival_date,'%M %d, %Y %h:%i %p') as arrival_date"),
                DB::raw("DATE_FORMAT(pregnant_formv2.arrival_date,'%M %d, %Y') as arrival_date_name"),
                DB::raw('CONCAT(
                    if(users.level = "doctor", "Dr. ", ""), users.fname, " ", users.mname, " ", users.lname) as md_referring'),
                    'facility.name as referring_facility_name',
                    'b.description as facility_brgy',
                    'm.description as facility_muncity',
                    'p.description as facility_province',
                    'ff.name as referred_facility',
                    'bb.description as ff_brgy',
                    'mm.description as ff_muncity',
                    'pp.description as ff_province',
                    'pregnant_formv2.health_worker',
                    'pregnant_formv2.educ_attainment',
                    'pregnant_formv2.family_income',
                    'patients.civil_status as woman_status',
                    'patients.phic_id as phic_id',
                    'patients.contact as contact',
                DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), " "), patients.lname) as woman_name'),
                DB::raw("TIMESTAMPDIFF(YEAR, patients.dob, CURDATE()) AS woman_age"),
                'patients.sex',
                DB::raw("DATE_FORMAT(patients.dob, '%M %d, %Y') as bday"),
                'barangay.description as patient_brgy',
                'muncity.description as patient_muncity',
                'province.description as patient_province',
                'facility.contact as referring_contact',
                'facility.license_no as referring_license_no',
                'ff.contact as referred_contact',
                'users.contact as referring_md_contact',
                'department.description as department',
                'pregnant_formv2.covid_number',
                'pregnant_formv2.religion',
                'pregnant_formv2.ethnicity',
                'pregnant_formv2.sibling_rank',
                'pregnant_formv2.out_of',
                DB::raw("DATE_FORMAT(pregnant_formv2.lmp, '%M %d, %Y') as patient_lmp"),
                DB::raw("DATE_FORMAT(pregnant_formv2.edc_edd, '%M %d, %Y') as patient_edc_edd"),
                DB::raw("DATE_FORMAT(pregnant_formv2.td1, '%M %d, %Y') as patient_td1"),
                DB::raw("DATE_FORMAT(pregnant_formv2.td2, '%M %d, %Y') as patient_td2"),
                DB::raw("DATE_FORMAT(pregnant_formv2.td3, '%M %d, %Y') as patient_td3"),
                DB::raw("DATE_FORMAT(pregnant_formv2.td4, '%M %d, %Y') as patient_td4"),
                DB::raw("DATE_FORMAT(pregnant_formv2.td5, '%M %d, %Y') as patient_td5"),
                'pregnant_formv2.*',
            )
            ->leftJoin('patients', 'patients.id', '=', 'pregnant_formv2.patient_woman_id')
            ->leftJoin('tracking', 'tracking.form_id', '=', 'pregnant_formv2.id')
            ->leftJoin('facility', 'facility.id', '=', 'tracking.referred_from')
            ->leftJoin('facility as ff', 'ff.id', '=', 'tracking.referred_to')
            ->leftJoin('users', 'users.id', '=', 'pregnant_formv2.referred_by')
            ->leftJoin('barangay', 'barangay.id', '=', 'patients.brgy')
            ->leftJoin('muncity', 'muncity.id', '=', 'patients.muncity')
            ->leftJoin('province', 'province.id', '=', 'patients.province')
            ->leftJoin('barangay as b', 'b.id', '=', 'facility.brgy')
            ->leftJoin('muncity as m', 'm.id', '=', 'facility.muncity')
            ->leftJoin('province as p', 'p.id', '=', 'facility.province')
            ->leftJoin('barangay as bb', 'bb.id', '=', 'ff.brgy')
            ->leftJoin('muncity as mm', 'mm.id', '=', 'ff.muncity')
            ->leftJoin('province as pp', 'pp.id', '=', 'ff.province')
            ->leftJoin('department', 'department.id', '=', 'pregnant_formv2.department_id')
            ->where('tracking.id', $id)
            ->first();

            $activity = Activity::select('activity.*', 'facility.name', 'facility.contact')->where('activity.code', $form->code)
                        ->leftJoin('facility', 'facility.id', '=', 'activity.referred_to')
                        ->where('activity.status', '!=', 'referred')
                        ->orderby('activity.id', 'desc')
                        ->first();

            $status_on_er = Activity::select('activity.status_on_er')->where('activity.code', $form->code)
                        ->leftJoin('facility', 'facility.id', '=', 'activity.referred_to')
                        ->where('activity.status', 'accepted')
                        ->orderby('activity.id', 'desc')
                        ->first();

            $antepartum = Antepartum::select('*')->where('antepartum_conditions.unique_id', $form->unique_id)->orderby('id', 'desc')->first();
            $sign_symptoms  = SignSymptoms::select('*')->where('sign_and_symptoms.unique_id', $form->unique_id)->orderby('id', 'desc')->first();

            $lab = LabResult::select('*')->where('unique_id', $form->unique_id)->wherenotnull('blood_type')->latest()->first();

            $lab_result = LabResult::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_lab, '%M %d, %Y') as date_of_lab_name"),
                'date_of_lab',
                )
            ->where('lab_results.unique_id', $form->unique_id)->latest()->take(5)->get();

            $lab_result_old = LabResult::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_lab, '%M %d, %Y') as date_of_lab_name"),
                'date_of_lab',
                )
            ->where('lab_results.unique_id', $form->unique_id)->oldest()->take(1)->get();


            $preg_vs = PregVitalSign::select('*')->where('preg_vital_signs.unique_id', $form->unique_id)->first();
            $preg_outcome = PregOutcome::select('*')->where('preg_outcome.unique_id', $form->unique_id)->orderby('id', 'desc')->first();

            $first_tri = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '1st')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)
            ->orderby('id', 'desc')
            ->first();

            $second_tri = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '2nd')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)
            ->orderby('id', 'desc')
            ->first();

            $third_tri = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '3rd')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)
            ->orderby('id', 'desc')
            ->first();

            $first_tri_visit = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '1st')
            ->where('no_visit', '1st')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)
            ->orderby('id', 'desc')
            ->first();

            $second_tri_visit = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '1st')
            ->where('no_visit', '2nd')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)     
            ->orderby('id', 'desc')        
            ->first();

            $third_tri_visit = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '1st')
            ->where('no_visit', '3rd')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)      
            ->orderby('id', 'desc')       
            ->first();

            $fourth_tri_visit = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '1st')
            ->where('no_visit', '4th')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)       
            ->orderby('id', 'desc')      
            ->first();

            $fifth_tri_visit = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '1st')
            ->where('no_visit', '5th')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)     
            ->orderby('id', 'desc')        
            ->first();

            $first_tri_visit_2nd = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '2nd')
            ->where('no_visit', '1st')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)      
            ->orderby('id', 'desc')       
            ->first();

            $second_tri_visit_2nd = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '2nd')
            ->where('no_visit', '2nd')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)             
            ->orderby('id', 'desc')
            ->first();

            $third_tri_visit_2nd = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '2nd')
            ->where('no_visit', '3rd')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)     
            ->orderby('id', 'desc')        
            ->first();

            $fourth_tri_visit_2nd = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '2nd')
            ->where('no_visit', '4th')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)    
            ->orderby('id', 'desc')         
            ->first();

            $fifth_tri_visit_2nd = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '2nd')
            ->where('no_visit', '5th')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)
            ->orderby('id', 'desc')             
            ->first();

            $first_tri_visit_3rd = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '3rd')
            ->where('no_visit', '1st')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)       
            ->orderby('id', 'desc')      
            ->first();

            $second_tri_visit_3rd = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '3rd')
            ->where('no_visit', '2nd')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)             
            ->orderby('id', 'desc')
            ->first();

            $third_tri_visit_3rd = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '3rd')
            ->where('no_visit', '3rd')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)           
            ->orderby('id', 'desc')  
            ->first();

            $fourth_tri_visit_3rd = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '3rd')
            ->where('no_visit', '4th')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)     
            ->orderby('id', 'desc')        
            ->first();

            $fifth_tri_visit_3rd = SignSymptoms::select(
                '*',
                DB::raw("DATE_FORMAT(date_of_visit, '%M %d, %Y') as date_of_visit"),
            )
            ->where('no_trimester', '3rd')
            ->where('no_visit', '5th')
            ->where('sign_and_symptoms.unique_id', $form->unique_id)
            ->orderby('id', 'desc')
            ->first();
            
        return array(
            'form'                  => $form,
            'activity'              => $activity,
            'status_on_er'          => $status_on_er,
            'antepartum'            => $antepartum,
            'sign_symptoms'         => $sign_symptoms, 
            'lab_result_old'        => $lab_result_old,
            'lab_result'            => $lab_result,
            'preg_vs'               => $preg_vs,
            'preg_outcome'          => $preg_outcome,
            'first_tri_visit'       => $first_tri_visit,
            'second_tri_visit'      => $second_tri_visit,
            'third_tri_visit'       => $third_tri_visit,
            'fourth_tri_visit'      => $fourth_tri_visit,
            'fifth_tri_visit'       => $fifth_tri_visit,
            'first_tri_visit_2nd'   => $first_tri_visit_2nd,
            'second_tri_visit_2nd'  => $second_tri_visit_2nd,
            'third_tri_visit_2nd'   => $third_tri_visit_2nd,
            'fourth_tri_visit_2nd'  => $fourth_tri_visit_2nd,
            'fifth_tri_visit_2nd'   => $fifth_tri_visit_2nd,
            'first_tri_visit_3rd'   => $first_tri_visit_3rd,
            'second_tri_visit_3rd'  => $second_tri_visit_3rd,
            'third_tri_visit_3rd'   => $third_tri_visit_3rd,
            'fourth_tri_visit_3rd'  => $fourth_tri_visit_3rd,
            'fifth_tri_visit_3rd'   => $fifth_tri_visit_3rd,
            'first_tri'             => $first_tri,
            'second_tri'            => $second_tri,
            'third_tri'             => $third_tri,
            'lab'                   => $lab,
        );
    }

    /**
     * Discharge patient
     */
    public function discharge2(Request $req, $track_id, $unique_id)
    {
        $user = Auth::user();
        $date = date('Y-m-d H:i:s', strtotime($req->date_time));

        $track = Tracking::find($track_id);
        $track->update([
            'status' => 'discharged'
        ]);

        $final_diagnosis = '';

        foreach ($req->final_diagnosis as $value) {
            $final_diagnosis .= $value . ", ";
        }

        $final_diagnosis = substr($final_diagnosis, 0, -2);

        $data = array(
            'unique_id' => $unique_id,
            'code' => $track->code,
            'patient_woman_id' => $track->patient_id,
            'birth_attendant' => $req->birth_attendant,
            'delivery_outcome' => $req->delivery_outcome,
            'type_of_delivery' => $req->type_of_delivery,
            'final_diagnosis' => $final_diagnosis,
            'status_on_discharge' => $req->status_on_discharge,
            'discharge_diagnosis' => $req->discharge_diagnosis,
            'discharge_instruction' => $req->discharge_instruction,
        );

        PregOutcome::create($data);

        $data = array(
            'code' => $track->code,
            'patient_id' => $track->patient_id,
            'date_referred' => $date,
            'referred_from' => $track->referred_to,
            'referred_to' => 0,
            'action_md' => $user->id,
            'department_id' => $track->department_id,
            'referring_md' => $track->referring_md,
            'remarks' => $req->remarks,
            'status' => 'discharged'
        );

        Activity::create($data);

        $hosp = Facility::find($user->facility_id)->name;
        $msg = "$track->code discharged from $hosp.";
        DeviceTokenCtrl::send('Discharged', $msg, $track->referred_from);
        return date('M d, Y h:i A', strtotime($date));
    }

    /**
     * Referred Patients
     */
    public function referred(Request $request)
    {
        ParamCtrl::lastLogin();
        $search = $request->search;
        $option_filter = $request->option_filter;
        $date = $request->date_range;
        $facility_filter = $request->facility_filter;
        $department_filter = $request->department_filter;

        $start = Carbon::now()->startOfYear()->format('m/d/Y');
        $end = Carbon::now()->endOfYear()->format('m/d/Y');

        if($request->referredCode) {
            ParamCtrl::lastLogin();
            $data = Tracking::select(
                'tracking.*',
                DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), " "), patients.lname) as patient_name'),
                DB::raw("TIMESTAMPDIFF(YEAR, patients.dob, CURDATE()) AS age"),
                DB::raw('CONCAT(users.fname, " ", IFNULL(CONCAT(users.mname, " "), ""), users.lname) as referring_md'),
                'patients.sex',
                'facility.name as facility_name',
                'facility.id as facility_id',
                'facility.license_no as referring_license_no',
                'patients.id as patient_id',
                'patients.contact',
                'users.level as user_level'
            )
            ->join('patients', 'patients.id', '=', 'tracking.patient_id')
            ->join('facility', 'facility.id', '=', 'tracking.referred_to')
            ->leftJoin('users', 'users.id', '=', 'tracking.referring_md')
            ->where('tracking.code', $request->referredCode)
            ->orderBy('date_referred', 'desc')
            ->paginate(10);
        } else {
            $user = Auth::user();
            $data = Tracking::select(
                'tracking.*',
                DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), " "), patients.lname) as patient_name'),
                DB::raw("TIMESTAMPDIFF(YEAR, patients.dob, CURDATE()) AS age"),
                DB::raw('COALESCE(CONCAT(users.fname, " ", IFNULL(CONCAT(users.mname, " "), ""), users.lname), "WALK IN") as referring_md'),
                'patients.sex',
                'facility.name as facility_name',
                'facility.id as facility_id',
                'facility.license_no as referring_license_no',
                'patients.id as patient_id',
                'patients.contact',
                'users.level as user_level'
            )
            ->join('patients', 'patients.id', '=', 'tracking.patient_id')
            ->join('facility', 'facility.id', '=', 'tracking.referred_to')
            ->leftJoin('users', 'users.id', '=', 'tracking.referring_md')
            ->where('referred_from', $user->facility_id)
            ->where(function($q) {
                $q->where('tracking.status', 'referred')
                    ->orwhere('tracking.status', 'seen')
                    ->orwhere('tracking.status', 'accepted')
                    ->orwhere('tracking.status', 'arrived')
                    ->orwhere('tracking.status', 'admitted')
                    ->orwhere('tracking.status', 'transferred')
                    ->orwhere('tracking.status', 'discharged')
                    ->orwhere('tracking.status', 'cancelled')
                    ->orwhere('tracking.status', 'archived')
                    ->orwhere('tracking.status', 'rejected')
                    ->orwhere('tracking.status', 'monitored');
            });

            if($search) {
                $data = $data->where(function($q) use ($search) {
                    $q->where('patients.fname', 'like', "%$search%")
                        ->orwhere('patients.mname', 'like', "%$search%")
                        ->orwhere('patients.lname', 'like', "%$search%")
                        ->orwhere('tracking.code', 'like', "%$search%");
                });
            }

            if($option_filter) {
                $data = $data->where('tracking.status', $option_filter);
            }

            if($facility_filter) {
                $data = $data->where('tracking.referred_to', $facility_filter);
            }

            if($department_filter) {
                $data = $data->where('tracking.department_id', $department_filter);
            }

            if($date) {
                $range = explode('-', str_replace(' ', '', $date));
                $start = $range[0];
                $end = $range[1];
            }

            $start_date = Carbon::parse($start)->startOfDay();
            $end_date = Carbon::parse($end)->endOfDay();

            $data = $data->whereBetween('tracking.date_referred', [$start_date, $end_date]);

            $data = $data->orderBy('date_referred', 'desc')->paginate(10);
        }
        
        return view('doctor.referred2', [
            'title' => 'Referred Patients',
            'data' => $data,
            'start' => $start,
            'end' => $end,
            'referredCode' => $request->referredCode,
            'search' => $search,
            'option_fitler' => $option_filter,
            'facility_filter' => $facility_filter,
            'department_filter' => $department_filter
        ]);
    }

    /**
     * Check for cancellation
     */
    static function checkForCancellation($code)
    {
        $check = Activity::where('code',$code)
                            ->where(function($q) {
                                $q->where('status','arrived')
                                    ->orwhere('status','admitted')
                                    ->orwhere('status','discharged')
                                    ->orwhere('status','cancelled')
                                    ->orwhere('status','archived')
                                    ->orwhere('status','accepted')
                                    ->orwhere('status','transferred');
                            })
                            ->first();
        if($check) {
            return true;
        }

        return false;
    }

    /**
     * Step
     */
    static function step($code)
    {
        $step = 0;

        $seen = Tracking::where('code', $code)
                        ->whereNotNull('date_seen')
                        ->first();

        if(self::hasStatus('referred', $code))
            $step = 1;
        if($seen)
            $step = 2;
        if(self::hasStatus('accepted', $code))
            $step = 3;
        if(self::hasStatus('arrived', $code))
            $step = 4;
        if(self::hasStatus('admitted', $code))
            $step = 5;
        if(self::hasStatus('monitored', $code))
            $step = 5.1;
        if(self::hasStatus('discharged', $code))
            $step = 6;
        if(self::hasStatus('cancelled', $code))
            $step = 0;
        if(self::hasStatus('archived', $code))
            $step = 4.5;

        return $step;
    }

    /**
     * Check if hasStatus
     */
    static function hasStatus($status, $code)
    {
        $check = Activity::where('code', $code)
                        ->where('status', $status)
                        ->first();
        if($check) {
            return true;
        }

        return false;
    }

    /**
     * Track referrals
     */
    public function trackReferral(Request $request)
    {
        $code = $request->referredCode;

        ParamCtrl::lastLogin();
        $data = Tracking::select(
            'tracking.*',
            DB::raw('CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), " "), patients.lname) as patient_name'),
            DB::raw("TIMESTAMPDIFF(YEAR, patients.dob, CURDATE()) AS age"),
            DB::raw('CONCAT(users.fname, " ", users.mname, " ", users.lname) as referring_md'),
            'patients.sex',
            'facility.name as facility_name',
            'facility.id as facility_id',
            'patients.id as patient_id',
            'patients.contact')->join('patients', 'patients.id', '=', 'tracking.patient_id')
                                ->join('facility', 'facility.id', '=', 'tracking.referred_to')
                                ->leftJoin('users', 'users.id', '=', 'tracking.referring_md')
                                ->where('tracking.code', $code)
                                ->orderBy('date_referred', 'desc')
                                ->paginate(10);

        return view('doctor.tracking', [
            'title' => 'Track Patients',
            'data' => $data,
            'code' => $code
        ]);
    }

    /**
     * 34 weeks report
     */
    public function week34(Request $req, $notif_id)
    {
       
        $user = Auth::user();

        $data = PregnantFormv2::selectRaw('
            t2.maxid as notif_id, 
            ROUND(DATEDIFF(CURDATE(), pregnant_formv2.lmp) / 7, 2) as now, 
            pregnant_formv2.lmp, 
            t2.maxaog,CONCAT(patients.fname, " ", IFNULL(CONCAT(patients.mname, " "), " "), patients.lname) as woman_name,
            tracking.id as id, 
            tracking.*, 
            tracking.code as patient_code, 
            CONCAT(action.fname, " ", action.mname, " ", action.lname) as action_md'
        )
        ->leftJoin(DB::raw('(SELECT *, max(id) as maxid, max(aog) as maxaog, max(unique_id) as maxunique_id FROM sign_and_symptoms A group by id, code, patient_woman_id, no_trimester, no_visit, date_of_visit, vaginal_spotting, severe_nausea, significant_decline, premature_rupture, fetal_pregnancy, severe_headache, abdominal_pain, edema_hands, fever_pallor, seizure_consciousness, difficulty_breathing, painful_urination, updated_at, created_at, subjective, bp, temp, hr, rr, fh, fht, other_physical_exam, assessment_diagnosis, elevated_bp, plan_intervention, aog, persistent_contractions, unique_id) AS t2'), function($join) {
            $join->on('pregnant_formv2.unique_id', '=', 't2.maxunique_id');
        })
        ->join('tracking', 'pregnant_formv2.code', '=', 'tracking.code')
        ->leftJoin('patients', 'patients.id', '=', 'pregnant_formv2.patient_woman_id')
        ->leftJoin('users as action', 'action.id', '=', 'tracking.action_md')
        ->whereRaw('ROUND(t2.maxaog, 0) >= 34')
        ->where('tracking.referred_to', $user->facility_id)
        ->where('tracking.status', '!=', 'referred')
        ->orderBy('t2.maxid', 'desc')
        ->distinct();
      
        if($req->search) {
            $keyword = $req->search;
            $data = $data->where(function($q) use ($keyword) {
                $q->where('patients.lname', "like", "%$keyword%")
                    ->orwhere('patients.fname', "like", "%$keyword%")
                    ->orwhere('tracking.code', "like", "%$keyword%");
            });
        }

        if($notif_id > 0) {
           $find = Tracking::select('*')->where('code', $notif_id);

            if($find) {
                $find->update([
                    'notif' => 0,
                    'un_notif' => date("Y/m/d h:i:sa")
                ]);
            }
               
            // $keyword = $notif_id;
            $data = $data->where('tracking.code',$notif_id);
        }

        if($req->date_range) {
            $date = $req->date_range;
            $range = explode('-', str_replace(' ', '', $date));
            $start = $range[0];
            $end = $range[1];
        } else {
            $start = Carbon::now()->startOfYear()->format('m/d/Y');
            $end = Carbon::now()->endOfYear()->format('m/d/Y');
        }

        $data = $data->paginate(15);

        // dd($data);

        return view('doctor.aogweeks', [
            "data" => $data,
            'keyword' => $req->search,
            'start' => $start,
            'end' => $end
        ]);
    }

    /**
     * Form is seen
     */
    public function seenBy($track_id)
    {
        $user = Auth::user();
        $data = array(
            'tracking_id' => $track_id,
            'facility_id' => $user->facility_id,
            'user_md' => $user->id
        );

        Tracking::find($track_id)->update([
           "date_seen" => date("Y-m-d H:i:s")
        ]);
        /*$code = Tracking::find($track_id)->code;
        $facility = Tracking::find($track_id)->referred_from;
        $hospital = Facility::find($user->facility_id)->name;
        $name = User::find($user->id);
        $doctor = ucwords(mb_strtolower($name->fname))." ".ucwords(mb_strtolower($name->lname));

        DeviceTokenCtrl::send('Referral Seen',"Referral code $code seen by Dr. $doctor of $hospital",$facility);*/
        Seen::firstOrCreate($data);
    }

    /**
     * List of users who seen the form
     */
    public function seenByList($track_id)
    {
        $data = Seen::select(
            DB::raw('CONCAT(users.fname, " ", IFNULL(CONCAT(users.mname, " "), " "), users.lname) as user_md'),
            DB::raw("DATE_FORMAT(seen.created_at, '%M %d, %Y %h:%i %p') as date_seen"),
            'users.contact'
        )
        ->join('users', 'users.id', '=', 'seen.user_md')
        ->where('seen.tracking_id', $track_id)
        ->orderBy('seen.created_at', 'desc')
        ->get();
        
        return $data;
    }

    /**
     * Request for contact
     */
    public function calling($track_id)
    {
        $user = Auth::user();
        $date = date('Y-m-d H:i:s');
        $track = Tracking::find($track_id);
        $data = array(
            'code' => $track->code,
            'patient_id' => $track->patient_id,
            'date_referred' => $date,
            'referred_from' => $track->referred_from,
            'referred_to' => $track->referred_to,
            'action_md' => $user->id,
            'remarks' => 'N/A',
            'status' => 'calling',
            'department_id' => $user->department_id,
            'referring_md' => $track->referring_md
        );
        $activity = Activity::create($data);

        $doc = User::find($user->id);
        $name = ucwords(mb_strtolower($doc->fname)) . " " . ucwords(mb_strtolower($doc->lname));
        $referred_name = User::select(DB::raw('CONCAT(if(level = "doctor", "Dr. ", ""), fname, " ", IFNULL(CONCAT(mname, " "), " "), lname) as referring_md'))
            ->where('id', $activity->referring_md)
            ->first();
        $hosp = Facility::find($track->referred_to)->name;
        $msg = "Dr. $name of $hosp is requesting a call regarding on $track->code. Please contact this number $doc->contact";
        //DeviceTokenCtrl::send('Requesting a Call',$msg,$track->referred_from);

        return array(
            'date' => date('M d, Y h:i A', strtotime($date)),
            'activity_id' => $activity->id,
            'referring_md' => $referred_name->referring_md
        );
    }

    /**
     * Get list of call requestee
     */
    public function callerByList($track_id)
    {
        $data = Tracking::select(
            DB::raw("CONCAT('Dr. ', users.fname, ' ', IFNULL(CONCAT(mname, ' '), ' '), users.lname) as user_md"),
            DB::raw("DATE_FORMAT(activity.created_at, '%M %d, %Y %h:%i %p') as date_call"),
            "users.contact"
        )
        ->join("activity", "activity.code", "=", "tracking.code")
        ->join("users", "users.id", "=", "activity.action_md")
        ->where('tracking.id', $track_id)
        ->where("activity.status", "=", "calling")
        ->get();

        return $data;
    }

    /**
     * Feedback
     */
    public function feedback($code)
    {
        $data = Feedback::select(
                    'feedback.id as id',
                    'feedback.sender as sender',
                    'feedback.message',
                    'users.fname as fname',
                    'users.lname as lname',
                    'facility.name as facility',
                    'facility.abbr as abbr',
                    'feedback.created_at as date'
                )
                ->leftJoin('users', 'users.id', '=', 'feedback.sender')
                ->leftJoin('facility', 'facility.id', '=', 'users.facility_id')
                ->where('code', $code)
                ->orderBy("id", "asc")
                ->get();

        return view('doctor.feedback', [
            'data' => $data
        ]);
    }

    /**
     * Save feedback
     */
    public function saveFeedback(Request $req)
    {
        $user = Auth::user();

        $data = array(
            'code'=> $req->code,
            'sender'=> $user->id,
            'receiver'=> 0,
            'message'=> $req->message,
        );

        $f = Feedback::create($data);

        $doc = User::find($user->id);
        $name = ucwords(mb_strtolower($doc->fname)) . " " . ucwords(mb_strtolower($doc->lname));

        return view('doctor.feedback_append', [
            "name" => $name,
            "message" => $req->message
        ]);
    }

    /**
     * Accept referral
     */
    public function accept(Request $req, $track_id)
    {
        $user = Auth::user();

        $track = Tracking::find($track_id);
        dd($track);
        if($track->status == 'accepted' || $track->status == 'rejected') {
            Session::put('incoming_denied', true);
            return 'denied';
        }

        Tracking::where('id', $track_id)
            ->update([
                'status' => 'accepted',
                'action_md' => $user->id,
                'date_accepted' => date('Y-m-d H:i:s')
            ]);

        $track = Tracking::find($track_id);
        $data = array(
            'code' => $track->code,
            'patient_id' => $track->patient_id,
            'date_referred' => date('Y-m-d H:i:s'),
            'referred_from' => $track->referred_from,
            'referred_to' => $user->facility_id,
            'department_id' => $track->department_id,
            'referring_md' => $track->referring_md,
            'action_md' => $user->id,
            'remarks' => isset($req->remarks) ? $req->remarks : "",
            'status_on_er' => isset($req->status_on_er) ? $req->status_on_er : "",
            'status' => $track->status
        );
        Activity::create($data);

        return $track_id;
    }

    /**
     * Step v2
     */
    static function step_v2($status){
        $step = 0;
        if($status == 'referred')
            $step = 1;
        elseif($status == 'seen')
            $step = 2;
        elseif($status == 'accepted')
            $step = 3;
        elseif($status == 'arrived')
            $step = 4;
        elseif($status == 'admitted')
            $step = 5;
        elseif($status == 'monitored')
            $step = 5.1;
        elseif($status == 'discharged')
            $step = 6;
        elseif($status == 'transferred')
            $step = 6;
        elseif($status == 'cancelled')
            $step = 0;
        elseif($status == 'archived')
            $step = 4.5;

        return $step;
    }

    /**
     * Patient arrived
     */
    public function arrive(Request $req, $track_id)
    {
        $user = Auth::user();
        $date = date('Y-m-d H:i:s');
        $track = Tracking::find($track_id);
        $data = array(
            'code' => $track->code,
            'patient_id' => $track->patient_id,
            'date_referred' => $date,
            'referred_from' => $track->referred_to,
            'referred_to' => $user->facility_id,
            'action_md' => $user->id,
            'department_id' => $track->department_id,
            'referring_md' => $track->referring_md,
            'remarks' => $req->remarks,
            'status' => 'arrived'
        );
        Activity::create($data);

        Tracking::where("id", $track_id)
                ->update([
                    'date_arrived' => $date,
                    'status' => 'arrived'
                ]);
        PregnantForm::where('id', $track->form_id)
                ->update([
                    'arrival_date' => $date
                ]);

        $hosp = Facility::find($user->facility_id)->name;
        $msg = "$track->code arrived at $hosp.";
        DeviceTokenCtrl::send('Arrived', $msg, $track->referred_from);

        return date('M d, Y h:i A', strtotime($date));
    }

    /**
     * Patient admitted
     */
    public function admit(Request $req, $track_id)
    {
        $user = Auth::user();
        $date = date('Y-m-d H:i:s', strtotime($req->date_time));
        $track = Tracking::find($track_id);
        $data = array(
            'code' => $track->code,
            'patient_id' => $track->patient_id,
            'date_referred' => $date,
            'referred_from' => $track->referred_to,
            'referred_to' => $user->facility_id,
            'action_md' => $user->id,
            'department_id' => $track->department_id,
            'referring_md' => $track->referring_md,
            'remarks' => 'admitted',
            'status' => 'admitted'
        );
        Activity::create($data);

        Tracking::where('id', $track_id)
            ->update([
                'status' => 'admitted'
            ]);

        $hosp = Facility::find($user->facility_id)->name;
        $msg = "$track->code admitted at $hosp.";
        DeviceTokenCtrl::send('Admitted', $msg, $track->referred_from);

        return date('M d, Y h:i A', strtotime($date));
    }

    /**
     * Archive patient
     */
    public function archive(Request $req, $track_id)
    {
        $user = Auth::user();
        $date = date('Y-m-d H:i:s');
        $track = Tracking::find($track_id);
        $data = array(
            'code' => $track->code,
            'patient_id' => $track->patient_id,
            'date_referred' => $date,
            'referred_from' => $track->referred_to,
            'referred_to' => 0,
            'action_md' => $user->id,
            'department_id' => $track->department_id,
            'referring_md' => $track->referring_md,
            'remarks' => $req->remarks,
            'status' => 'archived'
        );
        Activity::create($data);

        Tracking::where("id",$track_id)
                ->update([
                    'date_arrived' => $date,
                    'status' => 'archived'
                ]);
        PregnantForm::where('id',$track->form_id)
                ->update([
                    'arrival_date' => $date
                ]);

        return date('M d, Y h:i A', strtotime($date));
    }
}
