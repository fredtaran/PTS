<form method="POST" action="{{ asset('admin/diagnosis/add') }}">
    {{ csrf_field() }}
    <fieldset>
        <legend>
            <i class="fa fa-hospital-o"></i> Diagnosis
        </legend>
    </fieldset>

    <input type="hidden" value="@if(isset($data->id)){{ $data->id }}@endif" name="id">
    <input type="hidden" value="0" name="void">

    <div class="form-group">
        <label>Diagnosis Code:</label>
        <input type="text" class="form-control" value="@if(isset($data->diagcode)){{ $data->diagcode }}@endif" autofocus name="diagcode" required>
    </div>

    <div class="form-group">
        <label>Diagnosis Description:</label>
        <input type="text" class="form-control" value="@if(isset($data->diagdesc)){{ $data->diagdesc }}@endif" name="diagdesc">
    </div>

    <div class="form-group">
        <label>Diagnosis Main Category:</label>
        <select name="diagmaincat" class="form-control diagmcat" >
            <option value="">Select Main Category</option>
            <?php
            $miancat = App\Models\DiagMain::all()->where('void', 0);
            ?>
            @foreach($miancat as $row)
            <option {{ (@$data->diagmaincat == $row->diagcat ? 'selected' : '') }} value="{{ $row->diagcat }}"> {{ $row->diagcat }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Diagnosis Category:</label>
        <select name="diagcategory" class="form-control diagcategory" >
        @if(isset($data->diagsubcat))
            <option value="">Select</option>
            <?php
            $subcat = App\Models\DiagSubcat::all()->where('void', 0);
            ?>
            @foreach($subcat as $row)
            <option {{ (@$data->diagcategory == $row->diagsubcat ? 'selected' : '') }} value="{{ $row->diagsubcat }}"> {{ $row->diagsubcat }}</option>
            @endforeach
        @else
            <option value="">Select Category</option>
        @endif
        </select>
    </div>

    <div class="form-group">
        <label>Diagnosis Sub Category:</label>
        <input type="text" class="form-control" value="@if(isset($data->diagsubcat)){{ $data->diagsubcat }}@endif" name="diagsubcat">
    </div>

    <div class="form-group">
        <small class="text-success">Diagonis Priority:</small><br>
        <label>
            <input type="radio" id ="normal_rate" name="diagpriority" value="Y" <?php
            if(isset($data->diagpriority)) {
                if($data->diagpriority == 'Y') {
                    echo 'checked';
                }
            }
            ?> />Y
        </label>

        <label>
        <input type="radio" id ="normal_rate" name="diagpriority" value="N" <?php
        if(isset($data->diagpriority)) {
            if($data->diagpriority == 'N') {
                echo 'checked';
            }
        }
        ?>  />N
        </label>
    </div>

    <hr />

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>

        @if(isset($data->id))
        <a href="#diag_delete" data-toggle="modal" class="btn btn-danger btn-sm btn-flat" onclick="diagDelete('<?php echo $data->id; ?>')">
            <i class="fa fa-trash"></i> Remove
        </a>
        @endif
        
        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
    </div>
</form>

<script>
$(".select2").select2({ width: '100%' });

$('.diagmcat').on('change', function() {
    // $('.loading').show();
    var maincat_id = $(this).val();
    var url = "{{ url('admin/getmaincat/') }}";

    if (maincat_id != "") {
        $.ajax({
            url: url + '/' + maincat_id,
            type: 'GET',
            success: function(data) {
                $('.loading').hide();
                $('.diagsubcat').empty()
                .append($('<option>', {
                    value: '',
                    text : 'Select Sub Category'
                }));

                jQuery.each(data, function(i,val) {
                    $('.diagcategory').append($('<option>', {
                        value: val.diagsubcat,
                        text : val.diagsubcat
                    }));
                });
            },

            error: function(){
                $('#serverModal').modal();
            }
        });
    } else {
        $('.diagcategory').empty()
        .append($('<option>', {
            value: '',
            text : 'Select Sub Category'
        }));
    }
});

$('.select_muncity').on('change', function() {
    $('.loading').show();
    var province_id = $(".select_province").val();
    var muncity_id = $(this).val();
    var url = "{{ url('location/barangay/') }}";

    $.ajax({
        url: url + '/' + province_id + '/' + muncity_id,
        type: 'GET',
        success: function(data) {
            $('.loading').hide();
            $('.select_barangay').empty()
            .append($('<option>', {
                value: '',
                text : 'Select Barangay'
            }));

            jQuery.each(data, function(i,val) {
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