<?php
use App\Models\Incident_type;
$type = Incident_type::all();

$user = Auth::user();
?>
    <style>
        .trackFontSize{
            font-size: 8pt;
        }
    </style>
    <table class="table table-hover table-form table-striped">
            <tr>
            <input type="hidden" name="referred_from" value="@if(isset($referred_from)) {{$referred_from}} @endif" class="form-submit">
            <input type="hidden" name="referred_to" value="{{$user->facility_id}}" class="form-submit">
                <input type = "hidden" value="{{@$data->id}}" name="id">
                <td class="col-sm-3"><label>Type of Incident</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                <select name="type_id" class="chosen-select form-control" style="width: 100%;" required>
                    <option value="0">Select a type</option>
                    @foreach ($type as $ty)
                    <option {{ (@$data->type_id == $ty->id ? 'selected' : '') }} value="{{ $ty->id }}"> {{ $ty->type }}</option>
                    @endforeach
                </select> 
                </td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Reason of Incident</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                <textarea name="reason" style="width: 100%; height: 100px" class="form-control" required>@if(isset($data->reason)){{$data->reason}}@endif</textarea>    
                </td>
            </tr>

    </table>

    <div class="modal-footer">
        <button type="button" class="btn btn-default btn-cancel" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" class="btn btn-success btn-submit"><i class="fa fa-send"></i> Submit</button>
    </div>
