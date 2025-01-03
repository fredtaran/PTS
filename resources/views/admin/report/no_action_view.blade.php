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
        }
    </style>

    <div class="box box-success">
        <div class="box-body no-padding">
            <div class="box-body">
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
                            'referring_md as referring_md_id'
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
                        ?>
                        <div style="border:2px solid #7e7e7e;" class="panel panel-{{ $type }}">
                            <div class="panel-heading">
                                <span class="txtTitle"><i class="fa fa-wheelchair"></i> {{ ucwords(strtolower($row->patient_name)) }} <small class="txtSub">[ {{ $row->sex }}, {{ $row->age }} ] from {{ $patient_address }}. </small></span>
                                <br />
                                Referred by: <span class="txtDoctor" href="#">Dr. {{ $row->referring_md }}</span>
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
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="javascript:void(0)" class="bs-wizard-dot" title="Referred" @if($step==0) style="background-color:#a94442;" @endif ></a>
                                    </div>

                                    <div class="col-xs-2 bs-wizard-step @if($step==2) active @elseif($step>=2) complete @else disabled @endif"><!-- complete -->
                                        <div class="text-center bs-wizard-stepnum">Seen</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                    </div>

                                    <div class="col-xs-2 bs-wizard-step @if($step==3) active @elseif($step>=3) complete @else disabled @endif"><!-- complete -->
                                        <div class="text-center bs-wizard-stepnum">Accepted</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="javascript:void(0)" class="bs-wizard-dot"></a>
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
                                        <a href="javascript:void(0)" class="bs-wizard-dot" @if($step==4.5) style="background-color:#a94442;" @endif></a>
                                    </div>
                                    <div class="col-xs-2 bs-wizard-step @if($step==5) active @elseif($step>=5) complete @else disabled @endif"><!-- complete -->
                                        <div class="text-center bs-wizard-stepnum">Admitted</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="javascript:void(0)" class="bs-wizard-dot"></a>
                                    </div>
                                    <div class="col-xs-2 bs-wizard-step @if($step==6) active @elseif($step>=6) complete @else disabled @endif"><!-- complete -->
                                        <div class="text-center bs-wizard-stepnum">Discharged</div>
                                        <div class="progress"><div class="progress-bar"></div></div>
                                        <a href="javascript:void(0)" class="bs-wizard-dot"></a>
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
                                                    $old_facility = \App\Facility::find($act->referred_from)->name;
                                                    if($act->status=='transferred' || $act->status=='redirected'|| $act->status=='referred' || $act->status=='calling'){
                                                        $act_icon = 'fa-ambulance';
                                                    }
                                                    $new_facility = 'N/A';
                                                    $tmp_new = \App\Facility::find($act->referred_to);

                                                    if($act->referred_to==0)
                                                    {
                                                        $tmp_new = \App\Facility::find($act->referred_from);
                                                    }

                                                    if($tmp_new){
                                                        $new_facility = $tmp_new->name;
                                                    }
                                                    ?>
                                                    @if($act->status=='rejected')
                                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                                            <td>
                                                                <span class="txtDoctor">Dr. {{ $act->md_name }}</span> of <span class="txtHospital">{{ $new_facility }}</span> recommended to redirect <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> to other facility.
                                                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
                                                            </td>
                                                        </tr>
                                                    @elseif($act->status=='referred' || $act->status=='redirected')
                                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                                            <td>
                                                                @if($act->referring_md_id!=0)
                                                                    <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was referred by <span class="txtDoctor">Dr. {{ $act->referring_md }}</span> of <span class="txtHospital">{{ $old_facility }}</span> to <span class="txtHospital">{{ $new_facility }}.</span>
                                                                @else
                                                                    <strong>Walk-In Patient:</strong> <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>

                                                    @elseif($act->status=='transferred')
                                                        <tr @if($first==1) class="toggle toggle{{ $row->id }}" @endif>
                                                            <td>{{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</td>
                                                            <td>
                                                                <span class="txtPatient">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>  was referred by <span class="txtDoctor">Dr. {{ $act->md_name }}</span> of <span class="txtHospital">{{ $old_facility }}</span> to <span class="txtHospital">{{ $new_facility }}.</span>
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
                                                                Referral was cancelled by  by <span class="txtDoctor">Dr. {{ $doctor->fname }} {{ $doctor->lname }}</span>.
                                                                <span class="remarks">Remarks: {{ $act->remarks }}</span>
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
                                @if($seen>0)
                                    <a href="#seenModal" data-toggle="modal"
                                       data-id="{{ $row->id }}"
                                       class="btn btn-seen btn-xs btn-success"><i class="fa fa-user-md"></i> Seen
                                        @if($seen>0)
                                            <small class="badge bg-green-active">{{ $seen }}</small>
                                        @endif
                                    </a>
                                @endif
                                @if($caller_md > 0)
                                    <a href="#callerModal" data-toggle="modal"
                                       data-id="{{ $row->id }}"
                                       class="btn btn-primary btn-xs btn-caller"><i class="fa fa-phone"></i> Caller
                                        @if($caller_md>0)
                                            <small class="badge bg-blue-active">{{ $caller_md }}</small>
                                        @endif
                                    </a>
                                @endif
                                @if($step==3 && empty(\App\Activity::where("code",$row->code)->where("status","travel")->first()))
                                    <a href="#transferModal" data-toggle="modal"
                                       data-id="{{ $row->id }}" class="btn btn-xs btn-success btn-transfer"><i class="fa fa-ambulance"></i> Travel</a>
                                @endif
                                <button class="btn btn-xs btn-info btn-feedback" data-toggle="modal"
                                        data-target="#feedbackModal"
                                        data-code="{{ $row->code }}">
                                    <i class="fa fa-comments"></i> ReCo
                                    @if($feedback>0)
                                        <span class="badge bg-blue">{{ $feedback }}</span>
                                    @endif
                                </button>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-center">
                        {{ $data->links() }}
                    </div>
                @else
                    <div class="alert alert-warning">
                <span class="text-warning" style="font-weight: bold; font-size: 1.2em;">
                    <i class="fa fa-warning"></i> Referral code couldn't be found!
                </span>
                    </div>
                @endif
            </div>
        </div>

    </div>

    @include('modal.accept')
    @include('modal.view_form')
    @include('modal.seen')
    @include('modal.caller')
    @include('modal.feedback')
@endsection
@section('js')
    @include('script.feedback')
    @include('script.referred')
    <script>
        $(document).ready(function(){
            $('.toggle').toggle();

            $("a[href='#toggle']").on('click',function () {
                var id = $(this).data('id');
                $('.toggle'+id).toggle();
                var txt = ($(this).html() =='View More') ? 'View Less': 'View More';
                $(this).html(txt);
            });
        });
    </script>
@endsection

