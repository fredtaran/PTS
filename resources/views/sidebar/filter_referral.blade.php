<?php
    $user = Auth::user();
    $fac = \App\Models\Facility::where('id', '<>', $user->facility_id)
                                ->where('status', 1)
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
            <span class="pull-right badge">Result: {{ $data->total() }}</span>
        </h3>
    </div>

    <div class="panel-body">
        <form action="{{ url('doctor/referral/') }}" method="GET">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" placeholder="Code, Firstname, Lastname" class="form-control" value="{{ $keyword }}" id="keyword" name="search"/>
            </div>

            <div class="form-group">
                <input type="text" id="daterange" value="{{ $start.' - '.$end }}" max="{{ date('Y-m-d') }}" name="date_range" class="form-control" />
            </div>

            <div class="form-group">
                <select class="form-control select2" name="facility_filter" id="facility">
                    <option value="">All Facility</option>
                    @foreach($fac as $f)
                        <option {{ ($facility == $f->id) ? 'selected':'' }} value="{{ $f->id }}">{{ $f->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <select class="form-control" name="department_filter" id="department">
                    <option value="">All Department</option>
                    @foreach($dept as $d)
                        <option {{ ($department == $d->id) ? 'selected': '' }} value="{{ $d->id }}">{{ $d->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <select class="form-control" name="option_filter" id="option">
                    <option value="">Select All</option>
                    <option {{ ($option == 'referred') ? 'selected': '' }} value="referred">New Referral</option>
                    <option {{ ($option == 'accepted') ? 'selected': '' }} value="accepted">Accepted</option>
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