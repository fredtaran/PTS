<div class="modal fade" role="dialog" id="transferModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4><i class="fa fa-exclamation-triangle"></i> Mode of Transportation </h4>
                <div id="seenBy_section">
                    <hr />
                    <form method="post" action="" id="transferReferralForm">
                        {{ csrf_field() }}
                        <div class="form-group transportation_body">
                        </div>
                        <div class="transportation_others_body" style="margin-top: -10%;">

                        </div><br>
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
<script>
    function addOthers(){
        var transportation_val = $("#mode_transportation").val();
        console.log(transportation_val);
        if(transportation_val == 5){
            $(".transportation_others_body").html('<input type="text" class="form-control" placeholder="Enter the other transportation..." name="other_transportation" >');
        } else {
            $(".transportation_others_body").html('');
        }

    }
</script>
