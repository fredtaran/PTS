<style>
    input[type=radio] {
        width: 20%;
        height: 2em;
    }
</style>
<form action="<?php
if(isset($vaccine->typeof_vaccine)){
    echo asset('vaccine/update');
}
else{
    echo asset('vaccine/saved');
}
?>" method="POST" id="form_submit" autocomplete="off">
    {{ csrf_field() }}
    <input type="hidden" name="vaccine_id" value="{{ $vaccine->id }}">
    <div class="row">
        <div class="col-md-4">
            <small>Type of Vaccine</small>
            <select name="typeof_vaccine" id="typeof_vaccine" class="select2" required>
                <option value="">Select Option</option>
                <option value="Sinovac" <?php if(isset($vaccine->typeof_vaccine)){if($vaccine->typeof_vaccine == 'Sinovac')echo 'selected';} ?>>Sinovac</option>
                <option value="Astrazeneca" <?php if(isset($vaccine->typeof_vaccine)){if($vaccine->typeof_vaccine == 'Astrazeneca')echo 'selected';} ?>>Astrazeneca</option>
                <option value="SputnikV" <?php if(isset($vaccine->typeof_vaccine)){if($vaccine->typeof_vaccine == 'SputnikV')echo 'selected';} ?>>SputnikV</option>
                <option value="Pfizer" <?php if(isset($vaccine->typeof_vaccine)){if($vaccine->typeof_vaccine == 'Pfizer')echo 'selected';} ?>>Pfizer</option>
            </select>
        </div>
        <div class="col-md-4">
            <small>Priority</small>
            <select name="priority" id="" class="select2">
                <option value="">Select Option</option>
                <option value="frontline_health_workers" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'frontline_health_workers')echo 'selected';} ?>>Frontline Health Workers</option>
                <option value="indigent_senior_citizens" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'indigent_senior_citizens')echo 'selected';} ?>>Senior Citizens</option>
                <option value="remaining_indigent_population" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'remaining_indigent_population')echo 'selected';} ?> disabled>Remaining Indigent Population</option>
                <option value="uniform_personnel" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'uniform_personnel')echo 'selected';} ?> disabled>Uniform Personnel</option>
                <option value="teachers_school_workers" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'teachers_school_workers')echo 'selected';} ?> disabled>Teachers & School Workers</option>
                <option value="all_government_workers" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'all_government_workers')echo 'selected';} ?> disabled>All Government Workers (National & Local)</option>
                <option value="essential_workers" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'essential_workers')echo 'selected';} ?> disabled>Essential Workers</option>
                <option value="socio_demographic" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'socio_demographic')echo 'selected';} ?> disabled>Socio-demographic groups & significant higher risk other than senior citizen and indigent population (e.g.PDL,PWD,IP,Filipinos living in high-density areas)</option>
                <option value="ofw" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'ofw')echo 'selected';} ?> disabled >OFW's</option>
                <option value="remaining_workforce" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'remaining_workforce')echo 'selected';} ?> disabled>Other remaining workforce</option>
                <option value="remaining_filipino_citizen" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'remaining_filipino_citizen')echo 'selected';} ?> disabled>Remaining Filipino Citizen</option>
                <option value="etc" <?php if(isset($vaccine->priority)){if($vaccine->priority == 'etc')echo 'selected';} ?> disabled >ETC.</option>
            </select>
        </div>
        <div class="col-md-4">
            <small>Sub-Priority A1.1-A1.7 </small>
            <input type="text" name="sub_priority" value="<?php if(isset($vaccine->sub_priority)) echo $vaccine->sub_priority ?>" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <small>Province</small>
            <select name="province_id" id="province_id" class="select2" onchange="onChangeProvince($(this).val())">
                <option value="">Select Option</option>
                @foreach($province as $row)
                    <option value="{{ $row->id }}"  <?php if(isset($vaccine->province_id)){if($vaccine->province_id == $row->id)echo 'selected';} ?> >{{ $row->description }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <small>Municipality</small>
            <select name="muncity_id" id="municipality" class="select2">
                <option value="">Select Option</option>
                @if(isset($vaccine->muncity_id))
                    @foreach($muncity as $row)
                        <option value="{{ $row->id }}"  <?php if(isset($vaccine->muncity_id)){if($vaccine->muncity_id == $row->id)echo 'selected';} ?> >{{ $row->description }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-4">
            <small>Facility</small>
            <select name="facility_id" id="facility" class="select2">
                <option value="">Select Option</option>
                @if(isset($vaccine->province_id))
                    @foreach($facility as $row)
                        <option value="{{ $row->id }}"  <?php if(isset($vaccine->facility_id)){if($vaccine->facility_id == $row->id)echo 'selected';} ?> >{{ $row->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <small>No. of Eligble Population</small>
            <input type="text" name="no_eli_pop" value="<?php if(isset($vaccine->no_eli_pop)) echo $vaccine->no_eli_pop ?>" class="form-control">
        </div>
        <div class="col-md-4">
            <small>Ownership</small>
            <select name="ownership" id="" class="select2">
                <option value="" readonly>Select Option</option>
                <option value="Government" <?php if(isset($vaccine->ownership)){if($vaccine->ownership == 'Government')echo 'selected';} ?>>Government</option>
                <option value="Private"<?php if(isset($vaccine->ownership)){if($vaccine->ownership == 'Private')echo 'selected';} ?> >Private</option>
            </select>
        </div>
        <div class="col-md-4">
            <small>No. of Vaccine Allocated</small>
            <input type="text" name="nvac_allocated" id="nvac_allocated" onkeyup="getTarget($(this).val())" value="<?php if(isset($vaccine->nvac_allocated)) echo $vaccine->nvac_allocated ?>" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <small>Target Dose Per Day</small>
            <input type="text" name="tgtdoseper_day" id="tgtdoseper_day" value="<?php if(isset($vaccine->tgtdoseper_day)) echo $vaccine->tgtdoseper_day ?>" class="form-control" readonly>
        </div>
        <div class="col-md-4">
            <small class="text-green">Date of Delivery</small>
            <input type="text" id="date_picker2" name="dateof_del" value="<?php if(isset($vaccine->dateof_del)) echo date('m/d/Y',strtotime($vaccine->dateof_del)) ?>" class="form-control" required>
        </div>
        <div class="col-md-4">
            <small class="text-yellow">Date of Delivery</small>
            <input type="text" id="date_picker3" name="dateof_del2" value="<?php if(isset($vaccine->dateof_del2)) echo date('m/d/Y',strtotime($vaccine->dateof_del2)) ?>" class="form-control" >
        </div>
    </div>
    <br>
    <br>
<!--
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">
    <h4 style="color:green">First Dose</h4>
    <div class="row">
        <div class="col-md-3">
            <small>Date of Delivery</small>
            <input type="text" id="date_picker2" name="dateof_del" value="<?php if(isset($vaccine->dateof_del)) echo date('m/d/Y',strtotime($vaccine->dateof_del)) ?>" class="form-control" required>
        </div>
        <div class="col-md-3">
            <small>Date of Fist Dose</small>
            <input type="text" id="date_picker" name="first_dose" value="<?php if(isset($vaccine->first_dose)) echo date('m/d/Y',strtotime($vaccine->first_dose)) ?>" class="form-control">
        </div>
        <div class="col-md-3">
            <small>No. of Vaccinated</small>
            <input type="text" name="numof_vaccinated" value="<?php if(isset($vaccine->numof_vaccinated)) echo $vaccine->numof_vaccinated ?>" class="form-control">
        </div>
        <div class="col-md-3">
            <small>AEFI</small>
            <?php
$display_aefi_property = "hide";
$aefi_qty = "";
if(isset($vaccine->aefi)){
    $display_aefi_property = "";
    $aefi_qty = $vaccine->aefi." : ".$vaccine->aefi_qty;
}
?>
        <b style="margin-left:10%" class="text-green display_aefi {{ $display_aefi_property }}">{{ $aefi_qty }}</b>
            <input type="hidden" id="aefi_qty" name="aefi_qty">
            <select name="aefi" id="" class="select2" onchange="aefi_qtyFunc1($(this))">
                <option value="" readonly>Select Option</option>
                <option value="Mild" <?php if(isset($vaccine->aefi)){if($vaccine->aefi == 'Mild')echo 'selected';} ?>>Mild</option>
                <option value="Serious"<?php if(isset($vaccine->aefi)){if($vaccine->aefi == 'Serious')echo 'selected';} ?> >Serious</option>
            </select>
        </div>
            <div class="col-md-3">
            <br>
                <small>Deferred</small>
                <input type="text" name="deferred" value="<?php if(isset($vaccine->deferred)) echo $vaccine->deferred ?>" class="form-control">
            </div>
            <div class="col-md-3">
            <br>
                <small>Refused</small>
                <input type="text" name="refused" value="<?php if(isset($vaccine->refused)) echo $vaccine->refused ?>" class="form-control">
            </div>
            <div class="col-md-3">
            <br>
                <small>Wastage</small>
                <input type="text" name="wastage" value="<?php if(isset($vaccine->wastage)) echo $vaccine->wastage?>" class="form-control">
            </div>
        <br>
    </div>
    <hr style="height:1px;border-width:0;color:gray;background-color:gray">
    <h4 style="color:orange;">Second Dose</h4>
    <div class="row">
        <div class="col-md-3">
            <small>Date of Delivery</small>
            <input type="text" id="date_picker3" name="dateof_del2" value="<?php if(isset($vaccine->dateof_del2)) echo date('m/d/Y',strtotime($vaccine->dateof_del2)) ?>" class="form-control" >
        </div>
        <div class="col-md-3">
            <small>Date of Second Dose</small>
            <input type="text" id="date_picker4" name="second_dose" value="<?php if(isset($vaccine->second_dose))echo date('m/d/Y',strtotime($vaccine->second_dose)) ?>" class="form-control">
        </div>
        <div class="col-md-3">
            <small>No. of Vaccinated</small>
            <input type="text" name="numof_vaccinated2" value="<?php if(isset($vaccine->numof_vaccinated2)) echo $vaccine->numof_vaccinated2 ?>" class="form-control">
        </div>
        <div class="col-md-3">
            <small>AEFI</small>
            <?php
$display_aefi2_property = "hide";
$aefi_qty2 = "";
if(isset($vaccine->aefi2)){
    $display_aefi2_property = "";
    $aefi_qty2 = $vaccine->aefi2." : ".$vaccine->aefi_qty2;
}
?>
        <b style="margin-left:10%" class="text-orange display_aefi2 {{ $display_aefi2_property }}">{{ $aefi_qty2 }}</b>
            <input type="hidden" id="aefi_qty2" name="aefi_qty2">
            <select name="aefi2" id="" class="select2" onchange="aefi_qtyFunc2($(this))">
                <option value="" readonly>Select Option</option>
                <option value="Mild" <?php if(isset($vaccine->aefi2)){if($vaccine->aefi2 == 'Mild')echo 'selected';} ?>>Mild</option>
                <option value="Serious"<?php if(isset($vaccine->aefi2)){if($vaccine->aefi2 == 'Serious')echo 'selected';} ?> >Serious</option>
            </select>
        </div>
        <div class="col-md-3">
            <br>
            <small>Deferred</small>
            <input type="text" name="deferred2" value="<?php if(isset($vaccine->deferred)) echo $vaccine->deferred ?>" class="form-control">
        </div>
        <div class="col-md-3">
            <br>
            <small>Refused</small>
            <input type="text" name="refused2" value="<?php if(isset($vaccine->refused)) echo $vaccine->refused ?>" class="form-control">
        </div>
        <div class="col-md-3">
            <br>
            <small>Wastage</small>
            <input type="text" name="wastage2" value="<?php if(isset($vaccine->wastage2)) echo $vaccine->wastage2?>" class="form-control">
        </div>
        <br>
    </div>
    -->
    <div class="pull-right">
        <button type="button" class="btn btn-default btn-md" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        @if(isset($vaccine->typeof_vaccine))
            <button type="submit" class="btn btn-warning btn-md"><i class="fa fa-send"></i> Update</button>
        @else
            <button type="submit" class="btn btn-success btn-md"><i class="fa fa-send"></i> Submit</button>
        @endif
    </div>
    <br>
    <br>
</form>
<script>
    $("#date_picker").daterangepicker({
        "singleDatePicker":true
    });
    $("#date_picker1").daterangepicker({
        "singleDatePicker":true
    });
    $("#date_picker2").daterangepicker({
        "singleDatePicker":true
    });
    $("#date_picker3").daterangepicker({
        "singleDatePicker":true
    });
    $("#date_picker4").daterangepicker({
        "singleDatePicker":true
    });

    function aefi_qtyFunc1(aefi_value) {
        Lobibox.prompt('text',
            {
                title: 'How many AEFI '+aefi_value.val()+"?",
                callback: function ($this, type, ev) {
                    if($('.lobibox-input').val()) {
                        $('.display_aefi').removeClass('hide');
                        $('.display_aefi').html(aefi_value.val()+":"+($('.lobibox-input').val()));
                        $('#aefi_qty').val($('.lobibox-input').val());
                    }
                }
            });
    }

    function aefi_qtyFunc2(aef2_value) {
        Lobibox.prompt('text',
            {
                title: 'How many AEFI '+aef2_value.val()+"?",
                callback: function ($this, type, ev) {
                    if($('.lobibox-input').val()) {
                        $('.display_aefi2').removeClass('hide');
                        $('.display_aefi2').html(aef2_value.val()+":"+($('.lobibox-input').val()));
                        $('#aefi_qty2').val($('.lobibox-input').val());
                    }
                }
            });
    }

    function onChangeProvince($province_id){
        $('.loading').show();
        if($province_id){
            var url = "{{ url('opcen/onchange/province') }}";
            $.ajax({
                url: url+'/'+$province_id,
                type: 'GET',
                success: function(data){
                    $("#municipality").select2("val", "");
                    $('#municipality').empty()
                        .append($('<option>', {
                            value: '',
                            text : 'Select Option'
                        }));
                    jQuery.each(data, function(i,val){
                        $('#municipality').append($('<option>', {
                            value: val.id,
                            text : val.description
                        }));
                        $('.loading').hide();
                    });
                },
                error: function(){
                    $('#serverModal').modal();
                }
            });

            var url = "{{ url('vaccine/onchange/facility') }}";
            $.ajax({
                url: url+'/'+$province_id,
                type: 'GET',
                success: function(data){
                    console.log(data);
                    $("#facility").select2("val", "");
                    $('#facility').empty()
                        .append($('<option>', {
                            value: '',
                            text : 'Select Option'
                        }));
                    jQuery.each(data, function(i,val){
                        $('#facility').append($('<option>', {
                            value: val.id,
                            text : val.name
                        }));
                    });
                },
                error: function(e){
                    alert(e.message)
                }
            });
        } else {
            $("#municipality").select2("val", "");
            $('#municipality').empty()
                .append($('<option>', {
                    value: '',
                    text : 'Select Option'
                }));
        }
    }


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


</script>

