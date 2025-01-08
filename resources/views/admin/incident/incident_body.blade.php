<form method="POST" action="{{ asset('admin/incident_type/add') }}">
    {{ csrf_field() }}
    <fieldset>
        <legend><i class="fa fa-hospital-o"></i> Incident</legend>
    </fieldset>
    <input type="hidden" value="@if(isset($data->id)){{ $data->id }}@endif" name="id">
    <div class="form-group">
        <label>Incident Name:</label>
        <!-- <input type="text" class="form-control" value="@if(isset($data->type)){{ $data->type }}@endif" autofocus name="type" required> -->
        <input type="text" id="type" class="form-control" value="{{ old('type', isset($data->type) ? $data->type : '') }}" autofocus name="type" required>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        @if(isset($data->id))
            <a href="#incident_delete" data-toggle="modal" class="btn btn-danger btn-sm btn-flat" onclick="IncidentDelete('<?php echo $data->id; ?>')">
                <i class="fa fa-trash"></i> Remove
            </a>
        @endif
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
    </div>
</form>

