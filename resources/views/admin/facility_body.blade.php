<?php
use Illuminate\Contracts\Encryption\DecryptException;
?>
<form method="POST" action="{{ asset('admin/facility/add') }}">
    {{ csrf_field() }}
    <fieldset>
        <legend><i class="fa fa-hospital-o"></i> Facility</legend>
    </fieldset>
    <input type="hidden" value="@if(isset($data->id)){{ $data->id }}@endif" name="id">
    <input type="hidden" value="1" name="status">

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Facility Name:</label>
                <input type="text" class="form-control" value="@if(isset($data->name)){{ $data->name }}@endif" autofocus name="name" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Facility Code:</label>
                <input type="text" class="form-control" value="@if(isset($data->facility_code)){{ $data->facility_code }}@endif" name="facility_code">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Facility License No.:</label>
                <input type="text" class="form-control" value="@if(isset($data->license_no)){{ $data->license_no }}@endif" name="license_no" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Abbr:</label>
                <input type="text" class="form-control" value="@if(isset($data->abbr)){{ $data->abbr }}@endif" name="abbr" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Province:</label>
                <select class="form-control select_province" name="province" required>
                    @if(!isset($data->province))
                    <option value="">Select Province</option>
                    @endif
                    @foreach(\App\Models\Province::get() as $row)
                        <option value="{{ $row->id }}"
                            <?php
                                if(isset($data->province)){
                                    if($data->province == $row->id){
                                        echo 'selected';
                                    }
                                }
                            ?>
                        >{{ $row->description }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Municipality:</label>
                <select class="form-control select_muncity select2" name="muncity" required>
                    @if(isset($data->muncity))
                        @foreach(\App\Models\Muncity::where("province_id",$data->province)->get() as $row)
                            <option value="{{ $row->id }}" <?php if($data->muncity == $row->id) echo 'selected'; ?> >{{ $row->description }}</option>
                        @endforeach
                    @else
                        <option value="">Select Municipality</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Barangay:</label>
                <select class="form-control select_barangay select2" name="brgy" required>
                    @if(isset($data->brgy))
                        @foreach(\App\Models\Barangay::where("province_id",$data->province)->where("muncity_id",$data->muncity)->get() as $row)
                            <option value="{{ $row->id }}" <?php if($data->brgy == $row->id) echo 'selected'; ?> >{{ $row->description }}</option>
                        @endforeach
                    @else
                        <option value="">Select Barangay</option>
                    @endif
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Address:</label>
                <input type="text" class="form-control" value="@if(isset($data->address)){{ $data->address }}@endif" name="address" required>
            </div>
        </div> 
        <div class="col-sm-6">
            <div class="form-group">
                <label>Contact:</label>
                <input type="text" class="form-control" value="@if(isset($data->contact)){{ $data->contact }}@endif" name="contact" required>
            </div>
        </div> 
    </div> 

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" value="@if(isset($data->email)){{ $data->email }}@endif" name="email" required>
            </div>
        </div> 
        <div class="col-sm-6"> 
            <div class="form-group">
                <label>Chief of hospital(name):</label>
                <input type="text" class="form-control" value="@if(isset($data->chief_hospital)){{ $data->chief_hospital }}@endif" name="chief_hospital" required>
            </div>
        </div> 
    </div> 

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Service Capability:</label>
                <select class="form-control" name="level" >
                    @if(!isset($data->level))
                    <option value="">Select Service Capability</option>
                    @endif
                    <option value="1"
                        <?php
                            if(isset($data->level)){
                                if($data->level == 1){
                                    echo 'selected';
                                }
                            }
                        ?>
                    >Level 1
                    </option>

                    <option value="2"
                        <?php
                            if(isset($data->level)){
                                if($data->level == 2){
                                    echo 'selected';
                                }
                            }
                        ?>
                    >Level 2
                    </option>

                    <option value="3"
                        <?php
                            if(isset($data->level)){
                                if($data->level == 3){
                                    echo 'selected';
                                }
                            }
                        ?>
                    >Level 3
                    </option>

                    <option value="infirmary"
                    <?php
                        if(isset($data->level)){
                            if($data->level == 'infirmary'){
                                echo 'selected';
                            }
                        }
                        ?>
                    >Infirmary
                    </option>

                    <option value="RHU"
                    <?php
                        if(isset($data->level)){
                            if($data->level == 'RHU'){
                                echo 'selected';
                            }
                        }
                        ?>
                    >RHU
                    </option>

                    <option value="primary_care_facility"
                    <?php
                        if(isset($data->level)){
                            if($data->level == 'primary_care_facility'){
                                echo 'selected';
                            }
                        }
                        ?>
                    >Primary Care Facility
                    </option>
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>Ownership:</label>
                <select class="form-control" name="hospital_type">
                    @if(!isset($data->hospital_type))
                    <option value="">Select Ownership</option>
                    @endif

                    <option value="government"
                        <?php
                            if(isset($data->hospital_type)){
                                if($data->hospital_type == 'government'){
                                    echo 'selected';
                                }
                            }
                        ?>
                    >Government</option>

                    <option value="private"
                        <?php
                            if(isset($data->hospital_type)){
                                if($data->hospital_type == 'private'){
                                    echo 'selected';
                                }
                            }
                        ?>
                    >Private</option>

                    <option value="RHU"
                    <?php
                        if(isset($data->hospital_type)){
                            if($data->hospital_type == 'RHU'){
                                echo 'selected';
                            }
                        }
                        ?>
                    >RHU</option>

                    <option value="CIU/TTMF"
                    <?php
                        if(isset($data->level)){
                            if($data->hospital_type == 'CIU/TTMF'){
                                echo 'selected';
                            }
                        }
                        ?>
                    >CIU/TTMF
                    </option>

                    <option value="birthing_home"
                    <?php
                        if(isset($data->level)){
                            if($data->hospital_type == 'birthing_home'){
                                echo 'selected';
                            }
                        }
                        ?>
                    >Birthing Home
                    </option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Hospital Status:</label>
                <select class="form-control" name="status">
                    <option value="1" {{ @$data->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ @$data->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="form-group">
                <label>Vaccine Used:</label>
                <select class="form-control" name="vaccine_used">
                    <option value="no" <?php if(@$data->vaccine_used == 'no') echo 'selected'; ?>>No</option>
                    <option value="yes" <?php if(@$data->vaccine_used == 'yes') echo 'selected'; ?>>Yes</option>
                </select>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label>Referral Used</label>
                <select class="form-control" name="referral_used" required>
                    <option value="">Select Option</option>
                    <option value="yes" <?php if(@$data->referral_used == 'yes') echo 'selected'; ?>>Yes</option>
                    <option value="no" <?php if(@$data->referral_used == 'no') echo 'selected'; ?>>No</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- <div class="col-sm-6">
            <div class="form-group">
                <label>Tri City</label>
                <select class="select2" name="tricity_id">
                    <option value="">Select tricity</option>
                    @foreach(\App\Models\Muncity::where("province_id", 2)->get() as $row)
                        <option value="{{ $row->id }}" <?php if($row->id == @$data->tricity_id) echo 'selected'; ?>>{{ $row->description }}</option>
                    @endforeach
                </select>
            </div>
        </div> -->
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Latitude:</label>
                <input type="text" class="form-control" value="@if(isset($data->latitude)){{ $data->latitude }}@endif" name="latitude">
            </div>
        </div>
        
        <div class="col-sm-6">
            <div class="form-group">
                <label>Longitude:</label>
                <input type="text" class="form-control" value="@if(isset($data->longitude)){{ $data->longitude }}@endif" name="longitude">
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        @if(isset($data->id))
        <a href="#facility_delete" data-toggle="modal" class="btn btn-danger btn-sm btn-flat" onclick="FacilityDelete('<?php echo $data->id; ?>')">
            <i class="fa fa-trash"></i> Remove
        </a>
        @endif
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
    </div>
</form>

<script>
    $(".select2").select2({ width: '100%' });

    $('.select_province').on('change',function(){
        $('.loading').show();
        var province_id = $(this).val();
        var url = "{{ url('location/muncity/') }}";
        $.ajax({
            url: url+'/'+province_id,
            type: 'GET',
            success: function(data){
                console.log(data);
                $('.loading').hide();
                $('.select_muncity').empty()
                    .append($('<option>', {
                        value: '',
                        text : 'Select Municipality'
                    }));
                $('.select_barangay').empty()
                    .append($('<option>', {
                        value: '',
                        text : 'Select Barangay'
                    }));
                jQuery.each(data, function(i,val){
                    $('.select_muncity').append($('<option>', {
                        value: val.id,
                        text : val.description
                    }));
                });
            },
            error: function(){
                $('#serverModal').modal();
            }
        });

    });

    $('.select_muncity').on('change',function(){
        $('.loading').show();
        var province_id = $(".select_province").val();
        var muncity_id = $(this).val();
        var url = "{{ url('location/barangay/') }}";
        $.ajax({
            url: url+'/'+province_id+'/'+muncity_id,
            type: 'GET',
            success: function(data){
                $('.loading').hide();
                $('.select_barangay').empty()
                    .append($('<option>', {
                        value: '',
                        text : 'Select Barangay'
                    }));
                jQuery.each(data, function(i,val){
                    $('.select_barangay').append($('<option>', {
                        value: val.id,
                        text : val.description
                    }));
                });
            },
            error: function(){
                $('#serverModal').modal();
            }
        });

    });
</script>


