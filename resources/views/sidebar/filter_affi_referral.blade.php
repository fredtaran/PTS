<?php
    $user = Auth::user();
    $fac = \App\Models\Affiliated::where('facility_id', '<>', $user->facility_id)
        ->leftjoin('facility', 'facility.id', '=', 'affiliated.facility_id')
        ->select('facility.id', 'facility.name')
        ->orderBy('name', 'asc')
        ->get();
        
    $dept = \App\Models\Department::leftJoin('users', 'users.department_id', '=', 'department.id')
        ->select('department.*')
        ->where('users.department_id', '<>', '')
        ->where('users.facility_id', $user->facility_id)
        ->distinct('department.id')
        ->get();
?>

<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">
            Filter Results
            <span class="pull-right badge">Result: {{ count($data) }}</span>
        </h3>
    </div>

    <div class="panel-body">
        <form action="{{ url('doctor/affiliated/referral') }}" method="GET">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" placeholder="Code, Firstname, Lastname" class="form-control" value="{{ $keyword }}" id="keyword" name="search"/>
            </div>

            <div class="form-group">
                <input type="text" id="daterange" value="{{ $start.' - '.$end }}" max="{{ date('Y-m-d') }}" name="date_range" class="form-control" />
            </div>

            <div class="form-group">
                <select name="facility_filter" class="form-control select2 select_facility3" required>
                                <option value="">Select Facility...</option>
                                @foreach($fac as $f)
                             <option {{ ($facility == $f->id) ? 'selected' : '' }} value="{{ $f->id }}">{{ $f->name }}</option>
                         @endforeach
                </select>
            </div>

            <div class="form-group">
                <select name="department_filter" id="department" class="form-control-select select_department select_department_normal" style="width: 100%;">
                                <option value="">Select Option</option>
                            </select>
            </div>

            <div class="form-group">
                <select class="form-control" name="option_filter" id="option">
                    <option value="">Select All</option>
                    <option {{ ($option == 'referred') ? 'selected' : '' }} value="referred">New Referral</option>
                    <option {{ ($option == 'accepted') ? 'selected' : '' }} value="accepted">Accepted</option>
                </select>
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