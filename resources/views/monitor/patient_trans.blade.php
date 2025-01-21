<?php
$user = Session::get('auth');
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
        .bs-wizard-stepnum { color: #4caf50 !important;}
        /*END Form Wizard*/
        @media only screen and (max-width: 440px) {
            .bs-wizard-stepnum { visibility: hidden; }
            .tracking table td:first-child { color: #959595; letter-spacing: normal; white-space: normal;}
        }
    </style>
    <div class="col-md-3">
        @if($referredCode)
            @include('sidebar.track_monitor')
        @else
            @include('sidebar.monitor_filter')
        @endif
    </div>
    <div class="col-md-9">
        @if(count($data) > 0)
            @foreach($data as $row)
            <?php
                $type = ($row->type=='normal') ? 'success':'danger';
                $modal = ($row->type=='normal') ? '#normalFormModal' : '#pregnantFormModal';
                $date = ($row->status=='referred') ? date('M d, Y h:i A',strtotime($row->date_referred)) : date('M d, Y h:i A',strtotime($row->date_seen));

                $activities = \App\Activity::select(
                        'activity.*',
                        DB::raw('CONCAT(users.fname," ",users.mname," ",users.lname) as md_name'),
                        DB::raw('CONCAT(u.fname," ",u.mname," ",u.lname) as referring_md'),
                        'users.contact',
                        'fac_rejected.name as fac_rejected',
                        'referring_md as referring_md_id',
                        'u.id as user_id'
                    )
                    ->where('activity.code',$row->code)
                    ->where('activity.id','>=',function($q) use($row,$user){
                        $q->select('id')
                            ->from('activity')
                            ->where('code',$row->code)
                            ->where(function($q){
                                $q->where('status','referred')
                                    ->orwhere('status','rejected')
                                    ->orwhere('status','transferred');
                            })
                            ->first()
                        ;
                    })
                    ->leftJoin('users','users.id','=','activity.action_md')
                    ->leftJoin('users as u','u.id','=','activity.referring_md')
                    ->leftJoin('facility as fac_rejected','fac_rejected.id','=','users.facility_id')
                    ->orderBy('id','desc')
                    ->get();

                    $department_name = 'N/A';
                    $dept = \App\Department::find($row->department_id);
                    if($dept){
                        $department_name = $dept->description;
                    }
                    $patient = \App\Patients::find($row->patient_id);
                    $patient_address = '';
                    $patient_address .= ($patient->brgy) ? \App\Barangay::find($patient->brgy)->description.', ': '';
                    $patient_address .= ($patient->muncity) ? \App\Muncity::find($patient->muncity)->description: '';
                    if($patient->muncity=='others')
                    {
                        $patient_address = $patient->address;
                    }

                    $seen = \App\Seen::where('tracking_id',$row->id)->count();
                    $checkForCancellation = \App\Http\Controllers\doctor\ReferralCtrl::checkForCancellation($row->code);

                    $step = \App\Http\Controllers\doctor\ReferralCtrl::step($row->code);
                    $feedback = \App\Feedback::where('code',$row->code)->count();
                    $caller_md = \App\Activity::where('code',$row->code)->where("status","=","calling")->count();
                    $redirected = \App\Activity::where('code',$row->code)->where("status","=","redirected")->count();
            ?>
            <div style="border:2px solid #7e7e7e;" class="panel panel-{{ $type }}">
                <div class="panel-heading">
                    <span class="txtTitle"><i class="fa fa-wheelchair"></i> {{ ucwords(strtolower($row->patient_name)) }} <small class="txtSub">[ {{ $row->sex }}, {{ $row->age }} ] from {{ $patient_address }}. </small></span>
                    <br />
                    <!-- @if($row->contact)
                        Patient Contact Number: <strong class="text-primary">{{ $row->contact }}</strong>
                        <br />
                    @endif -->
                    Referred by:
                    <span class="txtDoctor" href="#">
                        <?php
                            if($row->user_level == 'doctor'){
                                $referring_md = "Dr. ".$row->referring_md;
                            } else{
                                $referring_md = $row->referring_md;
                            }
                        ?>
                        {{ $referring_md }}
                    </span>
                    <br />
                    <!-- Patient Code: <span class="txtCode">{{ $row->code }}</span> -->
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
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="javascript:void(0)" class="bs-wizard-dot" data-toggle="tooltip" data-placement="top" title="@if($step==0) Cancelled @else Referred @endif" @if($step==0) style="background-color:#a94442;" @endif ></a>
                        </div>

                        <div class="col-xs-2 bs-wizard-step @if($step==2) active @elseif($step>=2) complete @else disabled @endif"><!-- complete -->
                            <div class="text-center bs-wizard-stepnum">Seen</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="javascript:void(0)" class="bs-wizard-dot" data-toggle="tooltip" data-placement="top" title="Seen"></a>
                        </div>

                        <div class="col-xs-2 bs-wizard-step @if($step==3) active @elseif($step>=3) complete @else disabled @endif"><!-- complete -->
                            <div class="text-center bs-wizard-stepnum">Accepted</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="javascript:void(0)" class="bs-wizard-dot" data-toggle="tooltip" data-placement="top" title="Accepted"></a>
                        </div>

                        <div class="col-xs-2 bs-wizard-step @if($step==4 || $step==4.5) active @elseif($step>=4) complete @else disabled @endif"><!-- complete -->
                            <div class="text-center bs-wizard-stepnum">
                                @if($step==4.5)
                                    <span class="text-danger">Didn't Arrive</span>
                                @else
                                    Arrived
                                @endif
                            </div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="javascript:void(0)" class="bs-wizard-dot" data-toggle="tooltip" data-placement="top" title="@if($step==4.5) Didn't Arrive @else Arrived @endif" @if($step==4.5) style="background-color:#a94442;" @endif></a>
                        </div>
                        <div class="col-xs-2 bs-wizard-step @if($step==5) active @elseif($step>=5) complete @else disabled @endif"><!-- complete -->
                            <div class="text-center bs-wizard-stepnum">Admitted</div>
                            <div class="progress"><div class="progress-bar"></div></div>
                            <a href="javascript:void(0)" class="bs-wizard-dot" data-toggle="tooltip" data-placement="top" title="Admitted"></a>
                        </div>
                        <div class="col-xs-2 bs-wizard-step @if($step==6) active @elseif($step>=6) complete @else disabled @endif"><!-- complete -->
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
                                        $act_name = \App\Patients::find($act->patient_id);
                                        $level = \App\User::where('id',$act->user_id)->orderBy('id', 'DESC')->pluck('level')->first();
                                        $old_facility_data = \App\Facility::find($act->referred_from);
                                        $old_facility = $old_facility_data->name;
                                        $old_facility_id = $old_facility_data->id;
                                        if($act->status=='transferred' || $act->status=='redirected'|| $act->status=='referred' || $act->status=='calling'){
                                            $act_icon = 'fa-ambulance';
                                        }
                                        $new_facility = 'N/A';
                                        $tmp_new = \App\Facility::find($act->referred_to);

                                        if($act->referred_to==0)
                                        {
                                            $tmp_new = \App\Facility::find($act->referred_from);
                                        }

                                        if($tmp_new)
                                        {
                                            $new_facility = $tmp_new->name;
                                        }
                                    ?>
                                    @if($act->status=='rejected')
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                            <td>
                                                <span class="txtDoctor">Dr. {{ $act->md_name }}</span> of <span class="txtHospital">{{ $act->fac_rejected }}</span> recommended to redirect <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> to other facility.
                                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                                <br />
                                                @if($act->department_id==0 && $user->facility_id==$act->referred_from)
                                                    <button class="btn btn-success btn-xs btn-referred" data-toggle="modal" data-target="#referredFormModal" data-activity_id="{{ $act->id }}">
                                                        <i class="fa fa-ambulance"></i> Refer to other facility
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @elseif($act->status=='referred' || $act->status=='redirected')
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                            <td>
                                                @if($act->referring_md_id!=0)
                                                    <?php
                                                        if($level != 'doctor' && $level != 'nurse'&& $level != 'midwife'){
                                                            $referred_md = $act->referring_md;
                                                        }
                                                        elseif($level == 'nurse'){
                                                            $referred_md = 'Nurse '.$act->referring_md;
                                                        } 
                                                        elseif($level == 'midwife'){
                                                            $referred_md = 'Midwife '.$act->referring_md;
                                                        }
                                                        else {
                                                            $referred_md = 'Dr. '.$act->referring_md;
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

                                    @elseif($act->status=='transferred')
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                            <td>
                                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was {{ $row->status }} by <span class="txtDoctor">Dr. {{ $act->md_name }}</span> of <span class="txtHospital">{{ $old_facility }}</span> to <span class="txtHospital">{{ $new_facility }}.</span>
                                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                            </td>
                                        </tr>
                                    @elseif($act->status=='redirected')
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                            <td>
                                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was referred by <span class="txtDoctor">Dr. {{ $act->md_name }}</span> to <span class="txtHospital">{{ $new_facility }}.</span>
                                            </td>
                                        </tr>
                                    @elseif($act->status=='calling')
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                            <td>
                                                <span class="txtDoctor">Dr. {{ $act->md_name }}</span> of <span class="txtHospital">{{ $new_facility }}</span> is requesting a call from <span class="txtHospital">{{ $old_facility }}</span>.
                                                @if($user->facility_id==$act->referred_from)
                                                    Please contact this number <span class="txtInfo">({{ $act->contact }})</span> .
                                                @endif
                                            </td>
                                        </tr>
                                    @elseif($act->status=='accepted')
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                            <td>
                                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was accepted by <span class="txtDoctor">Dr. {{ $act->md_name }}</span> of <span class="txtHospital">{{ $new_facility }}</span>.
                                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                            </td>
                                        </tr>
                                    @elseif($act->status=='arrived')
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                            <td>
                                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> arrived at <span class="txtHospital">{{ $new_facility }}</span>.
                                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                            </td>
                                        </tr>
                                    @elseif($act->status=='admitted')
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                            <td>
                                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> admitted at <span class="txtHospital">{{ $new_facility }}</span>.
                                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                            </td>
                                        </tr>
                                    @elseif($act->status=='discharged')
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                            <td>
                                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> discharged from <span class="txtHospital">{{ $new_facility }}</span>.
                                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                                <?php
                                                    ($row->type=='normal') ? $covid_discharge = \App\PatientForm::where("code",$act->code)->first() : $covid_discharge = \App\PregnantForm::where("code",$act->code)->first();
                                                ?>
                                                @if($covid_discharge->dis_clinical_status or $covid_discharge->dis_sur_category)
                                                <span class="remarks">Clinical Status: <b>{{ ucfirst($covid_discharge->dis_clinical_status) }}</b></span>
                                                <span class="remarks">Surveillance Category: <b>{{ ucfirst($covid_discharge->dis_sur_category) }}</b></span>
                                                @endif
                                            </td>
                                        </tr>
                                    @elseif($act->status=='archived')
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                            <td>
                                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> didn't arrive to <span class="txtHospital">{{ $new_facility }}</span>.
                                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                            </td>
                                        </tr>
                                    @elseif($act->status=='cancelled')
                                        <?php
                                            $doctor = \App\User::find($act->action_md);
                                        ?>
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
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
                                    @elseif($act->status=='travel')
                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
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


    @include('modal.accept_reject')
    @include('modal.legitmodal')
    @include('modal.refer')
    @include('modal.accept')
    @include('modal.seen')
    @include('modal.caller')
    @include('modal.cancel')
    @include('modal.feedback')
    @include('modal.transfer')
    @include('modal.reject')
    @include('modal.contact')
@endsection
@include('script.firebase')

@section('js')
    @include('script.feedback')
    @include('script.referred')
    @include('script.datetime')
    <script>
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
            var transportation_all = <?php echo \App\ModeTransportation::get(); ?>;
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
        Session::put("refer_update_save",false);
        Session::put("refer_message",false)
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

        alert(code);
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

        $(document).ready(function(){
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
        $('.select2').select2();

        $('#daterange').daterangepicker({
            "singleDatePicker": false,
            "startDate": "{{ $start }}",
            "endDate": "{{ $end }}"
        });

        function clearFieldsSidebar(){
            <?php
            Session::put('referredKeyword',false);
            Session::put('referredSelect',false);
            Session::put('referred_date',false);
            Session::put('referred_facility',false);
            Session::put('referred_department',false);
            ?>
            refreshPage();
        }
    </script>
@endsection

@section('css')

@endsection

