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
        @include('doctor.sidebar.side_incoming')
        @include('sidebar.quick')
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
                                <th class="text-center" rowspan="2">Patient Code</th>
                                <th class="text-center" rowspan="2">Referring<br>Facility</th>
                                <th class="text-center" colspan="5">Status</th>
                            </tr>
                            <tr class="bg-black">
                                <th class="text-center">Arrived</th>
                                <th class="text-center">Admitted</th>
                                <th class="text-center">Discharged</th>
                                <th class="text-center">Transferred</th>
                                <th class="text-center">Cancelled</th>
                            </tr>
                            @foreach($data as $row)
                                <?php
                                $arrived = \App\Http\Controllers\doctor\ReportCtrl::checkStatus($row->date_referred,'arrived',$row->code);
                                $admitted = \App\Http\Controllers\doctor\ReportCtrl::checkStatus($row->date_referred,'admitted',$row->code);
                                $discharged = \App\Http\Controllers\doctor\ReportCtrl::checkStatus($row->date_referred,'discharged',$row->code);
                                $transferred = \App\Http\Controllers\doctor\ReportCtrl::checkStatus($row->date_referred,'transferred',$row->code);
                                $cancelled = \App\Http\Controllers\doctor\ReportCtrl::checkStatus($row->date_referred,'cancelled',$row->code);
                                ?>
                                <tr>
                                    <td class="text-warning">{{ $row->code }}</td>
                                    <td class="text-success" title="{{ $row->facility }}">
                                        {{ substr($row->facility,0,22) }}
                                        @if(strlen($row->facility) > 21)...@endif
                                    </td>
                                    <td class="text-center text-success">
                                        @if($arrived)
                                            <small>{{ date('m/d/y H:i',strtotime($arrived)) }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center text-success">
                                        @if($admitted)
                                            <small>{{ date('m/d/y H:i',strtotime($admitted)) }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center text-success">
                                        @if($discharged)
                                            <small>{{ date('m/d/y H:i',strtotime($discharged)) }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center text-success">
                                        @if($transferred)
                                            <small>{{ date('m/d/y H:i',strtotime($transferred)) }}</small>
                                        @endif
                                    </td>
                                    <td class="text-center text-success">
                                        @if($cancelled)
                                            <small>{{ date('m/d/y H:i',strtotime($cancelled)) }}</small>
                                        @endif
                                    </td>
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

@endsection

@section('js')
    <script>
        $('#daterange').daterangepicker();
    </script>
@endsection

