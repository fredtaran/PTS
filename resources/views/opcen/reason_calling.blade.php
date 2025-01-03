@if($reason == 'inquiry' || $reason == 'others')
<table class="table table-hover table-bordered">
    @if(@Session::get("client")->reason_notes)
        <tr>
            <td >
                <small>Notes - <b class="text-green"><i>(Previous)</i></b></small>
                <textarea cols="30" rows="5" class="form-control" disabled>{{ Session::get("client")->reason_notes }}</textarea>
            </td>
        </tr>
    @endif
    <tr>
        <td >
            <small>Notes</small>
            <textarea name="reason_notes" id="" cols="30" rows="5" class="form-control"></textarea>
        </td>
    </tr>
    @if(@Session::get("client")->reason_action_taken)
        <tr>
            <td >
                <small>Notes for action taken - <b class="text-green"><i>(Previous)</i></b></small>
                <textarea cols="30" rows="5" class="form-control" disabled>{{ Session::get("client")->reason_action_taken }}</textarea>
            </td>
        </tr>
    @endif
    <tr>
        <td >
            <small>Notes for action taken</small>
            <textarea name="reason_action_taken" id="" cols="30" rows="5" class="form-control"></textarea>
        </td>
    </tr>
</table>
@else
    <table class="table table-hover table-bordered" style="width: 100%">
        <tr>
            <td width="34%">
                @if(@Session::get("client")->reason_patient_data)
                    <small>Patient Data(Name,Age,Gender) - <b class="text-green"><i>(Previous)</i></b></small>
                    <textarea cols="30" rows="5" class="form-control" disabled>{{ Session::get("client")->reason_patient_data }}</textarea>
                @endif
                <small>Patient Data(Name,Age,Gender)</small>
                <textarea name="reason_patient_data" id="" cols="30" rows="5" class="form-control"></textarea>
            </td>
            <td width="34%">
                @if(@Session::get("client")->reason_chief_complains)
                    <small>Chief Complains - <b class="text-green"><i>(Previous)</i></b></small>
                    <textarea cols="30" rows="5" class="form-control" disabled>{{ Session::get("client")->reason_chief_complains }}</textarea>
                @endif
                <small>Chief Complaints</small>
                <textarea name="reason_chief_complains" id="" cols="30" rows="5" class="form-control"></textarea>
            </td>
            <td width="34%">
            @if(@Session::get("client")->relationship)
                <small style="font-size: 8pt;">Relationship to patient (Patient, Family & Others) - <b class="text-green"><i>(Previous)</i></b></small>
                <textarea cols="30" rows="5" class="form-control" disabled>{{ Session::get("client")->relationship }}</textarea>
            @endif
                <small>Relationship to patient (Patient, Family & Others)</small>
                <textarea name="relationship" id="" cols="30" rows="5" class="form-control"></textarea>
            </td>
        </tr>
        @if(@Session::get("client")->reason_action_taken)
            <tr>
                <td colspan="3">
                    <small>Notes for action taken - <b class="text-green"><i>(Previous)</i></b></small>
                    <textarea cols="30" rows="5" class="form-control" disabled>{{ Session::get("client")->reason_action_taken }}</textarea>
                </td>
            </tr>
        @endif
        <tr>
            <td colspan="3">
                <small>Notes for action taken</small>
                <textarea name="reason_action_taken" id="" cols="30" rows="5" class="form-control"></textarea>
            </td>
        </tr>
    </table>
@endif