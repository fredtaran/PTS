<?php
    $user = \Illuminate\Support\Facades\Session::get("auth");
    $fac = \App\Facility::where('id','<>',$user->facility_id)
        ->where('status',1)
        ->select('facility.id','facility.name')
        ->orderBy('name','asc')
        ->get();
    $dept = \App\Department::leftJoin('users','users.department_id','=','department.id')
                ->select('department.*')
                ->where('users.department_id','<>','')
                ->where('users.facility_id',$user->facility_id)
                ->distinct('department.id')
                ->get();
    $notif_id = 0;
?>
<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">
            Filter Results
            <!-- <span class="pull-right badge">Result: {{ $data->count() }}</span> -->
        </h3>
    </div>
    <div class="panel-body">
        <form action="{{ url('admin/aog/weeks/report' ) }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" placeholder="Code, Firstname, Lastname" class="form-control" value="{{ $keyword }}" id="keyword" name="search"/>
            </div>
            <div class="form-group">
                <input type="text" id="daterange" value="{{ $start.' - '.$end }}" max="{{ date('Y-m-d') }}" name="date_range" class="form-control" />
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-flat btn-warning" onclick="clearFieldsSidebar()">
                    <i class="fa fa-eye"></i> View All
                </button>
                <button type="submit" name="filter_submit" value="submit" class="btn btn-flat btn-success">
                    <i class="fa fa-filter"></i> Filter Result
                </button>
            </div>
        </form>
    </div>
</div>