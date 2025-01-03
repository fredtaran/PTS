<?php
$user = Session::get('auth');
$facilities = \App\Facility::select('id','name')
    ->where('id','!=',$user->facility_id)
    ->where('status',1)
    ->where('referral_used','yes')
    ->orderBy('name','asc')->get();
$myfacility = \App\Facility::find($user->facility_id);
$facility_address = \App\Http\Controllers\LocationCtrl::facilityAddress($myfacility->id);
$departments = \App\Http\Controllers\LocationCtrl::getDepartmentByFacility($myfacility->id);
?>
<div class="modal fade" role="dialog" id="normalFormModalWalkIn">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ url('doctor/patient') }}" method="POST" class="form-submit normal_form_walkin">
                <div class="jim-content">
                    <div class="title-form">CENTER OF HEALTH DEVELOPMENT SOCCSKSARGEN REGION REFERRAL SYSTEM<br /><small>Clinical Referral Form</small></div>
                    <div class="form-group-sm form-inline">
                        {{ csrf_field() }}
                        <input type="hidden" name="patient_id" class="patient_id" value="" />
                        <input type="hidden" name="date_referred" class="date_referred" value="{{ date('Y-m-d H:i:s') }}" />
                        <input type="hidden" name="code" value="" />
                        <input type="hidden" name="source" value="{{ $source }}" />
                        <input type="hidden" class="referring_name" value="" />
                        <table class="table table-striped">
                            <tr>
                                <td colspan="6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            Name of Referring Facility:
                                        </div>
                                        <div class="col-md-9">
                                            <select name="referring_facility_walkin" class="form-control-select select2 select_facility_walkin" style="width: 100%;" required>
                                                <option value="">Select Facility...</option>
                                                @foreach($facilities as $row)
                                                    <option data-name="{{ $row->name }}" value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            Address:
                                        </div>
                                        <div class="col-md-9">
                                            <span class="text-primary facility_address"></span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    Referred to:
                                    <span class="text-success">{{ $myfacility->name }}</span>
                                </td>
                                <td colspan="3">
                                    Department: <select name="referred_department" class="form-control-select select_department select_department_normal" style="padding: 3px" required>
                                        <option value="">Select Department...</option>
                                        @foreach($departments as $d)
                                            <option value="{{ $d->id }}">{{ $d->description }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">Address: <span class="text-success">{{ $facility_address['address'] }}</span></td>
                            </tr>
                            <tr>
                                <td colspan="3">Date/Time Referred (ReCo): <span class="text-success">{{ date('l F d, Y h:i A') }}</span> </td>
                                <td colspan="3">Date/Time Transferred: </td>
                            </tr>
                            <tr>
                                <td colspan="3">Name of Patient: <span class="text-danger patient_name"></span></td>
                                <td>Age: <span class="text-danger patient_age"></span></td>
                                <td>Sex:
                                    <select name="patient_sex" class="patient_sex form-control-select" style="padding: 3px" required>
                                        <option value="">Select...</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select></td>
                                <td>Status:
                                    <select name="civil_status" class="civil_status form-control-select" style="padding: 3px" required>
                                        <option value="">Select...</option>
                                        <option>Single</option>
                                        <option>Married</option>
                                        <option>Divorced</option>
                                        <option>Separated</option>
                                        <option>Widowed</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">Address: <span class="text-danger patient_address"></span></td>
                            </tr>
                            <tr>
                                <td colspan="3">PhilHealth status:
                                    <label>None <input type="radio" name="phic_status" value="None" checked></label>
                                    <label>Member <input type="radio" name="phic_status" value="Member"></label>
                                    <label>Dependent <input type="radio" name="phic_status" value="Dependent"></label>
                                </td>
                                <td colspan="3">PhilHealth #: <input type="text" class="text-danger form-control phic_id" name="phic_id" /> </td>
                            </tr>
                            <!--
                            <tr>
                                <td colspan="6">
                                    Diagnosis/Impression: <small class="text-primary">(Auto search from ICD10)</small>
                                    <input type="text" value="" id="icd_code_walkin" name="icd_code_walkin" readonly><br>
                                    <textarea class="form-control" onkeyup="Icd10Checker_walkin($(this))" id="diagnosis_walkin" rows="4" name="diagnosis" style="resize: none;width: 100%;margin-top: 1%" required></textarea>
                                    <br />
                                </td>
                            </tr>
                            -->
                            <tr>
                                <td colspan="6">
                                    Case Summary (pertinent Hx/PE, including meds, labs, course etc.):<br />
                                    <div class="row">
                                    <div class="col-md-6">
                                    <textarea class="form-control" id="case_summary" class="case_summary" name="case_summary[]" style="resize: none;width: 100%;" rows="7" >
                                    </textarea>
                                        </div>
                                        <div class="col-md-6">
                                    <textarea class="form-control" id="case_summary1" class="case_summary1" name="case_summary[]" style="resize: none;width: 100%;" rows="7" >
                                    </textarea>
                                        </div>
                                    </div>
                                </div>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td colspan="6">
                                    Summary of ReCo (pls. refer to ReCo Guide in Referring Patients Checklist):
                                    <br />
                                    <textarea class="form-control" name="reco_summary" style="resize: none;width: 100%;" rows="7" required></textarea>
                                </td>
                            </tr> -->
                            <tr>
                                <td colspan="6">
                                    <!-- Diagnosis/Impression:
                                    <br />
                                    <textarea class="form-control" rows="7" name="diagnosis" style="resize: none;width: 100%;margin-top: 1%" required></textarea> -->

                                    <span class="text-success">
                                    @if(Session::get('auth')->level == 'opcen')
                                        Chief Complaints
                                    @else
                                        Diagnosis/Impression:
                                    @endif
                                <br />
                                <?php
                                      $data = App\Diagnosis::where('void',0)
                                      ->orderby('id','asc')
                                      ->get();
                                 ?>                               
                                 <!-- <textarea list="diagnosis" class="form-control"  name="diagnosis" style="resize: none;width: 100%;margin-top: 1%" required></textarea> -->
                                <input list="diagnosis" name="diagnosis" class="form-control" rows="7" style="resize: none;width: 100%;margin-top: 1%;">
                                <datalist id = "diagnosis">
                                @foreach($data as $dataa)
                                        <option value="{{ $dataa->diagcode }} {{ $dataa->diagdesc}}"></option>
                                    @endforeach
                                </datalist>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    Reason for referral:
                                    <br />
                                    <textarea class="form-control reason_referral" name="reason" style="resize: none;width: 100%;" rows="7" required></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Preferred Doctor <br>
                                            <small class="text-success">MD/HCW- Mobile Contact # (ReCo):</small>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="referred_md" class="referred_md select2 form-control-select" style="width: 100%;">
                                                <option value="">Any...</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <hr />
                    <div class="form-fotter pull-right">
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Back</button>
                        <button type="submit" class="btn btn-success btn-flat btn-submit"><i class="fa fa-send"></i> Submit</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->