<fieldset>
    <legend>
        <i class="fa fa-user-secret"></i> Client Info
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </legend>
</fieldset>
<span class="text-blue" style="font-size: 12pt;">Personal Information</span>
<table class="table table-hover table-bordered" style="width: 100%;">
    <tr>
        <td >
            <small>Reference Number</small><br>
            &nbsp;&nbsp;<span class="text-green">{{ $client->reference_number }}</span>
        </td>
        <td >
            <small>Time Started</small><br>
            &nbsp;&nbsp;<span class="text-yellow" >{{ date('F d, Y H:i:s',strtotime($client->time_started)) }}</span>
        </td>
        <td>
            <small>Call Classification</small><br>
            &nbsp;&nbsp;<span class="<?php if($client->call_classification == 'repeat_call') echo 'text-red'; else echo 'text-blue'; ?>"><?php if($client->call_classification == 'repeat_call') echo 'Repeat Call'; else echo 'New Call'; ?></span>
        </td>
    </tr>
    <tr>
        <td >
            <small>Name</small><br>
            &nbsp;&nbsp;<span class="text-yellow">{{ $client->name }}</span>
        </td>
        <td >
            <small>Company/Agency Connected</small><br>
            &nbsp;&nbsp;<span class="text-yellow">
                <?php
                    if($client->company == 'nga')
                        echo 'NGAs';
                    elseif($client->company == 'ngo')
                        echo 'NGOs';
                    elseif($client->company == 'lgu')
                        echo 'LGU';
                    elseif($client->company == 'etc')
                        echo 'ETC.';
                    else{
                        $facility = \App\Facility::find($client->company);
                        if($facility)
                            echo $facility->name;
                    }

                ?>
            </span>
        </td>
        <td>
            <small>Age</small><br>
            &nbsp;&nbsp;<span class="text-yellow">{{ $client->age }}</span>
        </td>

    </tr>
    <tr>
        <td >
            <small>Gender</small><br>
            &nbsp;&nbsp;<span class="text-yellow">{{ ucfirst($client->sex) }}</span>
        </td>
        <td >
            <small>Region</small><br>
            &nbsp;&nbsp;<span class="text-yellow">
                <?php
                    if($client->region == 'region_7')
                        echo 'Region 7';
                    elseif($client->region == 'ncr')
                        echo 'NCR';
                    elseif($client->region == 'car')
                        echo 'CAR';
                    elseif($client->region == 'region_1')
                        echo 'Region 1';
                    elseif($client->region == 'region_2')
                        echo 'Region 2';
                    elseif($client->region == 'region_3')
                        echo 'Region 3';
                    elseif($client->region == 'region_4')
                        echo 'Region 4';
                    elseif($client->region == 'region_5')
                        echo 'Region 5';
                    elseif($client->region == 'region_6')
                        echo 'Region 6';
                    elseif($client->region == 'region_7')
                        echo 'Region 7';
                    elseif($client->region == 'region_8')
                        echo 'Region 8';
                    elseif($client->region == 'region_9')
                        echo 'Region 9';
                    elseif($client->region == 'region_10')
                        echo 'Region 10';
                    elseif($client->region == 'region_11')
                        echo 'Region 11';
                    elseif($client->region == 'region_12')
                        echo 'Region 12';
                    elseif($client->region == 'region_13')
                        echo 'Region 13';
                    elseif($client->region == 'barmm')
                        echo 'BARMM';
                ?>
            </span>
        </td>
        <td >
            <small>Province</small><br>
            &nbsp;&nbsp;<span class="text-yellow">
                <?php
                    if($province = \App\Province::find($client->province_id)->description)
                        echo $province;
                    else
                        echo $client->province_id;
                ?>
            </span>
        </td>
    </tr>
    <tr>
        <td>
            <small>Municipality</small><br>
            &nbsp;&nbsp;<span class="text-yellow">
                <?php
                    if($municipality = \App\Muncity::find($client->municipality_id)->description)
                        echo $municipality;
                    else
                        echo $client->municipality_id;
                ?>
            </span>
        </td>
        <td >
            <small>Barangay</small><br>
            &nbsp;&nbsp;<span class="text-yellow">
                {{ \App\Barangay::find($client->barangay_id)->description }}
                <?php
                    if($barangay = \App\Barangay::find($client->barangay_id)->description)
                        echo $barangay;
                    else
                        echo $client->barangay_id;
                ?>
            </span>
        </td>
        <td >
            <small>Sitio</small><br>
            &nbsp;&nbsp;<span class="text-yellow">{{ $client->sitio }}</span>
        </td>
    </tr>
    <tr>
        <td>
            <small>Contact Number</small><br>
            &nbsp;&nbsp;<span class="text-yellow">{{ $client->contact_number }}</span>
        </td>
    </tr>
