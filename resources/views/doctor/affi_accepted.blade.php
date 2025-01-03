<?php
$user = Session::get('auth');
$start = \Carbon\Carbon::parse($start)->format('m/d/Y');
$end = \Carbon\Carbon::parse($end)->format('m/d/Y');
?>
@extends('layouts.app')

@section('css')

@endsection

@section('content')
    <style>
        .facility {
            color: #ff8456;
        }
    </style>
    <div class="col-md-12">
        <div class="jim-content">
            <div class="pull-right">
                <form class="form-inline" action="{{ url('doctor/accepted') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Code,Firstname,Lastname" value="{{ \Illuminate\Support\Facades\Session::get('keywordAccepted') }}" name="keyword">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" id="daterange" value="{{ date("m/d/Y",strtotime($start)).' - '.date("m/d/Y",strtotime($end)) }}" max="{{ date('Y-m-d') }}" name="daterange">
                    </div>
                    <button type="submit" class="btn btn-md btn-success" style="padding: 8px 15px;"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <h3 class="page-header">{{ $title }} <small class="text-danger">TOTAL: {{ $patient_count }}</small> </h3>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    @if(count($data)>0)
                        <div class="hide info alert alert-success">
                        <span class="text-success">
                            <i class="fa fa-check"></i> <span class="message"></span>
                        </span>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-gray">
                                <tr>
                                    <th>Referring Facility</th>
                                    <th>Patient Name/Code</th>
                                    <th>Date Accepted</th>
                                    <th>Current Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $row)
                                    <?php
                                    $modal = ($row->type=='normal') ? '#normalFormModal' : '#pregnantFormModal';
                                    $type = ($row->type=='normal') ? 'Non-Pregnant' : 'Pregnant';
                                    //$step = \App\Http\Controllers\doctor\ReferralCtrl::step($row->code);
                                    $step = \App\Http\Controllers\doctor\ReferralCtrl::step_v2($row->status);
                                    $feedback = \App\Feedback::where('code',$row->code)->count();

                                    $status = '';
                                    $current = \App\Activity::where('code',$row->code)
                                        ->orderBy('id','desc')
                                        ->first();
                                    if($current)
                                    {
                                        $status = strtoupper($current->status);
                                    }

                                    $start = \Carbon\Carbon::parse($row->date_accepted);
                                    $end = \Carbon\Carbon::now();
                                    $diff = $end->diffInHours($start);
                                    $user = Session::get('auth');
                                    ?>
                                    <tr>
                                        <td style="white-space: nowrap;">
                                    <span class="facility" title="{{ $row->name }}">
                                    @if(strlen($row->name)>25)
                                            {{ substr($row->name,0,25) }}...
                                        @else
                                            {{ $row->name }}
                                        @endif
                                    </span>
                                            <br />
                                            <span class="text-muted">{{ $type }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ $modal }}" class="view_form"
                                               data-toggle="modal"
                                               data-type="{{ $row->type }}"
                                               data-id="{{ $row->id }}"
                                               data-code="{{ $row->code }}">
                                                <span class="text-primary">{{ $row->patient_name }}</span>
                                                <br />
                                                <small class="text-warning">{{ $row->code }}</small>
                                            </a>
                                        </td>
                                        <td>{{ $row->date_accepted }}</td>
                                        <td class="activity_{{ $row->code }}">{{ $status }}</td>
                                        <td style="white-space: nowrap;">
                                            @if( ($status=='ACCEPTED' || $status == 'TRAVEL') && $diff < 4)
                                                <button class="btn btn-sm btn-primary btn-action"
                                                        title="Patient Arrived"
                                                        data-toggle="modal"
                                                        data-toggle="tooltip"
                                                        data-target="#arriveModal"
                                                        data-track_id="{{ $row->id }}"
                                                        data-patient_name="{{ $row->patient_name }}"
                                                        data-code="{{ $row->code}}">
                                                    <i class="fa fa-wheelchair"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger btn-action"
                                                        title="Dead on Arrival"
                                                        data-toggle="modal"
                                                        data-toggle="tooltip"
                                                        data-target="#arriveModal"
                                                        data-track_id="{{ $row->id }}"
                                                        data-patient_name="{{ $row->patient_name }}"
                                                        data-code="{{ $row->code}}">
                                                        <i class="fa fa-skull-crossbones"></i>
                                                </button>
                                            @elseif( ($status=='ACCEPTED' || $status == 'TRAVEL') && $diff >= 4)
                                                <button class="btn btn-sm btn-danger btn-action"
                                                        title="Patient Didn't Arrive"
                                                        data-toggle="modal"
                                                        data-toggle="tooltip"
                                                        data-target="#archiveModal"
                                                        data-track_id="{{ $row->id }}"
                                                        data-patient_name="{{ $row->patient_name }}"
                                                        data-code="{{ $row->code}}">
                                                    <i class="fa fa-wheelchair"></i>
                                                </button>
                                            @endif

                                            @if($status=='ARRIVED' || $status=='ADMITTED')
                                                @if($status != 'ADMITTED')
                                                    <button class="btn btn-sm btn-info btn-action"
                                                            title="Patient Admitted"

                                                            data-toggle="modal"
                                                            data-toggle="tooltip"
                                                            data-target="#admitModal"
                                                            data-track_id="{{ $row->id }}"
                                                            data-patient_name="{{ $row->patient_name }}"
                                                            data-code="{{ $row->code}}">
                                                        <i class="fa fa-stethoscope"></i>
                                                    </button>
                                                @endif

                                                <button class="btn btn-sm btn-warning btn-action"
                                                        title="Patient Discharged"

                                                        data-toggle="modal"
                                                        data-toggle="tooltip"
                                                        data-target="#dischargeModal"
                                                        data-track_id="{{ $row->id }}"
                                                        data-patient_name="{{ $row->patient_name }}"
                                                        data-code="{{ $row->code}}">
                                                    <i class="fa fa-wheelchair-alt"></i>
                                                </button>

                                                <button class="btn btn-sm btn-success btn-action btn-transfer"
                                                        title="Transfer Patient"

                                                        data-toggle="modal"
                                                        data-toggle="tooltip"
                                                        data-target="#referAcceptFormModal"
                                                        data-track_id="{{ $row->id }}"
                                                        data-patient_name="{{ $row->patient_name }}"
                                                        data-code="{{ $row->code}}">
                                                    <i class="fa fa-ambulance"></i>
                                                </button>
                                            @endif

                                            @if($step<=4)
                                                <button class="btn btn-sm btn-info btn-feedback" data-toggle="modal"
                                                        data-target="#feedbackModal"
                                                        data-code="{{ $row->code }}">
                                                    <i class="fa fa-comments"> {{ $feedback }}</i>

                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $data->links() }}
                            </div>
                        </div>
                        <table class="table table-striped">
                            <caption>LEGENDS:</caption>
                            <tr>
                                <td class="text-right" width="60px"><button class="btn btn-sm btn-primary"><i class="fa fa-wheelchair"></i></button></td>
                                <td>Patient Arrived</td>
                            </tr>
                            <tr>
                                <td class="text-right" width="60px"><button class="btn btn-sm btn-danger"><i class="fa fa-wheelchair"></i></button></td>
                                <td>Patient Didn't Arrive</td>
                            </tr>
                            <tr>
                                <td class="text-right" width="60px"><button class="btn btn-sm btn-info"><i class="fa fa-stethoscope"></i> </button></td>
                                <td>Patient Admitted</td>
                            </tr>
                            <tr>
                                <td class="text-right" width="60px"><button class="btn btn-sm btn-warning"><i class="fa fa-wheelchair-alt"></i> </button></td>
                                <td>Patient Discharged</td>
                            </tr>
                            <tr>
                                <td class="text-right" width="60px"><button class="btn btn-sm btn-primary"><i class="fa fa-wheelchair-alt"></i></button></td>
                                <td>Patient Move</td>
                            </tr>
                            <tr>
                                <td class="text-right" width="60px"><button class="btn btn-sm btn-success"><i class="fa fa-ambulance"></i></button></td>
                                <td>Transfer Patient</td>
                            </tr>
                        </table>
                    @else
                        <div class="alert alert-warning">
                        <span class="text-warning">
                            <i class="fa fa-warning"></i> No data found!
                        </span>
                        </div>
                    @endif
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>

    </div>
    @include('modal.refer')
    @include('modal.accepted')
    @include('modal.accept_reject')
    @include('modal.feedback')
@endsection
{{--@include('script.firebase')--}}
@section('js')

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @include('script.datetime')
    @include('script.accepted')
    @include('script.feedback')
    @include('script.referred')

    <script>
        $('#daterange').daterangepicker({
            "opens" : "left"
        });
    </script>
@endsection

