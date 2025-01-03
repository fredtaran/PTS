<form method="POST" action="{{ asset('monitoring/add/remark') }}">
    {{ csrf_field() }}
    <input type="hidden" name="activity_id" value="{{ $activity_id }}">
    <input type="hidden" name="code" value="{{ $code }}">
    <input type="hidden" name="referring_facility" value="{{ $referring_facility }}">
    <input type="hidden" name="referred_to" value="{{ $referred_to }}">
    <fieldset>
        <legend><i class="fa fa-plus"></i> Add Remark</legend>
    </fieldset>
    <div class="form-group">
        <label>Notes:</label>
        <textarea name="remarks" class="form-control" id="" cols="30" rows="10"></textarea>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success btn-sm" onclick="loadPage()"><i class="fa fa-check"></i> Save</button>
    </div>
</form>

