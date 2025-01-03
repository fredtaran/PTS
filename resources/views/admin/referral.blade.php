<?php
$user = Session::get('auth');

$dateReportReferral = \Illuminate\Support\Facades\Session::get('dateReportOnline');
if(!$dateReportReferral)
    $dateReportReferral = date('m/d/Y');

$start = \Illuminate\Support\Facades\Session::get('startDateReportReferral');
$end = \Illuminate\Support\Facades\Session::get('endDateReportReferral');
if(!$start)
    $start = date('Y-m-d');
if(!$end)
    $end = date('Y-m-d');

?>
@extends('layouts.app')

@section('content')
    <style>
        label {
            padding: 0px !important;
        }
    </style>

    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <div class="pull-right">
                    <form action="{{ url('admin/report/referral') }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group-sm" style="margin-bottom: 10px;">
                            <input type="text" id="daterange" max="{{ date('Y-m-d') }}" value="{{ $dateReportReferral }}" name="date" class="form-control" />
                            <button type="submit" class="btn btn-success btn-sm btn-flat">
                                <i class="fa fa-calendar"></i> Change Date
                            </button>
                        </div>
                    </form>
                </div>
                <h3>{{ $title }}<br />
                    <small class="text-success">
                        {{ date('F d, Y',strtotime($start))}} to {{ date('F d, Y',strtotime($end))}}
                    </small>
                </h3>
            </div>
            <div class="box-body">
                @if(count($data) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <tr class="bg-black">
                                <th>Date Referred</th>
                                <th>Referred From</th>
                                <th>Referred To</th>
                                <th>Department</th>
                                <th>Patient Name</th>
                                <th>Status</th>
                            </tr>

                            @foreach($data as $row)
                            <?php $c = ($row->status=='rejected' || $row->status=='seen') ? 'bg-danger':'' ?>
                            <?php $c = ($row->status=='accepted' || $row->status=='arrived' || $row->status=='admitted') ? 'bg-success':$c ?>
                            <?php $c = ($row->status=='discharged' || $row->status=='admitted') ? 'bg-warning':$c ?>
                            <tr class="{{ $c }}">
                                <td class="text-success">
                                    {{ date('M d, h:i A',strtotime($row->date_referred)) }}
                                </td>
                                <td class="text-warning" title="{{ \App\Facility::find($row->referred_from)->name }}">
                                    <?php $f = \App\Facility::find($row->referred_from)->name; ?>
                                    @if(strlen($f)>25)
                                        {{ substr($f,0,25) }}...
                                    @else
                                        {{ $f }}
                                    @endif
                                </td>
                                <td class="text-warning" title="{{ \App\Facility::find($row->referred_to)->name }}">
                                    <?php $f = \App\Facility::find($row->referred_to)->name; ?>
                                    @if(strlen($f)>25)
                                        {{ substr($f,0,25) }}...
                                    @else
                                        {{ $f }}
                                    @endif
                                </td>
                                <td class="text-danger">
                                    {{ \App\Department::find($row->department_id)->description }}
                                </td>
                                <td class="text-primary">
                                    <?php $p = \App\Patients::find($row->patient_id); ?>
                                    {{ ucwords(mb_strtolower($p->lname))}}, {{ ucwords(mb_strtolower($p->fname))}}
                                </td>
                                <td class="text-danger">
                                    {{ ucfirst($row->status) }} <small style="font-style: italic;">({{ date('M d, h:i A',strtotime($row->updated_at)) }})</small>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <div class="text-center">
                            {{ $data->links() }}
                        </div>
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
        <?php
        $start = date('m/d/Y',strtotime($start));
        $end = date('m/d/Y',strtotime($end));
        ?>
        $('#daterange').daterangepicker({
            "startDate": "{{ $start }}",
            "endDate": "{{ $end }}"
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    </script>
@endsection

