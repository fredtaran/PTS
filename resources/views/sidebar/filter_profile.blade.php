<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">Filter Patients</h3>
    </div>

    <div class="panel-body">
        <form action="{{ url('doctor/patient') }}" method="POST" class="form-submit">
            {{ csrf_field() }}
    
            <div class="form-group">
                <input type="text" placeholder="Search Keyword..." class="form-control" name="keyword" />
            </div>

            <div class="form-group">
                <select class="form-control province filter_province select2" name="province">
                    <option value="">Province...</option>
                    @foreach($province as $p)
                        <option value="{{ $p->id }}">{{ $p->description }}</option>
                    @endforeach
                    <option value="others">Others</option>
                </select>
            </div>

            <div class="form-group">
                <select class="form-control muncity filter_muncity select2" name="muncity">
                    <option value="">Select Municipal/City...</option>
                    @foreach($muncity as $m)
                        <option value="{{ $m->id }}">{{ $m->description }}</option>
                    @endforeach
                    <option value="others">Others</option>
                </select>
            </div>

            <div class="form-group barangay_holder">
                <select class="form-control barangay select2" name="brgy">
                    <option value="">Select Barangay...</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block btn-flat btn-success">
                    <i class="fa fa-search"></i> Filter
                </button>
                <a href="{{ url('doctor/patient/add') }}" class="btn btn-block btn-flat btn-warning">
                    <i class="fa fa-user-plus"></i> Add Patient
                </a>
            </div>
        </form>
    </div>
</div>