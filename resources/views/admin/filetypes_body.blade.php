<form method="POST" action="{{ asset('admin/filetypes_options') }}">
    {{ csrf_field() }}
    <fieldset>
        <legend><i class="fa fa-hospital-o"></i> File Types</legend>
    </fieldset>

    <input type="hidden" value="@if(isset($data->id)){{ $data->id }}@endif" name="id">

    <div class="form-group">
        <label>Description: </label>
        <input type="text" class="form-control" value="@if(isset($data->description)){{ $data->description }}@endif" autofocus name="description" required>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        @if(isset($data->id))
            <a href="#filetype_delete" data-toggle="modal" class="btn btn-danger btn-sm btn-flat" onclick="filetypeDelete('<?php echo $data->id; ?>')">
                <i class="fa fa-trash"></i> Remove
            </a>
        @endif
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
    </div>
</form>



