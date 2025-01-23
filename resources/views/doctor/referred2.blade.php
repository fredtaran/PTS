<?php
$user = Auth::user();
?>
@extends('layouts.app')

@section('content')
<style>
    .txtTitle { font-size:1.4em; font-weight: bold; color: #ac2020 }
    .txtDoctor { font-weight: bold; color: #1a9cb7;}
    .txtPatient { font-weight: bold; font-size: 1em; color: #22a114 }
    .txtHospital { font-weight: bold; color: #9d7311; }
    .txtInfo { font-weight: bold; color: #437ea9; }
    .tracking { background : #efefef; padding:5px;}
    .tracking table td { font-size: 0.9em; padding:10px 15px; vertical-align: top; letter-spacing: 0.5px; }
    .tracking table td:first-child { white-space: nowrap; color: #959595; letter-spacing: normal; width: 100px;  }
    .remarks { display: block; color: #df9e38}
    .txtCode { color: #f39c12}
    .txtSub { font-size: 0.7em; font-weight: normal;color: #737373}
</style>

<style type="text/css">
    .bs-wizard {margin-top: 20px;}

    /*Form Wizard*/
    .bs-wizard {border-bottom: solid 1px #4caf50; padding: 0 0 10px 0;}
    .bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
    .bs-wizard > .bs-wizard-step + .bs-wizard-step {}
    .bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 16px; margin-bottom: 5px;}
    .bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #4caf50; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #4caf50; border-radius: 50px; position: absolute; top: 8px; left: 8px; }
    .bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
    .bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #4caf50;}
    .bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
    .bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
    .bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
    .bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
    .bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
    .bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
    .bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
    .bs-wizard-stepnum { color: #4caf50 !important; }
    
    /*END Form Wizard*/
    @media only screen and (max-width: 440px) {
        .bs-wizard-stepnum { visibility: hidden; }
        .tracking table td:first-child { color: #959595; letter-spacing: normal; white-space: normal;}
    }

    .modal-xl {
        width: 90%;
        margin: auto;
    }
</style>

<div class="col-md-3">
    @if($referredCode)
        @include('sidebar.track_referred')
    @else
        @include('sidebar.search_referred')
    @endif

    @include('sidebar.quick')
</div>

<div class="col-md-9">
    @if(count($data) > 0)
    @foreach($data as $row)
    <?php
    $type = ($row->type=='normal') ? 'success':'danger';
    $modal = ($row->type=='normal') ? '#normalFormModal' : '#RefferedpregnantFormModalTrack';
    $date = ($row->status=='referred') ? date('M d, Y h:i A', strtotime($row->date_referred)) : date('M d, Y h:i A', strtotime($row->date_seen));

    $activities = \App\Models\Activity::select(
                    'activity.*',
                    DB::raw('CONCAT(users.fname, " ", IFNULL(CONCAT(u.mname, " "), " "), users.lname) as md_name'),
                    DB::raw('CONCAT(u.fname, " ", IFNULL(CONCAT(u.mname, " "), " "), u.lname) as referring_md'),
                    'users.contact',
                    'fac_rejected.name as fac_rejected',
                    'referring_md as referring_md_id',
                    'u.id as user_id',
                    'activity.action_md as act_md_id',
                    'code'
                )
                ->where('activity.code', $row->code)
                ->where('activity.id', '>=', function($q) use ($row, $user) {
                    $q->select('id')
                        ->from('activity')
                        ->where('code', $row->code)
                        ->where(function($q) {
                            $q->where('status', 'referred')
                                ->orwhere('status', 'rejected')
                                ->orwhere('status', 'transferred');
                            })
                        ->first();
                    })
                ->leftJoin('users', 'users.id', '=', 'activity.action_md')
                ->leftJoin('users as u', 'u.id', '=', 'activity.referring_md')
                ->leftJoin('facility as fac_rejected', 'fac_rejected.id', '=', 'users.facility_id')
                ->orderBy('id', 'desc')
                ->get();

    $department_name = 'N/A';

    $dept = \App\Models\Department::find($row->department_id);

    if($dept) {
        $department_name = $dept->description;
    }

    $patient = \App\Models\Patients::find($row->patient_id);
    $patient_address = '';
    $patient_address .= ($patient->brgy) ? \App\Models\Barangay::find($patient->brgy)->description . ', ' : '';
    $patient_address .= ($patient->muncity) ? \App\Models\Muncity::find($patient->muncity)->description : '';
    if($patient->muncity=='others') {
        $patient_address = $patient->address;
    }

    $seen = \App\Models\Seen::where('tracking_id', $row->id)->count();
    $checkForCancellation = \App\Http\Controllers\doctor\ReferralCtrl::checkForCancellation($row->code);

    $step = \App\Http\Controllers\doctor\ReferralCtrl::step($row->code);
    $feedback = \App\Models\Feedback::where('code', $row->code)->count();
    $caller_md = \App\Models\Activity::where('code', $row->code)->where("status", "=", "calling")->count();
    $redirected = \App\Models\Activity::where('code', $row->code)->where("status", "=", "redirected")->count();
    ?>

    <div style="border:2px solid #7e7e7e;" class="panel panel-{{ $type }}">
        <div class="panel-heading">
            <span class="txtTitle"><i class="fa fa-wheelchair"></i> {{ ucwords(strtolower($row->patient_name)) }} <small class="txtSub">[ {{ $row->sex }}, {{ $row->age }} ] from {{ $patient_address }}. </small></span>
            <br />
            @if($row->contact)
                Patient Contact Number: <strong class="text-primary">{{ $row->contact }}</strong>
                <br />
            @endif
            Referred by:
            <span class="txtDoctor" href="#">
                <?php
                    if($row->user_level == 'doctor'){
                        $referring_md = "Dr. " . $row->referring_md;
                    } else{
                        $referring_md = $row->referring_md;
                    }
                ?>
                {{ $referring_md }}
            </span>
            <br />
            Patient Code: <span class="txtCode">{{ $row->code }}</span>
        </div>

        <div class="panel-body">
            <div class="row bs-wizard" style="border-bottom:0;">
                <div class="col-xs-2 bs-wizard-step @if($step==1) active @elseif($step>=1) complete @else disabled @endif"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum">
                        @if($step==0)
                            <span class="text-danger">Cancelled</span>
                        @else
                            Referred
                        @endif
                    </div>

                    <div class="progress">
                        <div class="progress-bar"></div>
                    </div>

                    <a href="javascript:void(0)" class="bs-wizard-dot" data-toggle="tooltip" data-placement="top" title="@if($step==0) Cancelled @else Referred @endif" @if($step == 0) style="background-color:#a94442;" @endif ></a>
                </div>

                <div class="col-xs-2 bs-wizard-step @if($step == 2) active @elseif($step >= 2) complete @else disabled @endif"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum">Seen</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="javascript:void(0)" class="bs-wizard-dot" data-toggle="tooltip" data-placement="top" title="Seen"></a>
                </div>

                <div class="col-xs-2 bs-wizard-step @if($step == 3) active @elseif($step >= 3) complete @else disabled @endif"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum">Accepted</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="javascript:void(0)" class="bs-wizard-dot" data-toggle="tooltip" data-placement="top" title="Accepted"></a>
                </div>

                <div class="col-xs-2 bs-wizard-step @if($step == 4 || $step == 4.5 || $step == 4.6) active @elseif($step >= 4) complete @else disabled @endif"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum">
                        @if($step == 4.5)
                            <span class="text-danger">Didn't Arrive</span>
                        @elseif($step == 4.6)
                            <span class="text-danger">Dead on Arrival</span>
                        @else
                            Arrived
                        @endif
                    </div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="javascript:void(0)" class="bs-wizard-dot" data-toggle="tooltip" data-placement="top" title=" @if($step == 4.5) Didn't Arrive @elseif($step == 4.6) Dead on Arrival @else Arrived @endif" @if($step == 4.6 || $step == 4.5) style="background-color:#a94442;" @endif></a>
                </div>

                <div class="col-xs-2 bs-wizard-step @if($step == 5 || $step == 5.1 ) active @elseif($step >= 5) complete @else disabled @endif"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum">
                        @if($step == 5.1)
                            Monitored as OPD
                        @else
                            Admitted
                        @endif
                        </div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="javascript:void(0)" class="bs-wizard-dot" data-toggle="tooltip" data-placement="top" title="Admitted"></a>
                </div>

                <div class="col-xs-2 bs-wizard-step @if($step == 6) active @elseif($step >= 6) complete @else disabled @endif"><!-- complete -->
                    <div class="text-center bs-wizard-stepnum">Discharged</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="javascript:void(0)" class="bs-wizard-dot" data-toggle="tooltip" data-placement="top" title="Discharged/Transferred"></a>
                </div>
            </div>

            @if(count($activities) > 0)
            <?php $first = 0; ?>
            <div class="tracking col-md-12">
                <div class="table-responsive">
                    <table width="100%">
                        @foreach($activities as $act)
                        <?php
                            $act_name = \App\Models\Patients::find($act->patient_id);
                            $acc_level = \App\Models\User::where('id', $act->act_md_id)->orderBy('id', 'DESC')->pluck('level')->first();
                            $level = \App\Models\User::where('id', $act->user_id)->orderBy('id', 'DESC')->pluck('level')->first();
                            $old_facility_data = \App\Models\Facility::find($act->referred_from);
                            $old_facility = $old_facility_data->name;
                            $old_facility_id = $old_facility_data->id;
                            if($act->status == 'transferred' || $act->status == 'redirected'|| $act->status == 'referred' || $act->status == 'calling') {
                                $act_icon = 'fa-ambulance';
                            }

                            $new_facility = 'N/A';
                            $tmp_new = \App\Models\Facility::find($act->referred_to);

                            if($act->referred_to==0) {
                                $tmp_new = \App\Models\Facility::find($act->referred_from);
                            }

                            if($tmp_new) {
                                $new_facility = $tmp_new->name;
                            }
                        ?>
                        @if($act->status == 'rejected')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>

                            <td>
                                <span class="txtDoctor">Dr. {{ $act->md_name }}</span> of <span class="txtHospital">{{ $act->fac_rejected }}</span> recommended to redirect <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> to other facility.
                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                <br />
                                @if($user->facility_id == $act->referred_from)
                                    <button class="btn btn-success btn-xs btn-referred" data-toggle="modal" data-target="#referredFormModal" data-activity_id="{{ $act->id }}">
                                        <i class="fa fa-ambulance"></i> Refer to other facility
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @elseif($act->status == 'referred' || $act->status == 'redirected')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>
                            <td>

                                @if($act->referring_md_id != 0)
                                    <?php
                                        if($level != 'doctor' && $level != 'nurse' && $level != 'midwife'){
                                            $referred_md = $act->referring_md;
                                        }
                                        elseif($level == 'nurse'){
                                            $referred_md = 'Nurse ' . $act->referring_md;
                                        } 
                                        elseif($level == 'midwife'){
                                            $referred_md = 'Midwife ' . $act->referring_md;
                                        }
                                        else {
                                            $referred_md = 'Dr. ' . $act->referring_md;
                                        }
                                    ?>
                                    <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was referred by <span class="txtDoctor">{{ $referred_md }}</span> of <span class="txtHospital">{{ $old_facility }}</span> to <span class="txtHospital">{{ $new_facility }}.</span>
                                @else
                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was referred by <span class="txtDoctor">{{ $referred_md }}</span> of <span class="txtHospital">{{ $old_facility }}</span> to <span class="txtHospital">{{ $new_facility }}.</span>
                                
                                <hr>
                                
                                <strong>Walk-In Patient:</strong> <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>
                                @endif
                            </td>
                        </tr>
                        @elseif($act->status == 'transferred')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>

                            <td>
                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was transferred by <span class="txtDoctor">Dr. {{ $act->md_name }}</span> of <span class="txtHospital">{{ $old_facility }}</span> to <span class="txtHospital">{{ $new_facility }}.</span>
                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                            </td>
                        </tr>
                        @elseif($act->status == 'dead')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>

                            <td>
                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> dead on arrival to <span class="txtHospital">{{ $new_facility }}</span>.
                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                            </td>
                        </tr>
                        @elseif($act->status == 'redirected')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>

                            <td>
                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was referred by <span class="txtDoctor">Dr. {{ $act->md_name }}</span> to <span class="txtHospital">{{ $new_facility }}.</span>
                            </td>
                        </tr>
                        @elseif($act->status == 'calling')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>

                            <td>
                                <span class="txtDoctor">Dr. {{ $act->md_name }}</span> of <span class="txtHospital">{{ $new_facility }}</span> is requesting a call from <span class="txtHospital">{{ $old_facility }}</span>.
                                @if($user->facility_id == $act->referred_from)
                                    Please contact this number <span class="txtInfo">({{ $act->contact }})</span> .
                                @endif
                            </td>
                        </tr>
                        @elseif($act->status=='accepted')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>
                            <td>
                                @if($act->act_md_id!=0)
                                    <?php
                                        if($acc_level != 'doctor' && $acc_level != 'nurse'&& $acc_level != 'midwife'){
                                            $act_md_name = $act->md_name;
                                        }
                                        elseif($acc_level == 'nurse'){
                                            $act_md_name = 'Nurse '.$act->md_name;
                                        } 
                                        elseif($acc_level == 'midwife'){
                                            $act_md_name = 'Midwife '.$act->md_name;
                                        }
                                        else {
                                            $act_md_name = 'Dr. '.$act->md_name;
                                        }
                                    ?>
                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was accepted by <span class="txtDoctor">{{ $act_md_name }}</span> of <span class="txtHospital">{{ $new_facility }}</span>.
                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                @else
                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was accepted by <span class="txtDoctor">{{ $act_md_name }}</span> of <span class="txtHospital">{{ $new_facility }}</span>.
                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                @endif
                            </td>
                        </tr>
                        @elseif($act->status == 'arrived')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>

                            <td>
                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> arrived at <span class="txtHospital">{{ $new_facility }}</span>.
                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                            </td>
                        </tr>
                        @elseif($act->status == 'admitted')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>

                            <td>
                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> admitted at <span class="txtHospital">{{ $new_facility }}</span>.
                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                            </td>
                        </tr>
                        @elseif($act->status == 'monitored')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>

                            <td>
                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> monitored as OPD at <span class="txtHospital">{{ $new_facility }}</span>.
                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                            </td>
                        </tr>
                        @elseif($act->status == 'discharged')
                            @if($type == 'normal')
                            <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                                <td>
                                    {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                                </td>

                                <td>
                                    <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> discharged from <span class="txtHospital">{{ $new_facility }}</span>.
                                    <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                    <?php
                                        ($row->type == 'normal') ? $covid_discharge = \App\Models\PatientForm::where("code",$act->code)->first() : $covid_discharge = \App\Models\PregnantForm::where("code", $act->code)->first();
                                    ?>
                                    @if(@$covid_discharge->dis_clinical_status || @$covid_discharge->dis_sur_category)
                                    <span class="remarks">Clinical Status: <b>{{ ucfirst($covid_discharge->dis_clinical_status) }}</b></span>
                                    <span class="remarks">Surveillance Category: <b>{{ ucfirst($covid_discharge->dis_sur_category) }}</b></span>
                                    @endif
                                </td>
                            </tr>
                            @else
                            <?php
                                $preg = \App\Models\PregOutcome::select('*')
                                                                ->where('preg_outcome.code',$act->code)
                                                                ->first();
                            ?>
                            <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                                <td>
                                    {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                                </td>

                                <td>
                                    <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> discharged from <span class="txtHospital">{{ $new_facility }}</span>.
                                    <span class="remarks">Discharge Instruction: {{ $preg->discharge_instruction }}</span>
                                    <span class="remarks">Discharge Diagnosis: {{ $preg->discharge_diagnosis }}</span>
                                    <?php
                                        ($row->type == 'normal') ? $covid_discharge = \App\Models\PatientForm::where("code", $act->code)->first() : $covid_discharge = \App\Models\PregnantForm::where("code", $act->code)->first();
                                    ?>
                                    @if(@$covid_discharge->dis_clinical_status || @$covid_discharge->dis_sur_category)
                                    <span class="remarks">Clinical Status: <b>{{ ucfirst($covid_discharge->dis_clinical_status) }}</b></span>
                                    <span class="remarks">Surveillance Category: <b>{{ ucfirst($covid_discharge->dis_sur_category) }}</b></span>
                                    @endif
                                </td>
                            </tr>
                            @endif
                        @elseif($act->status == 'archived')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>

                            <td>
                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> didn't arrive to <span class="txtHospital">{{ $new_facility }}</span>.
                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                            </td>
                        </tr>
                        @elseif($act->status == 'cancelled')
                        <?php
                            $doctor = \App\Models\User::find($act->action_md);
                        ?>
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>

                            <td>
                                Referral was cancelled by
                                <span class="txtDoctor">
                                    <?php
                                    if($doctor->facility_id == 63)
                                        $cancel_doctor = $doctor->fname.' '.$doctor->mname.' '.$doctor->lname;
                                    else
                                        $cancel_doctor = 'Dr. '.$doctor->fname.' '.$doctor->mname.' '.$doctor->lname;
                                    ?>
                                    {{ $cancel_doctor }}
                                </span>.
                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                            </td>
                        </tr>
                        @elseif($act->status == 'travel')
                        <tr @if($first == 1) class="toggle toggle{{ $row->id }}" @endif>
                            <td>
                                {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}
                            </td>

                            <td>
                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was departure by <span class="txtDoctor">{{ $act->remarks == 5 ? explode('-',$act->remarks)[1] : \App\ModeTransportation::find($act->remarks)->transportation }}</span>.
                            </td>
                        </tr>
                        @endif
                        <?php $first = 1; ?>
                        @endforeach
                    </table>
                </div>
                @if(count($activities)>1)
                <div style="border-top: 1px solid #ccc;">
                    <div class="text-center">
                        <a href="#toggle" data-id="{{ $row->id }}">View More</a> <small class="text-muted">({{ count($activities) }})</small>
                    </div>
                </div>
                @endif
            </div>
            @endif
        </div>

        <div class="panel-footer">
            <button data-target="{{ $modal }}" data-toggle="modal"
                data-type="{{ $row->type }}"
                data-id="{{ $row->id }}"
                data-code="{{ $row->code }}"
                class="view_form btn btn-warning btn-xs"><i class="fa fa-folder"></i> View Form</button>

            @if($seen > 0)
            <a href="#seenModal" data-toggle="modal"
                    data-id="{{ $row->id }}"
                    class="btn btn-seen btn-xs btn-success"><i class="fa fa-user-md"></i> Seen
                @if($seen > 0)
                    <small class="badge bg-green-active">{{ $seen }}</small>
                @endif
            </a>
            @endif

            @if($caller_md > 0)
                <a href="#callerModal" data-toggle="modal"
                    data-id="{{ $row->id }}"
                    class="btn btn-primary btn-xs btn-caller"><i class="fa fa-phone"></i> Caller
                    @if($caller_md > 0)
                        <small class="badge bg-blue-active">{{ $caller_md }}</small>
                    @endif
                </a>
            @endif
            
            @if($step == 3 && empty(\App\Models\Activity::where("code", $row->code)->where("status", "travel")->first()))
                <a href="#transferModal" data-toggle="modal"
                    data-id="{{ $row->id }}" class="btn btn-xs btn-success btn-transfer"><i class="fa fa-ambulance"></i> Travel</a>
            @endif

            <button class="btn btn-xs btn-info btn-feedback" data-toggle="modal"
                    data-target="#feedbackModal"
                    data-code="{{ $row->code }}">
                <i class="fa fa-comments"></i> ReCo
                @if($feedback > 0)
                    <span class="badge bg-blue">{{ $feedback }}</span>
                @endif
            </button>

            <a href="#upload_modal"
                                data-toggle="modal"
                                data-code="{{$row->code}}"
                                data-id = "{{ $row->id }}"
                                class="btn btn-info btn-xs btn-edit upload_code">
                                <i class="fa fa-file"></i>
                                Upload
                            </a>

            <?php $issue_and_concern = \App\Models\Issue::where("tracking_id", "=", $row->id)->count(); ?>

            <button class="btn btn-xs btn-danger btn-issue-referred" data-toggle="modal"
                    data-target="#IssueAndConcern"
                    data-code="{{ $row->code }}"
                    data-referred_from="{{ $row->referred_from }}"
                    data-tracking_id="{{ $row->id }}">
                <i class="fa fa fa-exclamation-triangle"></i> Issue and Concern
                @if($issue_and_concern > 0)
                <span class="badge bg-red">{{ $issue_and_concern }}</span>
                @endif
            </button>

            <?php $doh_remarks = \App\Models\Monitoring::where("code", "=", $row->code)->count(); ?>

            @if($doh_remarks > 0)
                <button class="btn btn-xs btn-doh" data-toggle="modal" style="background-color: #dd7556;color: white"
                        data-target="#feedbackDOH"
                        data-code="{{ $row->code }}">
                
                    <span class="badge bg-green">{{ $doh_remarks }}</span>
                </button>
            @endif

            @if($redirected > 0)
                <a href="#" data-toggle="modal"
                    data-id="{{ $row->id }}"
                    class="btn btn-danger btn-xs btn-caller"><i class="fa fa-chevron-circle-right"></i> Redirected
                    @if($redirected > 0)
                        <small class="badge bg-red-active">{{ $redirected }}</small>
                    @endif
                </a>
            @endif

            @if(!$checkForCancellation)
                <a href="#cancelModal" data-toggle="modal"
                    data-id="{{ $row->id }}" class="btn btn-xs btn-default btn-cancel"><i class="fa fa-times"></i> Cancel</a>
            @endif
            
        </div>
    </div>
    @endforeach
    <div class="text-center">
        {{ $data->links() }}
    </div>
    @else
    <div class="alert alert-warning">
        <span class="text-warning" style="font-weight: bold; font-size: 1.2em;">
            <i class="fa fa-warning"></i> No Referred Patients!
        </span>
    </div>
    @endif
</div>

@include('modal.refer')
@include('modal.seen')
@include('modal.feedback')
@include('modal.transfer')
@include('modal.legitmodal')
@include('modal.caller')
@include('modal.accept_reject')
@include('modal.cancel')
@include('modal.accept')
@include('modal.reject')
@include('modal.contact')
@endsection

@section('js')
@include('script.feedback')
@include('script.referred')
@include('script.datetime')

<script>
    $(document).ready(function() {
        $('.upload_code').on('click',function(){
            var code = $(this).data('code');
            var url = "<?php echo asset('doctor/upload_body'); ?>";
            var json = {
                "code" : code,
                "_token" : "<?php echo csrf_token(); ?>"
            };
            $.post(url,json,function(result){
                $(".upload_body").html(result);
            });
            
        });

        function PatientBody(patient_id){
            console.log(patient_id);
            var url = "<?php echo asset('doctor/refer/update'); ?>";
            var json = {
                "patient_id" : patient_id,
                "_token" : "<?php echo csrf_token(); ?>"
            };
            $.post(url,json,function(result){
                $(".body_editrefer").html(result);
            });
        }

        @if(session()->has('issueReferral'))
            Lobibox.notify('success', {
                title: '',
                msg: "<?php echo session()->get('issueReferral'); ?>",
                size: 'mini',
                rounded: true,
                sound: false
            });
        @endif

        @if(session()->has('transferReferral'))
        Lobibox.notify('success', {
                title: '',
                msg: "<?php echo session()->get('transferReferral'); ?>",
                size: 'mini',
                rounded: true,
                sound: false
            });
        @endif

        $('body').on('click','.btn-transfer',function(){
            $(".transportation_body").html(''); //clear data
            var id = $(this).data('id');
            var url = "{{ url('doctor/referred/transfer') }}/"+id;
            var transportation_all = <?php echo \App\Models\ModeTransportation::get(); ?>;
            var select_transportation = "<select class='form-control' onchange='addOthers()' name='mode_transportation' id='mode_transportation' >";
            $.each(transportation_all,function($x,$y){
                select_transportation += "<option value='"+$y.id+"'>"+$y.transportation+"</option>";
            });
            select_transportation += "</select><br>";

            $(".transportation_body").append(select_transportation);
            $("#transferReferralForm").attr('action',url);
        });

        @if(Session::get('refer_update_save'))
            Lobibox.notify('success', {
                title: "",
                msg: "<?php echo Session::get("refer_message"); ?>",
                size: 'mini',
                rounded: true,
                sound: false
            });

            <?php
                Session::put("refer_update_save", false);
                Session::put("refer_message", false)
            ?>
        @endif

        @if(Session::get('validated'))
            Lobibox.notify('warning', {
                title: "",
                msg: "File size should be 5MB below and PDF file only",
                size: 'mini',
                rounded: true,
                sound: false
            });

            $('#upload_modal').modal('show');

            var code = "<?php echo Session::get("unique_referral_code"); ?>"
            var url = "<?php echo asset('doctor/upload_body'); ?>"

            // alert(code);
            var json = {
                "code" : code,
                "_token" : "<?php echo csrf_token(); ?>"
            };
            $.post(url,json,function(result){
                $(".upload_body").html(result);
            });

            <?php
                Session::put("validated",false);
            ?>
        @endif

        @if(Session::get('upload_file'))
            Lobibox.notify('success', {
                title: "",
                msg: "<?php echo Session::get("upload_file_message"); ?>",
                size: 'mini',
                rounded: true,
                sound: false
            });

            $('#upload_modal').modal('show');

            var code = "<?php echo Session::get("unique_referral_code"); ?>"
            var url = "<?php echo asset('doctor/upload_body'); ?>"

            var json = {
                "code" : code,
                "_token" : "<?php echo csrf_token(); ?>"
            };
            $.post(url,json,function(result){
                $(".upload_body").html(result);
            });

            <?php
                Session::put("upload_file",false);
                Session::put("upload_file_message",false)
            ?>
        @endif
        
        $('.toggle').toggle();

        $("a[href='#toggle']").on('click',function () {
            var id = $(this).data('id');
            $('.toggle'+id).toggle();
            var txt = ($(this).html() =='View More') ? 'View Less': 'View More';
            $(this).html(txt);
        });

        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('#daterange').daterangepicker({
            "singleDatePicker": false,
            "startDate": "{{ $start }}",
            "endDate": "{{ $end }}"
        });
    })

    function clearFieldsSidebar() {
        <?php
            Session::put('referredKeyword', false);
            Session::put('referredSelect', false);
            Session::put('referred_date', false);
            Session::put('referred_facility', false);
            Session::put('referred_department', false);
        ?>
        refreshPage();
    }
</script>

@endsection

