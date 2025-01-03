<div class="modal fade" role="dialog" id="acceptFormModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4>ACCEPT PATIENT</h4>
                <hr />
                <form method="post" id="acceptForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label style="padding:0px;">REMARKS:</label>
                        <textarea class="form-control accept_remarks" name="remarks" required rows="5" style="resize: none;"></textarea>
                    </div>
                    <div class="form-group">
                        <label style="padding:0px;">Status/Condition upon Receipt at ER: </label>
                        <textarea class="form-control status_on_er" name="status_on_er" required rows="5" style="resize: none;"></textarea>
                    </div>
                    <hr />
                    <div class="form-fotter pull-right">
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Accept</button>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="callConfirmationModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4>CALL REQUEST</h4>
                <hr />
                <button type="button" class="btn btn-lg btn-block btn-success"><i class="fa fa-phone"></i> Called</button>
                <hr />

                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-2" role="dialog" id="incident">
    <div class="modal-dialog modal-lg" role="document1">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class=""><i class="fa fa-line-chart"></i> Incident Log</h4>
            </div>
        <div class="modal-body">
        <form action="{{ asset('admin/incident/addIncident') }}" method="POST">
            <table class="table table-hover table-form table-striped">
                <tr>
                    <td class="col-sm-3"><label>Patient Code</label></td>
                    <td class="col-sm-1">:</td>
                    <td class="col-sm-8"><input type="text" name="patient_code" readonly id="patient_code" value="" class="form-control"></td>
                </tr>
                <tr>
             </tr>
            </table>        
           
             {{ csrf_field() }}  
             <input type="hidden"  name="encoded_by" value="<?php echo Auth::user()->id; ?>">
         <div class="inci_body"></div> 

         </form>
        </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


