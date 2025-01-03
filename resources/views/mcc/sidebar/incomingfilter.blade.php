<?php
$incoming_date = \Illuminate\Support\Facades\Session::get('incoming_date');
if(!$incoming_date){
    $incoming_date = date('Y-m-d');
}
?>

<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">Filter Date</h3>
    </div>
    <form method="post" action="{{ url('mcc/report/incoming') }}">
        {{ csrf_field() }}
        <div class="panel-body">
            <input type="text" id="daterange" max="{{ date('Y-m-d') }}" value="{{ $incoming_date }}" name="date" class="form-control" />
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success btn-block">
                <i class="fa fa-filter"></i> Filter Result
            </button>
        </div>

    </form>
</div>