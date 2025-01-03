<?php
$user = Session::get('auth');

$dateReportUsers = \Illuminate\Support\Facades\Session::get('dateReportUsers');
if(!$dateReportUsers){
    $dateReportUsers = date('Y-m-d');
}

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
        .facility {
            color: #ff8456;
        }
    </style>
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>{{ $title }}</h3>
            </div>
            <div class="box-body">
                @if(count($data)> 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <tr class="bg-black">
                                <th>Patient Name</th>
                                <th>Referring Facility</th>
                                <th>Department</th>
                                <th>Date Referred</th>
                                <th>Status</th>
                            </tr>
                            @foreach($data as $row)
                            <tr>
                                <td><span class="text-primary text-bold">{{ ucwords(strtolower($row->patient_name)) }}</span></td>
                                <td><span class="facility">{{ $row->facility }}</span></td>
                                <td><span class="facility">{{ $row->department }}</span></td>
                                <td><span class="text-success">{{ $row->date_referred }}</span></td>
                                <td><span class="text-success">{{ ucwords($row->status) }}</span></td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="text-center">
                            {{ $data->links() }}
                        </div>
                    </div>
                @else
                    <div class="alert alert-success">
                        <span class="text-success">
                            <i class="fa fa-success"></i> Congrats! No incoming referral at this moment.
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script>

    </script>
@endsection

