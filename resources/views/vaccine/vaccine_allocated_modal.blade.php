<form method="POST" action="{{ asset('admin/municipality/crud/add') }}">
    {{ csrf_field() }}
    <fieldset>
        <legend><i class="fa fa-hospital-o"></i> Municipality</legend>
    </fieldset>
    <input type="hidden" value="@if(isset($muncity->id)){{ $muncity->id }}@endif" name="id">
    <input type="hidden" value="{{ $province_id }}" name="province_id">
    <div class="form-group">
        <label>Province Name:</label>
        <input type="text" class="form-control" value="{{ $province_name }} Province" disabled>
    </div>
    <div class="form-group">
        <label>Municipality Name:</label>
        <input type="text" class="form-control" value="@if(isset($muncity->description)){{ $muncity->description }}@endif" autofocus name="description" readonly>
    </div>
    <div class="form-group">
        <label>Municipality Code:</label>
        <input type="text" class="form-control" value="@if(isset($muncity->muncity_code)){{ $muncity->muncity_code }}@endif" name="muncity_code" readonly>
    </div>
    <div class="form-group">
        <label style="margin-left: -3%;">Sinovac Allocated</label>
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control text-green" value="@if(isset($muncity->sinovac_allocated_first)){{ $muncity->sinovac_allocated_first}}@endif" name="sinovac_allocated_first">
            </div>
            <div class="col-md-6">
                <input type="text"  class="form-control text-yellow" value="@if(isset($muncity->sinovac_allocated_second)){{ $muncity->sinovac_allocated_second}}@endif" name="sinovac_allocated_second">
            </div>
        </div>
    </div>
    <div class="form-group">
       <label style="margin-left: -3%;" >Astrazeneca Allocated</label>
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control text-green" value="@if(isset($muncity->astrazeneca_allocated_first)){{ $muncity->astrazeneca_allocated_first}}@endif" name="astrazeneca_allocated_first">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control text-yellow" value="@if(isset($muncity->astrazeneca_allocated_second)){{ $muncity->astrazeneca_allocated_second}}@endif" name="astrazeneca_allocated_second">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label style="margin-left: -3%;">Sputnik V Allocated</label>
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control text-green" value="@if(isset($muncity->sputnikv_allocated_first)){{ $muncity->sputnikv_allocated_first}}@endif" name="sputnikv_allocated_first">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control text-yellow" value="@if(isset($muncity->sputnikv_allocated_second)){{ $muncity->sputnikv_allocated_second}}@endif" name="sputnikv_allocated_second">
            </div>
        </div>
    </div>
    <div class="form-group">
      <label style="margin-left: -3%;">Pfizer Allocated</label>
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control text-green" value="@if(isset($muncity->pfizer_allocated_first)){{ $muncity->pfizer_allocated_first}}@endif" name="pfizer_allocated_first">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control text-yellow" value="@if(isset($muncity->pfizer_allocated_second)){{ $muncity->pfizer_allocated_second}}@endif" name="pfizer_allocated_second">
            </div>
        </div>
    </div>
        <br>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        @if(isset($muncity->id))
            <!-- <a href="#municipality_delete" data-toggle="modal" class="btn btn-danger btn-sm btn-flat" onclick="MunicipalityDelete('<?php echo $muncity->id; ?>')">
                <i class="fa fa-trash"></i> Remove
            </a> -->
            @endif
            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
        </div>

</form>



