<form method="POST" action="{{ asset('admin/municipality/crud/add') }}">
    {{ csrf_field() }}
    <fieldset>
        <legend><i class="fa fa-hospital-o"></i> Municipality/City</legend>
    </fieldset>

    <input type="hidden" value="@if(isset($muncity->id)){{ $muncity->id }}@endif" name="id">
    <input type="hidden" value="{{ $province_id }}" name="province_id">

    <div class="form-group">
        <label>Province Name:</label>
        <input type="text" class="form-control" value="{{ $province_name }} Province" disabled>
    </div>

    <div class="form-group">
        <label>Municipality/City Name:</label>
        <input type="text" class="form-control" value="@if(isset($muncity->description)){{ $muncity->description }}@endif" autofocus name="description" required>
    </div>

    <div class="form-group">
        <label>Municipality/City Code:</label>
        <input type="text" class="form-control" value="@if(isset($muncity->muncity_code)){{ $muncity->muncity_code }}@endif" name="muncity_code">
    </div>

    <div class="form-group">
        <label>Vaccine Used:</label>
        <select name="vaccine_used" id="" class="form-control">
            <option value="No" <?php if(@$muncity->vaccine_used == 'No')echo 'selected';?>>No</option>
            <option value="Yes"<?php if(@$muncity->vaccine_used == 'Yes')echo 'selected';?>>Yes</option>
        </select>
    </div>

    <hr />
    
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        @if(isset($muncity->id))
            <a href="#municipality_delete" data-toggle="modal" class="btn btn-danger btn-sm btn-flat" onclick="MunicipalityDelete('<?php echo $muncity->id; ?>')">
                <i class="fa fa-trash"></i> Remove
            </a>
        @endif
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
    </div>
</form>
