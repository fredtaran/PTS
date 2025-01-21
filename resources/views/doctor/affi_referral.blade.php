<?php
$search_referral = Session::get('search_referral');
$user = Auth::user();
?>
@extends('layouts.app')

@section('content')
    <style>
        .timeline .facility {
            color: #ff8456;
        }
    </style>

    <div class="col-md-3">
        @include('sidebar.filter_affi_referral')
        @include('sidebar.quick')
    </div>

    <div class="col-md-9">
        <div class="jim-content">
            @if(count($data) > 0)
            <div class="alert alert-warning">
                <div class="text-warning">
                    <i class="fa fa-warning"></i> Referrals that are not accepted within 72 hours will be <a href="{{ asset('doctor/archived') }}" style="color: #ff405f"> <b><u>archived</u></b></a><br>
                    <i class="fa fa-warning"></i> Referrals that are not accepted within 30 minutes will get a call from 711 DOH CVCHD HealthLine
                </div>
            </div>
            <div class="alert alert-info">
                <div class="text-info">
                    <i class="fa fa-info-circle"></i> Incoming patients referred to a particular department can only be accepted by those registered doctors who are assigned in that department.
                </div>
            </div>
            @endif
            <h3 class="page-header">
                Incoming Patients
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
                                <?php
                                $status = $row->status;

                                $type = ($row->type == 'normal') ? 'normal-section' : 'pregnant-section';
                                $type = ($row->status == 'referred' || $row->status == 'redirected') ? $type : 'read-section';
                                $icon = ($row->status == 'referred' || $row->status == 'redirected') ? 'fa-ambulance' : 'fa-eye';
                                $modal = ($row->type == 'normal') ? '#normalFormModal' : '#pregnantFormModal';
                                $date = date('M d, Y h:i A', strtotime($row->date_referred));    
                                $feedback = \App\Models\Feedback::where('code', $row->code)->count();

                                $department = '"Not specified department"';
                                $check_dept = \App\Department::find($row->department_id);
                                if($check_dept) {
                                    $department = $check_dept->description;
                                }
                                $seen = \App\Models\Seen::where('tracking_id', $row->id)->count();
                                $caller_md = \App\Models\Activity::where('code', $row->code)->where("status", "=", "calling")->count();
                                $redirected = \App\Models\Activity::where('code', $row->code)->where("status", "=", "redirected")->count();
                                ?>
                                <li>
                                    @if($row->status == 'referred' || $row->status == 'seen' || $row->status == 'redirected')
                                    <i class="fa fa-ambulance bg-blue-active"></i>
                                    <div class="timeline-item {{ $type }}" id="item-{{ $row->id }}">
                                        <span class="time"><i class="icon fa {{ $icon }}"></i> <span class="date_activity">{{ $date }}</span></span>
                                        <h3 class="timeline-header no-border">
                                            <strong class="text-bold">
                                                <a href="{{ asset('doctor/referred') . '?referredCode=' . $row->code }}" target="_blank">{{ $row->code }}</a>
                                            </strong>
                                            <small class="status">
                                                [ {{ $row->sex }}, {{ $row->age }} ]
                                            </small>
                                            was <span class="badge bg-blue">referred</span> to
                                            <span class="text-danger">{{ $department }}</span>
                                            by <span class="text-warning">{{ $row->referring_md }}</span> of
                                            <span class="facility">{{ $row->facility_name }}</span>
                                        </h3> <!-- time line for #referred #seen #redirected -->
                                        @include('doctor.include.timeline_footer')
                                    </div>
                                    @elseif($row->status == 'rejected')
                                    <i class="fa fa-user-times bg-maroon"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-calendar"></i> {{ $date }}</span>
                                        <h3 class="timeline-header no-border">
                                            <strong class="text-bold">
                                                <a href="{{ asset('doctor/referred') . '?referredCode=' . $row->code }}" target="_blank">{{ $row->code }}</a>
                                            </strong>
                                            RECOMMENDED TO REDIRECT to other facility by <span class="text-danger">Dr. {{ $row->action_md }}</span>
                                        </h3>
                                        @include('doctor.include.timeline_footer')
                                    </div>
                                    @elseif($row->status == 'cancelled')
                                    <i class="fa fa-ban bg-red"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-calendar"></i> {{ $date }}</span>
                                        <h3 class="timeline-header no-border">
                                            <strong class="text-bold">
                                                <a href="{{ asset('doctor/referred') . '?referredCode=' . $row->code }}" target="_blank">{{ $row->code }}</a>
                                            </strong>
                                            was <span class="badge bg-red">{{ $row->status }}</span> by
                                            {{ $row->referring_md }}
                                            <br><br>
                                            @include('doctor.include.timeline_footer')
                                        </h3>
                                    </div>
                                    @else
                                    <i class="fa fa-user-plus bg-olive"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-calendar"></i> {{ $date }}</span>
                                        <h3 class="timeline-header no-border">
                                            <strong class="text-bold">
                                                <a href="{{ asset('doctor/referred') . '?referredCode=' . $row->code }}" target="_blank">{{ $row->code }}</a>
                                            </strong>
                                            was <span class="badge bg-green">{{ $row->status }}</span> by
                                            <span class="text-success">
                                            Dr. {{ $row->action_md }}
                                            </span>
                                            <br><br>
                                            @include('doctor.include.timeline_footer')
                                        </h3>
                                    </div>
                                @endif
                                </li>
                            @endforeach
                        </ul>
                        <div class="text-center">
                            
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
                                            <li>Date range - {{ $start . ' - ' . $end }}</li>
                                            @if(isset($search_referral['department']))
                                            <li>Department - {{ \App\Models\Department::find($search_referral['department'])->description }}</li>
                                            @endif
                                            @if(isset($facility) && $facility != "")
                                            <li>Facility - {{ \App\Models\Facility::find($facility)->name }}</li>
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
    @include('modal.accept_reject')
    @include('modal.reject')
    @include('modal.refer')
    @include('modal.accept')
    @include('modal.contact')
    @include('modal.seen')
    @include('modal.caller')
    @include('modal.feedback')
@endsection

@section('js')
    @include('script.referral')
    @include('script.feedback')

    <script>
        $('.select_facility3').on('change', function() {
            var id = $(this).val();
            referred_facility = id;
            var url = "{{ url('location/facility/') }}";
            $.ajax({
                url: url + '/' + id,
                type: 'GET',
                success: function(data) {
                    $('.facility_address').html(data.address);

                    $('.select_department').empty()
                        .append($('<option>', {
                            value: '',
                            text : 'Select Department...'
                        }));

                    jQuery.each(data.departments, function(i,val) {
                        $('.select_department').append($('<option>', {
                            value: val.id,
                            text : val.description
                        }));
                    });
                },
                error: function(error) {
                    $('#serverModal').modal();
                }
            });
        });
    
        $(document).ready(function() {
            $('.select2').select2();
        })

        function clearFieldsSidebar() {
            <?php
                Session::put('search_referral', false)
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


