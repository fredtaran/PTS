<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">Track Patients</h3>
    </div>
    
    <div class="panel-body">
        <form method="GET" action="{{ url('doctor/referred') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input type="text" name="referredCode" value="{{ @$referredCode }}" class="form-control" placeholder="Referral Code" />
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default btn-block">
                    <i class="fa fa-search"></i> Search
                </button>
            </div>
        </form>
    </div>
</div>