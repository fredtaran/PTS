<div class="modal fade" role="dialog" id="dutyModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><i class="fa fa-user-md"></i> SELECT OPTION</h4>
            </div>
            <div class="modal-body">
                <button id="btn-on-duty" type="button" class="btn btn-success col-sm-6">
                    <i class="fa-5x fa fa-user-md"></i>
                    <br />
                    ON DUTY
                </button>
                <button id="btn-off-duty" type="button" class="btn btn-default col-sm-6">
                    <i class="fa-5x fa fa-user-md"></i>
                    <br />
                    OFF DUTY
                </button>
            </div>
            <div class="modal-footer"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="setLogoutTime">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="{{ url('logout/set') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h4><i class="fa fa-clock-o"></i> SET TIME TO LOGOUT</h4>
                </div>
                <div class="modal-body">
                    <input type="time" id="input_time_logout" name="input_time_logout" class="form-control">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-clock-o"></i> Set Time</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->