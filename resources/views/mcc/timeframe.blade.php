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
    <div class="col-md-3">
        @include('mcc.sidebar.timeframefilter')
        @include('mcc.sidebar.links')
    </div>

    <div class="col-md-9">
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
                        <table class="table table-striped table-hover table-bordered">
                            <tr class="bg-black">
                                <th class="text-center" rowspan="2">Referral Code</th>
                                <th class="text-center" rowspan="2">Time<br>Referred</th>
                                <th class="text-center" colspan="4">Time Frame for Actions Taken</th>
                            </tr>
                            <tr class="bg-black">
                                <th class="text-center">Seen</th>
                                <th class="text-center">Accepted</th>
                                <th class="text-center">Arrived</th>
                                <th class="text-center">Redirected</th>
                            </tr>
                            @foreach($data as $row)
                            <?php
                                $accepted = \App\Http\Controllers\mcc\ReportCtrl::getDateAction('accepted',$row->code);
                                $arrived = \App\Http\Controllers\mcc\ReportCtrl::getDateAction('arrived',$row->code);
                                $rejected = \App\Http\Controllers\mcc\ReportCtrl::getDateAction('rejected',$row->code);
                            ?>
                            <tr>
                                <td class="text-warning">{{ $row->code }}</td>
                                <td class="text-muted">{{ date('M d, Y h:i a',strtotime($row->date_referred)) }}</td>
                                <td class="text-right text-danger">
                                    @if($row->date_referred < $row->date_seen)
                                        {{ \App\Http\Controllers\mcc\ReportCtrl::timeDiff($row->date_referred,$row->date_seen) }}
                                    @endif
                                </td>
                                <td class="text-right text-danger">
                                    @if($accepted)
                                        {{ \App\Http\Controllers\mcc\ReportCtrl::timeDiff($row->date_referred,$accepted) }}
                                    @endif
                                </td>
                                <td class="text-right text-danger">
                                    @if($arrived)
                                        {{ \App\Http\Controllers\mcc\ReportCtrl::timeDiff($row->date_referred,$arrived) }}
                                    @endif
                                </td>
                                <td class="text-right text-danger">
                                    @if($rejected)
                                        {{ \App\Http\Controllers\mcc\ReportCtrl::timeDiff($row->date_referred,$rejected) }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                    <hr />
                    <div class="text-center">
                        {{ $data->links() }}
                    </div>
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

