<div class="modal fade" id="addFacilityModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title" style="font-size: 17pt;">Search Facility by keyword</h4>
            </div>
            <form action="{{ url('doctor/affiliated/add') }}" method="POST">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="input-group input-group-lg">
                        <input type="text" id="affiliated_keyword" class="form-control">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-info btn-flat affi_find_btn">Find</button>
                        </span>
                    </div><br>
                    <div class="affiliated_body"></div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save selected check</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>