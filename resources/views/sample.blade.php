<?php
$user = Session::get('auth');
?>
@extends('layouts.app')

@section('css')

@endsection
@section('content')

    <div class="col-md-9">
        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-green-active">

                    <h3 class="widget-user-username" style="margin-left: 0px;">Nadia Carmichael</h3>
                    <h5 class="widget-user-desc" style="margin-left: 0px;">VSMMC</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#">09162072427 <span class="pull-right badge bg-blue"><i class="fa fa-phone"></i> </span></a></li>
                        <li><a href="#">ER OB <span class="pull-right badge bg-aqua"><i class="fa fa-hospital-o"></i> </span></a></li>
                        <li><a href="#" style="color: #00a65a;">ON DUTY <span class="pull-right badge bg-green">01:24 PM</span></a></li>
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow-active">

                    <h3 class="widget-user-username" style="margin-left: 0px;">John Doe</h3>
                    <h5 class="widget-user-desc" style="margin-left: 0px;">TDH</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#">09162072427 <span class="pull-right badge bg-blue"><i class="fa fa-phone"></i> </span></a></li>
                        <li><a href="#">ER OB <span class="pull-right badge bg-aqua"><i class="fa fa-hospital-o"></i> </span></a></li>
                        <li><a href="#" style="color: #a94442;">OFF DUTY <span class="pull-right badge bg-yellow">01:24 PM</span></a></li>
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
    </div>
    <div class="col-md-3">
        @include('sidebar.quick')
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('.toggle').toggle();

        $("a[href='#toggle']").on('click',function () {
            var id = $(this).data('id');
            $('.toggle'+id).toggle();
            var txt = ($(this).html() =='View More') ? 'View Less': 'View More';
            $(this).html(txt);
        });
    });
</script>
@endsection

