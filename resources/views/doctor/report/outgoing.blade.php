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
        @include('doctor.sidebar.side_outgoing')
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
                                <th class="text-center" rowspan="2">Date<br>Referred</th>
                                <th class="text-center" colspan="4">Status</th>
                                <th class="text-center" rowspan="2">No Action</th>
                            </tr>
                            <tr class="bg-black">
                                <th class="text-center">Seen</th>
                                <th class="text-center">Accepted</th>
                                <th class="text-center">Arrived</th>
                                <th class="text-center">Redirected</th>
                            </tr>
                            @foreach($data as $row)
                                <?php
                                $accepted = \App\Http\Controllers\doctor\ReportCtrl::getDateAction('accepted',$row->code);
                                $arrived = \App\Http\Controllers\doctor\ReportCtrl::getDateAction('arrived',$row->code);
                                $rejected = \App\Http\Controllers\doctor\ReportCtrl::getDateAction('rejected',$row->code);
                                ?>
                                <tr>
                                    <td class="text-warning">{{ $row->code }}</td>
                                    <td class="text-muted">{{ date('m/d/y h:ia',strtotime($row->date_referred)) }}</td>
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
                                    <td class="text-right text-danger">
                                        @if($seen=='' && $accepted=='' && $arrived=='' && $rejected=='')
                                            {{ \App\Http\Controllers\doctor\ReportCtrl::timeDiff($row->date_referred,\Carbon\Carbon::now()) }}
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

