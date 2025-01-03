<div class="modal fade" role="dialog" id="cancelModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4><i class="fa fa-user-times"></i> Cancel Referral </h4>
                <div id="seenBy_section">
                    <hr />
                    <form method="post" action="" id="cancelReferralForm">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea required class="form-control" name="reason" style="resize: none;" rows="6" placeholder="Reason for Cancellation"></textarea>
                        </div>
                        <div class="pull-right">
                            <button type="button" data-dismiss="modal" class="btn btn-default btn-sm">
                                <i class="fa fa-times"></i> Close
                            </button>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fa fa-check"></i> Submit
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
