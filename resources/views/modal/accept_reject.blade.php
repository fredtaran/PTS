<?php
    $user = Auth::user();
    $myfacility = \App\Models\Facility::find($user->facility_id);
    $department = \App\Http\Controllers\LocationCtrl::facilityAddress(@$myfacility->id);
    $facility_address = $department['address'];
?>
<style>
    #normalFormModal span {
        color: #e08e0b;
    }

    #pregnantFormModal span {
        color: #1e8a2a;
    }
</style>

<div class="modal fade" role="dialog" id="normalFormModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="jim-content">
                @include('include.header_form')
                <center>
                    <h2>Clinical Referral Form</h2>
                </center>

                <table class="table table-striped">
                    <tr>
                        <td colspan="6">Name of Referring Facility: <span class="referring_name"></span></td>
                    </tr>

                    <tr>
                        <td colspan="6">Facility Contact #: <span class="referring_contact"></span></td>
                    </tr>

                    <tr>
                        <td colspan="6">Address: <span class="referring_address"></span></td>
                    </tr>

                    <tr>
                        <td colspan="3">Referred to: <span class="referred_name"></span></td>
                        <td colspan="3">Department: <span class="department_name"></span></td>
                    </tr>

                    <tr>
                        <td colspan="6">Address: <span class="referred_address"></span></td>
                    </tr>

                    <tr>
                        <td colspan="3">Date/Time Referred (ReCo): <span class="time_referred"></span></td>
                        <td colspan="3">Date/Time Transferred: <span class="time_transferred"></span></td>
                    </tr>

                    <tr>
                        <td colspan="3">Name of Patient: <span class="patient_name"></span></td>
                        <td>Age: <span class="patient_age"></span></td>
                        <td>Sex: <span class="patient_sex"></span></td>
                        <td>Status: <span class="patient_status"></span></td>
                    </tr>

                    <tr>
                        <td colspan="3">Birthday: <span class="patient_bday"></span></td>
                    </tr>

                    <tr>
                        <td colspan="6">Address: <span class="patient_address"></span></td>
                    </tr>

                    <tr>
                        <td colspan="3">PhilHealth status: <span class="phic_status"></span></td>
                        <td colspan="3">PhilHealth #: <span class="phic_id"></span></td>
                    </tr>

                    <tr>
                        <td colspan="6"><small class="badge bg-red"> New</small> Covid Number: <span class="covid_number"></span></td>
                    </tr>

                    <tr>
                        <td colspan="6"><small class="badge bg-red"> New</small> Clinical Status: <span class="clinical_status" style="text-transform: capitalize;"></span></td>
                    </tr>

                    <tr>
                        <td colspan="2"><small class="badge bg-red"> New</small> Surveillance Category: <span class="surveillance_category" style="text-transform: capitalize;"></span></td>
                    </tr>

                    <tr>
                        <td colspan="6">
                            Case Summary (pertinent Hx/PE, including meds, labs, course etc.):
                            <br />
                            <span class="case_summary">

                            </span>
                        </td>
                    </tr>

                    <!-- <tr>
                        <td colspan="6">
                            Summary of ReCo (pls. refer to ReCo Guide in Referring Patients Checklist):
                            <br />
                            <span class="reco_summary"></span>
                        </td>
                    </tr> -->

                    <tr>
                        <td colspan="6">
                            Diagnosis/Impression:
                            <br />
                            <span class="diagnosis"></span>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6">
                            Reason for referral:
                            <br />
                            <span class="reason"></span>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6">
                            Name of referring MD/HCW: <span class="referring_md"></span>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6">
                            Contact # of referring MD/HCW: <span class="referring_md_contact"></span>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="6">Name of referred MD/HCW- Mobile Contact # (ReCo): <span class="referred_md"></span></td>
                    </tr>
                </table>

                <hr />

                <button class="btn btn-default btn-flat btn_close" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <div class="form-fotter pull-right">
                  
                    <button data-dismiss="modal" class="btn btn-info btn_call_request btn-flat btn-call button_option" data-toggle="modal" data-target="#sendCallRequest"><i class="fa fa-phone"></i> Call Request <span class="badge bg-red-active call_count" data-toggle="tooltip" title=""></span> </button>
                    <button data-dismiss="modal" class="btn btn-danger btn-flat button_option" data-toggle="modal" data-target="#rejectModal"><i class="fa fa-line-chart"></i> Recommend to Redirect</button>
                    <button data-dismiss="modal" class="btn btn-success btn-flat button_option" data-toggle="modal" data-target="#acceptFormModal"><i class="fa fa-check"></i> Accept</button>
                
                    <a href="{{ url('doctor/print/form') }}" target="_blank" class="btn-refer-normal btn btn-warning btn-flat"><i class="fa fa-print"></i> Print Form</a>
                  
                </div>

                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
    $user = Auth::user();
    $myfacility = \App\Models\Facility::find(@$user->facility_id);
    $facilities = \App\Models\Facility::select('id', 'name')
        ->where('id', '!=', @$user->facility_id)
        ->where('status', 1)
        ->where('referral_used', 'yes')
        ->orderBy('name', 'asc')
        ->get();
        echo @$id;
