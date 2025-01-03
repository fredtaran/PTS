<?php
    $user = Session::get('auth');
    $myfacility = \App\Facility::find($user->facility_id);
    $facilities = \App\Facility::select('id','name')
        ->where('id','!=',$user->facility_id)
        ->where('status',1)
        ->where('referral_used','yes')
        ->orderBy('name','asc')->get();

        echo $id;
?>
<div class="modal fade" role="dialog" id="pregnantFormModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form method="POST" class="form-submit pregnant_form">
            <div class="jim-content">
                @include('include.header_form')
                <div class="title-form">BEmONC/ CEmONC REFERRAL FORM</div>
                <div class="form-group-sm form-inline">
                {{ csrf_field() }}
                    <input type="hidden" name="patient_id" class="patient_id" value="" />
                    <input type="hidden" name="date_referred" class="date_referred" value="{{ date('Y-m-d H:i:s') }}" />
                    <input type="hidden" name="code" value="" />
                    <input type="hidden" name="source" value="{{ $source }}" />
                    <input type="hidden" class="referring_name" value="{{ $myfacility->name }}" />
                    <table class="table table-striped">
                        <tr>
                            <th colspan="4">REFERRAL RECORD</th>
                        </tr>
                        <tr>
                            <td>Who is Referring: </td>
                            <td>Record Number: <input type="text" class="form-control" name="record_no" placeholder="" /></td>
                            <td>Referred Date: <span class="text-success">{{ date('l M d, Y') }}</span> </td>
                            <td>Time: <span class="text-success">{{ date('h:i A') }}</span> </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                Name of referring MD/HCW: <span class="text-success">Name Dr. {{ $user->fname }} {{ $user->mname }} {{ $user->lname }}</span>
                            </td>
                            <td>Arrival Date</td>
                            <td>Time</td>
                        </tr>
                        <tr>
                            <td colspan="4">Referring Facility: <span class="text-success">{{ $myfacility->name }}</span> </td>
                        </tr>
                        <tr>
                            <td colspan="4">Accompanied by the Health Worker: <input type="text" class="form-control" name="health_worker" style="width: 50%;" placeholder="Name of Health Worker"/> </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="row">
                                    <div class="col-md-2">
                                        Referred to:
                                    </div>
                                    <div class="col-md-6">
                                        <select name="referred_facility" class="form-control-select select2 select_facility" style="width: 100%" required>
                                            <option value="">Select Facility...</option>
                                            @foreach($facilities as $row)
                                                <option data-name="{{ $row->name }}" value="{{ $row->id }}">{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="referred_department" class="form-control select_department select_department_pregnant" required>
                                            <option value="">Select Department...</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="row">
                                    <div class="col-md-2">
                                        Address:
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-primary facility_address"></span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-md-4">
                            <small >Covid Number</small><br>
                            <input type="text" name="covid_number" style="width: 100%;">
                        </div>
                        <div class="col-md-4">
                            <small >Clinical Status</small><br>
                            <select name="clinical_status" id="" class="form-control-select" style="width: 100%;">
                                <option value="">Select option</option>
                                <option value="asymptomatic">Asymptomatic</option>
                                <option value="mild">Mild</option>
                                <option value="moderate">Moderate</option>
                                <option value="severe">Severe</option>
                                <option value="critical">Critical</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <small >Surveillance Category</small><br>
                            <select name="sur_category" id="" class="form-control-select" style="width: 100%;">
                                <option value="">Select option</option>
                                <option value="contact_pum">Contact (PUM)</option>
                                <option value="suspect">Suspect</option>
                                <option value="probable">Probable</option>
                                <option value="confirmed">Confirmed</option>
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="row">

                        <div class="col-sm-6">
                            <table class="table bg-warning">
                                <tr class="bg-gray">
                                    <th colspan="4">WOMAN</th>
                                </tr>
                                <tr>
                                    <td colspan="3">Name: <span class="text-danger patient_name"></span></td>
                                    <td>Age: <span class="text-danger patient_age"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Address: <span class="text-danger patient_address"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        Main Reason for Referral
                                        <label><input type="radio" name="woman_reason" value="None" checked /> None </label>
                                        <label><input type="radio" name="woman_reason" value="Emergency" /> Emergency </label>
                                        <label><input type="radio" name="woman_reason" value="Non-Emergency" /> Non-Emergency </label>
                                        <label><input type="radio" name="woman_reason" value="To accompany the baby" /> To accompany the baby </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Major Findings (Clinical and BP,Temp,Lab)
                                        <br />
                                        <textarea class="form-control" id="woman_major_findings" name="woman_major_findings" style="resize: none;width: 100%" rows="5" required></textarea>
                                    </td>
                                </tr>
                                <tr class="bg-gray">
                                    <td colspan="4">Treatments Give Time</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Before Referral
                                        <br />
                                        <input type="text" class="form-control" name="woman_before_treatment" placeholder="Treatment Given" />
                                        <input type="text" class="form-control form_datetime" name="woman_before_given_time" placeholder="Date/Time Given" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">During Transport
                                        <br />
                                        <input type="text" class="form-control" name="woman_during_treatment" placeholder="Treatment Given" />
                                        <input type="text" class="form-control form_datetime" name="woman_during_given_time" placeholder="Date/Time Given" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Information Given to the Woman and Companion About the Reason for Referral
                                        <br />
                                        <textarea class="form-control woman_information_given" name="woman_information_given" style="resize: none;width: 100%" rows="5" required></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-sm-6">
                            <table class="table bg-warning">
                                <tr class="bg-gray">
                                    <th colspan="4">BABY</th>
                                </tr>
                                <tr>
                                    <td colspan="2">Name :<br />
                                        <input type="text" class="form-control" style="width: 100%" name="baby_fname" placeholder="First Name" /><br />
                                        <input type="text" class="form-control" style="width: 100%" name="baby_mname" placeholder="Middle Name" /><br />
                                        <input type="text" class="form-control" style="width: 100%" name="baby_lname" placeholder="Last Name" />
                                    </td>
                                    <td style="vertical-align: top !important;">Date and Hour of Birth:
                                        <br />
                                        <input type="text" class="form-control  form_datetime" style="width: 100%" name="baby_dob" placeholder="Date/Time" /><br />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Birth Weight: <input type="text" class="form-control" style="width: 100%" name="baby_weight" placeholder="kg or lbs" /><br /></td>
                                    <td>Gestational Age: <input type="text" class="form-control" style="width: 100%" name="baby_gestational_age" placeholder="age" /><br /></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        Main Reason for Referral
                                        <label><input type="radio" name="baby_reason" value="None" checked /> None </label>
                                        <label><input type="radio" name="baby_reason" value="Emergency" /> Emergency </label>
                                        <label><input type="radio" name="baby_reason" value="Non-Emergency" /> Non-Emergency </label>
                                        <label><input type="radio" name="baby_reason" value="To accompany the mother" /> To accompany the mother </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Major Findings (Clinica and BP,Temp,Lab)
                                        <br />
                                        <textarea class="form-control" name="baby_major_findings" style="resize: none;width: 100%" rows="5"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Last (Breast) Feed (Time): <input type="text" class="form-control form_datetime" style="width: 100%" name="baby_last_feed" placeholder="Date/Time" /><br /></td>
                                </tr>
                                <tr class="bg-gray">
                                    <td colspan="4">Treatments Give Time</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Before Referral
                                        <br />
                                        <input type="text" class="form-control" name="baby_before_treatment" placeholder="Treatment Given" />
                                        <input type="text" class="form-control form_datetime" name="baby_before_given_time" placeholder="Date/Time Given" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">During Transport
                                        <br />
                                        <input type="text" class="form-control" name="baby_during_treatment" placeholder="Treatment Given" />
                                        <input type="text" class="form-control form_datetime" name="baby_during_given_time" placeholder="Date/Time Given" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Information Given to the Woman and Companion About the Reason for Referral
                                        <br />
                                        <textarea class="form-control" name="baby_information_given" style="resize: none;width: 100%" rows="5"></textarea>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <table class="table table-striped col-sm-6"></table>
                <hr />
                <div class="form-fotter pull-right">
                    <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Back</button>
                    <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-send"></i> Send</button>
                </div>
                <div class="clearfix"></div>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->