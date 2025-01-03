<?php
$user = Auth::user();
$status = Session::get('status');
?>
@extends('layouts.app')

@section('content')
    <style>
        /* .table-input tr td:first-child {
            text-align: right;
            vertical-align: middle;
            font-weight: bold;
            padding: 3px;
            width:30%;
        } */
        .table-input tr td {
            border:1px solid #bbb !important;
        }
        .table-input th {
            border:1px solid #bbb !important;
        }
        label {
            padding: 0px !important;
        }
    </style>

    <div class="col-md-9">
        <div class="jim-content">
            <h3 class="page-header">{{ $title }}</h3>

            <div class="row">
                <div class="col-md-12">
                    @if($status == 'added')
                    <div class="alert alert-success">
                        <span class="text-success">
                            <i class="fa fa-check"></i> Added Successfully!
                        </span>
                    </div>
                    @endif

                    <form method="POST" class="form-horizontal form-submit" id="form-submit" action="{{ asset('doctor/patient/' . $method) }}">
                        {{ csrf_field() }}
                        <table class="table table-input table-bordered table-hover" border="1">
                            <tr class="has-group">
                                <td>PhilHealth Status :</td>
                                <td>
                                    <select class="form-control select_phic" name="phic_status" required>
                                        <option>None</option>
                                        <option>Member</option>
                                        <option>Dependent</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>PhilHealth ID :<br/> <small class="text-info"><em>(If applicable)</em></small></td>
                                <td><input type="text" name="phicID" class="phicID form-control" disabled value="" /></td>
                            </tr>

                            <tr class="has-group">
                                <td>First Name :</td>
                                <td><input type="text" name="fname" class="fname form-control" required /> </td>
                            </tr>

                            <tr>
                                <td>Middle Name :</td>
                                <td><input type="text" name="mname" class="mname form-control"/> </td>
                            </tr>

                            <tr class="has-group">
                                <td>Last Name :</td>
                                <td><input type="text" name="lname" class="lname form-control" required /> </td>
                            </tr>

                            <tr class="has-group">
                                <td>Contact Number :</td>
                                <td><input type="text" name="contact" class="contact form-control" required /> </td>
                            </tr>
                            
                            <tr class="has-group">
                                <td>Birth Date :</td>
                                <td><input type="text" placeholder="mm/dd/yyyy" name="dob" id="dob" class="form-control dob" required /> </td>
                            </tr>

                            <tr>
                                <td>Sex :</td>
                                <td class="has-group">
                                    <!-- <label style="cursor: pointer;"><input type="radio" name="sex" class="sex" value="Male" required style="display:inline;"> Male</label>
                                    &nbsp;&nbsp;&nbsp;<br /> -->
                                    <label style="cursor: pointer;"><input type="radio" name="sex" class="sex" value="Female" checked="checked"  required> Female</label>
                                    <span class="span"></span>
                                </td>
                            </tr>

                            <tr class="has-group">
                                <td>Civil Status :</td>
                                <td>
                                    <select name="civil_status" class="form-control" required id="civil_status" style="width: 100%">
                                        <option>Single</option>
                                        <option>Married</option>
                                        <option>Divorced</option>
                                        <option>Separated</option>
                                        <option>Widowed</option>
                                    </select>
                                </td>
                            </tr>

                            <tr class="has-group">
                                <td>Province :</td>
                                <td>
                                    <select class="form-control province filter_province select2" name="province" required>
                                        <option value="">Province...</option>
                                        @foreach($province as $p)
                                            <option value="{{ $p->id }}">{{ $p->description }}</option>
                                        @endforeach
                                        <option value="others">Others</option>
                                    </select>
                                </td>
                            </tr>

                            <tr class="has-group">
                                <td>Municipality/City :</td>
                                <td>
                                    <select class="form-control muncity filter_muncity select2" name="muncity" required>
                                        <option value="">Select Municipal/City...</option>
                                    </select>
                                </td>
                            </tr>

                            <tr class="has-group barangay_holder">
                                <td>Barangay :</td>
                                <td>
                                    <select class="form-control barangay select2" name="brgy" required>
                                        <option value="">Select Barangay...</option>
                                    </select>
                                </td>
                            </tr>

                            <tr class="has-group others_holder hide">
                                <td>Complete Address :</td>
                                <td>
                                    <input type="text" name="others" class="form-control others" placeholder="Enter complete address..." />
                                </td>
                            </tr>

                            <tr>
                                <td>Patient Consent :</td>
                                <td class="has-group">
                                    <label style="cursor: pointer;"><input type="radio" name="consent" class="consent" value="Yes" required style="display:inline;"> <b>Yes</b>, I give my consent to transmit my health data to the E-Referral.</label>
                                    &nbsp;&nbsp;&nbsp;<br />
                                    <label style="cursor: pointer;"><input type="radio" name="consent" class="consent" value="No" required> <b>No</b>, I don’t give my consent to transmit my health data to the E-Referral.</label>
                                    <span class="span"></span><br>
                                    <a href="{{ asset('doctor/print/consent') }}" target="_blank">[Click here to view the Patient Consent Form] </a>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <a href="{{ asset('doctor/patient') }}" class="btn btn-sm btn-default">
                                        <i class="fa fa-arrow-left"></i> Back
                                    </a>
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-send"></i> Submit
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </div>

    <div class="col-md-3">
        @include('sidebar.quick')
    </div>
    @include('modal.patientConsent')
@endsection

@section('js')
@include('script.filterMuncity')
<script>
    $(document).ready(function() {
        $(".dob").inputmask("mm/dd/yyyy");
        $(".date_dose").inputmask("mm/dd/yyyy");

        $(".select2").select2({ width: '100%' });
        $('.select_phic').on('change', function() {
            var status = $(this).val();
            if(status != 'None') {
                $('.phicID').attr('disabled',false);
            } else {
                $('.phicID').val('').attr('disabled',true);
            }
        });
    })
</script>
@endsection