?>
<div class="modal fade" role="dialog" id="RefferedpregnantFormModalTrack">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content pregnant_modal_content">
            <form method="POST" class="form-submit" id="view_pregnant_form_new" >
                <div class="jim-content">
                    @include('include.header_form')
                    <div class="title-form">Risk Assessment Check List for Pregnant Women</div>
                    
                    {{ csrf_field() }}
                    <input type="hidden" name="patient_id" class="patient_id" value="" />
                    <input type="hidden" name="date_referred" class="date_referred" value="{{ date('Y-m-d H:i:s') }}" />
                    <input type="hidden" name="code" value="" />
                    <input type="hidden" name="source" value="{{ @$source }}" />
                    <input type="hidden" name="referring_name" value="{{ @$myfacility->name }}" />
                    <input type="hidden" name="referring_facility" value="{{ @$myfacility->id }}" />
                    <div class="row">
                        <h2>Patients Information</h2>

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Personnal Data</a></li>
                            <li><a data-toggle="tab" href="#menu1">Antepartum Conditions</a></li>
                            <li><a data-toggle="tab" href="#menu2new">Sign and Symptoms</a></li>
                            <!-- <li><a data-toggle="tab" href="#menu3new">Lab Result</a></li> -->
                            <!-- <li><a data-toggle="tab" href="#menu4">Vital Signs</a></li> -->
                            <!-- <li><a data-toggle="tab" href="#menu5">Pregnancy Outcome</a></li> -->
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane fade in active">
                                <table class="table table-striped">
                                    <tr class="bg-gray">
                                        <th colspan="5">A.I Personnal Data</th>
                                    </tr>

                                    <tr>
                                        <td width="25%">
                                            Referring Facility: 
                                            <span class="text-primary">{{ @$myfacility->name }} </span>
                                        </td>

                                        <td width="25%">
                                            Address of facility: 
                                            <span class="text-primary">{{ @$myfacility->address }}</span> 
                                        </td>

                                        <td width="25%">
                                            PHIC: 
                                            <span class="text-primary phic_id"></span> 
                                        </td>

                                        <td width="25%" colspan="4">
                                            Referred Date: 
                                            <span class="text-primary">{{ date('l M d, Y') }}</span> 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Name of Patient:
                                            <span class="text-primary patient_name"></span>
                                        </td>

                                        <td>
                                            Age: 
                                            <span class="text-primary patient_age"></span> 
                                        </td>

                                        <td>
                                            Sex: 
                                            <span class="text-primary preg_patient_sex"></span> 
                                        </td>

                                        <td>
                                            Educational Attainment:
                                            <select name="educ_attainment" class="form-control educ_attainment" disabled >
                                                <option value="">Select Attainment...</option>
                                                <option value="elementary">Elementary</option>
                                                <option value="highschool">Highschool</option>
                                                <option value="college">College</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Address of Patient: 
                                            <span class="text-primary patient_address"></span> 
                                        </td>

                                        <td>
                                            Birthday: 
                                            <span class="text-primary patient_dob"></span>
                                        </td>

                                        <td>
                                            Marital Status: 
                                            <span class="text-primary preg_civil_status"></span> 
                                        </td>

                                        <td>
                                            Family Monthly Income:
                                            <select name="family_income" class="form-control family_income" disabled>
                                                <option value="">Select Income...</option>
                                                <option value="rich">> 219,140</option>
                                                <option value="high">131,484 - 219,140</option>
                                                <option value="upper_middle">76,670 - 131,483</option>
                                                <option value="middle">43,829 - 76,669</option>
                                                <option value="lower_middle">21,915 - 43,828</option>
                                                <option value="low">10,958 - 21,914</option>
                                                <option value="poor">< 10,957</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Contact No. of Patient: 
                                            <span class="text-primary patient_contact"></span> 
                                        </td>

                                        <td>
                                            Religion: 
                                            <input type="text" class="form-control religion" name="religion" style="width: 100%;" disabled> 
                                        </td>

                                        <td>
                                            Ethnicity: 
                                            <input type="text" class="form-control ethnicity" name="ethnicity" style="width: 100%;" disabled> 
                                        </td>

                                        <td>Sibling Rank: 
                                            <input type="text" class="form-control sibling_rank" name="sibling_rank" style="width: 100%;" disabled> Out of  
                                            <input type="text" class="form-control out_of" name="out_of" style="width: 100%;" disabled> 
                                        </td>
                                    </tr>
                                </table>

                                <table class="table table-striped">
                                    <tr class="bg-gray">
                                        <th colspan="6">A.II Personnal Data</th>
                                    </tr>

                                    <tr>
                                        <td>
                                            Gravidity: 
                                            <input type="text" class="form-control" name="gravidity" style="width: 100%;" disabled> 
                                        </td>

                                        <td>
                                            Parity: 
                                            <input type="text" class="form-control" name="parity" style="width: 100%;" disabled> 
                                        </td>

                                        <td>
                                            FTPAL: 
                                            <input type="text" class="form-control" name="ftpal" style="width: 100%;" disabled> 
                                        </td>

                                        <td>
                                            BMI: 
                                            <input type="text"class="form-control" name="bmi" style="width: 100%;" disabled> 
                                        </td>

                                        <td>
                                            Fundic Height: 
                                            <input type="text" class="form-control" name="fundic_height" style="width: 100%;" disabled> 
                                        </td>

                                        <td>
                                            HR: 
                                            <input type="text" class="form-control" name="hr" style="width: 100%;" disabled>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            LMP: 
                                            <input type="text" class="form-control lmp_date" name="lmp" placeholder="mm/dd/yyyy" style="width: 100%;" disabled>
                                        </td>

                                        <td>
                                            EDC/EDD: 
                                            <input type="text" class="form-control edc_edd" name="edc_edd" placeholder="mm/dd/yyyy" style="width: 100%;" disabled>
                                        </td>

                                        <td>
                                            Height (m): 
                                            <input type="text" class="form-control" name="height" style="width: 100%;" disabled> 
                                        </td>

                                        <td>
                                            Weigth (kg): 
                                            <input type="text" class="form-control" name="weigth" style="width: 100%;" disabled>
                                        </td>

                                        <td>
                                            BP: 
                                            <input type="text" class="form-control" name="bp" style="width: 100%;" disabled>
                                        </td>

                                        <td>
                                            TEMP: 
                                            <input type="text" class="form-control" name="temp" style="width: 100%;" disabled>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            RR: 
                                            <input type="text" class="form-control" name="rr" style="width: 100%;" disabled>
                                        </td>

                                        <td>
                                            Td1: 
                                            <input type="text" placeholder="mm/dd/yyyy" class="form-control td1" name="td1" style="width: 100%;" disabled>
                                        </td>

                                        <td>
                                            Td2: 
                                            <input type="text" placeholder="mm/dd/yyyy" class="form-control td2" name="td2" style="width: 100%;" disabled> 
                                        </td>

                                        <td>
                                            Td3: 
                                            <input type="text" placeholder="mm/dd/yyyy" class="form-control td3" name="td3" style="width: 100%;" disabled> 
                                        </td>

                                        <td>
                                            Td4: 
                                            <input type="text" placeholder="mm/dd/yyyy" class="form-control td4" name="td4" style="width: 100%;" disabled> 
                                        </td>

                                        <td>
                                            Td5: 
                                            <input type="text" placeholder="mm/dd/yyyy" class="form-control td5" name="td5" style="width: 100%;" disabled> 
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div id="menu1" class="tab-pane fade">
                                <table class="table table-striped pre_pregnancy_table">
                                    <tr class="bg-gray">
                                        <th>Risk Factor</th>
                                        <th>Risk Factor</th>
                                        <th>Risk Factor</th>
                                        <th>Risk Factor</th>
                                        <th>Risk Factor</th>
                                        <th>Remarks/Management</th>
                                    </tr>

                                    <tr>
                                        <td> 
                                            Hypertension <br> 
                                            <input type="checkbox" value="yes" class="hypertension" name="hypertension" disabled>
                                        </td>

                                        <td> 
                                            Anemia <br> 
                                            <input type="checkbox" value="yes" class="anemia" name="anemia" disabled>
                                        </td>

                                        <td> 
                                            Malaria <br> 
                                            <input type="checkbox" value="yes" class="malaria" name="malaria" disabled>
                                        </td>

                                        <td> 
                                            Cancer <br> 
                                            <input type="checkbox" value="yes" class="cancer" name="cancer" disabled>
                                        </td>

                                        <td> 
                                            Allergies <br> 
                                            <input type="checkbox" value="yes" class="allergies" name="allergies" disabled>
                                        </td>

                                        <td rowspan="5"> 
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <small class="text-info">Subjective</small><br>
                                                    <textarea class="form-control ante_subjective" name="ante_subjective" style="resize: none;width: 100%;" disabled> </textarea>
                                                </div>
                                            </div>    

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <small class="text-info">BP</small><br>
                                                    <input type="text" class="form-control ante_bp"  name="ante_bp" style="width: 100%;" disabled>
                                                    <small class="text-info">HR</small><br>
                                                    <input type="text" class="form-control ante_hr"  name="ante_hr" style="width: 100%;" disabled>
                                                    <small class="text-info">FH</small><br>
                                                    <input type="text" class="form-control ante_fh"  name="ante_fh" style="width: 100%;" disabled>
                                                </div>

                                                <div class="col-md-6">
                                                    <small class="text-info">TEMP</small><br>
                                                    <input type="text" class="form-control ante_temp"  name="ante_temp" style="width: 100%;" disabled>
                                                    <small class="text-info">RR</small><br>
                                                    <input type="text" class="form-control ante_rr"  name="ante_rr" style="width: 100%;" disabled>
                                                    <small class="text-info">FHT</small><br>
                                                    <input type="text" class="form-control ante_fht"  name="ante_fht" style="width: 100%;"disabled>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <small class="text-info">Other Physical Examination</small><br>
                                                    <textarea class="form-control ante_other_physical_exam" name="ante_other_physical_exam" style="resize: none;width: 100%;" disabled> </textarea>
                                                </div>
                                            </div> 

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <small class="text-info">Assessment/Diagnosis</small><br>
                                                    <textarea class="form-control ante_assessment_diagnosis" name="ante_assessment_diagnosis" style="resize: none;width: 100%;" disabled> </textarea>
                                                </div>
                                            </div> 

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <small class="text-info">Plan/Intervention</small><br>
                                                    <textarea class="form-control ante_plan_intervention" name="ante_plan_intervention" style="resize: none;width: 100%;" disabled> </textarea>
                                                </div>
                                            </div> 

                                        </td>
                                    </tr>

                                    <tr>
                                        <td> 
                                            Renal Disease<br> 
                                            <input type="checkbox" value="yes" class="renal_disease" name="renal_disease" disabled>
                                        </td>

                                        <td> 
                                            Typhoid Disorders <br> 
                                            <input type="checkbox" value="yes" class="typhoid_disorders" name="typhoid_disorders" disabled>
                                        </td>

                                        <td> 
                                            Hypo/Hyperthyroidism <br> 
                                            <input type="checkbox" value="yes" class="hypo_hyperthyroidism" name="hypo_hyper" disabled>
                                        </td>

                                        <td> 
                                            Tuberculosis <br> 
                                            <input type="checkbox" value="yes" class="tuberculosis" name="tuberculosis" disabled>
                                        </td>
                                        
                                        <td> 
                                            Diabetes Mellitus <br> 
                                            <input type="checkbox" value="yes" class="diabetes_mellitus" name="diabetes_mellitus" disabled>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> 
                                            Hepatitis B Infection<br> 
                                            <input type="checkbox" value="yes" class="hepatitisb_infection" name="hepatatis_b" disabled>
                                        </td>

                                        <td> 
                                            HIV-AIDs/STI <br> 
                                            <input type="checkbox" value="yes" class="hiv_sti" name="hiv_sti" disabled>
                                        </td>

                                        <td> 
                                            Seizure Disorder <br> 
                                            <input type="checkbox" value="yes" class="seizure_disorder" name="seizure_disorder" disabled>
                                        </td>

                                        <td> 
                                            Cardiovascular disease <br> 
                                            <input type="checkbox" value="yes" class="cadiovascular_disease" name="cardiovascular_disease" disabled>
                                        </td>

                                        <td> 
                                            Malnutrition (<18.5 BMI) <br> 
                                                <input type="checkbox" value="yes" class="malnutrition" name="malnutrition" disabled>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> 
                                            Hemotilgic/Bleeding disorder<br> 
                                            <input type="checkbox" value="yes" class="hemotilgic_bleeding" name="hemotilgic_disorder" disabled>
                                        </td>

                                        <td> 
                                            Alcohol/Substance Abuse <br> 
                                            <input type="checkbox" value="yes" class="alcohol_abuse" name="substance_abuse" disabled>
                                        </td>

                                        <td> 
                                            Patient w/ anti-phospholipid syndrome <br> 
                                            <input type="checkbox" value="yes" class="phospholipid_syndrome" name="anti_phospholipid" disabled>
                                        </td>

                                        <td> 
                                            Obstructive or restrictive pulmonary disease (Asthma) <br> 
                                            <input type="checkbox" value="yes" class="asthma" name="restrictive_pulmonary" disabled>
                                        </td>
                                        
                                        <td> 
                                            Patients w/psychiatirc conditions and/mental retardation <br> 
                                            <input type="checkbox" value="yes" class="psychiatric_mental" name="mental_retardation" disabled>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> 
                                            Habitual abortion (2 consecutive abortion and 3/more repeated abortion)<br> 
                                            <input type="checkbox" value="yes" class="habitual_abortion" name="habitual_abortion" disabled>
                                        </td>

                                        <td> 
                                            Birth of fetus with congenital anomaly <br> 
                                            <input type="checkbox" value="yes" class="fetus_congenital" name="fetus_congenital" disabled>
                                        </td>

                                        <td> 
                                            Previous caesarean section <br> 
                                            <input type="checkbox" value="yes" class="caesarean_section" name="previous_caesarean" disabled>
                                        </td>

                                        <td> 
                                            Preterm Delivery resulting to stillbirth or neonatal death <br> 
                                            <input type="checkbox" value="yes" class="neonatal_death" name="preterm_delivery" disabled>
                                        </td>

                                        <td> 
                                            Others
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div id="menu2new" class="tab-pane fade">
                                <table class="table table-striped sign_symthoms_table">
                                    <tr class="bg-gray">
                                        <th rowspan="4" width="50%"> 
                                            <br><br><br><br><br><h3>Risk Factor</h3>
                                            (CHECK AT LEAST ONE OF THE SYMPTOM OR SIGN)
                                        </th>

                                        <th>     
                                            <select style="width:50px;" class="prev_trimester" disabled>
                                            <option styple="width:150px;" value="">...</option>
                                            <option value="1st">1st</option>
                                            <option value="2nd">2nd</option>
                                            <option value="3rd">3rd</option>
                                            </select> Trimester
                                        </th>
                                    </tr>

                                    <tr class="bg-gray">
                                        <td>                      
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
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> 
                                            <center>
                                                Date: <input  class="form-control prev_date" placeholder="mm/dd/yyyy" type="text" disabled> <br>
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

                            <!-- <div id="menu3new" class="tab-pane fade">
                                <div id="myDiv">
                                    <table class="table table-striped pre_pregnancy_table" id="table_lab_res_referred">
                                        <tr class="bg-gray">
                                            <th>Date of Lab.</th>
                                            <th>CBC Result</th>
                                            <th>UA Result</th>
                                            <th>UTZ</th>
                                            <th>Blood Type</th>
                                            <th>HBsAg Result</th>
                                            <th>VDRL Result</th>
                                            <th>Management/Intervention</th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control date_of_lab" placeholder="mm/dd/yyyy" name="date_of_lab[]" disabled> </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Hgb: <input type="text" class="form-control cbc_hgb" name="cbc_hgb[]" disabled> 
                                                    </div>
                                                    <div class="col-md-6">
                                                        WBC: <input type="text" class="form-control cbc_wbc" name="cbc_wbc[]" disabled>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        RBC: <input type="text" class="form-control cbc_rbc" name="cbc_rbc[]" disabled> 
                                                    </div>
                                                    <div class="col-md-6">
                                                        Platelet: <input type="text" class="form-control cbc_platelet" name="cbc_platelet[]" disabled>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Hct: <input type="text" class="form-control cbc_hct" name="cbc_hct[]" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Pus: <input type="text" class="form-control ua_pus" name="ua_pus[]" disabled> 
                                                    </div>
                                                    <div class="col-md-6">
                                                        RBC: <input type="text" class="form-control ua_rbc" name="ua_rbc[]"disabled>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        Sugar: <input type="text" class="form-control ua_sugar" name="ua_sugar[]" disabled> 
                                                    </div>
                                                    <div class="col-md-6">
                                                        Specific Gravity: <input type="text" class="form-control ua_gravity" name="ua_gravity[]" disabled>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        Albumin: <input type="text" class="form-control ua_albumin" name="ua_albumin[]" disabled>
                                                    </div>
                                                </div>
                                            </td>
                                            <td> <textarea name="utz[]" class="form-control utz" disabled></textarea> </td>
                                            <td rowspan="5" id="blood_type">
                                                    <select name="blood_type" class="form-control blood_type" disabled>
                                                        <option value="">Select type...</option>
                                                        <option value="a+">A+</option>
                                                        <option value="a-">A-</option>
                                                        <option value="b+">B+</option>
                                                        <option value="b-">B-</option>
                                                        <option value="ab+">AB+</option>
                                                        <option value="ab-">AB-</option>
                                                        <option value="o+">O+</option>
                                                        <option value="o-">O-</option>
                                                    </select> 
                                            </td>
                                            <td rowspan="5" id="hbsag_result">
                                                    <select name="hbsag_result" class="form-control hbsag_result" disabled>
                                                        <option value="">Select HBsAg...</option>
                                                        <option value="reactive">Reactive</option>
                                                        <option value="non_reactive">Non-Reactive</option>
                                                    </select> 
                                            </td>
                                            <td rowspan="5" id="vdrl_result"> 
                                                    <select name="vdrl_result" class="form-control vdrl_result" disabled>
                                                        <option value="">Select VDRL...</option>
                                                        <option value="reactive">Reactive</option>
                                                        <option value="non_reactive">Non-Reactive</option>
                                                    </select> 
                                            </td>
                                            <td><textarea name="lab_remarks[]" class="form-control lab_remarks" disabled></textarea> </td>
                                        </tr>
                                    </table>
                                </div>
                            </div> -->

                            <div id="menu4" class="tab-pane fade">
                                <table class="table table-striped pre_pregnancy_table">
                                    <tr class="bg-gray">
                                        <th>Monitoring</th>
                                        <th>15 min.</th>
                                        <th>30 min.</th>
                                        <th>45 min.</th>
                                        <th>60 min.</th>
                                        <th>Remarks</th>
                                    </tr>

                                    <tr>
                                        <td>BP</td>
                                        <td> 
                                            <input type="text" class="form-control bp_15" name="bp_15" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control bp_30" name="bp_30" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control bp_45" name="bp_45" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control bp_60" name="bp_60" disabled> 
                                        </td>

                                        <td> 
                                            <textarea name="bp_remarks" class="form-control bp_remarks" disabled></textarea> 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>TEMP</td>
                                        <td> 
                                            <input type="text" class="form-control temp_15" name="temp_15" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control temp_30" name="temp_30" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control temp_45" name="temp_45" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control temp_60" name="temp_60" disabled> 
                                        </td>

                                        <td> 
                                            <textarea name="temp_remaks" class="form-control temp_remaks" disabled></textarea> 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>HR</td>
                                        <td> 
                                            <input type="text" class="form-control hr_15" name="" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control hr_30" name="" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control hr_45" name="" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control hr_60" name="" disabled> 
                                        </td>

                                        <td> 
                                            <textarea name="hr_remarks" class="form-control hr_remarks" disabled></textarea> 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>RR</td>
                                        <td> 
                                            <input type="text" class="form-control rr_15" name="rr_15" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control rr_30" name="rr_30" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control rr_45" name="rr_45" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control rr_60" name="rr_60" disabled> 
                                        </td>

                                        <td> 
                                            <textarea name="rr_remarks" class="form-control rr_remarks" disabled></textarea> 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>O2Sat</td>
                                        <td> 
                                            <input type="text" class="form-control o2sat_15" name="o2sat_15" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control o2sat_30" name="o2sat_30" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control o2sat_45" name="o2sat_45" disabled>
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control o2sat_60" name="o2sat_60" disabled> 
                                        </td>

                                        <td> 
                                            <textarea name="o2sat_remaks" class="form-control o2sat_remaks"disabled></textarea> 
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>FHT</td>
                                        <td> 
                                            <input type="text" class="form-control fht_15" name="fht_15" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control fht_30" name="fht_30" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control fht_45" name="fht_45" disabled> 
                                        </td>

                                        <td> 
                                            <input type="text" class="form-control fht_60" name="fht_60" disabled> 
                                        </td>

                                        <td> 
                                            <textarea name="fht_remarks" class="form-control fht_remarks" disabled></textarea> 
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div id="menu5" class="tab-pane fade">
                                <table class="table table-striped">
                                    <tr>
                                        <td width="25%"> <label>Delivery Outcome:  </label> 
                                            <select name="delivery_outcome" class="form-control delivery_outcome" disabled>
                                                <option value="">Select Outcome...</option>
                                                <option value="fullterm">Fullterm</option>
                                                <option value="preterm">Preterm</option>
                                                <option value="stillbirth">Stillbirth</option>
                                                <option value="abortion">Abortion</option>
                                            </select> 
                                        </td>

                                        <td width="25%"> <label> Birth Attendant:   </label> 
                                            <select name="birth_attendant" class="form-control birth_attendant" disabled>
                                                <option value="">Select Attendant...</option>
                                                <option value="md">MD</option>
                                                <option value="rn">RN</option>
                                                <option value="rm">RM</option>
                                            </select>
                                        </td>

                                        <td width="25%">  <label> Status on Discharge:   </label> 
                                            <select name="status_on_discharge" class="form-control status_on_discharge" disabled>
                                                <option value="">Select Status...</option>
                                                <option value="expired">Expired</option>
                                                <option value="improved">Improved</option>
                                                <option value="hama">HAMA</option>
                                            </select>
                                        </td>

                                        <td width="25%">  <label> Type of Delivery:   </label> 
                                            <select name="type_of_delivery" class="form-control type_of_delivery" disabled>
                                                <option value="">Select Delivery...</option>
                                                <option value="nsvd">Normal Spontaneous Vaginal Delivery (NSVD)</option>
                                                <option value="caesarean">Caesarean</option>
                                                <option value="vinal_after_caesarean">Vaginal Birth After Caesarean</option>
                                                <option value="assisted_vaginal_delivery">Assisted Vaginal Delivery</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4">  
                                            <?php
                                                $data = App\Models\Diagnosis::where('void', 0)
                                                                            ->orderby('id','asc')
                                                                            ->get();
                                            ?>      
                                            <label> Final Diagnosis with ICD 10 code:   </label>   
                                            <textarea class="form-control final_diagnosis" disabled></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <hr />

                    <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>

                    <div class="form-fotter pull-right">
                        <button data-dismiss="modal" class="btn btn-info btn_call_request btn-flat btn-call button_option" data-toggle="modal" data-target="#sendCallRequest"><i class="fa fa-phone"></i> Call Request</button>
                        <button data-dismiss="modal" class="btn btn-danger btn-flat button_option" data-toggle="modal" data-target="#rejectModal"><i class="fa fa-line-chart"></i> Recommend to Redirect</button>
                        <button data-dismiss="modal" class="btn btn-success btn-flat button_option" data-toggle="modal" data-target="#acceptFormModal"><i class="fa fa-check"></i> Accept</button>
                        <a href="{{ url('doctor/print/form') }}" target="_blank" class="btn-refer-pregnant btn btn-warning btn-flat"><i class="fa fa-print"></i> Print Form</a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- <div class="form-fotter pull-right">
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Back</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-send"></i> Send</button>
                    </div>
                    <div class="clearfix"></div> -->
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade" role="dialog" id="pregnantFormModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="jim-content">
                @include('include.header_form')
                <div class="title-form">BEmONC/ CEmONC REFERRAL FORM</div>
                <table class="table table-striped">
                    <tr>
                        <th colspan="4">REFERRAL RECORD</th>
                    </tr>
                    <tr>
                        <td>Who is Referring</td>
                        <td>Record Number: <span class="record_no"></span></td>
                        <td colspan="2">Referred Date: <span class="referred_date"></span></td>
                    </tr>
                    <tr>
                        <td colspan="2">Referring Name: <span class="md_referring"></span></td>
                        <td colspan="2">Arrival Date: </td>
                    </tr>
                    <tr>
                        <td colspan="4">Contact # of referring MD/HCW: <span class="referring_md_contact"></span></td>
                    </tr>
                    <tr>
                        <td colspan="2">Referring Facility: <span class="referring_facility"></span></td>
                        <td colspan="2">Department: <span class="department_name"></span></td>
                    </tr>
                    <tr>
                        <td colspan="4">Facility Contact #: <span class="referring_contact"></span></td>
                    </tr>
                    <tr>
                        <td colspan="4">Accompanied by the Health Worker: <span class="health_worker"></span></td>
                    </tr>
                    <tr>
                        <td colspan="4">Referred To: <span class="referred_name"></span></td>
                    </tr>
                    <tr>
                        <td colspan="4"><small class="badge bg-red"> New</small> Covid Number: <span class="covid_number"></span></td>
                    </tr>
                    <tr>
                        <td colspan="4"><small class="badge bg-red"> New</small> Clinical Status: <span class="clinical_status" style="text-transform: capitalize;"></span></td>
                    </tr>
                    <tr>
                        <td colspan="4"><small class="badge bg-red"> New</small> Surveillance Category: <span class="surveillance_category" style="text-transform: capitalize;"></span></td>
                    </tr>
                </table>

                <div class="row">
                    <div class="col-sm-6">
                        <table class="table bg-warning">
                            <tr class="bg-gray">
                                <th colspan="4">WOMAN</th>
                            </tr>
                            <tr>
                                <td colspan="3">Name: <span class="woman_name"></span></td>
                                <td>Age: <span class="woman_age"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4">Birthday: <span class="woman_bday"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4">Address: <span class="woman_address"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    Main Reason for Referral: <span class="woman_reason"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">Major Findings (Clinica and BP,Temp,Lab)
                                    <br />
                                    <span class="woman_major_findings"></span>
                                </td>
                            </tr>
                            <tr class="bg-gray">
                                <td colspan="4">Treatments Give Time</td>
                            </tr>
                            <tr>
                                <td colspan="4">Before Referral: <span class="woman_before_treatment"></span> - <span class="woman_before_given_time"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4">During Transport: <span class="woman_during_transport"></span> - <span class="woman_transport_given_time"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4">Information Given to the Woman and Companion About the Reason for Referral
                                    <br />
                                    <span class="woman_information_given"></span>
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
                                <td colspan="2">Name: <span class="baby_name"></span></td>
                                <td>Date of Birth: <span class="baby_dob"></span></td>
                            </tr>
                            <tr>
                                <td colspan="2">Birth Weight: <span class="weight"></span></td>
                                <td>Gestational Age: <span class="gestational_age"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    Main Reason for Referral: <span class="baby_reason"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">Major Findings (Clinica and BP,Temp,Lab)
                                    <br />
                                    <span class="baby_major_findings"></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">Last (Breast) Feed (Time): <span class="baby_last_feed"></span></td>
                            </tr>
                            <tr class="bg-gray">
                                <td colspan="4">Treatments Give Time</td>
                            </tr>
                            <tr>
                                <td colspan="4">Before Referral: <span class="baby_before_treatment"></span> - <span class="baby_before_given_time"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4">During Transport: <span class="baby_during_transport"></span> - <span class="baby_transport_given_time"></span></td>
                            </tr>
                            <tr>
                                <td colspan="4">Information Given to the Woman and Companion About the Reason for Referral
                                    <br />
                                    <span class="baby_information_given"></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <table class="table table-striped col-sm-6"></table>
                <div class="clearfix"></div>
                <hr />
                <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                <div class="pull-right">
                    <button class="btn btn-info btn_call_request btn-flat btn-call button_option" data-toggle="modal" data-target="#sendCallRequest"><i class="fa fa-phone"></i> Call Request</button>
                    <button class="btn btn-danger btn-flat button_option" data-toggle="modal" data-target="#rejectModal"><i class="fa fa-line-chart"></i> Recommend to Redirect</button>
                    <button class="btn btn-success btn-flat button_option" data-toggle="modal" data-target="#acceptFormModal"><i class="fa fa-check"></i> Accept</button>
                    <a href="{{ url('doctor/print/form') }}" target="_blank" class="btn-refer-pregnant btn btn-warning btn-flat"><i class="fa fa-print"></i> Print Form</a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="cssForm">
    <div class="modal-dialog modal-md" role="document">
        <form method="POST" action="{{ url('doctor/css_add') }}">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-body css_body">
                  
            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->