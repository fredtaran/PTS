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
                    <form action="{{ asset('admin/statistics/outgoing') }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group-sm">
                            <input type="text" class="form-control" name="date_range" value="{{ date("m/d/Y",strtotime($date_range_start)).' - '.date("m/d/Y",strtotime($date_range_end)) }}" placeholder="Filter your daterange here..." id="consolidate_date_range">
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
                                <th>Outgoing</th>
                                <th>Accepted</th>
                            </tr>
                            <?php
                            $count = 0;
                            ?>
                            @foreach($data as $row)
                                <?php
                                $count++;

                                ?>
                                @if(!isset($province[$row->province]))
                                    <?php $province[$row->province] = true; ?>
                                    <tr>
                                        <td colspan="5">
                                            <strong class="text-green">{{ $row->province }}</strong>
                                        </td>
                                    </tr>
                                @endif
                                <tr class="">
                                    <td>{{ $count }}</td>
                                    <td >
                                        <span style="font-size: 12pt;">
                                            {{ $row->name }}
                                        </span><br>
                                        <small class="@if($row->hospital_type == 'government'){{ 'text-yellow' }}@else{{ 'text-maroon' }}@endif">{{ ucfirst($row->hospital_type) }}</small>
                                    </td>
                                    <td width="10%">
                                        <span class="text-blue" style="font-size: 15pt">{{ $row->outgoing }}</span><br><br>
                                    </td>
                                    <td width="10%">
                                        <?php
                                        $accept_percent = ($row->accepted / $row->outgoing) * 100;
                                        ?>
                                        <span class="text-blue">{{ $row->accepted }}</span><br>
                                        <b style="font-size: 15pt" class="<?php if($accept_percent >= 50) echo 'text-green'; else echo 'text-red'; ?>">({{ round($accept_percent)."%" }})</b>
                                    </td>
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
        $('#consolidate_date_range').daterangepicker();
    </script>
@endsection

