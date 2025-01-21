<?php
$search_referral = Session::get('search_referral');
$user = Session::get('auth');
?>
@extends('layouts.app')

@section('content')
    <style>
        .timeline .facility {
            color: #ff8456;
        }
        .modal-xl {
        width: 90%;
        margin: auto;
        }
        
        .pre_pregnancy_table td
        {
            width: 1%;
            text-align:center;
        }

        .pre_pregnancy_table th
        {
            text-align:center;
        }
        .sign_symthoms_table th
        {
            text-align:center;
        }
        .sign_symthoms_table td
        {
            text-align:center;
        }
        .sign_symthoms_table_box td
        {
            text-align:left;
        }
    </style>
    <div class="col-md-3">
    @include('admin.sidebar.filter_aog')
    </div>
    <div class="col-md-9">
        <div class="jim-content">
            @if(count($data) > 0)
            <!-- <div class="alert alert-warning">
                <div class="text-warning">
                    <i class="fa fa-warning"></i> Referrals that are not accepted within 72 hours will be <a href="{{ asset('doctor/archived') }}" style="color: #ff405f"> <b><u>archived</u></b></a><br>
                    <i class="fa fa-warning"></i> Referrals that are not accepted within 30 minutes will get a call from 711 DOH CVCHD HealthLine
                </div>
            </div>
            <div class="alert alert-info">
                <div class="text-info">
                    <i class="fa fa-info-circle"></i> Incoming patients referred to a particular department can only be accepted by those registered doctors who are assigned in that department.
                </div>
            </div> -->
            @endif
            <h3 class="page-header">
                Patients with 34weeks AOG or Above
            </h3>
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->

                    @if(count($data) > 0)
                        <ul class="timeline">
                            <!-- timeline time label -->

                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            @foreach($data as $row)
                                @if($row->now >= '34')
                                    <?php
                                    $status = $row->status;

                                    $type = ($row->type=='normal') ? 'normal-section':'pregnant-section';
                                    $type = ($row->status=='referred' || $row->status=='redirected') ? $type : 'read-section';
                                    $icon = ($row->status=='referred' || $row->status=='redirected') ? 'fa-ambulance' : 'fa-eye';
                                    $modal = ($row->type=='normal') ? '#normalFormModal' : '#RefferedpregnantFormModalTrack';
                                    $date = date('M d, Y h:i A',strtotime($row->date_referred));    
                                    $feedback = \App\Feedback::where('code',$row->code)->count();

                                    $department = '"Not specified department"';
                                    $check_dept = \App\Department::find($row->department_id);
                                    if($check_dept)
                                    {
                                        $department = $check_dept->description;
                                    }
                                    $seen = \App\Seen::where('tracking_id',$row->id)->count();
                                    $caller_md = \App\Activity::where('code',$row->code)->where("status","=","calling")->count();
                                    $redirected = \App\Activity::where('code',$row->code)->where("status","=","redirected")->count();
                                    ?>
                              
                                    <li>
                                        @if($row->status == 'referred' || $row->status == 'seen' || $row->status == 'redirected')
                                        <i class="fa fa-ambulance bg-blue-active"></i>
                                        <div class="timeline-item {{ $type }}" id="item-{{ $row->id }}">
                                            <span class="time"><i class="icon fa {{ $icon }}"></i> <span class="date_activity">{{ $date }}</span></span>
                                            <h3 class="timeline-header no-border">
                                                <strong class="text-bold">
                                                    <a href="{{ asset("doctor/referred")."?referredCode=".$row->code }}" target="_blank">{{ $row->code }}</a>
                                                </strong>
                                                <small class="status">
                                                    [ {{ $row->sex }}, {{ $row->age }} ]
                                                </small>
                                                was <span class="badge bg-blue">referred</span> to
                                                <span class="text-danger">{{ $department }}</span>
                                                by <span class="text-warning">{{ $row->referring_md }}</span> of
                                                <span class="facility">{{ $row->facility_name }}</span>
                                            </h3> <!-- time line for #referred #seen #redirected -->
                                            <div class="timeline-footer">
                                                <div class="form-inline">
                                                    @if( ($row->status == 'referred' || $row->status == 'seen' || $row->status == 'redirected' || $row->status == 'transferred') && $user->department_id == $row->department_id )
                                                        <div class="form-group">
                                                            <a class="btn btn-warning btn-xs btn-refer" href="{{ $modal }}"
                                                            data-toggle="modal"
                                                            data-code="{{ $row->code }}"
                                                            data-item="#item-{{ $row->id }}"
                                                            data-status="{{ $row->status }}"
                                                            data-type="{{ $row->type }}"
                                                            data-id="{{ $row->id }}"
                                                            data-referred_from="{{ $row->referred_from }}"
                                                            data-backdrop="static">
                                                                <i class="fa fa-folder"></i> View Form
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($row->status=='rejected')
                                        <i class="fa fa-user-times bg-maroon"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-calendar"></i> {{ $date }}</span>
                                            <h3 class="timeline-header no-border">
                                                <strong class="text-bold">
                                                    <a href="{{ asset("doctor/referred")."?referredCode=".$row->code }}" target="_blank">{{ $row->code }}</a>
                                                </strong>
                                                RECOMMENDED TO REDIRECT to other facility by <span class="text-danger">Dr. {{ $row->action_md }}</span>
                                            </h3>
                                            <div class="timeline-footer">
                                                <div class="form-inline">
                                                    @if( ($row->status == 'referred' || $row->status == 'seen' || $row->status == 'redirected' || $row->status == 'transferred') && $user->department_id == $row->department_id )
                                                        <div class="form-group">
                                                            <a class="btn btn-warning btn-xs btn-refer" href="{{ $modal }}"
                                                            data-toggle="modal"
                                                            data-code="{{ $row->code }}"
                                                            data-item="#item-{{ $row->id }}"
                                                            data-status="{{ $row->status }}"
                                                            data-type="{{ $row->type }}"
                                                            data-id="{{ $row->id }}"
                                                            data-referred_from="{{ $row->referred_from }}"
                                                            data-backdrop="static">
                                                                <i class="fa fa-folder"></i> View Form
                                                            </a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @elseif($row->status=='cancelled')
                                        <i class="fa fa-ban bg-red"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-calendar"></i> {{ $date }}</span>
                                            <h3 class="timeline-header no-border">
                                                <strong class="text-bold">
                                                    <a href="{{ asset("doctor/referred")."?referredCode=".$row->code }}" target="_blank">{{ $row->code }}</a>
                                                </strong>
                                                was <span class="badge bg-red">{{ $row->status }}</span> by
                                                {{ $row->referring_md }}
                                                <br><br>
                                                <div class="timeline-footer">
                                                    <div class="form-inline">
                                                        @if( ($row->status == 'referred' || $row->status == 'seen' || $row->status == 'redirected' || $row->status == 'transferred') && $user->department_id == $row->department_id )
                                                            <div class="form-group">
                                                                <a class="btn btn-warning btn-xs btn-refer" href="{{ $modal }}"
                                                                data-toggle="modal"
                                                                data-code="{{ $row->code }}"
                                                                data-item="#item-{{ $row->id }}"
                                                                data-status="{{ $row->status }}"
                                                                data-type="{{ $row->type }}"
                                                                data-id="{{ $row->id }}"
                                                                data-referred_from="{{ $row->referred_from }}"
                                                                data-backdrop="static">
                                                                    <i class="fa fa-folder"></i> View Form
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </h3>
                                        </div>
                                        @else
                                        <i class="fa fa-user-plus bg-olive"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fa fa-calendar"></i> {{ $date }}</span>
                                            <h3 class="timeline-header no-border">
                                                <strong class="text-bold">
                                                    <a href="{{ asset("doctor/referred")."?referredCode=".$row->code }}" target="_blank">{{ $row->code }}</a>
                                                </strong>
                                                was <span class="badge bg-green">{{ $row->status }}</span> by
                                                <span class="text-success">
                                                Dr. {{ $row->action_md }}
                                                </span>
                                                <br>
                                                <span class="text-danger">Patient current AOG {{$row->now}} weeks</span>
                                                <br><br>
                                                @if($seen > 0)
                                                    <div class="form-group">
                                                        <a href="#seenModal" data-toggle="modal"
                                                        data-id="{{ $row->id }}"
                                                        class="btn btn-success btn-xs btn-seen"><i class="fa fa-user-md"></i> Seen
                                                            @if($seen>0)
                                                                <small class="badge bg-green-active">{{ $seen }}</small>
                                                            @endif
                                                        </a>
                                                    </div>
                                                @endif
                                            </h3>
                                        </div>
                                    @endif
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="text-center">
                            {{ $data->links() }}
                        </div>
                    @else
                        <div class="alert-section">
                            <div class="alert alert-warning">
                                <span class="text-warning">
                                    <i class="fa fa-warning"></i> No referrals!
                                    <ul>
                                        <li>Filter List:</li>
                                        <ul>
                                            @if(isset($search_referral['keyword']))
                                            <li>Code - {{ $search_referral['keyword'] }}</li>
                                            @endif
                                            <li>Date range - {{ $start.' - '.$end }}</li>
                                            @if(isset($search_referral['department']))
                                            <li>Department - {{ \App\Department::find($search_referral['department'])->description }}</li>
                                            @endif
                                        </ul>
                                    </ul>
                                </span>
                            </div>
                        </div>

                        <ul class="timeline">
                        </ul>
                    @endif
                </div><!-- /.col -->
            </div><!-- /.row -->
          </div>
        </div>
    </div>
    @include('modal.feedback')
    @include('modal.caller')
    @include('modal.seen')
    @include('modal.refer')
    @include('modal.reject')
    @include('modal.contact')
    @include('modal.accept')
    @include('modal.accept_reject')

@endsection
@section('css')

@endsection

@section('js')
    @include('script.referral')
    @include('script.feedback')

    <script>
        $('.select2').select2();

        function clearFieldsSidebar(){
            <?php
                Session::put('search_referral',false)
            ?>
            refreshPage();
        }

        $('#daterange').daterangepicker({
            "singleDatePicker": false,
            "startDate": "{{ $start }}",
            "endDate": "{{ $end }}"
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });

        @if(Session::get('incoming_denied'))
            Lobibox.alert("error", //AVAILABLE TYPES: "error", "info", "success", "warning"
            {
                msg: "This form was already accepted"
            });
            <?php Session::put("incoming_denied",false); ?>
        @endif

 @if(Session::get('incidentadd'))
        Lobibox.notify('success', {
            title: "",
            msg: "<?php echo Session::get("incidentadd_message"); ?>",
            size: 'mini',
            rounded: true,
            sound: false
        });
    <?php
        Session::put("incidentadd",false);
        Session::put("incidentadd_message",false)
    ?>
@endif
    </script>
@endsection


