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
        <label>FacilityCode:</label>
        <input type="text" class="form-control" value="@if(isset($facility->facility_code)){{ $facility->facility_code }}@endif" name="facility_code" readonly>
    </div>
    <div class="form-group">
      <label style="margin-left: -3%;">Sinovac Allocated</label>
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control text-green" value="@if(isset($facility->sinovac_allocated_first)){{ $facility->sinovac_allocated_first}}@endif" name="sinovac_allocated_first">
            </div>
            <div class="col-md-6">
                <input type="text"  class="form-control text-yellow" value="@if(isset($facility->sinovac_allocated_second)){{ $facility->sinovac_allocated_second}}@endif" name="sinovac_allocated_second">
            </div>
        </div>
    </div>
    <div class="form-group">
       <label style="margin-left: -3%;">Astrazeneca Allocated</label>
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control text-green" value="@if(isset($facility->astrazeneca_allocated_first)){{ $facility->astrazeneca_allocated_first}}@endif" name="astrazeneca_allocated_first">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control text-yellow" value="@if(isset($facility->astrazeneca_allocated_second)){{ $facility->astrazeneca_allocated_second}}@endif" name="astrazeneca_allocated_second">
            </div>
        </div>
    </div>
    <div class="form-group">
       <label style="margin-left: -3%;">Sputnik V Allocated</label>
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control text-green" value="@if(isset($facility->sputnikv_allocated_first)){{ $facility->sputnikv_allocated_first}}@endif" name="sputnikv_allocated_first">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control text-yellow" value="@if(isset($facility->sputnikv_allocated_second)){{ $facility->sputnikv_allocated_second}}@endif" name="sputnikv_allocated_second">
            </div>
        </div>
    </div>
    <div class="form-group">
       <label style="margin-left: -3%;">Pfizer Allocated</label>
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control text-green" value="@if(isset($facility->pfizer_allocated_first)){{ $facility->pfizer_allocated_first}}@endif" name="pfizer_allocated_first">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control text-yellow" value="@if(isset($facility->pfizer_allocated_second)){{ $facility->pfizer_allocated_second}}@endif" name="pfizer_allocated_second">
            </div>
        </div>
    </div>
        <br>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
        </div>

</form>



