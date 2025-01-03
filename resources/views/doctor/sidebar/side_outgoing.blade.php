<?php
$user = \Illuminate\Support\Facades\Session::get('auth');
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

$facility = \Illuminate\Support\Facades\Session::get('report_outgoing_facility');
$department = \Illuminate\Support\Facades\Session::get('report_outgoing_department');

?>
<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">Filter Result
            <span class="badge pull-right">Result: {{ $data->total() }}</span>
        </h3>
    </div>
    <div class="panel-body">
        <form method="post" action="{{ url('doctor/report/outgoing') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" id="daterange" value="{{ date("m/d/Y",strtotime($start)).' - '.date("m/d/Y",strtotime($end)) }}" max="{{ date('Y-m-d') }}" name="date" class="form-control" />
            </div>
            <div class="form-group">
                <select name="facility" class="form-control">
                    <option value="">All Facility</option>
                    @foreach($fac as $f)
                        <option {{ ($facility==$f->id) ? 'selected':'' }} value="{{ $f->id }}">{{ $f->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="department">
                    <option value="">All Department</option>
                    @foreach($dept as $d)
                        <option {{ ($department==$d->id) ? 'selected': '' }} value="{{ $d->id }}">{{ $d->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">
                    <i class="fa fa-filter"></i> Filter Result
                </button>
            </div>
        </form>
    </div>
</div>