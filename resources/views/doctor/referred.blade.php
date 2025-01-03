<?php
$user = Session::get('auth');
?>
@extends('layouts.app')

@section('content')
    <style>
        .timeline .facility {
            color: #ff8456;
        }
        div.timeline-header{
            padding: 10px;
            color: #333;
        }
        .text-remarks {
            padding: 3px 5px;
            background: #c0ff99;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        ul.timeline li:first-child {
            cursor: pointer;
        }
        .modal-xl {
        width: 90%;
        margin: auto;
        }
    </style>
    <div class="col-md-12">
        <div class="jim-content">
            <h3 class="page-header">Referred Patients

            </h3>
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    @if(count($data) > 0)
                        @foreach($data as $row)
                            <?php
                            $type = ($row->type=='normal') ? 'normal-section':'pregnant-section';
                            $type = ($row->status=='referred') ? $type : 'read-section';
                            $icon = ($row->status=='referred') ? 'fa-ambulance' : 'fa-eye'; 
                            $modal = ($row->type=='normal') ? '#normalFormModal' : '#RefferedpregnantFormModalTrack';
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
                                        ->where('referred_from',$user->facility_id)
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
                            ?>
                            <ul class="timeline activity-{{ $row->id }} code-{{ $row->code }}">
                                <li>
                                    <i class="fa fa-user bg-blue-active"></i>
                                    <div class="timeline-item {{ $type }}" id="item-{{ $row->id }}">
                                        {{--<span class="time"><i class="icon fa {{ $icon }}"></i> <span class="date_activity">{{ $date }}</span></span>--}}
                                        <h3 class="timeline-header no-border">
                                            <?php
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

                                            ?>
                                            {{--<a href="#" class="patient_name">{{ $row->patient_name }}</a> <small class="status">[ {{ $row->sex }}, {{ $row->age }} ]</small> was referred to <span class="text-danger">{{ $department_name }}</span> of <span class="facility">{{ $row->facility_name }}</span> by <span class="text-warning">Dr. {{ $row->referring_md }}</span>.--}}
                                            <a href="#" class="patient_name">{{ $row->patient_name }}</a> <small class="status">[ {{ $row->sex }}, {{ $row->age }} ]</small> from <span class="facility">{{ $patient_address }}</span>.
                                            <br />
                                            <small style="font-size: 0.8em;" class="text-danger">[ Patient Code: {{ $row->code }} ]</small>
                                        </h3>
                                        <div class="timeline-footer">
                                            <div class="form-inline">
                                                <?php $checkForCancellation = \App\Http\Controllers\doctor\ReferralCtrl::checkForCancellation($row->code);?>
                                                @if(!$checkForCancellation)
                                                <div class="form-group">
                                                    <a href="#cancelModal" data-toggle="modal"
                                                       data-id="{{ $row->id }}"
                                                       class="btn btn-danger btn-xs btn-cancel col-xs-12"><i class="fa fa-user-times"></i> Cancel Referral</a>
                                                </div>
                                                @endif
                                                <div class="form-group">
                                                    <a href="{{ $modal }}" data-toggle="modal"
                                                       data-type="{{ $row->type }}"
                                                       data-id="{{ $row->id }}"
                                                       data-code="{{ $row->code }}"
                                                       class="view_form btn btn-warning btn-xs col-xs-12"><i class="fa fa-folder"></i> View Form</a>
                                                </div>
                                                @if(count($activities)>1)
                                                <div class="form-group">
                                                    <a class="btn btn-info btn-xs btn-activity col-xs-12"><i class="fa fa-line-chart"></i> View {{ count($activities) }} Activities</a>
                                                </div>
                                                @endif

                                                @if($seen > 0)
                                                <div class="form-group">
                                                    <a href="#seenModal" data-toggle="modal"
                                                       data-id="{{ $row->id }}"
                                                       class="btn btn-success btn-xs btn-seen col-xs-12"><i class="fa fa-user-md"></i> Seen by {{ $seen }} User{{ ($seen>1) ? 's':'' }}</a>
                                                </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </li>
                                @if(count($activities) > 0)

                                    @foreach($activities as $act)
                                        <?php

                                        $act_icon = ($act->status=='rejected') ? 'fa-user-times': 'fa-user-plus';
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
                                        <li>

                                            @if($act->status=='rejected')
                                                <div class="timeline-item read-section">
                                                    <span class="time"><i class="fa {{ $act_icon }}"></i> {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</span>
                                                    <a>
                                                        <div class="timeline-header no-border">
                                                            <span class="text-danger">Dr. {{ $act->md_name }}</span> of <span class="facility">{{ $new_facility }}</span> recommended to redirect <span class="text-success">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span> to other facility.
                                                            <br />
                                                            <div class="text-remarks">
                                                                Remarks: {{ $act->remarks }}
                                                            </div>
                                                            @if($act->department_id==0 && $user->facility_id==$act->referred_from)
                                                                <button class="btn btn-success btn-xs btn-referred" data-toggle="modal" data-target="#referredFormModal" data-activity_id="{{ $act->id }}">
                                                                    <i class="fa fa-ambulance"></i> Refer to other facility
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </a>

                                                </div>
                                            @elseif($act->status=='referred' || $act->status=='redirected')
                                                <?php
                                                $act_section = 'normal';
                                                $act_icon = 'ambulance';
                                                $act_date = $act->date_referred;
                                                if($act->date_seen!='0000-00-00 00:00:00')
                                                {
                                                    $act_section = 'read';
                                                    $act_icon ='eye';
                                                    $act_date = $act->date_seen;
                                                }
                                                ?>
                                                <div class="timeline-item {{ $act_section }}-section" id="activity-{{ $act->id }}">
                                                    <span class="time"><i class="icon fa fa-{{ $act_icon }}"></i> <span class="date_activity">{{ date('M d, Y h:i A',strtotime($act_date)) }}</span></span>
                                                    <a>
                                                        <div class="timeline-header no-border">
                                                            @if($act->referring_md_id!=0)
                                                                {{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}  was referred by <span class="text-success">Dr. {{ $act->referring_md }}</span> of <span class="facility">{{ $old_facility }}</span> to <span class="facility">{{ $new_facility }}.</span>
                                                            @else
                                                                <strong>Walk-In Patient:</strong> <span class="text-success">{{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}</span>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </div>
                                            @elseif($act->status=='transferred')
                                                <?php
                                                $act_section = 'normal';
                                                $act_icon = 'ambulance';
                                                $act_date = $act->date_referred;
                                                if($act->date_seen!='0000-00-00 00:00:00')
                                                {
                                                    $act_section = 'read';
                                                    $act_icon ='eye';
                                                    $act_date = $act->date_seen;
                                                }
                                                ?>
                                                <div class="timeline-item {{ $act_section }}-section" id="activity-{{ $act->id }}">
                                                    <span class="time"><i class="icon fa fa-{{ $act_icon }}"></i> <span class="date_activity">{{ date('M d, Y h:i A',strtotime($act_date)) }}</span></span>
                                                    <a>
                                                        <div class="timeline-header no-border">
                                                            {{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}  was referred by <span class="text-success">Dr. {{ $act->md_name }}</span> of <span class="facility">{{ $old_facility }}</span> to <span class="facility">{{ $new_facility }}.</span>
                                                            <br />
                                                            <div class="text-remarks">Remarks: {{ $act->remarks }}</div>
                                                        </div>
                                                    </a>

                                                </div>
                                            @elseif($act->status=='redirected')
                                                <div class="timeline-item read-section">
                                                    <span class="time"><i class="fa {{ $act_icon }}"></i> {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</span>
                                                    <a>
                                                        <div class="timeline-header no-border">
                                                            {{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}  was referred by <span class="text-success">Dr. {{ $act->md_name }}</span> to <span class="facility">{{ $new_facility }}.</span>
                                                        </div>
                                                    </a>

                                                </div>
                                            @elseif($act->status=='calling')
                                                <div class="timeline-item {{ ($act->remarks=='N/A') ? 'normal-section': 'read-section' }}">
                                                    <span class="time"><i class="fa fa-phone"></i> {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</span>
                                                    <a>
                                                        <div class="timeline-header no-border">
                                                            <span class="text-info">Dr. {{ $act->md_name }}</span> of <span class="facility">{{ $new_facility }}</span> is requesting a call from <span class="facility">{{ $old_facility }}</span>.
                                                            @if($user->facility_id==$act->referred_from)
                                                                Please contact this number <span class="text-danger">({{ $act->contact }})</span> .
                                                            @endif
                                                            <br />
                                                            @if($act->remarks==='N/A')
                                                                @if($user->facility_id==$act->referred_from)
                                                                    <button type="button" class="btn btn-success btn-sm btn-call"
                                                                            data-action_md = "{{ $act->md_name }}"
                                                                            data-facility_name = "{{ $old_facility }}"
                                                                            data-activity_id="{{ $act->id }}"><i class="fa fa-phone"></i> Called</button>
                                                                @endif
                                                                <div class="text-remarks hide"></div>
                                                            @else
                                                                <div class="text-remarks">Remarks: {{ $act->remarks }}</div>
                                                            @endif

                                                        </div>

                                                    </a>
                                                </div>
                                            @elseif($act->status=='called')
                                                <div class="timeline-item read-section">
                                                    <span class="time"><i class="fa fa-phone"></i> {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</span>
                                                    <a href="#">
                                                        <div class="timeline-header no-border">
                                                            <span class="text-info">Dr. {{ $act->md_name }}</span> of <span class="facility">{{ $new_facility }}</span> called the referring facility.
                                                        </div>
                                                    </a>
                                                </div>
                                            @elseif($act->status=='arrived')
                                                <div class="timeline-item read-section">
                                                    <span class="time"><i class="fa fa-wheelchair"></i> {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</span>
                                                    <a>
                                                        <div class="timeline-header no-border">
                                                            {{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }} arrived at <span class="facility">{{ $new_facility }}</span>.
                                                            <br />
                                                            <div class="text-remarks">Remarks: {{ $act->remarks }}</div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @elseif($act->status=='cancelled')
                                                <?php
                                                    $doctor = \App\User::find($act->action_md);
                                                ?>
                                                <div class="timeline-item read-section">
                                                    <span class="time"><i class="fa fa-user-times"></i> {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</span>
                                                    <a>
                                                        <div class="timeline-header no-border">
                                                            Referral was cancelled by  by <span class="text-success">Dr. {{ ucwords(strtolower($doctor->fname)) }} {{ ucwords(strtolower($doctor->lname)) }}</span>.
                                                            <br />
                                                            <div class="text-remarks">Reason: {{ $act->remarks }}</div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @elseif($act->status=='admitted')
                                                <div class="timeline-item read-section">
                                                    <span class="time"><i class="fa fa-stethoscope"></i> {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</span>
                                                    <a href="#">
                                                        <div class="timeline-header no-border">
                                                            {{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }} admitted at <span class="facility">{{ $new_facility }}</span>.
                                                        </div>
                                                    </a>
                                                </div>
                                            @elseif($act->status=='monitored')
                                                <div class="timeline-item read-section">
                                                    <span class="time"><i class="fas fa-search-location"></i> {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</span>
                                                    <a href="#">
                                                        <div class="timeline-header no-border">
                                                            {{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }} monitored as OPD at <span class="facility">{{ $new_facility }}</span>.
                                                        </div>
                                                    </a>
                                                </div>
                                            @elseif($act->status=='discharged')
                                                <div class="timeline-item read-section">
                                                    <span class="time"><i class="fa fa-stethoscope"></i> {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</span>
                                                    <a>
                                                        <div class="timeline-header no-border">
                                                            {{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }} discharged from <span class="facility">{{ $new_facility }}</span>.
                                                            <br />
                                                            <div class="text-remarks">Remarks: {{ $act->remarks }}</div>
                                                        </div>
                                                    </a>
                                                </div>
                                            @elseif($act->status=='accepted')
                                                <div class="timeline-item read-section">
                                                    <span class="time"><i class="fa {{ $act_icon }}"></i> {{ date('M d, Y h:i A',strtotime($act->date_referred)) }}</span>
                                                    <a>
                                                        <div class="timeline-header no-border">
                                                            {{ $act_name->fname }} {{ $act_name->mname }} {{ $act_name->lname }}  was accepted by <span class="text-success">Dr. {{ $act->md_name }}</span> of <span class="facility">{{ $new_facility }}</span>.</span>
                                                            <br />
                                                            <div class="text-remarks">Remarks: {{ $act->remarks }}</div>
                                                        </div>
                                                    </a>

                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        @endforeach

                        <div class="text-center">
                            {{ $data->links() }}
                        </div>
                    @else
                        <div class="alert alert-warning">
                        <span class="text-warning">
                            <i class="fa fa-warning"></i> No Referred Patients!
                        </span>
                        </div>
                    @endif
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>

    </div>
    {{--<div class="col-md-3">--}}
        {{--@include('sidebar.quick')--}}
    {{--</div>--}}
    @include('modal.accept')
    @include('modal.refer')
    @include('modal.view_form')
    @include('modal.seen')
    @include('modal.cancel')
@endsection
@include('script.firebase')
@section('js')
    @include('script.referred')

@endsection