</table>
<span class="text-blue" style="font-size: 12pt;">Reason for Calling {{ "- ".ucfirst($client->reason_calling) }}</span><br>
@if($client->reason_calling == 'inquiry' || $client->reason_calling == 'others')
<table class="table table-hover table-bordered" style="width: 100%;">
    <tr>
        <td>
            <small>Notes</small><br>
            &nbsp;&nbsp;<span class="text-yellow" >{{ $client->reason_notes }}</span>
        </td>
    </tr>
    <tr>
        <td>
            <small>Notes for action taken</small><br>
            &nbsp;&nbsp;<span class="text-yellow">{!! $client->reason_action_taken !!}</span>
        </td>
    </tr>
</table>
@elseif($client->reason_calling == 'referral')
<table class="table table-hover table-bordered" style="width: 100%;">
    <tr>
        <td width="100%">
            <div class="row">
                <div class="col-md-4">
                    <small>Patient Data(Name,Age,Gender)</small><br>
                    &nbsp;&nbsp;<span class="text-yellow" >{{ $client->reason_patient_data }}</span>
                </div>
                <div class="col-md-4">
                    <small>Chief Complaints</small><br>
                    &nbsp;&nbsp;<span class="text-yellow">{{ $client->reason_chief_complains }}</span>
                </div>
                <div class="col-md-4">
                    <small style="font-size: 9pt;">Relationship to patient (Patient, Family & Others)</small><br>
                    &nbsp;&nbsp;<span class="text-yellow">{{ $client->relationship }}</span>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td width="25%" colspan="3">
            <small>Notes for action taken</small><br>
            &nbsp;&nbsp;<span class="text-yellow">{{ $client->reason_action_taken }}</span>
        </td>
    </tr>
</table>
@endif
<span class="text-blue" style="font-size: 12pt;">Status of transaction</span><br>
@if($client->transaction_complete)
<table class="table table-hover table-bordered" style="width: 100%;">
    <tr>
        <td >
            <small>Complete</small><br>
            &nbsp;&nbsp;<span class="text-yellow" >
                <?php
                    if($client->transaction_complete == 'concern_address')
                        echo 'Concern Address';
                    elseif($client->transaction_complete == 'need_provide')
                        echo 'Need Provided';
                    elseif($client->transaction_complete == 'complete_call')
                        echo 'Completed Call';
                ?>
            </span>
        </td>
        <td >
            <small>Time Ended</small><br>
            &nbsp;&nbsp;<span class="text-yellow" >
                {{ date('F d, Y H:i:s',strtotime($client->time_ended)) }}
            </span>
        </td>
        <td >
            <small>Time Duration</small><br>
            &nbsp;&nbsp;<span class="text-yellow" >
                {{ date('H:i:s',strtotime($client->time_duration)) }}
            </span>
        </td>
    </tr>
</table>
@elseif($client->transaction_incomplete)
    <table class="table table-hover table-bordered" style="width: 100%;">
        <tr>
            <td >
                <small>In Complete</small><br>
                &nbsp;&nbsp;<span class="text-yellow" >
                    <?php
                        if($client->transaction_incomplete == 'drop_call')
                            echo 'Dropped Calls';
                        elseif($client->transaction_incomplete == 'hung_up')
                            echo 'Hung up';
                        elseif($client->transaction_incomplete == 'prank_call')
                            echo 'Prank Calls';
                        else
                            echo $client->transaction_incomplete;
                    ?>
                </span>
            </td>
            <td >
                <small>Time Ended</small><br>
                &nbsp;&nbsp;<span class="text-yellow" >
                {{ date('F d, Y H:i:s',strtotime($client->time_ended)) }}
            </span>
            </td>
            <td >
                <small>Time Duration</small><br>
                &nbsp;&nbsp;<span class="text-yellow" >
                {{ date('H:i:s',strtotime($client->time_duration)) }}
            </span>
            </td>
        </tr>
    </table>
@endif

<span class="text-blue" style="font-size: 12pt;">Addendum</span><br>
<?php $client_addendum = \App\ClientAddendum::where("client_id",$client->id)->get(); ?>
@foreach($client_addendum as $addendum)
    <small>Notes</small><br>
    &nbsp;&nbsp;<span class="text-yellow" >
        {!! nl2br($addendum->notes) !!}
    </span><br>
@endforeach
<form action="{{ asset('opcen/client/addendum/post') }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="reference_number" value="{{ $client->reference_number }}">
    <input type="hidden" name="client_id" value="{{ $client->id }}">
    <div class="addendum_body"></div><br>
    <button type="button" class="btn btn-primary" onclick="addAddendum()"><i class="fa fa-plus"></i> Add Notes</button>
    <button type="submit" class="btn btn-success hide" id="addendum_button"><i class="fa fa-send"></i> Submit</button>
    <button class="btn btn-default pull-right" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
</form>

<script>
    function addAddendum(){
        $("#addendum_button").removeClass('hide');
        var url = "<?php echo asset('opcen/client/addendum/body'); ?>";
        $.get(url,function(result){
            $(".addendum_body").append(result).hide().fadeIn();
        });
    }
</script>