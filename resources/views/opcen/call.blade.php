<style>
    input[type=radio] {
        width: 20%;
        height: 2em;
    }
</style>

<form action="{{ asset('opcen/transaction/end') }}" method="POST" id="form_submit">
    {{ csrf_field() }}
    <table class="table table-hover table-bordered" style="width: 100%;">
        <tr>
            <td >
                <small>Reference Number</small><br>
                &nbsp;&nbsp;<b class="text-green">{{ $reference_number }}</b>
                <input type="hidden" name="reference_number" value="{{ $reference_number }}">
            </td>
            <td >
                <small>Time Started</small><br>
                &nbsp;&nbsp;<b class="text-yellow" id="time_started_text"></b>
                <input type="hidden" name="time_started" id="time_started">
            </td>
            <td>
                <small>Call Classification</small><br>
                &nbsp;&nbsp;<b class="<?php if(isset($client->reference_number)) echo 'text-red'; else echo 'text-blue'; ?>" id="call_classification_text"></b>
                <input type="hidden" id="call_classification" name="call_classification">
            </td>
        </tr>

        <tr>
            <td >
                <small>Name</small>
                <input type="text" name="name" value="<?php if(isset($client->name)) echo $client->name ?>" class="form-control">
            </td>
            <td width="35%">
                <small>Company/Agency Connected</small>
                <select name="company" id="" class="select2">
                    <option value="">Select Option</option>
                    <option value="nga" <?php if(isset($client->company)){if($client->company == 'nga')echo 'selected';} ?>>NGAs</option>
                    <option value="ngo" <?php if(isset($client->company)){if($client->company == 'ngo')echo 'selected';} ?>>NGOs</option>
                    <option value="lgu" <?php if(isset($client->company)){if($client->company == 'lgu')echo 'selected';} ?>>LGU</option>
                    @foreach($facility as $fac)
                        <option value="{{ $fac->id }}" <?php if(isset($client->company)){if($client->company == $fac->id)echo 'selected';} ?>>{{ $fac->name }}</option>
                    @endforeach
                    <option value="etc" <?php if(isset($client->company)){if($client->company == 'etc')echo 'selected';} ?>>ETC.</option>
                </select>
            </td>
            <td >
                <small>Age</small>
                <input type="text" name="age" value="<?php if(isset($client->age)) echo $client->age ?>" class="form-control">
            </td>
        </tr>

        <tr>
            <td >
                <small>Gender</small>
                <select name="sex" id="" class="form-control">
                    <option value="">Select Option</option>
                    <option value="male" <?php if(isset($client->sex)){if($client->sex == 'male')echo 'selected';} ?>>Male</option>
                    <option value="female" <?php if(isset($client->sex)){if($client->sex == 'female')echo 'selected';} ?>>Female</option>
                </select>
            </td>
            <td >
                <small>Region</small>
                <select name="region" id="" class="select2" onchange="onChangeRegion($(this).val())">
                    <option value="">Select Option</option>
                    <option value="region_7" <?php if(isset($client->region)){if($client->region == 'region_7')echo 'selected';} ?>>Region 7</option>
                    <option value="ncr" <?php if(isset($client->region)){if($client->region == 'ncr')echo 'selected';} ?>>NCR</option>
                    <option value="car" <?php if(isset($client->region)){if($client->region == 'car')echo 'selected';} ?>>CAR</option>
                    <option value="region_1" <?php if(isset($client->region)){if($client->region == 'region_1')echo 'selected';} ?>>Region 1</option>
                    <option value="region_2" <?php if(isset($client->region)){if($client->region == 'region_2')echo 'selected';} ?>>Region 2</option>
                    <option value="region_3" <?php if(isset($client->region)){if($client->region == 'region_3')echo 'selected';} ?>>Region 3</option>
                    <option value="region_4" <?php if(isset($client->region)){if($client->region == 'region_4')echo 'selected';} ?>>Region 4</option>
                    <option value="region_5" <?php if(isset($client->region)){if($client->region == 'region_5')echo 'selected';} ?>>Region 5</option>
                    <option value="region_6" <?php if(isset($client->region)){if($client->region == 'region_6')echo 'selected';} ?>>Region 6</option>
                    <option value="region_8" <?php if(isset($client->region)){if($client->region == 'region_8')echo 'selected';} ?>>Region 8</option>
                    <option value="region_9" <?php if(isset($client->region)){if($client->region == 'region_9')echo 'selected';} ?>>Region 9</option>
                    <option value="region_10" <?php if(isset($client->region)){if($client->region == 'region_10')echo 'selected';} ?>>Region 10</option>
                    <option value="region_11" <?php if(isset($client->region)){if($client->region == 'region_11')echo 'selected';} ?>>Region 11</option>
                    <option value="region_12" <?php if(isset($client->region)){if($client->region == 'region_12')echo 'selected';} ?>>Region 12</option>
                    <option value="region_13" <?php if(isset($client->region)){if($client->region == 'region_13')echo 'selected';} ?>>Region 14</option>
                    <option value="barmm" <?php if(isset($client->region)){if($client->region == '')echo 'barmm';} ?>>BARMM</option>
                </select>
            </td>
            <td >
                <small>Province</small>
                <div class="province_body">
                    <select name='province_id' id='' class='select2' onchange='onChangeProvince($(this).val())'>
                        <option value=''>Select Option</option>
                        @foreach($province as $row)
                            <option value='{{ $row->id }}' <?php if(isset($client->province_id)){if($client->province_id == $row->id)echo 'selected';} ?>>{{ $row->description }}</option>
                        @endforeach
                    </select>
                </div>
            </td>
        </tr>

        <tr>
            <td >
                <small>Municipality:</small>
                <div class="municipality_body">
                    <select name='municipality_id' id='municipality' class='select2' onchange='onChangeMunicipality($(this).val())'>
                        @if(isset($client->municipality_id))
                            <option value=''>Select Option</option>
                            @foreach($municipality as $mun)
                                <option value='{{ $mun->id }}' <?php if($client->municipality_id == $mun->id) echo 'selected'; ?>>{{ $mun->description }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </td>
            <td >
                <small>Barangay</small>
                <div class="barangay_body">
                    <select name="barangay_id" id="barangay" class="select2">
                        @if(isset($client->barangay_id))
                            <option value="">Select Option</option>
                            @foreach($barangay as $bar)
                                <option value="{{ $bar->id }}" <?php if($client->barangay_id == $bar->id) echo 'selected'; ?>>{{ $bar->description }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </td>
            <td >
                <small>Sitio</small>
                <input type="text" name="sitio" class="form-control" value="<?php if(isset($client->sitio)) echo $client->sitio; ?>">
            </td>
        </tr>
        
        <tr>
            <td>
                <small>Active contact number:</small>
                <input type="text" name="contact_number" class="form-control" value="<?php if(isset($client->contact_number)) echo $client->contact_number; ?>">
            </td>
        </tr>
    </table>

    <table class="table table-hover table-bordered">
        <tr>
            <th>Reason for calling:
                <button class="btn btn-info" type="button" onclick="reasonCalling('inquiry')">Inquiry</button>
                <button class="btn btn-warning" type="button" onclick="reasonCalling('referral')">Referral</button>
                <button class="btn btn-success" type="button" onclick="reasonCalling('others')">Others</button>
                <input type="hidden" name="reason_calling" id="reason_calling">
            </th>
        </tr>
    </table>

    <div class="reason_calling"></div>

    <table class="table table-hover table-bordered">
        <tr>
            <th>Status of Transaction:
                <input type="checkbox" id="status_transaction" checked data-toggle="toggle" data-on="Complete" data-off="Incomplete" data-onstyle="success" data-offstyle="danger" data-width="100" >
            </th>
        </tr>
    </table>

    <div class="transaction_status"></div>
    
    <table class="table table-hover table-bordered">
        <tr>
            <td >
                <button class="btn btn-primary" type="submit" onclick="endTransaction($(this))">End Transaction</button>
            </td>
            <th class="pull-right">Time Ended: <input type="text" name="time_ended" id="time_ended" readonly></th>
        </tr>
    </table>
</form>

<script>
    @if(@$client->municipality_id && !@$client->barangay_id)
        onChangeMunicipality("<?php echo $client->municipality_id ?>");
    @endif

    $('#status_transaction').change(function() {
        if(!this.checked) {
            transactionInComplete();
        } else {
            $(".transaction_incomplete").remove();
        }
    });

    $('#status_transaction').bootstrapToggle();

    function onChangeRegion($region) {
        if($region == 'region_10') {
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
        } else {
            $(".province_body").html("<input type='text' class='form-control' name='province_id'>");
            $(".municipality_body").html("<input type='text' class='form-control' name='municipality_id'>");
            $(".barangay_body").html("<input type='text' class='form-control' name='barangay_id'>");
        }
        
        $(".select2").select2({ width: '100%' });
    }
</script>

