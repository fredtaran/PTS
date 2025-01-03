<div class="modal fade" role="dialog" id="license_noModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4>INPUT LICNSE NUMBER</h4>
                <hr />
                <form method="post" id="license_submit">
                    {{ csrf_field() }}
                    <div class="password_success hide alert alert-success">
                        <span class="text-success">
                            <i class="fa fa-check"></i> <span class="info">df</span>
                        </span>
                    </div>
                    <div class="form-group">
                        <label style="padding:0px;">License Number:</label>
                        <input type="text" class="form-control" name="license_no" id="license_no" autofocus required />
                    </div>

                    <hr />
                    <div class="form-fotter pull-right">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-pencil"></i> Submit</button>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

