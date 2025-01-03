<?php
$user = Auth::user();
$facilities = \App\Models\Facility::select('id', 'name')
    ->where('referral_used', 'yes')
    ->orderBy('name', 'asc')->get();

$dateReportOnline = \Illuminate\Support\Facades\Session::get('dateReportOnline');
if(!$dateReportOnline)
    $dateReportOnline = date('m/d/Y');
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
                    <form action="{{ url('admin/report/online') }}" method="POST" class="form-inline">
                        {{ csrf_field() }}
                        <div class="form-group-sm" style="margin-bottom: 10px;">
                            <input type="text" id="daterange" max="{{ date('Y-m-d') }}" value="{{ $dateReportOnline }}" name="date" class="form-control" />
                            <button type="submit" class="btn btn-success btn-sm btn-flat">
                                <i class="fa fa-calendar"></i> Change Date
                            </button>
                        </div>
                    </form>
                </div>

                <h3>{{ $title }}<br />

                <small class="text-success">
                    {{ date('F d, Y',strtotime($dateReportOnline))}}
                </small></h3>
            </div>

            <div class="box-body">
                @if(count($data) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <tr class="bg-black">
                                <th>Facility</th>
                                <th>Name of User</th>
                                <th>Level</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Login</th>
                            </tr>

                            <?php
                                $h = 0;
                                $count = 0;
                            ?>
                            @foreach($data as $row)
                            <tr>
                                <td class="text-warning text-bold">
                                    @if($h != $row->facility_id)
                                    {{ \App\Models\Facility::find($row->facility_id)->name }}
                                    <?php $h = $row->facility_id; ?>
                                    @endif
                                </td>
                                <td class="text-success">
                                    <?php
                                        $count++;
                                        echo $count;
                                    ?>
                                    {{ ucwords(mb_strtolower($row->lname)) }}, {{ ucwords(mb_strtolower($row->fname)) }}<br>
                                    <small class="text-warning">{{ @$row->contact }}</small>
                                </td>
                                <td class="text-danger">
                                    {{ ucfirst($row->level) }}
                                </td>
                                <td class="text-danger">
                                    @if($row->department_id>0)
                                    {{ ucfirst(\App\Models\Department::find($row->department_id)->description) }}
                                    @endif
                                </td>
                                <td>
                                    {{ ($row->login_status=='login') ? 'On Duty' : 'Off Duty' }}
                                </td>
                                <td>
                                    {{ date('h:i A',strtotime($row->last_login)) }}
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

@section('js')

    <script>
        <?php
        $date = date('m/d/Y',strtotime($dateReportOnline));
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

