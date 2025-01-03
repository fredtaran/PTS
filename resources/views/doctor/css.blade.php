<?php
$user = Session::get('auth');
$start = \Carbon\Carbon::parse($start)->format('m/d/Y');
$end = \Carbon\Carbon::parse($end)->format('m/d/Y');

?>
@extends('layouts.app')

@section('css')

@endsection

@section('content')
    <style>
        .facility {
            color: #ff8456;
        }
    </style>
    <div class="col-md-12">
        <div class="jim-content">
            <div class="pull-right">
                <form class="form-inline" action="{{ url('doctor/accepted') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Code,Firstname,Lastname" value="{{ \Illuminate\Support\Facades\Session::get('keywordAccepted') }}" name="keyword">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" id="daterange" value="{{ date("m/d/Y",strtotime($start)).' - '.date("m/d/Y",strtotime($end)) }}" max="{{ date('Y-m-d') }}" name="daterange">
                    </div>
                    <button type="submit" class="btn btn-md btn-success" style="padding: 8px 15px;"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <h3 class="page-header">{{ $title }} <small class="text-danger">TOTAL: {{ $total }}</small> </h3>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
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
                                    <th>Patient Name/Code</th>
                                    <th>Facility Name</th>
                                    <th>Respondent</th>
                                    <th>Overall</th>
                                    <th width="1%">Suggestions</th>
                                    <th>Date of Visit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $row)
                                    <tr>
                                        <td>
                                        <span class="text-primary">{{$row -> patient_name}}</span></br>
                                            {{$row -> patient_code }}
                                        </td>
                                        <td>
                                        {{$row -> fac_name }}
                                        </td>
                                        <td>{{$row -> respondent }}</td>
                                        <td>@if($row -> overall == 1)
                                            Excellent
                                            @elseif($row -> overall == 2)
                                            Good
                                            @else
                                            Poor
                                            @endif
                                        </td>
                                        <td>{{$row -> suggestions }}</td>
                                        <td>{{$row -> date_of_visit }}</td>
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
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>
    </div>
    @include('modal.feedback')
    @include('modal.refer')
    @include('modal.accepted')
    @include('modal.accept_reject')
    
@endsection
{{--@include('script.firebase')--}}
@section('js')

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    @include('script.datetime')
    @include('script.accepted')
    @include('script.feedback')
    @include('script.referred')

    <script>
        $('#daterange').daterangepicker({
            "opens" : "left"
        });

        $('.viewupload_code').on('click',function(){
       var code = $(this).data('code');
        var url = "<?php echo asset('doctor/view_upload_body'); ?>";
        var json = {
            "code" : code,
            "_token" : "<?php echo csrf_token(); ?>"
        };
        $.post(url,json,function(result){
            $(".view_upload").html(result);
        });
       
    });
    </script>
@endsection

