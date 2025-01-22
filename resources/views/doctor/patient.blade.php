<?php
    $user = Auth::user();
?>

@extends('layouts.app')

@section('content')
<style>
    .select2-hidden-accessible[required] {
        display: block;
        height: 0;
        border: 1px solid transparent;
        margin-bottom: -2px;
    }
    .ui-autocomplete
    {
        background-color: white;
        width: 20%;
        z-index: 1100;
        max-height: 300px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
    .ui-menu-item {
        cursor: pointer;
    }

    .modal-xl {
    width: 90%;
    margin: auto;
    }
    
    .pre_pregnancy_table td
    {
        width: 1%;
        text-align:center;
    }

    .pre_pregnancy_table th
    {
        text-align:center;
    }
    .sign_symthoms_table th
    {
        text-align:center;
    }
    .sign_symthoms_table td
    {
        text-align:center;
    }
    .sign_symthoms_table_box td
    {
        text-align:left;
    }

</style>

<div class="col-md-3">
    @include('sidebar.' . $sidebar)
</div>

<div class="col-md-9">
    <div class="jim-content">
        <h3 class="page-header">{{ $title }}</h3>
        @if(count($data))
        <div class="table-responsive">
            <table class="table table-striped"  style="white-space:nowrap;">
                <tbody>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age / DOB</th>
                    <th>Barangay</th>
                    <th style="width:5%;">Encoded Facility</th>
                    <th style="width:18%;">Action</th>
                </tr>

                @foreach($data as $row)
                <?php
                    $pregv2 = \App\Models\PregnantFormv2::where('patient_woman_id', $row->patient_id)->latest()->first();

                    $tracking = \App\Models\Tracking::where('code', @$pregv2->code)->latest()->first();
                    $activity = \App\Models\Activity::where('code', @$pregv2->code)->latest()->first();

                    $user = Auth::user();
                ?>
                <tr>
                    <td>
                        <b>
                            @if ($row->facility_id == $user->facility_id)
                            <a href="#patient_modal"
                                data-toggle="modal"
                                data-id = "{{ $row->patient_id }}"
                                click="PatientBody"
                                class="update_info">
                                {{ $row->lname }}, {{ $row->fname }} {{ $row->mname }}
                            </a>
                            @else
                            {{ $row->lname }}, {{ $row->fname }} {{ $row->mname }}
                            @endif
                            <br>
                            @if( $pregv2 && (!is_null($tracking) && $tracking->status != 'discharged' && $tracking->status != 'archived') )
                            <a href="{{ url('doctor/print/form/' . $tracking->id) }}" target="_blank" class="btn-refer-pregnant"> {{ $tracking->code }}</a>
                            @endif
                        </b>
                        <br>
                        <small class="text-success">{{ $row->contact }}</small>
                    </td>

                    <td>
                        {{ $row->sex }}<br>
                        <small class="text-success">{{ $row->civil_status }}</small>
                    </td>

                    <td>
                        <?php $age = \App\Http\Controllers\ParamCtrl::getAge($row->dob);?>
                        {{ $age }} years old
                        <br />
                        <small class="text-muted">{{ date('M d, Y', strtotime($row->dob)) }}</small>
                    </td>

                    <td>
                        @if($row->brgy != 0)
                        {{ $brgy = \App\Models\Barangay::find($row->brgy)->description }}<br />
                        <small class="text-success">{{ $city = \App\Models\Muncity::find($row->muncity)->description }}</small>
                        @else
                        {{ $row->address }}
                        @endif
                    </td>

                    <td>
                        {{ $row->facility_name }}
                    </td>

                    <td>
                        @if($row->sex == 'Female' && ($age >= 10 && $age <= 49))
                            @if(($activity != null && $activity->status != 'discharged' && $activity->referred_to == $user->facility_id))
                                <button class="btn btn-xs btn-success btn-action profile_info hide"
                                        title="Patient Return"
                                        data-toggle="modal"
                                        data-toggle="tooltip"
                                        data-target="#patientReturnModal"
                                        data-unique_id = "{{ $pregv2->unique_id }}"
                                        data-patient_id = "{{ $pregv2->patient_woman_id }}"
                                        data-code="{{ $pregv2->code}}">
                                        <i class="fas fa-plus"></i>
                                        Add1
                                </button>

                                <a href="#upload_modal"
                                    data-toggle="modal"
                                    data-code="{{ $pregv2->code}}"
                                    data-id = "{{ $row->id }}"
                                    class="btn btn-info btn-xs btn-edit hide upload_code">
                                    <i class="fa fa-file"></i>
                                    Upload
                                </a>
                            @elseif(($tracking != null && $activity == null))
                                @if ($tracking->referred_to == $user->facility_id)
                                    <a href="#pregnantFormModalTrack"
                                        data-patient_id = "{{ $row->patient_id }}"
                                        data-toggle="modal"
                                        class="btn btn-primary btn-xs profile_info btn_refer_preg hide">
                                        <i class="fa fa-stethoscope"></i>
                                        Refer
                                    </a>

                                    <button class="btn btn-xs btn-success btn-action profile_info hide"
                                        title="Patient Return"
                                        data-toggle="modal"
                                        data-toggle="tooltip"
                                        data-target="#patientReturnModal"
                                        data-unique_id = "{{ $pregv2->unique_id }}"
                                        data-patient_id = "{{ $pregv2->patient_woman_id }}"
                                        data-code="{{ $pregv2->code}}">
                                        <i class="fas fa-plus"></i>
                                        Add
                                    </button>

                                    <button class="btn btn-xs btn-warning hide btn-action discharge_button"
                                        title="Patient Discharged"
                                        data-toggle="modal"
                                        data-toggle="tooltip"
                                        data-target="#pregnantDisModal"
                                        data-track_id="{{ $tracking->id }}" 
                                        data-unique_id="{{ $pregv2->unique_id }}"
                                        data-patient_name="{{ $row->patient_name }}"
                                        data-code="{{ $pregv2->code}}">
                                        <i class="fab fa-accessible-icon">Discharge </i>
                                    </button>

                                    <a href="#upload_modal"
                                        data-toggle="modal"
                                        data-code="{{ $pregv2->code}}"
                                        data-id = "{{ $row->id }}"
                                        class="btn btn-info btn-xs btn-edit hide upload_code">
                                        <i class="fa fa-file"></i>
                                        Upload
                                    </a>
                                @else
                                    <button class="btn btn-xs btn-success btn-action profile_info hide"
                                        title="Patient Return"
                                        data-toggle="modal"
                                        data-toggle="tooltip"
                                        data-target="#patientReturnModal"
                                        data-unique_id = "{{ $pregv2->unique_id }}"
                                        data-patient_id = "{{ $pregv2->patient_woman_id }}"
                                        data-code="{{ $pregv2->code}}">
                                        <i class="fas fa-plus"></i>
                                        Add
                                    </button>
                                @endif
                            @elseif($tracking == null && $activity == null)
                                @if ($user->facility_id == $row->facility_id)
                                <a href="#pregnantFormModalTrack"
                                    data-patient_id = "{{ $row->patient_id }}"
                                    data-toggle="modal"
                                    class="btn btn-primary btn-xs profile_info btn_refer_preg hide">
                                    <i class="fa fa-stethoscope"></i>
                                    Refer
                                </a>
                                @endif

                                <a href="#pregnantAddData"
                                    data-patient_id = "{{ $row->patient_id }}"
                                    data-toggle="modal"
                                    class="btn btn-success btn-xs profile_info hide">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </a>
                            @elseif ( $tracking->status == 'discharged' || $tracking->status == 'archived' )
                                <a href="#pregnantFormModalTrack"
                                data-patient_id = "{{ $row->patient_id }}"
                                data-toggle="modal"
                                class="btn btn-primary btn-xs profile_info btn_refer_preg hide">
                                    <i class="fa fa-stethoscope"></i>
                                    Refer
                                </a>

                                <a href="#pregnantAddData"
                                data-patient_id = "{{ $row->patient_id }}"
                                data-toggle="modal"
                                class="btn btn-success btn-xs profile_info hide">
                                <i class="fa fa-plus"></i>
                                    Add
                                </a>
                            @endif
                        @else
                            <a href="#normalFormModal"
                                data-patient_id = "{{ $row->patient_id }}"
                                data-backdrop="static"
                                data-toggle="modal"
                                class="btn btn-primary btn-xs profile_info btn_refer_preg hide">
                                <i class="fa fa-stethoscope"></i>
                                Refer5
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <ul class="pagination pagination-sm no-margin pull-right">
                {{ $data->links() }}
        </ul>
        @else
        <div class="alert alert-warning">
            <span class="text-warning">
                <i class="fa fa-warning"></i> Patient not found!
            </span>
        </div>
        @endif
        <div class="clearfix"></div>
    </div>
</div>
@include('modal.pregnantModal')
@include('modal.pregnant_modal_track')
@include('modal.normal_form_editable')
@endsection

@section('js')

@include('script.filterMuncity')
@include('script.datetime')
@include('script.patient_script')
@include('script.pregnant_modal')
@endsection

