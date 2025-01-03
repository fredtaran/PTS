<?php
    use Illuminate\Support\Facades\Session;
?>
@extends('layouts.app')

@section('content')
    <form action="{{ asset('admin/report/consolidated/incomingv2') }}" method="POST">
        {{ csrf_field() }}
        <div class="row" style="margin-top: -0.5%;margin-bottom: 1%">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" name="date_range" value="{{ date('m/d/Y', strtotime($date_range_start)) . ' - ' . date('m/d/Y', strtotime($date_range_end)) }}" placeholder="Filter your daterange here..." id="consolidate_date_range">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-info btn-flat">Filter</button>
                        <a href="{{ asset('excel/incoming') }}" type="button" name="from_the_start" class="btn btn-warning btn-flat"><i class="fa fa-file-excel-o"></i> Incoming (Excel)</a>
                        <a href="{{ asset('excel/outgoing') }}" type="button" name="from_the_start" class="btn btn-success btn-flat"><i class="fa fa-file-excel-o"></i> Outgoing (Excel)</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
        $user = Auth::user();
        $date_start = $date_range_start;
        $date_end = $date_range_end;
        $accepted_incoming = [];
        $seenzoned_incoming = [];
        $common_source_incoming = [];
        $referring_doctor_incoming = [];
        $diagnosis_ref_incoming = [];
        $reason_ref_incoming = [];
        $transport_ref_incoming = [];
        $department_ref_incoming = [];
        $issue_ref_incoming = [];
        $turnaround_time_accept_incoming = [];
        $turnaround_time_arrived_incoming = [];

        $total_outgoing1 = [];
        $accepted_outgoing1 = [];
        $seenzoned_outgoing1 = [];
        $common_referred_facility_outgoing1 = [];
        $common_referred_doctor_outgoing1 = [];
        $diagnosis_ref_outgoing1 = [];
        $reason_ref_outgoing1 = [];
        $transport_ref_outgoing1 = [];
        $department_ref_outgoing1 = [];
        $issue_ref_outgoing1 = [];
        $turnaround_time_accept_outgoing1 = [];
        $turnaround_time_arrived_outgoing1 = [];
    ?>
    @if(count($data) > 0)
    @foreach($data as $row)
    <div class="box box-success">
        <h3>{{ $title }}</h3>
        <div class="box-body no-padding">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#incoming{{ $row->id }}" data-toggle="tab">Incoming</a></li>
                    <li ><a href="#outgoing{{ $row->id }}" data-toggle="tab">Outgoing</a></li>
                    <li class="pull-right"><strong><div class="text-info">{{ date('F', strtotime($date_range_start)) . " (" . date('Y',strtotime($date_range_start)) . ") " . ' to ' . date('F', strtotime($date_range_end)) . " (" . date('Y', strtotime($date_range_end)) . ")" }}</div></strong></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="incoming{{ $row->id }}">
                        <?php
                            $incoming = $row->count_incoming;
                            $facility_id = $row->id;
                            $accepted = $row->count_accepted;
                            $no_respond = $row->count_no_action;

                            $seenzoned = \DB::connection('mysql')->select("call getViewedOnly('$facility_id', '$date_start', '$date_end')")[0]->viewed_only;
                            $facility = \App\Models\Tracking::select("facility.name", \DB::raw("count(facility.id) as count"))
                                ->leftJoin("facility", "facility.id", "=", "tracking.referred_from")
                                ->where("tracking.referred_to", "=", $row->id)
                                ->where("tracking.date_referred", ">=", $date_start)
                                ->where("tracking.date_referred", "<=", $date_end)
                                ->groupBy('facility.id', 'facility.name')
                                ->orderBy("count", "desc")
                                ->get();
                            $referring_doctor = \App\Models\Tracking::select(\DB::raw("concat('DR. ', users.fname, ' ', users.mname, ' ', users.lname) as fullname"),
                                \DB::raw("count(tracking.referring_md) as count")
                            )
                            ->leftJoin("users", "users.id", "=", "tracking.referring_md")
                            ->where("tracking.referred_to", "=", $row->id)
                            ->where("tracking.date_referred", ">=", $date_start)
                            ->where("tracking.date_referred", "<=", $date_end)
                            ->where(\DB::raw("concat('DR. ', users.fname, ' ', users.mname, ' ', users.lname)"), "!=", "")
                            ->groupBy("tracking.referring_md", 'users.fname', 'users.mname', 'users.lname')
                            ->orderBy("count", "desc")
                            ->limit(10)
                            ->get();

                            $diagnosis_ref = \DB::connection('mysql')->select("call diagnosisIncoming('$facility_id', '$date_start', '$date_end')");
                            $reason_ref = \DB::connection('mysql')->select("call reasonIncoming('$facility_id', '$date_start', '$date_end')");

                            $transport_ref = \App\Models\Tracking::select("mode_transportation.transportation",
                                \DB::raw("count(mode_transportation.id) as count")
                            )
                            ->leftJoin("mode_transportation", "mode_transportation.id", "=", "tracking.mode_transportation")
                            ->where("tracking.referred_to", "=", $row->id)
                            ->where("tracking.date_referred", ">=", $date_start)
                            ->where("tracking.date_referred", "<=", $date_end)
                            ->where("mode_transportation.transportation", "!=", "")
                            ->groupBy('mode_transportation.id', 'mode_transportation.transportation')
                            ->orderBy("count", "desc")
                            ->get();

                            $department_ref = \App\Models\Tracking::select("department.description",
                                \DB::raw("count(department.id) as count")
                            )
                            ->leftJoin("department", "department.id", "=", "tracking.department_id")
                            ->where("tracking.referred_to", "=", $row->id)
                            ->where("tracking.date_referred", ">=", $date_start)
                            ->where("tracking.date_referred", "<=", $date_end)
                            ->where("tracking.department_id", "!=", "")
                            ->groupBy('department.id', 'department.description')
                            ->orderBy("count", "desc")
                            ->get();

                            $issue_ref = \App\Models\Tracking::select("issue.issue")
                                ->leftJoin("issue", "issue.tracking_id", "=", "tracking.id")
                                ->where("tracking.referred_to", "=", $row->id)
                                ->where("tracking.date_referred", ">=", $date_start)
                                ->where("tracking.date_referred", "<=", $date_end)
                                ->where("issue.issue", "!=", "")
                                ->get();

                            $incoming_horizontal = \DB::connection('mysql')->select("call hospitalLevelIncoming('$facility_id', '$date_start', '$date_end')")[0]->horizontal;
                            $incoming_vertical = $incoming - $incoming_horizontal;

                            $accepted_incoming[$facility_id] = $accepted;
                            $seenzoned_incoming[$facility_id] = $no_respond;
                        ?>
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="box-body box-profile">
                                    @if($row->picture)
                                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('hospital_logo') . '/' . $row->picture }}" alt="User profile picture">
                                    @else
                                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/logo.png') }}" alt="User profile picture">
                                    @endif

                                    <h3 class="profile-username text-center">{{ $row->name }}</h3>
                                    <strong><i class="fa fa-random margin-r-5"></i> Transaction</strong>
                                    <p >
                                        <?php
                                            if($user->facility_id == $row->id) {
                                                $viewed_only_href = asset('admin/no_action') . '/' . $facility_id . '/' . $date_start . '/' . $date_end . '/referred_to';
                                                $viewed_only_target = "_target";
                                            } else {
                                                $viewed_only_href = '#';
                                                $viewed_only_target = "";
                                            }

                                            echo '<span class="label label-warning">Incoming <span class="badge bg-red" >' . $incoming . '</span></span>';
                                            echo '<span class="label label-warning">Accepted <span class="badge bg-red" >' . $accepted . '</span></span>';
                                            echo '<a href="' . $viewed_only_href . '" target="' . $viewed_only_target . '"><span class="label label-warning">Not Accepted <small>(click to view form)</small><span class="badge bg-red" >' . $no_respond . '</span></span></a><br><br><br>';
                                        ?>
                                    </p>

                                    <strong><i class="fa fa-clock-o margin-r-5"></i> Turnaround time</strong>
                                    <p>
                                        <?php
                                            $turnaround_time_accept_incoming[$facility_id] = "UNDER DEVELOPMENT";
                                            $turnaround_time_arrived_incoming[$facility_id] = "UNDER DEVELOPMENT";
                                        ?>
                                        @if($accepted)
                                            <?php $turnaround_time_accept_incoming[$facility_id] .= ' mins'; ?>
                                            <span class="label label-primary">Acceptance <?php echo '<span class="badge bg-red"><i class="fa fa-clock-o"></i> UNDER DEVELOPMENT</span>'; ?></span>
                                        @endif
                                        @if($accepted)
                                            <?php $turnaround_time_arrived_incoming[$facility_id] .= ' mins'; ?>
                                            <span class="label label-primary">Arrival <?php echo '<span class="badge bg-red"><i class="fa fa-clock-o"></i> UNDER DEVELOPMENT</span>'; ?></span>
                                        @endif
                                    </p><br><br><br>

                                    <strong><i class="fa fa-book margin-r-5"></i> Hospital Level</strong>
                                    <p>
                                        <span class="label label-success">Horizontal <?php echo '<span class="badge bg-red">' . $incoming_horizontal . '</span>'; ?></span>
                                        <span class="label label-success">Vertical <?php echo '<span class="badge bg-red">' . $incoming_vertical.'</span>'; ?></span>
                                    </p>

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#common_sources{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: green"></i> Referring Facility</a></li>
                                        <li><a href="#common_referring{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: blue"></i> Referring Doctors <small>(Top 10)</small></a></li>
                                        <li><a href="#diagnosis_reason{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: yellowgreen"></i> Diagnoses & Reasons <small>(Top 10)</small></a></li>
                                        <li><a href="#transportation{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: red"></i> Common Transportation</a></li>
                                        <li><a href="#department{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: lightskyblue"></i> Department</a></li>
                                        <li><a href="#issue{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: orange"></i> Remarks</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="common_sources{{ $row->id }}">
                                            <?php $common_source_incoming_concat = ''; ?>
                                            @foreach($facility as $fac)
                                                <?php $common_source_incoming_concat .= $fac->name . '-' . $fac->count . "<br>"; ?>
                                                <label><span class="badge bg-maroon">{{ $fac->count }}</span> {{ $fac->name }}</label><br>
                                            @endforeach
                                            <?php $common_source_incoming[$facility_id] = $common_source_incoming_concat; ?>
                                        </div>
                                        <div class="tab-pane fade" id="common_referring{{ $row->id }}">
                                            <?php $referring_doctor_incoming_concat = ''; ?>
                                            @foreach($referring_doctor as $referring)
                                                    <?php $referring_doctor_incoming_concat .= $referring->fullname . '-' . $referring->count . "<br>"; ?>
                                                <label><span class="badge bg-maroon">{{ $referring->count }}</span> {{ $referring->fullname }}</label><br>
                                            @endforeach
                                            <?php $referring_doctor_incoming[$facility_id] = $referring_doctor_incoming_concat; ?>
                                        </div>
                                        <div class="tab-pane fade" id="diagnosis_reason{{ $row->id }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Diagnosis</h4>
                                                    <?php $diagnosis_ref_incoming_concat = ''; ?>
                                                    @if(count($diagnosis_ref) >= 1)
                                                        @foreach($diagnosis_ref as $diagnosis)
                                                            <?php $diagnosis_ref_incoming_concat .= $diagnosis->diagnosis . '-' . $diagnosis->count . "<br>"; ?>
                                                            <label><span class="badge bg-maroon">{{ $diagnosis->count }}</span> {{ $diagnosis->diagnosis }}</label><br>
                                                        @endforeach
                                                    @else
                                                        <h1>Empty Record!</h1>
                                                    @endif
                                                    <?php $diagnosis_ref_incoming[$facility_id] = $diagnosis_ref_incoming_concat; ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4>Reasons</h4>
                                                    <?php $reason_ref_incoming_concat = ''; ?>
                                                    @if(count($reason_ref) >= 1)
                                                        @foreach($reason_ref as $reason)
                                                            <?php $reason_ref_incoming_concat .= $reason->reason . '-' . $reason->count . "<br>"; ?>
                                                            <label><span class="badge bg-maroon">{{ $reason->count }}</span> {{ $reason->reason }}</label><br>
                                                        @endforeach
                                                    @else
                                                        <h1>Empty Record!</h1>
                                                    @endif
                                                    <?php $reason_ref_incoming[$facility_id] = $reason_ref_incoming_concat; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="transportation{{ $row->id }}">
                                            <?php $transport_ref_incoming_concat = ''; ?>
                                            @if(count($transport_ref) >= 1)
                                                @foreach($transport_ref as $transport)
                                                    <?php $transport_ref_incoming_concat .= $transport->transportation . '-' . $transport->count . "<br>"; ?>
                                                    <label><span class="badge bg-maroon">{{ $transport->count }}</span> {{ $transport->transportation }}</label><br>
                                                @endforeach
                                            @else
                                                <h1>Empty Record!</h1>
                                            @endif
                                            <?php $transport_ref_incoming[$facility_id] = $transport_ref_incoming_concat; ?>
                                        </div>
                                        <div class="tab-pane fade" id="department{{ $row->id }}">
                                            <?php $department_ref_incoming_concat = ''; ?>
                                            @if(count($department_ref) >= 1)
                                                @foreach($department_ref as $department)
                                                    <?php $department_ref_incoming_concat .= $department->description . '-' . $department->count . "<br>"; ?>
                                                    <label><span class="badge bg-maroon">{{ $department->count }}</span> {{ $department->description }}</label><br>
                                                @endforeach
                                            @else
                                                <h1>Empty Record!</h1>
                                            @endif
                                            <?php $department_ref_incoming[$facility_id] = $department_ref_incoming_concat; ?>
                                        </div>
                                        <div class="tab-pane fade" id="issue{{ $row->id }}">
                                            <?php $issue_ref_incoming_concat = ''; ?>
                                            @if(count($issue_ref) >= 1)
                                                @foreach($issue_ref as $issue)
                                                    <?php $issue_ref_incoming_concat .= $issue->issue . "<br>"; ?>
                                                    <label>{{ $issue->issue }}</label><br>
                                                @endforeach
                                            @else
                                                <h1>Empty Record!</h1>
                                            @endif
                                            <?php $issue_ref_incoming[$facility_id] = $issue_ref_incoming_concat; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="outgoing{{ $row->id }}">
                        <?php
                            $outgoing = $row->count_outgoing;
                            $accepted_outgoing = $row->count_accepted_outgoing;
                            $outgoing_no_respond = $row->count_no_action_outgoing;
                            $facility_outgoing = \App\Models\Tracking::select("facility.name",
                                \DB::raw("count(facility.id) as count")
                            )
                            ->leftJoin("facility", "facility.id", "=", "tracking.referred_to")
                            ->where("tracking.referred_from","=",$row->id)
                            ->where("tracking.date_referred", ">=", $date_start)
                            ->where("tracking.date_referred", "<=", $date_end)
                            ->groupBy('facility.id', 'facility.name')
                            ->orderBy("count", "desc")
                            ->get();

                            $referral_md_outgoing = \App\Models\Tracking::select(\DB::raw("concat('DR. ', users.fname, ' ', users.mname, ' ', users.lname) as fullname"),
                                \DB::raw("count(tracking.referring_md) as count")
                            )
                            ->leftJoin("users", "users.id", "=", "tracking.referring_md")
                            ->where("tracking.referred_from", "=", $row->id)
                            ->where(\DB::raw("concat('DR. ', users.fname, ' ', users.mname, ' ', users.lname)"), "!=", "")
                            ->where("tracking.date_referred", ">=", $date_start)
                            ->where("tracking.date_referred", "<=" ,$date_end)
                            ->groupBy("tracking.referring_md", 'users.fname', 'users.mname', 'users.lname')
                            ->orderBy("count", "desc")
                            ->limit(10)
                            ->get();

                            $diagnosis_ref_outgoing = \DB::connection('mysql')->select("call diagnosisOutgoing('$facility_id', '$date_start', '$date_end')");
                            $reason_ref_outgoing = \DB::connection('mysql')->select("call reasonOutgoing('$facility_id', '$date_start', '$date_end')");

                            $transport_ref_outgoing = \App\Models\Tracking::select("mode_transportation.transportation",
                                \DB::raw("count(mode_transportation.id) as count")
                            )
                            ->leftJoin("mode_transportation", "mode_transportation.id", "=", "tracking.mode_transportation")
                            ->where("tracking.referred_from", "=", $row->id)
                            ->where("mode_transportation.transportation", "!=", "")
                            ->where("tracking.date_referred", ">=", $date_start)
                            ->where("tracking.date_referred", "<=", $date_end)
                            ->groupBy('mode_transportation.id', 'mode_transportation.transportation')
                            ->orderBy("count", "desc")
                            ->get();

                            $department_ref_outgoing = \App\Models\Tracking::select("department.description",
                                \DB::raw("count(department.id) as count")
                            )
                            ->leftJoin("department", "department.id", "=", "tracking.department_id")
                            ->where("tracking.referred_from", "=", $row->id)
                            ->where("tracking.date_referred", ">=", $date_start)
                            ->where("tracking.date_referred"," <=", $date_end)
                            ->where("tracking.department_id", "!=", "")
                            ->groupBy('department.id', 'department.description')
                            ->orderBy("count","desc")
                            ->get();

                            $issue_ref_outgoing = \App\Models\Tracking::select("issue.issue")
                                ->leftJoin("issue", "issue.tracking_id", "=", "tracking.id")
                                ->where("tracking.referred_from", "=",$row->id)
                                ->where("tracking.date_referred", ">=", $date_start)
                                ->where("tracking.date_referred", "<=", $date_end)
                                ->where("issue.issue", "!=", "")
                                ->get();

                            $redirected_outgoing = \App\Models\Activity::
                                where("status", "=", "rejected")
                                ->where("date_referred", ">=", $date_start)
                                ->where("date_referred", "<=", $date_end)
                                ->where('referred_from',$row->id)
                                ->count();

                            $achived_outgoing = \App\Models\Tracking::where(function($q) {
                                    $q->where('tracking.status', 'referred')
                                        ->orwhere('tracking.status', 'seen');
                                })
                                ->where(DB::raw("TIMESTAMPDIFF(MINUTE, tracking.date_referred,now())"), ">", 4320)
                                ->where('referred_from', $row->id)
                                ->count();

                            $total_outgoing1[$facility_id] = $outgoing;
                            $accepted_outgoing1[$facility_id] = $accepted_outgoing;
                            $seenzoned_outgoing1[$facility_id] = $outgoing_no_respond;
                        ?>
                        <div class="row">
                            <div class="col-md-4 ">
                                <div class="box-body box-profile">
                                    @if($row->picture)
                                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('hospital_logo') . '/' . $row->picture }}" alt="User profile picture">
                                    @else
                                        <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/logo.png') }}" alt="User profile picture">
                                    @endif

                                    <h3 class="profile-username text-center">{{ $row->name }}</h3>
                                    <strong><i class="fa fa-random margin-r-5"></i> Transaction</strong>
                                    <p>
                                        <?php
                                            if($user->facility_id == $row->id){
                                                $viewed_only_href = asset('admin/no_action').'/'.$facility_id.'/'.$date_start.'/'.$date_end.'/referred_from';
                                                $viewed_only_target = "_target";
                                            } else {
                                                $viewed_only_href = '#';
                                                $viewed_only_target = "";
                                            }
                                            echo '<span class="label label-warning">Outgoing <span class="badge bg-red" >'.$outgoing.'</span></span>';
                                            echo '<span class="label label-warning">Accepted <span class="badge bg-red" >'.$accepted_outgoing.'</span></span>';
                                            echo '<a href="'.$viewed_only_href.'" target="'.$viewed_only_target.'"><span class="label label-warning">Not Accepted <small>(click to view form)</small><span class="badge bg-red" >'.$outgoing_no_respond.'</span></span></a>';
                                            echo '<span class="label label-warning">Redirected <span class="badge bg-red" >'.$redirected_outgoing.'</span></span>';
                                            echo '<span class="label label-warning">Archived <span class="badge bg-red" >Under Development</span></span><br><br><br><br><br>';
                                        ?>
                                    </p>
                                    <strong><i class="fa fa-clock-o margin-r-5"></i> Turnaround time</strong>
                                    <p>
                                        <span class="label label-primary">Viewed Only Acceptance<?php echo '<span class="badge bg-red"><i class="fa fa-clock-o"></i> '.' Under Development</span>'; ?></span>
                                        <span class="label label-primary">Viewed Only Redirection<?php echo '<span class="badge bg-red"><i class="fa fa-clock-o"></i> '.' Under Development</span>'; ?></span>
                                        <?php
                                            $turnaround_time_accept_outgoing1[$facility_id] = $outgoing;
                                            $turnaround_time_arrived_outgoing1[$facility_id] = $outgoing;
                                        ?>
                                        @if($outgoing)
                                            <?php $turnaround_time_accept_outgoing1[$facility_id] .= ' mins'; ?>
                                            <span class="label label-primary">Acceptance <?php echo '<span class="badge bg-red"><i class="fa fa-clock-o"></i> '.' Under Development</span>'; ?></span>
                                        @endif
                                        <span class="label label-primary">Redirection <?php echo '<span class="badge bg-red"><i class="fa fa-clock-o"></i> '.' Under Development</span>'; ?></span>
                                        @if($outgoing)
                                            <?php $turnaround_time_arrived_outgoing1[$facility_id] .= ' mins'; ?>
                                            <span class="label label-primary">To Transport <?php echo '<span class="badge bg-red"><i class="fa fa-clock-o"></i> '.' Under Development</span>'; ?></span>
                                        @endif
                                    </p><br><br><br><br><br><br><br><br>

                                    <strong><i class="fa fa-book margin-r-5"></i> Hospital Level</strong>
                                    <p>
                                        <span class="label label-success">Horizontal <?php echo '<span class="badge bg-red">'.'Under Development</span>'; ?></span>
                                        <span class="label label-success">Vertical <?php echo '<span class="badge bg-red">'.'Under Development</span>'; ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#referral_hospitals_outgoing{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: green"></i> Referred Facility</a></li>
                                        <li><a href="#referral_md_outgoing{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: blue"></i> Referred Doctor <small>(Top 10)</small></a></li>
                                        <li><a href="#diagnosis_reason_outgoing{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: yellowgreen"></i> Diagnoses & Reasons <small>(Top 10)</small></a></li>
                                        <li><a href="#transportation_outgoing{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: red"></i> Common Transportation</a></li>
                                        <li><a href="#department_outgoing{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: lightskyblue"></i> Department</a></li>
                                        <li><a href="#issue_outgoing{{ $row->id }}" data-toggle="tab"><i class="fa fa-ambulance" style="color: orange"></i> Remarks</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="referral_hospitals_outgoing{{ $row->id }}">
                                            <?php $common_referred_facility_outgoing_concat = ''; ?>
                                            @foreach($facility_outgoing as $fac_outgoing)
                                                <?php $common_referred_facility_outgoing_concat .= $fac_outgoing->name.'-'.$fac_outgoing->count."<br>"; ?>
                                                <label><span class="badge bg-maroon">{{ $fac_outgoing->count }}</span> {{ $fac_outgoing->name }}</label><br>
                                            @endforeach
                                            <?php $common_referred_facility_outgoing1[$facility_id] = $common_referred_facility_outgoing_concat; ?>
                                        </div>
                                        <div class="tab-pane fade" id="referral_md_outgoing{{ $row->id }}">
                                            <?php $common_referred_doctor_outgoing_concat = ''; ?>
                                            @foreach($referral_md_outgoing as $ref_md_outgoing)
                                                <?php $common_referred_doctor_outgoing_concat .= $ref_md_outgoing->fullname.'-'.$ref_md_outgoing->count."<br>"; ?>
                                                <label><span class="badge bg-maroon">{{ $ref_md_outgoing->count }}</span> {{ $ref_md_outgoing->fullname }}</label><br>
                                            @endforeach
                                            <?php $common_referred_doctor_outgoing1[$facility_id] = $common_referred_doctor_outgoing_concat; ?>
                                        </div>
                                        <div class="tab-pane fade" id="diagnosis_reason_outgoing{{ $row->id }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Diagnosis</h4>
                                                    <?php $diagnosis_ref_outgoing_concat = ''; ?>
                                                    @if(count($diagnosis_ref_outgoing) >= 1)
                                                        @foreach($diagnosis_ref_outgoing as $diagnosis_outgoing)
                                                            <?php $diagnosis_ref_outgoing_concat .= $diagnosis_outgoing->diagnosis.'-'.$diagnosis_outgoing->count."<br>"; ?>
                                                            <label><span class="badge bg-maroon">{{ $diagnosis_outgoing->count }}</span> {{ $diagnosis_outgoing->diagnosis }}</label><br>
                                                        @endforeach
                                                    @else
                                                        <h1>Empty Record!</h1>
                                                    @endif
                                                    <?php $diagnosis_ref_outgoing1[$facility_id] = $diagnosis_ref_outgoing_concat; ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4>Reasons</h4>
                                                    <?php $reason_ref_outgoing_concat = ''; ?>
                                                    @if(count($reason_ref_outgoing) >= 1)
                                                        @foreach($reason_ref_outgoing as $reason_outgoing)
                                                            <?php $reason_ref_outgoing_concat .= $reason_outgoing->reason.'-'.$reason_outgoing->count."<br>"; ?>
                                                            <label><span class="badge bg-maroon">{{ $reason_outgoing->count }}</span> {{ $reason_outgoing->reason }}</label><br>
                                                        @endforeach
                                                    @else
                                                        <h1>Empty Record!</h1>
                                                    @endif
                                                    <?php $reason_ref_outgoing1[$facility_id] = $reason_ref_outgoing_concat; ?>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="transportation_outgoing{{ $row->id }}">
                                            <?php $transport_ref_outgoing_concat = ''; ?>
                                            @if(count($transport_ref_outgoing) >= 1)
                                                @foreach($transport_ref_outgoing as $transport_outgoing)
                                                    <?php $transport_ref_outgoing_concat .= $transport_outgoing->transportation.'-'.$transport_outgoing->count."<br>"; ?>
                                                    <label><span class="badge bg-maroon">{{ $transport_outgoing->count }}</span> {{ $transport_outgoing->transportation }}</label><br>
                                                @endforeach
                                            @else
                                                <h1>Empty Record!</h1>
                                            @endif
                                            <?php $transport_ref_outgoing1[$facility_id] = $transport_ref_outgoing_concat; ?>
                                        </div>
                                        <div class="tab-pane fade" id="department_outgoing{{ $row->id }}">
                                            <?php $department_ref_outgoing_concat = ''; ?>
                                            @if(count($department_ref_outgoing) >= 1)
                                                @foreach($department_ref_outgoing as $department_outgoing)
                                                    <?php $department_ref_outgoing_concat .= $department_outgoing->description.'-'.$department_outgoing->count."<br>"; ?>
                                                    <label><span class="badge bg-maroon">{{ $department_outgoing->count }}</span> {{ $department_outgoing->description }}</label><br>
                                                @endforeach
                                            @else
                                                <h1>Empty Record!</h1>
                                            @endif
                                            <?php $department_ref_outgoing1[$facility_id] = $department_ref_outgoing_concat; ?>
                                        </div>
                                        <div class="tab-pane fade" id="issue_outgoing{{ $row->id }}">
                                            <?php $issue_ref_outgoing_concat = ''; ?>
                                            @if(count($issue_ref_outgoing) >= 1)
                                                @foreach($issue_ref_outgoing as $issue_outgoing)
                                                    <?php $issue_ref_outgoing_concat .= $issue_outgoing->issue."<br>"; ?>
                                                    <label>{{ $issue_outgoing->issue }}</label><br>
                                                @endforeach
                                            @else
                                                <h1>Empty Record!</h1>
                                            @endif
                                            <?php $issue_ref_outgoing1[$facility_id] = $issue_ref_outgoing_concat; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
        <div class="alert-section">
            <div class="alert alert-warning">
                <span class="text-warning">
                    <i class="fa fa-warning"></i> No referrals!
                    <ul>
                        <li>Filer List:</li>
                        <ul>
                            <li>Date range - {{ $date_range_start.' - '.$date_range_end }}</li>
                        </ul>
                    </ul>
                </span>
            </div>
        </div>
    @endif
    <?php
        //INCOMING
        Session::put('accepted_incoming',$accepted_incoming);
        Session::put('seenzoned_incoming',$seenzoned_incoming);
        Session::put('common_source_incoming',$common_source_incoming);
        Session::put('referring_doctor_incoming',$referring_doctor_incoming);
        Session::put('diagnosis_ref_incoming',$diagnosis_ref_incoming);
        Session::put('reason_ref_incoming',$reason_ref_incoming);
        Session::put('transport_ref_incoming',$transport_ref_incoming);
        Session::put('department_ref_incoming',$department_ref_incoming);
        Session::put('issue_ref_incoming',$issue_ref_incoming);
        Session::put('turnaround_time_accept_incoming',$turnaround_time_accept_incoming);
        Session::put('turnaround_time_arrived_incoming',$turnaround_time_arrived_incoming);
        //OUTGOING
        Session::put('total_outgoing1',$total_outgoing1);
        Session::put('accepted_outgoing1',$accepted_outgoing1);
        Session::put('seenzoned_outgoing1',$seenzoned_outgoing1);
        Session::put('common_referred_facility_outgoing1',$common_referred_facility_outgoing1);
        Session::put('common_referred_doctor_outgoing1',$common_referred_doctor_outgoing1);
        Session::put('diagnosis_ref_outgoing1',$diagnosis_ref_outgoing1);
        Session::put('reason_ref_outgoing1',$reason_ref_outgoing1);
        Session::put('transport_ref_outgoing1',$transport_ref_outgoing1);
        Session::put('department_ref_outgoing1',$department_ref_outgoing1);
        Session::put('issue_ref_outgoing1',$issue_ref_outgoing1);
        Session::put('turnaround_time_accept_outgoing1',$turnaround_time_accept_outgoing1);
        Session::put('turnaround_time_arrived_outgoing1',$turnaround_time_arrived_outgoing1);
    ?>

@endsection

@section('css')

@endsection

@section('js')
    <script>
        //Date range picker
        $('#consolidate_date_range').daterangepicker();
    </script>

@endsection