<?php
    $user = Auth::user();
    $status = Session::get('status');
?>
<form method="POST" action="{{ asset('doctor/patient/update') }}">
    {{ csrf_field() }}
    <fieldset>
        <legend><i class="fa fa-pencil"></i> Update Patients</legend>
    </fieldset>
<div class="row">
     <div class="col-sm-6">
        <div class="form-group">
            <input type="hidden" name="patient_id" value="{{ $data->id }}">
            <label>PhilHealth Status:</label>
            <select class="form-control" name="phic_status" required>
                <option
                <?php
                    if(isset($data->phic_status)){
                        if($data->phic_status == "None"){
                            echo 'selected';
                        }
                    }
                ?>
                >None</option>
                <option
                <?php
                    if(isset($data->phic_status)){
                        if($data->phic_status == "Member"){
                            echo 'selected';
                        }
                    }
                ?>
                >Member</option>
                <option
                <?php
                    if(isset($data->phic_status)){
                        if($data->phic_status == "Dependent"){
                            echo 'selected';
                        }
                    }
                ?>
                >Dependent</option>
            </select>
        </div>
     </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>PhilHealth ID:</label>
            <input type="text" class="form-control" value="@if(isset($data->phic_id)){{ $data->phic_id }}@endif" autofocus name="phic_id">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" class="form-control" value="@if(isset($data->fname)){{ $data->fname }}@endif" name="fname" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Middle Name:</label>
            <input type="text" class="form-control" value="@if(isset($data->mname)){{ $data->mname }}@endif" name="mname">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" class="form-control" value="@if(isset($data->lname)){{ $data->lname }}@endif" name="lname" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Contact Number:</label>
            <input type="text" class="form-control" value="@if(isset($data->contact)){{ $data->contact }}@endif" name="contact" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Birth Date:</label>
            <input type="date" class="form-control" value="@if(isset($data->dob)){{ $data->dob }}@endif" min="1910-05-11" max="{{ date('Y-m-d') }}" name="dob" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Sex:</label>
            <select class="form-control" name="sex" required>
                <option
                <?php
                    if(isset($data->sex)){
                        if($data->sex == 'Male'){
                            echo 'selected';
                        }
                    }
                ?>
                >Male
                </option>
                <option
                <?php
                    if(isset($data->sex)){
                        if($data->sex == 'Female'){
                            echo 'selected';
                        }
                    }
                ?>
                >Female</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Civil Status:</label>
            <select class="form-control" name="civil_status" required>
                <option
                    <?php
                        if(isset($data->civil_status)){
                            if($data->civil_status == 'Single'){
                                echo 'selected';
                            }
                        }
                    ?>
                >Single</option>
                <option
                    <?php
                        if(isset($data->civil_status)){
                            if($data->civil_status == 'Married'){
                                echo 'selected';
                            }
                        }
                    ?>
                >Married</option>
                <option
                    <?php
                        if(isset($data->civil_status)){
                            if($data->civil_status == 'Divorced'){
                                echo 'selected';
                            }
                        }
                    ?>
                >Divorced</option>
                <option
                    <?php
                        if(isset($data->civil_status)){
                            if($data->civil_status == 'Separated'){
                                echo 'selected';
                            }
                        }
                    ?>
                >Separated</option>
                <option
                    <?php
                        if(isset($data->civil_status)){
                            if($data->civil_status == 'Widowed'){
                                echo 'selected';
                            }
                        }
                    ?>
                >Widowed</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Municipality:</label>
            <select class="form-control select_muncity" name="muncity" required>
                @foreach(\App\Models\Muncity::where("province_id",$data->province)->get() as $mun)
                    <option value="{{ $mun->id }}"
                    <?php
                        if(isset($data->muncity)){
                            if($data->muncity == $mun->id){
                                echo 'selected';
                            }
                        }
                        ?>
                    >{{ $mun->description }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
    <div class="form-group">
        <label>Barangay:</label>
        <select class="form-control select_barangay" name="brgy" required>
            @if(isset($data->brgy))
                @foreach(\App\Models\Barangay::where("province_id",$data->province)->where("muncity_id",$data->muncity)->get() as $row)
                    <option value="{{ $row->id }}" <?php if($data->brgy == $row->id)echo 'selected'; ?> >{{ $row->description }}</option>
                @endforeach
            @else
                <option value="">Select Barangay</option>
            @endif
        </select>
    </div>
    <hr />
    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" value="true" name="patient_update_button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
    </div>
</form>

<script>

    $('.select_muncity').on('change',function(){
        var province_id = "<?php echo $user->province; ?>";
        var muncity_id = $(this).val();
        var url = "{{ url('location/barangay/') }}";
        $.ajax({
            url: url+'/'+province_id+'/'+muncity_id,
            type: 'GET',
            success: function(data){
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


