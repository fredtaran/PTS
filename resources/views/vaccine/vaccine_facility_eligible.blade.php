<form method="POST" action="{{ asset('admin/facility/add') }}">
    {{ csrf_field() }}
    <fieldset>
        <legend><i class="fa fa-hospital-o"></i> {{ $facility->name }}</legend>
    </fieldset>
    <input type="hidden" value="@if(isset($facility->id)){{ $facility->id }}@endif" name="id">
    <input type="hidden" value="{{ $province_id }}" name="province">
    <div class="form-group">
        <label>Province Name:</label>
        <input type="text" class="form-control" value="{{ $province_name }} Province" disabled>
    </div>
    <div class="form-group">
        <label>Facility Name:</label>
        <input type="text" class="form-control" value="@if(isset($facility->name)){{ $facility->name }}@endif" autofocus name="name" readonly>
    </div>
    <div class="form-group">
        <label>Facility Code:</label>
        <input type="text" class="form-control" value="@if(isset($facility->facility_code)){{ $facility->facility_code }}@endif" name="facility_code" readonly>
    </div>
    <div class="form-group">
        <label>A1</label>
        <input type="text" class="form-control" value="@if(isset($facility->a1)){{ $facility->a1 }}@endif" name="a1" required>
    </div>
    <div class="form-group">
        <label>A2</label>
        <input type="text" class="form-control" value="@if(isset($facility->a2)){{ $facility->a2 }}@endif" name="a2" required>
    </div>
    <div class="form-group">
        <label>A3</label>
        <input type="text" class="form-control" value="@if(isset($facility->a2)){{ $facility->a3 }}@endif" name="a3" required>
    </div>
    <div class="form-group">
        <label>A4</label>
        <input type="text" class="form-control" value="@if(isset($facility->a2)){{ $facility->a4 }}@endif" name="a4" required>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
    </div>
</form>



