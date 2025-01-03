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
        <div class="col-md-4">
            @include('doctor.sidebar.side_outgoing')
        </div>
        <div class="col-md-4">
            @include('sidebar.quick')
        </div>
        <div class="col-md-4">
            @include('sidebar.quick2')
        </div>
    </div>


    <div class="col-md-13">
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
                                <th class="text-center">Referred To</th>
                                <th class="text-center">Diagnosis and Impression</th>
                                <th class="text-center">Referring MD / HCW (Contact No.)</th>
                                <th class="text-center">Reason for Referral</th>
                                <th class="text-center">Referred to MD / HCW (Contact No.)</th>
                                <th class="text-center">Method of Transportation</th>
                                <th class="text-center">ReCo<br>"Call Done"</th>
                                <th class="text-center">Acknowledgements<br>Receipt<br>Returned</th>
                                <th class="text-center">Remarks</th>
                            </tr>
                            {{--<tr class="bg-black">--}}
                            {{--<th class="text-center">Seen</th>--}}
                            {{--<th class="text-center">Accepted</th>--}}
                            {{--<th class="text-center">Arrived</th>--}}
                            {{--<th class="text-center">Redirected</th>--}}
                            {{--</tr>--}}
                            @foreach($data as $row)
                                <?php
                                $accepted = \App\Http\Controllers\doctor\ReportCtrl::getDateAction('accepted',$row->code);
                                $arrived = \App\Http\Controllers\doctor\ReportCtrl::getDateAction('arrived',$row->code);
                                $rejected = \App\Http\Controllers\doctor\ReportCtrl::getDateAction('rejected',$row->code);
                                ?>
                                <tr>
                                    <td class="text-warning text-center">{{ $row->date_referred }}</td>
                                    <td class="text-muted text-center">{{ date('m/d/y h:ia',strtotime($arrived)) }}</td>
                                    <td class="text-center">{{ $row->code }}</td>
                                    <td class="text-right text-danger">
                                        <?php $seen = \App\Http\Controllers\doctor\ReportCtrl::timeDiff($row->date_referred,$row->date_seen); ?>
                                        @if($row->date_referred < $row->date_seen)
                                            {{ $seen }}
                                        @endif
                                    </td>
                                    <td class="text-right text-danger">
                                        @if($accepted)
                                            {{ \App\Http\Controllers\doctor\ReportCtrl::timeDiff($row->date_referred,$accepted) }}
                                        @endif
                                    </td>
                                    <td class="text-right text-danger">
                                        @if($arrived)
                                            {{ \App\Http\Controllers\doctor\ReportCtrl::timeDiff($row->date_referred,$arrived) }}
                                        @endif
                                    </td>
                                    <td class="text-right text-danger">
                                        @if($rejected)
                                            {{ \App\Http\Controllers\doctor\ReportCtrl::timeDiff($row->date_referred,$rejected) }}
                                        @endif
                                    </td>
                                    <td class="text-danger text-center">
                                        @if($seen=='' && $accepted=='' && $arrived=='' && $rejected=='')
                                            {{ \App\Http\Controllers\doctor\ReportCtrl::timeDiff($row->date_referred,\Carbon\Carbon::now()) }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                    <hr />
                    <div class="text-center">{{ $data->links() }}</div>
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
    <script>
        $('#daterange').daterangepicker({
            "singleDatePicker": false,
            "startDate": "{{ $start }}",
            "endDate": "{{ $end }}"
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    </script>
@endsection

