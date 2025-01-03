<?php
$online_date = \Illuminate\Support\Facades\Session::get('date_online');
if(!$online_date){
    $online_date = date('Y-m-d');
}
?>

<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">Filter Date</h3>
    </div>
    <form method="post" action="{{ url('mcc/report/online') }}">
        {{ csrf_field() }}
        <div class="panel-body">
            <input type="text" id="daterange" max="{{ date('Y-m-d') }}" value="{{ $online_date }}" name="date" class="form-control" />
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success btn-block">
                <i class="fa fa-filter"></i> Filter Result
            </button>
        </div>

    </form>
</div>