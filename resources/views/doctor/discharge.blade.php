<?php
$user = Auth::user();
use App\Http\Controllers\doctor\CSSCtrl as CSSCtrl;
?>
@extends('layouts.app')

@section('content')
    <style>
        .facility {
            color: #ff8456;
        }

        .disableddddddd{
            pointer-events: none;
            cursor: not-allowed;
        }
    </style>

    <div class="col-md-12">
        <div class="jim-content">
            <div class="pull-right">
                <form class="form-inline" action="{{ url('doctor/discharge') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Code,Firstname,Lastname" value="{{ \Illuminate\Support\Facades\Session::get('keywordDischarged') }}" name="keyword">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" id="daterange" max="{{ date('Y-m-d') }}" name="daterange">
                    </div>
                    
                    <button type="submit" class="btn btn-md btn-success" style="padding: 8px 15px;">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>

            <h3 class="page-header">{{ $title }} <small class="text-danger">TOTAL: {{ count($data) }}</small></h3>

            <div class="row">
                <div class="col-md-12">
                    @if(count($data)>0)
                    <div class="hide info alert alert-success">
                        <span class="text-success">
                            <i class="fa fa-check"></i> <span class="message"></span>
                        </span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="bg-gray">
                                <tr>
                                    <th>Referring Facility</th>
                                    <th>Patient Name/Code</th>
                                    <th>Date Discharged</th>
                                    <th>Status</th>
                                    <th>Record</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($data as $row)
                            <?php
                            $checker1 = CSSCtrl::checkCSS($row->code);

                            $modal = ($row->type=='normal') ? '#normalFormModal' : '#RefferedpregnantFormModalTrack';
                            $type = ($row->type=='normal') ? 'Non-Pregnant' : 'Pregnant';
                            ?>
                                <tr>
                                    <td style="white-space: nowrap;">
                                        <span class="facility" title="{{ $row->name }}">
                                        @if(strlen($row->name)>25)
                                            {{ substr($row->name,0,25) }}...
                                        @else
                                            {{ $row->name }}
                                        @endif
                                        </span><br />
                                        <span class="text-muted">{{ $type }}</span>
                                    </td>

                                    <td>
                                        <a href="{{ $modal }}" class="view_form"
                                            data-toggle="modal"
                                            data-type="{{ $row->type }}"
                                            data-id="{{ $row->id }}"
                                            data-code="{{ $row->code }}">
                                            <span class="text-primary">{{ $row->patient_name }}</span>
                                            <br />
                                            <small class="text-warning">{{ $row->code }}</small>
                                        </a>
                                    </td>

                                    <?php
                                        $status = \App\Http\Controllers\doctor\PatientCtrl::getDischargeDate('discharged',$row->code);
                                    ?>
                                    <td>{{ $status }}</td>

                                    <td>{{ strtoupper($row->status) }}</td>

                                    <td>
                                        @if($checker1 == 'yes')
                                        <a href="#cssForm" data-code="{{ $row->code }}"  data-toggle="modal" class="btn btn-info disableddddddd css_btn" disabled>
                                        <i class="fa-sharp fa-solid fa-square-pen"></i> CSS
                                        </a>
                                        @else
                                        <a href="#cssForm" data-code="{{ $row->code }}"  data-toggle="modal" class="btn btn-info css_btn">
                                        <i class="fa-sharp fa-solid fa-square-pen"></i> CSS
                                        </a>
                                        @endif
                                        <a href="{{ url('doctor/referred?referredCode='.$row->code) }}" class="btn btn-success" target="_blank">
                                            <i class="fa fa-stethoscope"></i> Track
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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
    </div>
    @include('modal.accept_reject')
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @include('script.datetime')
    @include('script.accepted')
    @include('script.referred')

    <?php
    $start = \Illuminate\Support\Facades\Session::get('startDischargedDate');
    $end = \Illuminate\Support\Facades\Session::get('endDischargedDate');
    if(!$start)
        $start = \Carbon\Carbon::now()->startOfYear()->format('m/d/Y');

    if(!$end)
        $end = \Carbon\Carbon::now()->endOfYear()->format('m/d/Y');

    $start = \Carbon\Carbon::parse($start)->format('m/d/Y');
    $end = \Carbon\Carbon::parse($end)->format('m/d/Y');
    ?>
    <script>
        $('#daterange').daterangepicker({
            "startDate": "{{ $start }}",
            "endDate": "{{ $end }}",
            "opens": "left"
        }, function(start, end, label) {
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            console.log("{{ $start }}");
        });

    </script>
@endsection

