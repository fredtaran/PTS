<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PregnantFormv2;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PregnantCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index (Request $req)
    {
        $user = Auth::user();
        $keyword = null;

        $data = PregnantFormv2::selectRaw('t2.maxid as notif_id, ROUND(DATEDIFF(CURDATE(), pregnant_formv2.lmp) / 7, 2) as now, pregnant_formv2.lmp, t2.maxaog, CONCAT(patients.fname, " ", patients.mname, " ", patients.lname) as woman_name, tracking.id as id, tracking.*, tracking.code as patient_code, CONCAT(action.fname, " ", action.mname, " ", action.lname) as action_md')
        ->leftJoin(DB::raw('(SELECT *, max(id) as maxid, max(aog) as maxaog, max(unique_id) as maxunique_id FROM sign_and_symptoms A GROUP BY unique_id, id, code, patient_woman_id, no_trimester, no_visit, date_of_visit, vaginal_spotting, severe_nausea, significant_decline, premature_rupture, fetal_pregnancy, severe_headache, abdominal_pain, edema_hands, fever_pallor, seizure_consciousness, difficulty_breathing, difficulty_breathing, painful_urination, updated_at, created_at, subjective, bp, temp, hr, rr, fh, fht, other_physical_exam, assessment_diagnosis, elevated_bp, plan_intervention, aog, persistent_contractions) AS t2'), function($join) {
            $join->on('pregnant_formv2.unique_id', '=', 't2.maxunique_id');
        })
        ->join('tracking', 'pregnant_formv2.code', '=', 'tracking.code')
        ->leftJoin('patients', 'patients.id', '=', 'pregnant_formv2.patient_woman_id')
        ->leftJoin('users as action', 'action.id', '=', 'tracking.action_md')
        ->whereRaw('ROUND(t2.maxaog, 0) >= 34')
        ->where('tracking.status', '!=', 'referred')
        ->orderBy('t2.maxid', 'desc');

        if($req->search)
        {
            $keyword = $req->search;
            $data = $data->where(function($q) use ($keyword){
                $q->where('patients.lname', "like", "%$keyword%")
                    ->orwhere('patients.fname', "like", "%$keyword%")
                    ->orwhere('tracking.code', "like", "%$keyword%");
            });
        }

        if($req->date_range)
        {
            $date = $req->date_range;
            $range = explode('-', str_replace(' ', '', $date));
            $start = $range[0];
            $end = $range[1];
        } else {
            $start = Carbon::now()->startOfYear()->format('m/d/Y');
            $end = Carbon::now()->endOfYear()->format('m/d/Y');
        }

        $data = $data->distinct()->paginate(15);

        return view('admin.aogweeks', [
            "data" => $data,
            'keyword' => $keyword,
            'start' => $start,
            'end' => $end
        ]);
    }
}
