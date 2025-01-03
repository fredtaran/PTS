<?php
     $fac = App\Facility::where('status',1)
     ->where('province',$user->province)
     ->orderBy('name','asc')
     ->get();
    $dept = \App\Department::get();
?>
<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">
            Filter Results
            <span class="pull-right badge">Result: {{ $data->total() }}</span>
        </h3>
    </div>
    <div class="panel-body">
        <form method="GET" action="{{ url('monitoring/patient_transactions') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="search" id="keyword" value="{{ $search }}" class="form-control" placeholder="Code, Firstname, Lastname" />
            </div>
            <div class="form-group">
                <input type="text" id="daterange" value="{{ $start.' - '.$end }}" max="{{ date('Y-m-d') }}" name="date" class="form-control" />
            </div>
            <div class="form-group">
                <select class="form-control select2" name="facility_filter" id="facility">
                    <option value="">All Facility</option>
                    @foreach($fac as $f)
                        <option {{ ($facility_filter==$f->id) ? 'selected':'' }} value="{{ $f->id }}">{{ $f->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" name="department_filter" id="department">
                    <option value="">All Department</option>
                    @foreach($dept as $d)
                        <option {{ ($department_filter==$d->id) ? 'selected': '' }} value="{{ $d->id }}">{{ $d->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select name="option_filter" class="form-control" id="option">
                    <option value="">All Transaction</option>
                    <option @if($option_filter=='referred') selected @endif value="referred">Referred</option>
                    <option @if($option_filter=='seen') selected @endif value="seen">Seen</option>
                    <option @if($option_filter=='accepted') selected @endif value="accepted">Accepted</option>
                    <option @if($option_filter=='arrived') selected @endif value="arrived">Arrived</option>
                    <option @if($option_filter=='admitted') selected @endif value="admitted">Admitted</option>
                    <option @if($option_filter=='discharged') selected @endif value="discharged">Discharged</option>
                    <option @if($option_filter=='cancelled') selected @endif value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-flat btn-warning" onclick="clearFieldsSidebar()">
                    <i class="fa fa-eye"></i> View All
                </button>
                <button type="submit" class="btn btn-flat btn-success">
                    <i class="fa fa-filter"></i> Filter Result
                </button>
            </div>
        </form>

    </div>
</div>