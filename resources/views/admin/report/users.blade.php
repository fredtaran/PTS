<?php
$user = Session::get('auth');

$dateDailyUsers = \Illuminate\Support\Facades\Session::get('dateDailyUsers');
if(!$dateDailyUsers)
    $dateDailyUsers = date('Y-m-d');

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
        .table td{
            vertical-align: middle;
        }
        .table th {
            vertical-align: middle !important;
            text-align: center;
        }
    </style>
    <div class="col-md-3">

        @include('admin.sidebar.filterDailyUser')
        @include('admin.sidebar.quick')
    </div>

    <div class="col-md-9">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>{{ $title }}<br />
                    <small class="text-success">
                        {{ date('F d, Y',strtotime($dateDailyUsers ))}}
                    </small>
                </h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <tr class="bg-black">
                            <th rowspan="2">Name of Hospital</th>
                            <th class="text-center" colspan="3">Health Professional</th>
                            <th rowspan="2">Subtotal</th>
                            <th class="text-center" colspan="2">IT</th>
                            <th rowspan="2">Subtotal</th>
                            <th rowspan="2">TOTAL</th>
                        </tr>
                        <tr class="bg-black">
                            <th>On Duty</th>
                            <th>Off Duty</th>
                            <th>Offline</th>
                            <th>Online</th>
                            <th>Offline</th>
                        </tr>
                        @foreach($facilities as $row)
                        <?php
                            $log = \App\Http\Controllers\admin\DailyCtrl::countDailyUsers($row->id);
                            $offline = $log['total'] - ($log['on'] + $log['off']);
                            $it_offline = $log['it_total'] - $log['it_on'];
                        ?>
                        <tr>
                            <td style="text-align: left;" title="{{ $row->name }}">
                                {{ $row->name }}
                            </td>
                            <td class="text-center">{{ $log['on'] }}</td>
                            <td class="text-center">{{ $log['off'] }}</td>
                            <td class="text-center">{{ $offline }}</td>
                            <td class="text-center">{{ $log['total'] }}</td>
                            <td class="text-center">{{ $log['it_on'] }}</td>
                            <td class="text-center">{{ $it_offline }}</td>
                            <td class="text-center">{{ $log['it_total'] }}</td>
                            <td class="text-center">{{ $log['it_total']+$log['total'] }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
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
        <?php
        $date = date('m/d/Y',strtotime($dateDailyUsers));
        ?>
        $('#daterange').daterangepicker({
            "singleDatePicker": true,
            "startDate": "{{ $date }}",
            "endDate": "{{ $date }}"
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    </script>
@endsection

