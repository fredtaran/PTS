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
        @include('mcc.sidebar.onlinefilter')
        @include('mcc.sidebar.links')
    </div>

    <div class="col-md-9">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3>{{ $title }}
                    <small class="pull-right text-success">
                        {{ date('M d, Y',strtotime($start ))}} - {{ date('M d, Y',strtotime($end ))}}
                    </small>
                </h3>
            </div>
            <div class="box-body">
                @if(count($data)>0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <tr class="bg-black">
                                <th>Department</th>
                                <th class="text-center">On Duty</th>
                                <th class="text-center">Off Duty</th>
                                <th class="text-center"># of Users</th>
                            </tr>
                            @foreach($data as $row)
                            <tr>
                                <td class="text-warning">
                                    @if($row->description)
                                        {{ $row->description }}
                                    @else
                                        No Department
                                    @endif
                                </td>
                                <td class="text-success text-center"><strong>{{ \App\Http\Controllers\mcc\ReportCtrl::countLogin('login',$row->id) }}</strong></td>
                                <td class="text-danger text-center"><strong>{{ \App\Http\Controllers\mcc\ReportCtrl::countLogin('login_off',$row->id) }}</strong></td>
                                <td class="text-info text-center"><strong>{{ \App\Http\Controllers\mcc\ReportCtrl::countLogin('',$row->id) }}</strong></td>
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
    <link rel="stylesheet" href="{{ url('plugin/daterange/daterangepicker.css') }}" />
@endsection

@section('js')
    <script src="{{ url('plugin/daterange/moment.min.js') }}"></script>
    <script src="{{ url('plugin/daterange/daterangepicker.js') }}"></script>
    <script>
        $('#daterange').daterangepicker({
            "singleDatePicker": false,
            "startDate": "{{ $start }}",
            "endDate": "{{ $end }}"
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        });
    </script>
@endsection

