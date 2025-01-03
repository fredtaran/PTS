<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">Links</h3>
    </div>
    <?php
    $count = \App\Http\Controllers\doctor\ReferralCtrl::countReferral();
    ?>
    <div class="panel-body">
        <div class="list-group">
            <a href="{{ asset('support/users') }}" class="list-group-item clearfix">
                Manage Users
                <span class="pull-right">
                        <i class="fa fa-users"></i>
                    </span>
            </a>
            <a href="{{ asset('support/report/users') }}" class="list-group-item clearfix">
                Generate Report
                <span class="pull-right">
                        <i class="fa fa-line-chart"></i>
                    </span>
            </a>
        </div>

    </div>
</div>