<?php

namespace App\Http\Controllers\doctor;

use App\Models\CSS;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CSSCtrl extends Controller
{
    /**
     * Index
     */
    public function index() {
        $user = Auth::user();

        $data = CSS::select('css.*', 'facility.name as fac_name',
            DB::raw('CONCAT(patients.fname, " ", patients.mname, " ", patients.lname) as patient_name'),
            DB::raw("DATE_FORMAT(css.date_of_visit, '%M %d, %Y %h:%i %p') as date_of_visit")
        )
        ->leftJoin('facility', 'facility.id', '=', 'css.fac_id')
        ->leftjoin('patient_form', 'patient_form.code', '=', 'css.patient_code')
        ->leftjoin('patients', 'patients.id', '=', 'patient_form.patient_id')
        ->where('fac_id', $user->facility_id)
        ->paginate(10);

        $total = count($data);

        return view('doctor.css', [
            'data' => $data,
            'total' => $total
        ]);
    }

    /**
     * CSS
     */
    public function css(Request $req)
    {

        $hospital_id = Auth::user()->facility_id;
        $hospital = Facility::find($hospital_id)->name;
        $code = $req->code;

        return view('doctor.css_body', [
            'hospital_id' => $hospital_id,
            'hospital' => $hospital,
            'code' => $code
        ]);
    }

    /**
     * CSS Add
     */
    public function cssAdd(Request $req)
    {
        $data = $req->all();
        $data['code'] = $hospital = Facility::find(Auth::user()->facility_id)->name;

        $create = CSS::create($data);

        if($create->wasRecentlyCreated) {
            Session::put('cssAdd', true);
        }

        return Redirect::back();
    }

    /**
     * Check CSS
     */
    static function checkCSS($code) {
        $checker = CSS::select('patient_code')
                        ->where('patient_code', $code)->pluck('patient_code');

        if(count($checker) > 0) {
            return 'yes';
        } else {
            return 'no';
        }
    }
}
