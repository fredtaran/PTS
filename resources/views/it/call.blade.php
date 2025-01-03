<style>
    input[type=radio] {
        width: 20%;
        height: 2em;
    }
</style>
<form action="{{ asset('it/call/saved') }}" method="POST" id="form_submit">
    {{ csrf_field() }}
    <input type="hidden" name="patient_code" id="patient_code" class="form-control" value="<?php if(isset($client->code)) echo $client->code; ?>">
    <table class="table table-hover table-bordered" style="width: 100%;">
        <tr>
            <td >
                <small>Time Started</small><br>
                &nbsp;&nbsp;<b class="text-yellow" id="time_started_text"></b>
                <input type="hidden" name="time_started" id="time_started">
            </td>
            <td >
                <small>Time Ended</small><br>
                &nbsp;&nbsp;<b class="text-yellow" id="time_ended_text"></b>
                <input type="hidden" name="time_ended" id="time_ended">
            </td>
            <td>
                <small>Call Classification</small><br>
                &nbsp;&nbsp;<b class="<?php if(isset($client->reference_number)) echo 'text-red'; else echo 'text-blue'; ?>" id="call_classification_text"></b>
                <input type="hidden" id="call_classification" name="call_classification">
            </td>
        </tr>
    </table>
    <div class="row">
        <div class="col-md-4">
            <small>Name</small>
            <input type="text" name="name" value="<?php if(isset($client->name)) echo $client->name ?>" class="form-control" required>
        </div>
        <div class="col-md-4">
            <small>Facility Name</small>
            <select name="facility_id" id="" class="select2" required>
                <option value="">Select Option</option>
                @foreach($facility as $fac)
                    <option value="{{ $fac->id }}" <?php if(isset($client->facility_id)){if($client->facility_id == $fac->id)echo 'selected';} ?>>{{ $fac->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <small>Department</small>
            <input type="text" name="department" value="<?php if(isset($client->department)) echo $client->department ?>" class="form-control" required>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-4">
            <small>Designation:</small>
            <input type="text" name="designation" class="form-control" value="<?php if(isset($client->designation)) echo $client->designation; ?>" required>
        </div>
        <div class="col-md-4">
            <small>Active contact number:</small>
            <input type="text" name="contact_no" class="form-control" value="<?php if(isset($client->contact_no)) echo $client->contact_no; ?>" required>
        </div>
        <div class="col-md-4">
            <small>Email Address:</small>
            <input type="text" name="email" class="form-control" value="<?php if(isset($client->email)) echo $client->email; ?>" required>
        </div>
    </div><br>
    <table class="table table-hover table-bordered">
        <tr>
            <td width="15%;">
                <span class="pull-right">
                    Type of call:
                </span>
            </td>
            <td>
                <input type="hidden" name="type_call" id="type_call" value="outgoing">
                <input type="checkbox" id="type_call_toggle" checked data-toggle="toggle" data-on="Outgoing" data-off="Incoming" data-onstyle="primary" data-offstyle="warning" data-width="100" >
            </td>
        </tr>
    </table>
    <table class="table table-hover table-bordered">
        <tr>
            <td width="15%;">
                <span class="pull-right">
                    Reason for calling:
                </span>
            </td>
            <td>
                <button class="btn btn-warning" type="button" onclick="reasonCalling('offline')">Offline Facility</button>
                <button class="btn btn-info" type="button" onclick="reasonCalling('support')">Tech Support</button>
                <a href="#patient_code_dialog" data-toggle="modal" class="btn btn-success" type="button" onclick="reasonCalling1('walkin')">Walk-In Patient</a>
                <a href="#patient_code_dialog" data-toggle="modal" class="btn btn-danger" type="button" onclick="reasonCalling1('issue')">Issue and Concern</a>
                <input type="hidden" name="reason_calling" id="reason_calling">
            </td>
        </tr>
    </table>
    <div class="reason_calling"></div>
    <table class="table table-hover table-bordered">
        <tr>
            <td width="15%;">
                <span class="pull-right">
                    Status of Transaction:
                </span>
            </td>
            <td>
                <input type="checkbox" id="status_transaction" checked data-toggle="toggle" data-on="Complete" data-off="Incomplete" data-onstyle="success" data-offstyle="danger" data-width="100" >
            </td>
        </tr>
        <tr>
            <td colspan="2"><div class="transaction_status"></div></td>
        </tr>
    </table>

    <table class="table table-hover table-bordered">
        <tr>
            <td >
                <button class="btn btn-app" type="submit" onclick="endTransaction($(this))"><i class="fa fa-save"></i> End Transaction</button>
            </td>
        </tr>
    </table>
</form>

<script>
    @if(@$client->municipality_id && !@$client->barangay_id)
        onChangeMunicipality("<?php echo $client->municipality_id ?>");
    @endif

    $('#status_transaction').change(function() {
        if(!this.checked)
            transactionInComplete();
        else
            $(".transaction_incomplete").remove();
    });

    $('#type_call_toggle').change(function() {
        if(this.checked)
            $("#type_call").val("outgoing");
        else
            $("#type_call").val("incoming");
    });

    $('#type_call_toggle').bootstrapToggle();

    $('#status_transaction').bootstrapToggle();

    function onChangeRegion($region){
        if($region == 'region_7'){

            $(".province_body").html("<select name='province_id' id='' class='select2' onchange='onChangeProvince($(this).val())'>\n" +
                "                        <option value=''>Select Option</option>\n" +
                "                        @foreach($province as $row)\n" +
                "                            <option value='{{ $row->id }}' <?php if (isset($client->province_id)) {
                    if ($client->province_id == $row->id) echo 'selected';
                } ?>>{{ $row->description }}</option>\n" +
                "                        @endforeach\n" +
                "                    </select>");

            $(".municipality_body").html("<select name='municipality_id' id='municipality' class='select2' onchange='onChangeMunicipality($(this).val())'>\n" +
                "                        @if(isset($client->municipality_id))\n" +
                "                            <option value=''>Select Option</option>\n" +
                "                            @foreach($municipality as $mun)\n" +
                "                                <option value='{{ $mun->id }}' <?php if ($client->municipality_id == $mun->id) echo 'selected'; ?>>{{ $mun->description }}</option>\n" +
                "                            @endforeach\n" +
                "                        @endif\n" +
                "                    </select>");

            $(".barangay_body").html("<select name=\"barangay_id\" id=\"barangay\" class=\"select2\">\n" +
                "                        @if(isset($client->barangay_id))\n" +
                "                            <option value=\"\">Select Option</option>\n" +
                "                            @foreach($barangay as $bar)\n" +
                "                                <option value=\"{{ $bar->id }}\" <?php if ($client->barangay_id == $bar->id) echo 'selected'; ?>>{{ $bar->description }}</option>\n" +
                "                            @endforeach\n" +
                "                        @endif\n" +
                "                    </select>");
        }
        else {
            $(".province_body").html("<input type='text' class='form-control' name='province_id'>");
            $(".municipality_body").html("<input type='text' class='form-control' name='municipality_id'>");
            $(".barangay_body").html("<input type='text' class='form-control' name='barangay_id'>");
        }
        $(".select2").select2({ width: '100%' });
    }
</script>

