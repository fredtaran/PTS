<?php
    function convertToHoursMins($time, $format = '%02d:%02d') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

    function calculateFromDay($date_start,$minutes){
        $to_time =  explode(' ', $date_start)[0].date(' H:i:s', strtotime($minutes));
        $to_time = strtotime($to_time);
        $from_time = strtotime(explode(' ', $date_start)[0] . ' 23:59:59');
        $minutes = round(abs($to_time - $from_time) / 60, 2);

        return $minutes;
    }

    function offlineTime($date_start,$date_end)
    {
        if($date_end == '0000-00-00 00:00:00')
            $date_end = explode(' ',$date_start)[0].' 23:59:59';

        $to_time = strtotime($date_start);
        $from_time = strtotime($date_end);
        $minutes = round(abs($to_time - $from_time) / 60,2);
        $minutes = date('H:i', mktime(0,$minutes));


        return convertToHoursMins(calculateFromDay($date_start, $minutes), '%02d hours and %02d minutes');
    }
?>

@extends('layouts.app')

@section('content')
    <style>
        label {
            padding: 0px !important;
        }
    </style>
    <div class="row col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <div class="pull-right">
                    <form action="{{ asset('online/facility') }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group-sm">
                            <input type="text" class="form-control" name="day_date" value="{{ date('m/d/Y',strtotime($day_date)) }}" placeholder="Filter your date here..." id="onboard_picker">
                            <button type="submit" class="btn-sm btn-info btn-flat"><i class="fa fa-search"></i> Filter</button>
                        </div>
                    </form>
                </div>
                <h3>{{ $title }}</h3>
            </div>
            <div class="box-body">
                @if(count($data) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tr class="bg-black">
                                <th></th>
                                <th>Facility Name</th>
                                <th>Login Time</th>
                                <th>Logout Time</th>
                                <th>Number of hours offline</th>
                                <th>Status</th>
                            </tr>
                            <?php
                                $count = 0;
                                $province = [];
                            ?>
                            @foreach($data as $row)
                                <?php $count++; ?>
                                @if(!isset($province[$row->province]))
                                    <?php $province[$row->province] = true; ?>
                                <tr>
                                    <td colspan="6"><strong class="text-green">{{ $row->province }}</strong></td>
                                </tr>
                                @endif
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->login }}</td>
                                    <td>@if($row->logout == '0000-00-00 00:00:00'){{ date('Y-m-d',strtotime($day_date)).' 23:59:59' }}@else{{ $row->logout }}@endif</td>
                                    <td>{{ offlineTime($row->login,$row->logout) }}</td>
                                    <td>{{ $row->status }}</td>
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

@endsection

@section('js')
    <script>
        //Date range picker
        $('#onboard_picker').daterangepicker({
            "singleDatePicker": true
        });
    </script>
@endsection

