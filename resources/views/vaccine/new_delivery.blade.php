<h3><i class="fa fa-location-arrow" style="color:green"></i> {{ \App\Muncity::find($vaccine->muncity_id)->description }}</h3>
<form action="{{ asset('vaccine/new_delivery/saved') }}" method="POST" id="form_submit" autocomplete="off">
    {{ csrf_field() }}
    <input type="hidden" name="province_id" value="{{ $vaccine->province_id }}">
    <input type="hidden" name="muncity_id" value="{{ $vaccine->muncity_id }}">
    <div class="row">
        <div class="col-md-4">
            <small>Type of Vaccine</small>
            <select name="typeof_vaccine" id="typeof_vaccine" class="select2" required>
                <option value="">Select Option</option>
                <option value="Sinovac">Sinovac</option>
                <option value="Astrazeneca">Astrazeneca</option>
                <option value="SputnikV">SputnikV</option>
                <option value="Pfizer">Pfizer</option>
            </select>
        </div>
        <div class="col-md-4">
            <small>Priority</small>
            <select name="priority" id="" class="select2">
                <option value="">Select Option</option>
                <option value="frontline_health_workers">Frontline Health Workers</option>
                <option value="indigent_senior_citizens" >Senior Citizens</option>
                <option value="remaining_indigent_population"  disabled>Remaining Indigent Population</option>
                <option value="uniform_personnel"  disabled>Uniform Personnel</option>
                <option value="teachers_school_workers" disabled>Teachers & School Workers</option>
                <option value="all_government_workers"  disabled>All Government Workers (National & Local)</option>
                <option value="essential_workers" disabled>Essential Workers</option>
                <option value="socio_demographic" disabled>Socio-demographic groups & significant higher risk other than senior citizen and indigent population (e.g.PDL,PWD,IP,Filipinos living in high-density areas)</option>
                <option value="ofw"  disabled >OFW's</option>
                <option value="remaining_workforce" disabled>Other remaining workforce</option>
                <option value="remaining_filipino_citizen"  disabled>Remaining Filipino Citizen</option>
                <option value="etc"  disabled >ETC.</option>
            </select>
        </div>
        <div class="col-md-4">
            <small>Sub-Priority A1.1-A1.7 </small>
            <input type="text" name="sub_priority"  class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <small>Facility</small>
            <select name="facility_id" id="facility" class="select2">
                <option value="">Select Option</option>
                @if(isset($vaccine->province_id))
                    @foreach($facility as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-4">
            <small>Ownership</small>
            <select name="ownership" id="" class="select2">
                <option value="" readonly>Select Option</option>
                <option value="Government">Government</option>
                <option value="Private">Private</option>
            </select>
        </div>
        <div class="col-md-4">
            <small>No. of Eligble Population</small>
            <input type="text" name="no_eli_pop"  class="form-control">
        </div>
    </div>
    <br>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <small>No. of Vaccine Allocated</small>
            <input type="text" name="nvac_allocated" id="nvac_allocated" onkeyup="getTarget($(this).val())" class="form-control">
        </div>
        <div class="col-md-3">
            <small>Target Dose Per Day</small>
            <input type="text" name="tgtdoseper_day" id="tgtdoseper_day" class="form-control" readonly>
        </div>
        <div class="col-md-3">
            <small class="text-green">Date of Delivery</small>
            <input type="text" id="dateof_delivery_picker4" name="dateof_del"  class="form-control" required>
        </div>
        <div class="col-md-3">
            <small class="text-yellow">Date of Delivery</small>
            <input type="text" id="dateof_delivery_picker5" name="dateof_del2" class="form-control" >
        </div>
    </div>
    <br>
    <br>
    <div class="pull-right">
        <button type="button" class="btn btn-default btn-md" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        <button type="submit" class="btn btn-success btn-md"><i class="fa fa-send"></i> Submit</button>
    </div>
    <br>
    <br>
</form>
<script>

    function getTarget(vaccine_allocated) {
        var typeof_vaccine = $('#typeof_vaccine').val();
        var target = 0;
        if(typeof_vaccine == 'Sinovac'){
            target = (vaccine_allocated/2) / 5;
            $('#tgtdoseper_day').val(target);
        }
        else if (typeof_vaccine == 'Astrazeneca'){
            target = (vaccine_allocated/5);
            $('#tgtdoseper_day').val(target);
        }
    }

    $("#dateof_delivery_picker4").daterangepicker({
        "singleDatePicker":true
    });
    $("#dateof_delivery_picker5").daterangepicker({
        "singleDatePicker":true
    });
</script>