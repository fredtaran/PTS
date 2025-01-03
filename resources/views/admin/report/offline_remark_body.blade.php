<form method="POST" action="{{ asset('offline/facility/remark/add') }}">
    {{ csrf_field() }}
    <input type="hidden" name="facility_id" value="{{ $facility_id }}">
    <fieldset>
        <legend><i class="fa fa-plus"></i> Offline Facility Remarks</legend>
    </fieldset>
    <div class="form-group">
        <label>Notes:</label>
        <textarea name="remarks" class="form-control" cols="30" rows="10"></textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success btn-sm" onclick="loadPage()"><i class="fa fa-check"></i> Save</button>
    </div>
</form>
<script>
    $('.textarea').wysihtml5();
</script>

