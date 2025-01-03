
<span id="url" data-link="{{ asset('date_in') }}"></span>
<span id="token" data-token="{{ csrf_token() }}"></span>
<div class="col-md-3 wrapper">

    <div class="panel panel-jim">
        <div class="panel-heading">
            <h3 class="panel-title">Links</h3>
        </div>
        <div class="panel-body">
            <div class="list-group">
                <a href="{{ asset('member/list') }}" class="list-group-item clearfix">
                    Member List
                    <span class="pull-right">
                        <i class="fa fa-users"></i>
                    </span>
                </a>
                <a href="{{ asset('member/add') }}" class="list-group-item clearfix">
                    Add Member
                    <span class="pull-right">
                        <i class="fa fa-user-plus"></i>
                    </span>
                </a>
                <a href="{{ asset('report') }}" class="list-group-item clearfix">
                    Generate Report
                    <span class="pull-right">
                        <i class="fa fa-table"></i>
                    </span>
                </a>
            </div>

        </div>
    </div>
</div>


