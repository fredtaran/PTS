<div class="modal-content">
    <div class="modal-body facility_body">
        {{ csrf_field() }}
        <fieldset>
            <legend><i class="fa fa-plus"></i> Update Inventory</legend>
        </fieldset>
        <input type="hidden" name="inventory_id" value="{{ $inventory->id }}">
        @if($inventory->name != 'Patients Waiting for Admission')
        <div class="form-group">
            <label>Description:</label>
            <input type="text" class="form-control" value="{{ $inventory->name }}" disabled>
        </div>
        @endif
        <div class="form-group">
            @if($inventory->name == 'Patients Waiting for Admission')
                <label>No.of Patients Waiting for Admission</label>
            @else
                <label>Capacity:</label>
            @endif
            <input type="number" class="form-control" value="{{ $inventory->capacity }}" name="capacity" required>
        </div>
        @if($inventory->name != 'Patients Waiting for Admission')
        <div class="form-group">
            <label>Occupied:</label>
            <input type="number" class="form-control" value="{{ $inventory->occupied }}" name="occupied" required>
        </div>
        @endif
    </div><!-- /.modal-content -->
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
    </div>
</div>