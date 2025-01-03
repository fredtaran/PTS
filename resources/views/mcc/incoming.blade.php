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
        @include('mcc.sidebar.incomingfilter')
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
                                <th class="text-center" rowspan="2">Hospital</th>
                                <th class="text-center" colspan="3">Seen</th>
                                <th class="text-center" rowspan="2">No Action</th>
                                <th class="text-center" rowspan="2">TOTAL</th>
                            </tr>
                            <tr class="bg-black">
                                <th class="text-center">Accepted</th>
                                <th class="text-center">Redirected</th>
                                <th class="text-center">Idle</th>
                            </tr>
                            @foreach($data as $row)
                            <?php
                                $accepted = \App\Http\Controllers\mcc\ReportCtrl::countIncoming('accepted',$row->id);
                                $redirected = \App\Http\Controllers\mcc\ReportCtrl::countIncoming('rejected',$row->id);
                                $total = \App\Http\Controllers\mcc\ReportCtrl::countIncoming('',$row->id);
                                $total += $redirected;
                                $seen = \App\Http\Controllers\mcc\ReportCtrl::countIncoming('seen',$row->id);
                                $idle = $seen - $accepted;
                                if($idle<0) $idle = 0;
                                $no_action = $total - ($accepted + $redirected + $idle);
                            ?>
                            <tr>
                                <td class="text-warning">{{ $row->name }}</td>
                                <td class="text-center text-success">{{ $accepted }}</td>
                                <td class="text-center text-danger">{{ $redirected }}</td>
                                <td class="text-center text-muted">{{ $idle }}</td>
                                <td class="text-center text-muted">{{ $no_action }}</td>
                                <td class="text-center text-primary text-bold">{{ $total }}</td>
                            </tr>
                            @endforeach
                        </table>

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

