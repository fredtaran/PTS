<?php
$search_doctor = Session::get('search_doctor');
$facilities = \App\Facility::select('id','name')
    ->where('province',$user->province)
    ->where('status',1)
    ->where('referral_used','yes')
    ->orderBy('name','asc')->get();
?>
<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">Filter Results</h3>
    </div>
    <div class="panel-body">
        <form action="{{ url('doctor/list') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" placeholder="Enter fullname or lastname..." class="form-control" value="{{ $search_doctor['keyword'] }}" name="keyword"/>
            </div>
            <div class="form-group">
                <select class="form-control" name="facility_id">
                    <option value="">Select All</option>
                    @foreach($facilities as $row)
                    <option {{ ($search_doctor['facility_id']==$row->id) ? 'selected': '' }} value="{{ $row->id }}">{{ $row->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-flat btn-success">
                    <i class="fa fa-filter"></i> Filter Result
                </button>
            </div>
        </form>
    </div>
</div>