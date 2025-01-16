<div class="modal fade" role="dialog" id="arriveModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4>PATIENT ARRIVED</h4>

                <hr />

                <form method="post" id="arriveForm">
                    {{ csrf_field() }}
                    <div class="form-group-lg">
                        <div class="text-center text-bold text-success">
                            <small class="text-muted">Date/Time Arrived:</small><br />
                            {{ date('M d, Y h:i A') }}
                        </div>
                    </div>

                    <hr />

                    <div class="form-group-lg">
                        <label style="padding: 0px;">Remarks: </label>
                        <br />
                        <textarea name="remarks" class="remarks form-control" rows="5" style="resize: none"></textarea>
                    </div>

                    <hr />

                    <div class="form-fotter pull-right">
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </form>

                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" role="dialog" id="DoAModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4>DEAD ON ARRIVAL</h4>

                <hr />

                <form method="post" id="deadForm">
                    {{ csrf_field() }}
                    <div class="form-group-lg">
                        <div class="text-center text-bold text-success">
                            <small class="text-muted">Date/Time Dead on Arrival:</small><br />
                            {{ date('M d, Y h:i A') }}
                        </div>
                    </div>

                    <hr />

                    <div class="form-group-lg">
                        <label style="padding: 0px;">Remarks: </label>
                        <br />
                        <textarea name="remarks" class="remarks form-control" rows="5" style="resize: none"></textarea>
                    </div>

                    <hr />
                    
                    <div class="form-fotter pull-right">
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </form>

                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="archiveModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4>PATIENT DIDN'T ARRIVED</h4>

                <hr />

                <form method="post" id="archiveForm">
                    {{ csrf_field() }}
                    <div class="form-group-lg">
                        <label style="padding: 0px;">Remarks: </label>
                        <br />
                        <textarea name="remarks" class="remarks form-control" rows="5" style="resize: none"></textarea>
                    </div>

                    <hr />

                    <div class="form-fotter pull-right">
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </form>

                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="admitModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4>ADMIT PATIENT</h4>
                
                <hr />

                <form method="post" id="admitForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label style="padding: 0px">Select Date/Time:</label>
                        <br />
                        <input type="text" value="{{ date('Y-m-d h:i:s A') }}" class="form-control form_datetime" name="date_time" placeholder="Date/Time Admitted" />
                    </div>

                    <hr />

                    <div class="form-fotter pull-right">
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </form>

                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" role="dialog" id="MonOPDModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4>PATIENT MONITORED AS OPD</h4>

                <hr />

                <form method="post" id="MonOPDForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label style="padding: 0px">Select Date/Time:</label>
                        <br />
                        <input type="text" value="{{ date('Y-m-d h:i:s A') }}" class="form-control form_datetime" name="date_time" placeholder="Date/Time Admitted" />
                    </div>

                    <hr />

                    <div class="form-fotter pull-right">
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </form>

                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="dischargeModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4>DISCHARGE PATIENT</h4>

                <hr />

                <form method="post" id="dischargeForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label style="padding: 0px">Select Date/Time:</label>
                        <br />
                        <input type="text" value="{{ date('Y-m-d h:i:s A') }}" class="form-control form_datetime" name="date_time" placeholder="Date/Time Admitted" />
                    </div>

                    <div class="form-group">
                        <label style="padding: 0px">Clinical Status</label>
                        <br />
                        <select name="clinical_status" id="" class="form-control" >
                            <option value="">Select option</option>
                            <option value="asymptomatic">Asymptomatic for at least 3 days</option>
                            <option value="recovered">Recovered</option>
                            <option value="expired">Expired</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="padding: 0px">Surveillance Category</label>
                        <br />
                        <select name="sur_category" id="" class="form-control" >
                            <option value="">Select option</option>
                            <option value="contact_pum">Contact (PUM)</option>
                            <option value="suspect">Suspect</option>
                            <option value="probable">Probable</option>
                            <option value="confirmed">Confirmed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="padding: 0px">Enter Remarks:</label>
                        <br />
                        <textarea name="remarks" class="remarks form-control" rows="5" style="resize: none" required></textarea>
                    </div>

                    <hr />

                    <div class="form-fotter pull-right">
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </form>

                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="pregnantDisModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="jim-content">
                <h4>DISCHARGE PATIENT</h4>

                <hr />

                <form method="post" id="dischargeForm2"> 
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label style="padding: 0px">Select Date/Time:</label>
                        <br />
                        <input type="text" value="{{ date('Y-m-d h:i:s A') }}" class="form-control form_datetime" name="date_time" placeholder="Date/Time Admitted" />
                    </div>

                    <div class="form-group">
                        <label style="padding: 0px">Delivery Outcome: </label>
                        <br />
                        <select name="delivery_outcome" class="form-control select2" required>
                            <option value="">Select Outcome...</option>
                            <option value="fullterm">Fullterm</option>
                            <option value="preterm">Preterm</option>
                            <option value="stillbirth">Stillbirth</option>
                            <option value="abortion">Abortion</option>
                        </select> 
                    </div>

                    <div class="form-group">
                        <label style="padding: 0px">Birth Attendant: </label>
                        <br />
                        <select name="birth_attendant" class="form-control select2" required>
                            <option value="">Select Attendant...</option>
                            <option value="md">MD</option>
                            <option value="rn">RN</option>
                            <option value="rm">RM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="padding: 0px">Status on Discharge:</label>
                        <br />
                        <select name="status_on_discharge" class="form-control select2" required>
                            <option value="">Select Status...</option>
                            <option value="expired">Expired</option>
                            <option value="improved">Improved</option>
                            <option value="hama">HAMA</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="padding: 0px">Type of Delivery: </label>
                        <br />
                        <select name="type_of_delivery" class="form-control select2" required>
                            <option value="">Select Delivery...</option>
                            <option value="nsvd">Normal Spontaneous Vaginal Delivery (NSVD)</option>
                            <option value="caesarean">Caesarean Section</option>
                            <option value="vinal_after_caesarean">Vaginal Birth After Caesarean</option>
                            <option value="assisted_vaginal_delivery">Assisted Vaginal Delivery</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <?php
                            $data = App\Models\Diagnosis::where('void', 0)
                                                ->orderby('id','asc')
                                                ->get();
                        ?>
                        <label> Final Diagnosis with ICD 10 code:</label> 
                            <select name="final_diagnosis[]" id="choices-multiple-remove-button" class="form-control" style="width: 100%" required multiple>
                                @foreach($data as $dataa)
                                    <option defaultValue="{{ $dataa->id }}">{{ $dataa->diagcode }} {{ $dataa->diagdesc}}</option>
                                @endforeach
                            </select>
                    </div>

                    <div class="form-group">
                        <label style="padding: 0px">Enter Discharged Instruction:</label>
                        <br />
                        <textarea name="discharge_instruction" class="discharge_instruction form-control" rows="5" style="resize: none" required></textarea>
                    </div>

                    <div class="form-group">
                        <label style="padding: 0px">Enter Discharged Diagnosis:</label>
                        <br />
                        <textarea name="discharge_diagnosis" class="discharge_diagnosis form-control" rows="5" style="resize: none" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label style="padding: 0px">Remarks: </label>
                        <br />
                        <textarea name="remarks" class="remarks form-control" rows="5" style="resize: none" required></textarea>
                    </div>

                    <hr />

                    <div class="form-fotter pull-right">
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </form>
                
                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="patientReturnModal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <form method="POST" class="form-submit" action="{{ url('doctor/patient/return/pregnant') }}" id="pregnant_form_return">
                <div class="jim-content">
                    @include('include.header_form')
                    <div class="title-form">Risk Assessment Check list for Pregnant Women</div>

                    {{ csrf_field() }}
                    <input type="hidden" name="patient_woman_id" class="patient_woman_id"/>
                    <input type="hidden" name="unique_id" class="unique_id"/>
                    <input type="hidden" name="code" class="code"/>
                    <!-- <input type="hidden" name="patient_id" class="patient_id" value="" />
                    <input type="hidden" name="date_referred" class="date_referred" value="{{ date('Y-m-d H:i:s') }}" />
                    <input type="hidden" name="code" value="" />
                    <input type="hidden" name="source" value="{{ @$source }}" />
                    <input type="hidden" name="referring_name" value="{{ @$myfacility->name }}" />
                    <input type="hidden" name="referring_facility" value="{{ @$myfacility->id }}" /> -->

                    <div class="row">
                        <h2>Patients Information</h2>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu2">Sign and Symptoms</a></li>
                            <!-- <li><a data-toggle="tab" href="#menu3">Lab Result</a></li> -->
                        </ul>
                        <div class="tab-content">

                            <div id="menu2" class="tab-pane fade in active">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#previous">New Data</a></li>
                                    <!-- <li><a data-toggle="tab" href="#current">Previous Data</a></li> -->
                                </ul>

                                <div class="tab-content">
                                    <div id="previous" class="tab-pane fade in active">
                                        <table class="table table-striped sign_symthoms_table">
                                            <tr class="bg-gray">
                                                <th rowspan="4" width="50%"> 
                                                    <br><br><br><br><br><h3>Risk Factor</h3>
                                                        (a CHECK to ATLEAST ONE of the boxex indicates REFERRAL to a higher facility) 
                                                </th>

                                                <th> 
                                                    <span> 
                                                        <select style="width:50px;" class="new_trimester" name="no_trimester" required readonly>
                                                        <option style="width:150px;" value="">...</option>
                                                        <option value="1st">1st</option>
                                                        <option value="2nd">2nd</option>
                                                        <option value="3rd">3rd</option>
                                                        </select> Trimester 
                                                    </span>
                                                </th>
                                            </tr>

                                            <tr class="bg-gray">
                                                <td> 
                                                    <span> 
                                                        <select style="width:50px;" name="no_visit" class="new_visit_no" required>
                                                        <option style="width:150px;" value="" selected>...</option>
                                                        <option value="1st" >1st</option>
                                                        <option value="2nd">2nd</option>
                                                        <option value="3rd">3rd</option>
                                                        <option value="4th">4th</option>
                                                        <option value="5th">5th</option>
                                                        </select> Visit 
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> 
                                                    <center>
                                                        <span> Date: <input  class="form-control new_date_of_visit"  type="text" name="date_of_visit">  <br>
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr class="bg-gray">
                                                <td>
                                                    <b>Remarks</b>
                                                </td>
                                            </tr>

                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="vaginal_spotting" name="vaginal_spotting" value="yes" stlye="float:left">Vaginal spotting or bleeding
                                                </td>

                                                <td rowspan="13">
                                                    <center>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <small class="text-info">Subjective</small><br>
                                                                <textarea class="form-control" name="sign_subjective" style="resize: none;width: 100%;"> </textarea>
                                                            </div>
                                                        </div>    

                                                        <div class="row">
                                                            <div class="col-md-4"></div>

                                                            <div class="col-md-4">
                                                                <small class="text-info">AOG</small><br>
                                                                <input type="text" class="form-control new_aog"  name="sign_aog" style="width: 100%;" readonly>
                                                            </div>

                                                            <div class="col-md-4"></div>
                                                        </div>    

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <small class="text-info">BP</small><br>
                                                                <input type="text" class="form-control bp_signsymptoms"  name="sign_bp" style="width: 100%;">
                                                                <small class="text-info">HR</small><br>
                                                                <input type="text" class="form-control hr_signsymptoms"  name="sign_hr" style="width: 100%;">
                                                                <small class="text-info">FH</small><br>
                                                                <input type="text" class="form-control fh_signsymptoms"  name="sign_fh" style="width: 100%;">
                                                            </div>

                                                            <div class="col-md-6">
                                                                <small class="text-info">TEMP</small><br>
                                                                <input type="text" class="form-control temp_signsymptoms"  name="sign_temp" style="width: 100%;">
                                                                <small class="text-info">RR</small><br>
                                                                <input type="text" class="form-control rr_signsymptoms"  name="sign_rr" style="width: 100%;">
                                                                <small class="text-info">FHT</small><br>
                                                                <input type="text" class="form-control fht_signsymptoms"  name="sign_fht" style="width: 100%;">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <small class="text-info">Other Physical Examination</small><br>
                                                                <textarea class="form-control sign_other_physical_exam" id="sign_other_physical_exam" name="sign_other_physical_exam" style="resize: none;width: 100%;"></textarea>
                                                            </div>
                                                        </div> 

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <small class="text-info">Assessment/Diagnosis</small><br>
                                                                <textarea class="form-control sign_assessment_diagnosis" id="sign_assessment_diagnosis" name="sign_assessment_diagnosis" style="resize: none;width: 100%;"></textarea>
                                                            </div>
                                                        </div> 

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <small class="text-info">Plan/Intervention</small><br>
                                                                <textarea class="form-control" name="sign_plan_intervention" style="resize: none;width: 100%;"></textarea>
                                                            </div>
                                                        </div> 
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="severe_nausea" value="yes" name="severe_nausea" stlye="float:left">Severe nausea and vomiting 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="significant_decline" value="yes" name="significant_decline" stlye="float:left">Significant decline fetal movement (less than 10 in 12 hrs during 2 ½ of pregnancy) 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="persistent_contractions" value="yes" name="persistent_contractions" stlye="float:left">Persistent contractions
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="premature_rupture" value="yes" name="premature_rupture" stlye="float:left">Premature rupture of the bag of membrane 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="fetal_pregnancy" value="yes" name="fetal_pregnancy" stlye="float:left">Multi fetal pregnancy 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="severe_headache" value="yes" name="severe_headache" stlye="float:left">Persistent severe headache, dizziness, or blurring of vision 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="abdominal_pain" value="yes" name="abdominal_pain" stlye="float:left">Abdominal pain or epigastric pain 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="edema_hands" value="yes" name="edema_hands" stlye="float:left">Edema of the hands, feet or face 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box"> 
                                                <td>
                                                    <input type="checkbox" class="fever_pallor" value="yes" name="fever_pallor" stlye="float:left">Fever or pallor 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="seizure_consciousness" value="yes" name="seizure_consciousness" stlye="float:left">Seizure or loss of consciousness 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="difficulty_breathing" value="yes" name="difficulty_breathing" stlye="float:left">Difficulty of breathing 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="painful_urination" value="yes" name="painful_urination" stlye="float:left">Painful urination 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="elevated_bp" value="yes" name="elevated_bp" stlye="float:left">Elevated blood pressure ≥ 120/90 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div id="current" class="tab-pane fade">
                                        <table class="table table-striped sign_symthoms_table">
                                            <tr class="bg-gray">
                                                <th rowspan="4" width="50%"> 
                                                    <br><br><br><br><br><h3>Risk Factor</h3>
                                                        (a CHECK to ATLEAST ONE of the boxex indicates REFERRAL to a higher facility) 
                                                </th>

                                                <th> 
                                                    <span> 
                                                        <select style="width:50px;" class="prev_trimester" disabled>
                                                        <option styple="width:150px;" value="">...</option>
                                                        <option value="1st">1st</option>
                                                        <option value="2nd">2nd</option>
                                                        <option value="3rd">3rd</option>
                                                        </select> Trimester 
                                                    </span>
                                                </th>
                                            </tr>
                                            
                                            <tr class="bg-gray">
                                                <td> 
                                                    <span> 
                                                        <select style="width:50px;" class="prev_visit" disabled>
                                                        <option styple="width:150px;" value="">...</option>
                                                        <option value="1st">1st</option>
                                                        <option value="2nd">2nd</option>
                                                        <option value="3rd">3rd</option>
                                                        <option value="4th">4th</option>
                                                        <option value="5th">5th</option>
                                                        <option value="6th">6th</option>
                                                        <option value="7th">7th</option>
                                                        <option value="8th">8th</option>
                                                        <option value="9th">9th</option>
                                                        <option value="10th">10th</option>
                                                        <option value="11th">11th</option>
                                                        <option value="12th">12th</option>
                                                        </select> Visit 
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> 
                                                    <center>
                                                        <span> Date: <input  class="form-control prev_date"  type="date" disabled>  <br>
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr class="bg-gray">
                                                <td>
                                                    <b>Remarks</b>
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_viganal_bleeding" stlye="float:left" disabled>Vaginal spotting or bleeding
                                                </td>

                                                <td rowspan="13">
                                                    <center>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <small class="text-info">Subjective</small><br>
                                                                <textarea class="form-control prev_subjective" style="resize: none;width: 100%;" disabled> </textarea>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4"></div>

                                                            <div class="col-md-4">
                                                                <small class="text-info">AOG</small><br>
                                                                <input type="text" class="form-control prev_aog" style="width: 100%;" disabled>
                                                            </div>

                                                            <div class="col-md-4"></div>
                                                        </div>  

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <small class="text-info">BP</small><br>
                                                                <input type="text" class="form-control prev_bp"  style="width: 100%;" disabled>
                                                                <small class="text-info">HR</small><br>
                                                                <input type="text" class="form-control prev_hr"  style="width: 100%;" disabled>
                                                                <small class="text-info">FH</small><br>
                                                                <input type="text" class="form-control prev_fh"  style="width: 100%;" disabled>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <small class="text-info">TEMP</small><br>
                                                                <input type="text" class="form-control prev_temp"  style="width: 100%;" disabled>
                                                                <small class="text-info">RR</small><br>
                                                                <input type="text" class="form-control prev_rr"  style="width: 100%;" disabled>
                                                                <small class="text-info">FHT</small><br>
                                                                <input type="text" class="form-control prev_fht"  style="width: 100%;" disabled>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <small class="text-info">Other Physical Examination</small><br>
                                                                <textarea class="form-control prev_other_exam" style="resize: none;width: 100%;" disabled> </textarea>
                                                            </div>
                                                        </div> 

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <small class="text-info">Assessment/Diagnosis</small><br>
                                                                <textarea class="form-control prev_assestment_diagnosis" style="resize: none;width: 100%;" disabled> </textarea>
                                                            </div>
                                                        </div> 

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <small class="text-info">Plan/Intervention</small><br>
                                                                <textarea class="form-control prev_plan_intervention" style="resize: none;width: 100%;" disabled> </textarea>
                                                            </div>
                                                        </div> 
                                                    </center>
                                                </td>
                                            </tr>

                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_severe_nausea" stlye="float:left" disabled>Severe nausea and vomiting 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_significant_decline" stlye="float:left" disabled>Significant decline fetal movement (less than 10 in 12 hrs during 2 ½ of pregnancy) 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_persistent_contractions" stlye="float:left" disabled>Persistent contractions
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_premature_rupture" stlye="float:left" disabled>Premature rupture of the bag of membrane 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_multi_pregnancy" stlye="float:left" disabled>Multi fetal pregnancy 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox"  class="prev_persistent_severe" stlye="float:left" disabled>Persistent severe headache, dizziness, or blurring of vision 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_abdominal_pain" stlye="float:left" disabled>Abdominal pain or epigastric pain 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_edema_hands" stlye="float:left" disabled>Edema of the hands, feet or face 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box"> 
                                                <td>
                                                    <input type="checkbox" class="prev_fever_pallor" stlye="float:left" disabled>Fever or pallor 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_seiszure_consciousness" stlye="float:left" disabled>Seizure or loss of consciousness 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_difficulty_breathing" stlye="float:left" disabled>Difficulty of breathing 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_painful_urination" stlye="float:left" disabled>Painful urination 
                                                </td>
                                            </tr>
                                            
                                            <tr class="sign_symthoms_table_box">
                                                <td>
                                                    <input type="checkbox" class="prev_elevated_bp" stlye="float:left" disabled>Elevated blood pressure ≥ 120/90 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
