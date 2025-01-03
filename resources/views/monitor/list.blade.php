<?php
$user = Session::get('auth');
?>
@extends('layouts.app')

@section('content')
    <style>
        .title-name {
            font-weight:bold;
            font-size:1.2em;
        }
        .widget-user-header {
            padding: 10px 15px !important;
        }
        .widget-user-2 .widget-user-username {
            margin-top: 5px;
            margin-bottom: 0px;
            font-size: 22px;
            font-weight: 300;
        }
    </style>
    <div class="row">
        <div class="col-md-8">
            <div class="jim-content" style="background: rgba(255, 255, 255, 0.4)">
                <h3 class="page-header">{{ $title }} <span class="badge bg-blue doctor_online">0</span></h3>
                <?php $doctor_online_count = 0; ?>
                @if(count($data)>0)
                    <?php
                    //$expense_length = \App\Expense::select(DB::raw("length(description) as char_max"))->orderBy(DB::raw("length(description)"),"desc")->first()->char_max; //count the max character para dile maguba ang info-box-content
                    ?>
                    @foreach($data as $row)
                        <?php
                            if($row->status=='login_off'){
                                $status = '<em>OFF DUTY</em>';
                                $color = 'yellow';
                            } else {
                                $color = 'green';
                                $status = 'ON DUTY';
                                $doctor_online_count++;
                            }
                        ?>
                        <div class="col-md-4">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-{{ $color }}-active">
                                    <?php
                                    $name = strtoupper($row->fname.". ".$row->lname);

                                    $temp = $name;
                                    $count = 0;
                                    $string = "";
                                    for($i=0;$i<50;$i++){
                                    if(!isset($temp[$i])){
                                    $temp .= " ";
                                    }
                                    if($count != 18){
                                    $count++;
                                    $string .= $temp[$i];
                                    } else {
                                    $count = 0;
                                    $string .= "<br>";
                                    }
                                    }
                                    ?>
                                    <small>{{ $row->level == 'doctor' ? 'Dr. ' : '' }} {!! $string !!}</small><br>
                                    &nbsp;<small class="widget-user-desc badge bg-maroon" style="margin-left: 0px;">{{ $row->abbr ? $row->abbr : "NO ABBR" }}</small>
                                </div>
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li><a href="#">{{ $row->contact }} <span class="pull-right badge bg-blue"><i class="fa fa-phone"></i> </span></a></li>
                                        <li><a href="#">{{ $row->department ? $row->department : "." }} <span class="pull-right badge bg-aqua"><i class="fa fa-hospital-o"></i> </span></a></li>
                                        <li><a href="#" class="text-{{ $color }}">{!! $status !!} <span class="pull-right badge bg-{{ $color }}">{{ date('h:i A',strtotime($row->login)) }}</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    @endforeach
                @else
                    <div class="alert-section">
                        <div class="alert alert-warning">
                            <span class="text-warning">
                                <i class="fa fa-warning"></i> No Online Doctors!
                            </span>
                        </div>
                    </div>

                    <ul class="timeline">
                    </ul>
                @endif
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="col-md-4">
            @include('mcc.sidebar.hospitals')
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(".doctor_online").text("<?php echo $doctor_online_count; ?>");
        $(".hospital_online").text("<?php echo Session::get('hospital_online_count'); ?>");
    </script>
@endsection

