<?php
$dateDailyReferral = \Illuminate\Support\Facades\Session::get('dateDailyReferral');
if(!$dateDailyReferral){
    $dateDailyReferral = date('Y-m-d');
}
?>

<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">Select Date</h3>
    </div>
    <form method="post" action="{{ url('admin/report/patient/outgoing') }}">
        {{ csrf_field() }}
        <div class="panel-body">
            <input type="text" id="daterange" max="{{ date('Y-m-d') }}" value="{{ $dateDailyReferral }}" name="date" class="form-control" />
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success btn-block">
                <i class="fa fa-calendar"></i> Change Date
            </button>
            <a href="{{ url('admin/daily/referral/export') }}" class="btn btn-warning btn-block">
                <i class="fa fa-file-excel-o"></i> Export Data
            </a>
        </div>
    </form>
</div>