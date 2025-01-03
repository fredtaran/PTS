<div class="modal fade" role="dialog" id="resetPasswordModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4>CHANGE PASSWORD</h4>
                <hr />
                <form method="post" id="resetForm">
                    {{ csrf_field() }}
                    <div class="password_success hide alert alert-success">
                        <span class="text-success">
                            <i class="fa fa-check"></i> <span class="info">df</span>
                        </span>
                    </div>
                    <div class="form-group">
                        <label style="padding:0px;">Current Password:</label>
                        <input type="password" class="form-control" name="current" id="reset_password_current" autofocus required />
                    </div>
                    <div class="form-group">
                        <label style="padding:0px;">New Password:</label>
                        <input type="password" class="form-control" name="new" id="reset_password_new" pattern=".{6,}" title="New password - minimum of 6 Characters" placeholder="Minimum of 6 characters..." required />
                    </div>
                    <div class="form-group">
                        <label style="padding:0px;">Confirm Password:</label>
                        <input type="password" class="form-control" name="confirm" id="reset_password_confirm" pattern=".{6,}" title="Confirm password - minimum of 6 Characters" required />
                    </div>
                    <div class="password_error hide alert alert-danger">
                        <span class="text-danger">
                            <i class="fa fa-info"></i> <span class="info"></span>
                        </span>
                    </div>
                    <hr />
                    <div class="form-fotter pull-right">
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-pencil"></i> Change</button>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

