<div class="panel panel-jim">
    <div class="panel-heading">
        <h3 class="panel-title">Links</h3>
    </div>
    <?php
    $count = \App\Http\Controllers\doctor\ReferralCtrl::countReferral();
    ?>
    <div class="panel-body" style="height:157px">
        <div class="list-group">
            <a href="{{ asset('admin/users') }}" class="list-group-item clearfix">
                Manage Users
                <span class="pull-right">
                        <i class="fa fa-users"></i>
                    </span>
            </a>
            <a href="{{ asset('admin/login') }}" class="list-group-item clearfix">
                Login As
                <span class="pull-right">
                        <i class="fa fa-sign-in"></i>
                    </span>
            </a>
        </div>

    </div>
</div>