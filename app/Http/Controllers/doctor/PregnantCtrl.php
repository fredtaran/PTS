<?php

namespace App\Http\Controllers\doctor;

use App\Models\User;
use App\Models\Facility;
use App\Models\Tracking;
use App\Models\Antepartum;
use App\Models\SignSymptoms;
use Illuminate\Http\Request;
use App\Models\PregVitalSign;
use App\Models\PregnantFormv2;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PregnantCtrl extends Controller
{
    /**
     * Pregnant add info ctrl
     */
    public function addInfo (Request $req)
    {
        $td1 = date('Ymd', strtotime($req->td1));
        $td2 = date('Ymd', strtotime($req->td2));
        $td3 = date('Ymd', strtotime($req->td3));
        $td4 = date('Ymd', strtotime($req->td4));
        $td5 = date('Ymd', strtotime($req->td5));

        $user = Auth::user();
        $patient_id = $req->patient_id;
        $user_code = str_pad($user->facility_id, 3, 0, STR_PAD_LEFT);
        $code = date('ymd') . '-' . $user_code . '-' . date('His');
        $tracking_id = 0;

        $unique_id = "$patient_id-$user->facility_id-" . date('ymdH');

        $match = array(
            'unique_id' => $unique_id
        );

        $lmp = date('Y-m-d', strtotime($req->lmp));
        $edc_edd = date('Y-m-d', strtotime($req->edc_edd));
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
            'patient_woman_id'      => $req->patient_id,
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
            'td1'                   => ($td1 != '19700101') ? $td1 : NULL,
            'td2'                   => ($td2 != '19700101') ? $td2 : NULL,
            'td3'                   => ($td3 != '19700101') ? $td3 : NULL,
            'td4'                   => ($td4 != '19700101') ? $td4 : NULL,
            'td5'                   => ($td5 != '19700101') ? $td5 : NULL,
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

        if($form->wasRecentlyCreated)
        {
            PregnantFormv2::where('unique_id', $unique_id)
                ->update([
                    'code' => $code
                ]);

            $tracking_id = self::addTracking($code, $patient_id, $user, $req, $type = 'pregnant', $form->id);
        }

        $data1 = array(
            'unique_id'                 => $unique_id,
            'patient_woman_id'          => $req->patient_id,
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
            'temp'                      => ($req->ante_temp) ? $req->ante_temp: NULL,
            'hr'                        => ($req->ante_hr) ? $req->ante_hr : NULL,
            'rr'                        => ($req->ante_rr) ? $req->ante_rr : NULL,
            'fh'                        => ($req->ante_fh) ? $req->ante_fh : NULL,
            'fht'                       => ($req->ante_fht || $req->ante_fht == 0) ? $req->ante_fht : NULL,
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
            'patient_woman_id'          => $req->patient_id,
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
        //     if ($lab != null) {
        //         $date_of_lab = date('Ymd', strtotime($lab));
        //         $data3 = array(
        //             'unique_id' => $unique_id,
        //             'patient_woman_id' => $req->patient_id,
        //             'date_of_lab' => ($date_of_lab) ? $date_of_lab: NULL,
        //             'cbc_hgb' => ($req->cbc_hgb[$key]) ? $req->cbc_hgb[$key]: NULL,
        //             'cbc_wbc' => ($req->cbc_wbc[$key]) ? $req->cbc_wbc[$key]: NULL,
        //             'cbc_rbc' => ($req->cbc_rbc[$key]) ? $req->cbc_rbc[$key]: NULL,
        //             'cbc_platelet' => ($req->cbc_platelet[$key]) ? $req->cbc_platelet[$key]: NULL,
        //             'cbc_hct' => ($req->cbc_hct[$key]) ? $req->cbc_hct[$key]: NULL,
        //             'ua_pus' => ($req->ua_pus[$key]) ? $req->ua_pus[$key]: NULL,
        //             'ua_rbc' => ($req->ua_rbc[$key]) ? $req->ua_rbc[$key]: NULL,
        //             'ua_sugar' => ($req->ua_sugar[$key]) ? $req->ua_sugar[$key]: NULL,
        //             'ua_gravity' => ($req->ua_gravity[$key]) ? $req->ua_gravity[$key]: NULL,
        //             'ua_albumin' => ($req->ua_albumin[$key]) ? $req->ua_albumin[$key]: NULL,
        //             'utz' => ($req->utz[$key]) ? $req->utz[$key]: NULL,
        //             'blood_type' => ($req->blood_type) ? $req->blood_type: NULL,
        //             'hbsag_result' => ($req->hbsag_result) ? $req->hbsag_result:NULL,
        //             'vdrl_result' => ($req->vdrl_result) ? $req->vdrl_result:NULL,
        //             'lab_remarks' => ($req->lab_remarks[$key]) ? $req->lab_remarks[$key]: NULL,
        //         );

        //         $lab_result = LabResult::Create($data3);
        //         if ($lab_result->wasRecentlyCreated) {
        //             LabResult::where('unique_id',$unique_id)
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
            'patient_woman_id'  => $req->patient_id,
            'bp_15'             => ($req->bp_15) ? $req->bp_15 : NULL,
            'bp_30'             => ($req->bp_30) ? $req->bp_30 : NULL,
            'bp_45'             => ($req->bp_45) ? $req->bp_45 : NULL,
            'bp_60'             => ($req->bp_60) ? $req->bp_60 : NULL,
            'bp_remarks'        => ($req->bp_remarks) ? $req->bp_remarks : NULL,
            'temp_15'           => ($req->temp_15) ? $req->temp_15 : NULL,
            'temp_30'           => ($req->temp_30) ? $req->temp_30 : NULL,
            'temp_45'           => ($req->temp_45) ? $req->temp_45 :  NULL,
            'temp_60'           => ($req->temp_60) ? $req->temp_60 :  NULL,
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

        Session::put('return_pregnant', true);

        return redirect()->back();
    }

    /**
     * Track patient
     */
    function addTracking($code, $patient_id, $user, $req, $type, $form_id, $status='')
    {
        $match = array(
            'code' => $code
        );
        
        $track = array(
            'patient_id'        => $patient_id,
            'date_referred'     => date('Y-m-d H:i:s'),
            'referred_from'     => ($status == 'walkin') ? $req->referring_facility_walkin : $user->facility_id,
            'referred_to'       => ($status == 'walkin') ? $user->facility_id : (($user->facility_id) ? $user->facility_id : 0),
            'department_id'     => ($req->referred_department) ? $req->referred_department : 0 ,
            'referring_md'      => ($status == 'walkin') ? 0 : $user->id,
            'action_md'         => '0',
            'type'              => 'pregnant',
            'form_id'           => $form_id,
            'remarks'           => ($req->reason) ? $req->reason : '',
            'status'            => '',
            'walkin'            => 'no',
            'pregnant_status'   => ($req->pregnant_status) ? $req->pregnant_status : NULL
        );

        if ($status == 'walkin') {
            $track['date_seen'] = date('Y-m-d H:i:s');
            $track['date_accepted'] = date('Y-m-d H:i:s');
            $track['action_md'] = $user->id;
            $track['walkin'] = 'yes';
        }

        $tracking = Tracking::updateOrCreate($match, $track);

        $tracking_id = $tracking->id;

        return $tracking_id;
    }

    /**
     * Add details
     */
    public function returnPregnant(Request $req)
    {
        $date_of_visit = date('Y-m-d', strtotime($req->date_of_visit));
        $data2 = array(
            'unique_id'                 => ($req->unique_id) ? $req->unique_id : NULL,
            'patient_woman_id'          => ($req->patient_woman_id) ? $req->patient_woman_id : NULL,
            'code'                      => ($req->code) ? $req->code : NULL,
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

        SignSymptoms::where('unique_id', $req->unique_id)
            ->update([
                'code' => ($req->code) ? $req->code : NULL,
            ]);
        
        if($req->date_of_lab)
        {
            foreach ($req->date_of_lab as $key => $lab)
            {
                if ($lab != null) {
                    $date_of_lab = date('Ymd', strtotime($lab));

                    $data3 = array(
                        'unique_id'         => ($req->unique_id) ? $req->unique_id : NULL,
                        'code'              => ($req->code) ? $req->code : NULL,
                        'patient_woman_id'  => ($req->patient_woman_id) ? $req->patient_woman_id : NULL,
                        'date_of_lab'       => ($date_of_lab) ? $date_of_lab : NULL,
                        'cbc_hgb'           => ($req->cbc_hgb[$key]) ? $req->cbc_hgb[$key] : NULL,
                        'cbc_wbc'           => ($req->cbc_wbc[$key]) ? $req->cbc_wbc[$key] : NULL,
                        'cbc_rbc'           => ($req->cbc_rbc[$key]) ? $req->cbc_rbc[$key] : NULL,
                        'cbc_platelet'      => ($req->cbc_platelet[$key]) ? $req->cbc_platelet[$key] : NULL,
                        'cbc_hct'           => ($req->cbc_hct[$key]) ? $req->cbc_hct[$key] : NULL,
                        'ua_pus'            => ($req->ua_pus[$key]) ? $req->ua_pus[$key] : NULL,
                        'ua_rbc'            => ($req->ua_rbc[$key]) ? $req->ua_rbc[$key] : NULL,
                        'ua_sugar'          => ($req->ua_sugar[$key]) ? $req->ua_sugar[$key] : NULL,
                        'ua_gravity'        => ($req->ua_gravity[$key]) ? $req->ua_gravity[$key] : NULL,
                        'ua_albumin'        => ($req->ua_albumin[$key]) ? $req->ua_albumin[$key] : NULL,
                        'utz'               => ($req->utz[$key]) ? $req->utz[$key] : NULL,
                        'blood_type'        => ($req->blood_type) ? $req->blood_type : NULL,
                        'hbsag_result'      => ($req->hbsag_result) ? $req->hbsag_result : NULL,
                        'vdrl_result'       => ($req->vdrl_result) ? $req->vdrl_result : NULL,
                        'lab_remarks'       => ($req->lab_remarks[$key]) ? $req->lab_remarks[$key] : NULL,
                    );

                    $lab_result = LabResult::Create($data3);

                    LabResult::where('unique_id', $unique_id)
                        ->update([
                                'code' => ($req->code) ? $req->code : NULL,
                        ]);
                } else {
                    continue;
                }
            }
        }

        Session::put('return_pregnant', true);

        return redirect()->back();
    }
}
