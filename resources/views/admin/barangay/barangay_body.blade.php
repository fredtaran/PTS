<form method="POST" action="{{ asset('admin/barangay/data/crud/add') }}">
    {{ csrf_field() }}
    <fieldset>
        <legend><i class="fa fa-hospital-o"></i> Barangay</legend>
    </fieldset>
    <input type="hidden" value="@if(isset($barangay->id)){{ $barangay->id }}@endif" name="id">
    <input type="hidden" value="{{ $muncity->id }}" name="muncity_id">
    <input type="hidden" value="{{ $province_id }}" name="province_id">
    <div class="form-group">
        <label>Province Name:</label>
        <input type="text" class="form-control" value="{{ $province_name }} Province" disabled>
    </div>
    <div class="form-group">
        <label>Municipality Name:</label>
        <input type="text" class="form-control" value="{{ $muncity->description }}" disabled>
    </div>
    <div class="form-group">
        <label>Barangay Name:</label>
        <input type="text" class="form-control" value="@if(isset($barangay->description)){{ $barangay->description }}@endif" autofocus name="description" required>
    </div>
    <div class="form-group">
        <label>Barangay Code:</label>
        <input type="text" class="form-control" value="@if(isset($barangay->barangay_code)){{ $barangay->barangay_code }}@endif" name="barangay_code">
    </div>
    <hr />
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        @if(isset($barangay->id))
            <a href="#barangay_delete" data-toggle="modal" class="btn btn-danger btn-sm btn-flat" onclick="BarangayDelete('<?php echo $barangay->id; ?>')">
                <i class="fa fa-trash"></i> Remove
            </a>
        @endif
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
    </div>
</form>



