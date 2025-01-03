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
    </style>
    <div class="col-md-3">
        @include('support.sidebar.filter')
        @include('support.sidebar.quick')
    </div>

    <div class="col-md-9">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>{{ $title }}
                <small class="pull-right text-success">
                    {{ date('F d, Y',strtotime($dateReportUsers ))}}
                </small>
                </h3>
            </div>
            <div class="box-body">
                @if(count($data)>0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <tr class="bg-black">
                                <th>User</th>
                                <th class="text-center">On Duty</th>
                                <th class="text-center">Off Duty</th>
                                <th class="text-center">Login</th>
                                <th class="text-center">Logout</th>

                            </tr>
                            @foreach($data as $row)
                            <?php
                                $log = \App\Http\Controllers\support\ReportCtrl::getLoginLog($row->id);
                            ?>

                            <tr>
                                <td style="font-size:0.9em;white-space: nowrap;">{{ $row->lname }}, {{ $row->fname }}</td>
                                <td class="text-center text-success">
                                    @if($log->status=='login')
                                    <i class="fa fa-check"></i>
                                    @endif
                                </td>
                                <td class="text-center text-danger">
                                    @if($log->status=='login_off')
                                        <i class="fa fa-check"></i>
                                    @endif
                                </td>
                                <td class="text-center text-info">
                                    @if($log->login)
                                    {{ date('h:i A',strtotime($log->login)) }}
                                    @endif
                                </td>
                                <td class="text-center text-warning">
                                    @if($log->logout)
                                        {{ date('h:i A',strtotime($log->logout)) }}
                                    @endif
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
        $date = date('m/d/Y',strtotime($dateReportUsers));
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

