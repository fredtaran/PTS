<?php
$user = Session::get('auth');

$dateDailyReferral = \Illuminate\Support\Facades\Session::get('dateDailyReferral');
if(!$dateDailyReferral){
    $dateDailyReferral = date('Y-m-d');
}

$start = \Illuminate\Support\Facades\Session::get('startDateDailyReferral');
$end = \Illuminate\Support\Facades\Session::get('endDateDailyReferral');
if(!$start)
    $start = date('Y-m-d');
if(!$end)
    $end = date('Y-m-d');

?>
@extends('layouts.app')

@section('content')

    <style>
        label {
            padding: 0px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .table td, .table th{
            vertical-align: middle !important;
        }
    </style>
    <div class="row">
        <div class="col-md-6">
            @include('admin.sidebar.filterOutgoing')
        </div>
        <div class="col-md-6">
            @include('admin.sidebar.quick')
        </div>
    </div>

    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>{{ $title }}
                    <small class="pull-right text-success">
                        {{ date('F d, Y',strtotime($start ))}} - {{ date('F d, Y',strtotime($end ))}}
                    </small>
                </h3>
            </div>
            <div class="box-body">
                @if(count($data)>0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered" width="100px">
                            <tr class="bg-black">
                                <th class="text-center">Date and Time Referred</th>
                                <th class="text-center">Date and Time Arrived</th>
                                <th class="text-center">Patient Code</th>
                                <th class="text-center">Age / Sex</th>
                                <th class="text-center">Complete Address</th>
                                <th class="text-center">Referred From</th>
                                <th class="text-center">Diagnosis and Impression</th>
                                <th class="text-center">Referring MD / HCW (Contact No.)</th>
                                <th class="text-center">Reason for Referral</th>
                                <th class="text-center">Referred to MD / HCW (Contact No.)</th>
                                <th class="text-center">Method of Transportation</th>
                                <th class="text-center">ReCo<br>"Call Done"</th>
                                <th class="text-center">Acknowledgements<br>Receipt<br>Returned</th>
                                <th class="text-center">Remarks</th>
                            </tr>
                            @foreach($data as $row)
                                <tr>
                                    <td class="text-warning text-center">{{ $row -> date_referred }}</td>
                                    <td></td>
                                    <td class="text-sucess text-center">{{ $row -> patient_name }}</td>
                                    <td class="text-center">
                                        {{ (int)$row -> ageInYears }} / {{ $row -> sex }}
                                    </td>
                                    <td class="text-center"> {{ $row -> address }} </td>
                                    <td class="text-center"> {{ $row -> name }} </td>
                                    <td class="text-center"> {{ $row -> diagnosis }}</td>
                                    <td class="text-center"> {{ $row -> referring_md }}</td>
                                    <td class="text-center"> {{ $row -> reason }}</td>
                                    <td class="text-center"> {{ $row -> referred_md }}</td>
                                    <td class="text-center"> {{ $row -> transportation }}</td>
                                    <td>
                                        {{--EDITED--}}
                                        <?php
                                        echo "<ul class='pull-left'>";
                                        $count = 0;
                                        foreach(\App\Feedback::where('message', $row->message)->get() as $feedback)
                                        {
                                            if($count < 3)
                                            {
                                                echo "<li class='pull-left'>$feedback->message</li><br>";
                                            }
                                            $count++;
                                        }
                                        echo "</ul>";
                                        ?>
                                        {{--END--}}
                                    </td>
                                    <td></td>
                                    <td>
                                        <?php
                                        echo "<ul class='pull-left'>";
                                        foreach(\App\Issue::where('tracking_id', $row -> tracking_id) -> where('status', 'outgoing')->get() as $issue)
                                        {
                                            echo "<li class='pull-left'>$issue->issue</li>";
                                        }
                                        echo "</ul>";
                                        ?>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                    <hr />
                @else
                    <div class="alert alert-warning">
                        <span class="text-warning">
                            <i class="fa fa-warning"></i> No data found!
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link rel="stylesheet" href="{{ url('plugin/daterange/daterangepicker.css') }}" />
@endsection

@section('js')
    <script src="{{ url('plugin/daterange/moment.min.js') }}"></script>
    <script src="{{ url('plugin/daterange/daterangepicker.js') }}"></script>
    <script src="{{ url('plugin/Outgoing.js/outgoing.js')}}"></script>

    <script>
        <?php
        $start = date('m/d/Y',strtotime($start));
        $end = date('m/d/Y',strtotime($end));
        ?>
        $('#daterange').daterangepicker({
            "startDate": "{{ $start }}",
            "endDate": "{{ $end }}"
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    </script>
@endsection