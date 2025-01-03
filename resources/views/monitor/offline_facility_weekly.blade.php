<?php
    // function convertToHoursMins($time, $format = '%02d:%02d') {
    //     if ($time < 1) {
    //         return;
    //     }
    //     $hours = floor($time / 60);
    //     $minutes = ($time % 60);
    //     return sprintf($format, $hours, $minutes);
    // }

    // function calculateFromDay($date_start,$minutes){
    //     $to_time =  explode(' ',$date_start)[0].date(' H:i:s',strtotime($minutes));
    //     $to_time = strtotime($to_time);
    //     $from_time = strtotime(explode(' ',$date_start)[0].' 23:59:59');
    //     $minutes = round(abs($to_time - $from_time) / 60,2);

    //     return $minutes;
    // }

    // function offlineTime($date_start,$date_end)
    // {
    //     if($date_end == '0000-00-00 00:00:00')
    //         $date_end = explode(' ',$date_start)[0].' 23:59:59';

    //     $to_time = strtotime($date_start);
    //     $from_time = strtotime($date_end);
    //     $minutes = round(abs($to_time - $from_time) / 60,2);
    //     $minutes = date('H:i', mktime(0,$minutes));


    //     return convertToHoursMins(calculateFromDay($date_start,$minutes));
    // }
?>
@extends('layouts.app')

@section('content')
    <style>
        label {
            padding: 0px !important;
        }
      @media print {
        @page {size: landscape}
      .input-groups {
        visibility: hidden;
      }
      #month {
        appearance: none;
    	padding: 5px;
    	background-color: #4834d4;
    	color: white;
    	border: none;
    	font-family: inherit;
    	outline: none;
      }
      #search {
        display: none;
      }
      .myBtn
      {
        display: none;  
      }

    }
    </style>

    <div class="row" id ="important_thing">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h1>{{ $title }}</h1>

                <form action="{{ asset('weekly/report') }}" method="POST" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group-sm input-groups">
                        <input type="text" class="form-control" name="date_range" value="{{ date('m/d/Y', strtotime($date_start)) . ' - ' . date('m/d/Y', strtotime($date_end)) }}" placeholder="Filter your date here..." id="consolidate_date_range">
                        <button type="submit" class="btn-sm btn-info btn-flat"><i class="fa fa-search"></i> Filter</button>
                    </div>
                </form><br>

                <strong>Legend:</strong>

                <table>
                    <tr>
                        <td style="font-size: 15pt;" >
                            <i class="fa fa-check text-green"></i>
                        </td>
                        <td>&nbsp;&nbsp;Whole day online</td>
                    </tr>

                    <tr>
                        <td style="font-size: 15pt;" class="bg-danger">
                            <i class="fa fa-check text-green"></i>
                        </td>
                        <td>&nbsp;&nbsp;Online but went offline for about 30 minutes or more</td>
                    </tr>

                    <tr>
                        <td style="font-size: 15pt;">
                            <i class="fa fa-times text-red"></i>
                        </td>
                        <td>&nbsp;&nbsp;Whole day offline</td>
                    </tr>
                </table>
            </div>

            <div class="box-body">
                @if(count($facility) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-fixed-header" style="font-size: 7pt;">
                            <thead class='header'>
                                <tr>
                                    <th style="background-color: rgb(31, 73, 125);color: rgb(255, 192, 50);vertical-align: middle;">Facility Name</th>
                                    @foreach($generate_weeks as $per_day)
                                        <td style="background-color: rgb(31, 73, 125);color: rgb(255, 192, 50);">
                                            {{ date('D', strtotime($per_day->per_day)) }}<br>
                                            <small style="font-size: 7pt;"><i>{{ date('M d,y',strtotime($per_day->per_day)) }}</i></small>
                                        </td>
                                    @endforeach
                                    <th style="background-color: rgb(31, 73, 125);color: rgb(255, 192, 50);vertical-align: middle;">Whole<br>day<br>online</th>
                                    <th style="background-color: rgb(31, 73, 125);color: rgb(255, 192, 50);vertical-align: middle;">Offline</th>
                                    <th style="background-color: rgb(31, 73, 125);color: rgb(255, 192, 50);vertical-align: middle;">Offline >= 30</th>
                                </tr>
                            </thead>
                            <?php
                                $province = [];
                            ?>
                            @foreach($facility as $row)
                                <?php
                                $whole_day_online = 0;
                                $went_day_minutes_30 = 0;
                                $offline_count = 0;
                                $went_minutes_30 = 0;
                                ?>
                                @if(!isset($province[$row->province]))
                                    <?php $province[$row->province] = true; ?>
                                    <tr>
                                        <td colspan="9">
                                            <strong class="text-info" style="font-size: 20pt;">{{ $row->province }}</strong>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>
                                        <strong>{{ $row->name }}</strong><br>
                                        @if($row->hospital_type == 'birthing_home')
                                            <strong style="color: darkgoldenrod;">Birthing Home</strong>
                                        @elseif($row->hospital_type == 'government')
                                            <strong class="text-green" >Government</strong>
                                        @elseif($row->hospital_type == 'private')
                                            <strong class="text-blue" >Private</strong>
                                        @elseif($row->hospital_type == 'RHU')
                                            <strong class="text-red" >RHU</strong>
                                        @endif
                                    </td>
                                    @foreach($generate_weeks as $per_day)
                                        <?php
                                            $check_online = \DB::connection('mysql')->select("call check_online_facility('$row->facility_id', '$per_day->per_day')")[0];
                                            $offline_time = offlineTime($check_online->login, $check_online->logout);
                                            $offline_time = explode(":", $offline_time);
                                            $hours = $offline_time[0];
                                            $minutes = $offline_time[1];
                                        ?>
                                        @if($check_online->check_online)
                                            @if($minutes >= 30 || $hours > 0)
                                                <?php
                                                    $went_minutes_30++;
                                                    $went_day_minutes_30++;
                                                    $display_online = "bg-danger";
                                                ?>
                                            @else
                                                <?php
                                                    $display_online = "";
                                                    $whole_day_online++;
                                                ?>
                                            @endif
                                            <td style="font-size: 10pt;" class="{{ $display_online }}">
                                                <span style="content: '\2713'" class="text-green">&#10003;</span>
                                                <b style="font-size: 7pt" class="text-red">{{ $hours }}:{{ $minutes }}</b>
                                            </td>
                                        @else
                                            <?php $offline_count++; ?>
                                            <td style="font-size: 15pt;">
                                                <span style="content: '\00d7'" class="text-red">&#215;</span>
                                            </td>
                                        @endif
                                    @endforeach
                                    <td><span style="font-size: 15pt;" class="text-green">{{ $whole_day_online }}</span></td>
                                    <td><span style="font-size: 15pt;" class="text-red">{{ $offline_count }}</span></td>
                                    <td><span style="font-size: 15pt;" class="text-orange">{{ $went_minutes_30 }}</span></td>
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
        $("#container").removeClass("container");
        $("#container").addClass("container-fluid");
        $(document).ready(function(){
            $('.table-fixed-header').fixedHeader();
        });
        //Date range picker
        $('#consolidate_date_range').daterangepicker();
    </script>
@endsection

