<?php
    $user = Session::get('auth');
    $facilities = \App\Facility::select('id','name')
        ->where('id','!=',$user->facility_id)
        ->where('status',1)
        ->where('referral_used','yes')
        ->orderBy('name','asc')->get();
    $myfacility = \App\Facility::find($user->facility_id);
    $facility_address = \App\Http\Controllers\LocationCtrl::facilityAddress($myfacility->id);
    $inventory = \App\Inventory::where("facility_id",$myfacility->id)->get();

?>
@if($data->type == normal)
<form action="{{ url('doctor/refer/updated') }}" method="POST">
            <div class="jim-content">
                <div style="margin-left: 58%;margin-top:10%;position: absolute;font-size: 8pt;background-color: white;">

                </div>
            
                @include('include.header_form')
                <center>
                    <h2>Clinical Referral Form</h2>
                </center>
                <div class="form-group-sm form-inline">
                 
                    {{ csrf_field() }}
                    <input type="hidden" name="tracking_id" class="tracking_id" value="{{$data->tracking_id}}" />
                    <input type="hidden" name="status" class="tracking_id" value="{{$data->status}}" />
                    <input type="hidden" name="type" class="tracking_id" value="{{$data->type}}" />
                    <input type="hidden" name="patientsform_id" class="patientsform_id" value="{{$data->patientsform_id}}" />
                    <input type="hidden" name="patient_id" class="patient_id" value="{{$data->patient_id}}" />
                    <input type="hidden" name="date_referred" class="date_referred" value="{{ date('Y-m-d H:i:s') }}" />
                    <input type="hidden" name="code" value="" />
                    <input type="hidden" name="source" value="{{ $source }}" />
                    <input type="hidden" class="referring_name" value="{{ $myfacility->name }}" />
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-success">Name of Referring Facility</small><br>
                            &nbsp;<span>{{ $myfacility->name }}</span>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Address</small><br>
                            &nbsp;<span >{{ $facility_address['address'] }}</span>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Name of referring MD/HCW</small><br>
                            &nbsp;<span >Dr. {{ $user->fname }} {{ $user->mname }} {{ $user->lname }}</span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-success">Date/Time Referred (ReCo)</small><br>
                            <span >{{ date('l F d, Y h:i A') }}</span>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Name of Patient</small><br>
                            &nbsp;<span >{{ $data->patient_name }}</span>
                            <!-- <input type="text" name="name" style="width: 100%;" value="{{ $data->patient_name }}"> -->
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Address</small><br>
                            &nbsp;<span >{{$data->address}}</span>
                            <!-- <input type="text" name="name" style="width: 100%;" value="{{$data->address}}"> -->
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-success">Referred to</small> </span><br>
                            <select name="referred_facility" class="select2 select_facility" >
                                <option value="">Select</option>
                                @foreach($facilities as $row)
                                <!-- <option {{ ($user->designation == $a->id ? 'selected' : '') }} value="{{ $a->id }}">{{ $a->description }}</option>
                                    <option data-name="{{ $row->name }}" value="{{ $row->id }}">{{ $row->name }}</option> -->
                                    <option  data-name="{{ $row->name }}" {{ ($data->referred_name == $row->name ? 'selected' : '') }} value="{{ $row->id }}"> {{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Department</small> </span><br>
                            <select name="referred_department" class="form-control-select select_department select_department_normal" style="width: 100%;" >
                                <option value="{{$data->department_id}}">{{$data->department}}</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Address</small><br>
                            <span class="text-yellow facility_address"></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-success">Age</small><br>
                            <input type="text" name="name" style="width: 100%;" value="{{ $data->age }}">
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Sex</small> </span><br>
                            <select name="patient_sex" class="patient_sex form-control" style="width: 100%;" >
                                <option value="">Select...</option>
                                <option <?php
                                    if(isset($data->sex)){
                                        if($data->sex == 'Male'){
                                            echo 'selected';
                                        }
                                    }
                                ?>>Male</option>
                                <option <?php
                                    if(isset($data->sex)){
                                        if($data->sex == 'Female'){
                                            echo 'selected';
                                        }
                                    }
                                ?>>Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Civil Status</small> </span><br>
                            <select name="civil_status" style="width: 100%;" class="civil_status form-control" >
                            <option value="">Select...</option>
                            <option
                <?php
                    if(isset($data->civil_status)){
                        if($data->civil_status == 'Single'){
                            echo 'selected';
                        }
                    }
                ?>
            >Single</option>
            <option
                <?php
                    if(isset($data->civil_status)){
                        if($data->civil_status == 'Married'){
                            echo 'selected';
                        }
                    }
                ?>
            >Married</option>
            <option
                <?php
                    if(isset($data->civil_status)){
                        if($data->civil_status == 'Divorced'){
                            echo 'selected';
                        }
                    }
                ?>
            >Divorced</option>
            <option
                <?php
                    if(isset($data->civil_status)){
                        if($data->civil_status == 'Separated'){
                            echo 'selected';
                        }
                    }
                ?>
            >Separated</option>
            <option
                <?php
                    if(isset($data->civil_status)){
                        if($data->civil_status == 'Widowed'){
                            echo 'selected';
                        }
                    }
                ?>
            >Widowed</option>
        </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-success">Covid Number</small><br>
                            <input type="text" name="covid_number" style="width: 100%;" value="{{$data->covid_number}}">
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Clinical Status</small><br>
                            <select name="clinical_status" id="" class="form-control-select" style="width: 100%;">
                                <option value="">Select option</option>
                                <option value="asymptomatic"
                                            <?php
                                if(isset($data->refer_clinical_status)){
                                    if($data->refer_clinical_status == 'asymptomatic'){
                                        echo 'selected';
                                    }
                                }
                            ?>
                                >Asymptomatic</option>
                                <option value="mild"
                                <?php
                                if(isset($data->refer_clinical_status)){
                                    if($data->refer_clinical_status == 'mild'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Mild</option>
                                <option value="moderate"
                                <?php
                                if(isset($data->refer_clinical_status)){
                                    if($data->refer_clinical_status == 'moderate'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Moderate</option>
                                <option value="severe"
                                <?php
                                if(isset($data->refer_clinical_status)){
                                    if($data->refer_clinical_status == 'severe'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Severe</option>
                                <option value="critical"
                                <?php
                                if(isset($data->refer_clinical_status)){
                                    if($data->refer_clinical_status == 'critical'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Critical</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Surveillance Category</small><br>
                            <select name="sur_category" id="" class="form-control-select" style="width: 100%;">
                                <option value="">Select option</option>
                                <option value="contact_pum" 
                                <?php
                                if(isset($data->refer_sur_category)){
                                    if($data->refer_sur_category == 'contact_pum'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Contact (PUM)</option>
                                <option value="suspect"
                                <?php
                                if(isset($data->refer_sur_category)){
                                    if($data->refer_sur_category == 'suspect'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Suspect</option>
                                <option value="probable"
                                <?php
                                if(isset($data->refer_sur_category)){
                                    if($data->refer_sur_category == 'probable'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Probable</option>
                                <option value="confirmed"
                                <?php
                                if(isset($data->refer_sur_category)){
                                    if($data->refer_sur_category == 'confirmed'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Confirmed</option>
                            </select>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <!--
                        <tr>
                            <td colspan="6">
                                Diagnosis/Impression: <small class="text-primary">(Auto search from ICD10)</small>
                                <input type="text" value="" id="icd_code" name="icd_code" readonly><br>
                                <textarea class="form-control" onkeyup="Icd10Checker($(this))" id="diagnosis" rows="4" name="diagnosis" style="resize: none;width: 100%;margin-top: 1%" ></textarea>
                            </td>
                        </tr>
                        -->
                        <tr>
                            <td colspan="6">
                                <span class="text-success">Case Summary (pertinent Hx/PE, including meds, labs, course etc.):</span> </span><br />
                                <textarea class="form-control" name="case_summary" style="resize: none;width: 100%;" rows="7" >{{$data->case_summary}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <span class="text-success">Summary of ReCo (pls. refer to ReCo Guide in Referring Patients Checklist):</span> </span>
                                <br />
                                <textarea class="form-control" name="reco_summary" style="resize: none;width: 100%;" rows="7" >{{$data->reco_summary}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <span class="text-success">
                                    @if(Session::get('auth')->level == 'opcen')
                                        Chief Complaints
                                    @else
                                        Diagnosis/Impression:
                                    @endif
                                </span> <span class="text-red">*</span>
                                <br />
                                <?php
                                      $diag = App\Diagnosis::where('void',0)
                                      ->orderby('id','asc')
                                      ->get();
                                 ?>                               
                                 <!-- <textarea list="diagnosis" class="form-control"  name="diagnosis" style="resize: none;width: 100%;margin-top: 1%" required></textarea> -->
                                <input type='text' value="{{$data->diagnosis}}" list="diagnosis"  name="diagnosis" class="form-control" rows="7" style="resize: none;width: 100%;margin-top: 1%;">
                                <datalist id ="diagnosis">
                                @foreach($diag as $dataa)
                                        <option value="{{ $dataa->diagcode }} {{ $dataa->diagdesc}}"></option>
                                    @endforeach
                                </datalist>
                            </td>
                        </tr>
                        <!--
                        <tr>
                            <td colspan="6">
                                <a class="btn btn-block btn-social btn-google" data-toggle="modal" data-target="#modal-default">
                                    <i class="fa fa-calendar-plus-o"></i> Click here for ICD-10
                                </a>
                            </td>
                        </tr>
                        -->
                        <tr>
                            <td colspan="6">
                                <span class="text-success">Reason for referral:</span> </span>
                                <br />
                                <textarea class="form-control reason_referral" name="reason" style="resize: none;width: 100%;" rows="7" >{{$data->reason}}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <div class="row">
                                    <div class="col-md-5">
                                        <span class="text-success">Preferred Doctor:</span><br>
                                        <small class="text-success">MD/HCW- Mobile Contact # (ReCo)</small>
                                    </div>
                                    <div class="col-md-7">
                                        <select name="reffered_md" class="referred_md form-control-select select2" style="width: 100%">
                                        <option value="{{$data->md_referring}}">{{$data->md_referring}}</option>
                                            <option value="&nbsp;">Any...</option>
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
                    <button type="submit" name="refer_edit_button" class="btn btn-success btn-flat btn-submit"><i class="fa fa-send"></i> Update</button>
                </div>
                <div class="clearfix"></div>
            </div>
    </form>
@elseif($data->type == pregnant)
<form action="{{ url('doctor/refer/updated') }}" method="POST">
            <div class="jim-content">
                @include('include.header_form')
                <div class="title-form">BEmONC/ CEmONC REFERRAL FORM</div>
                <div class="form-group-sm form-inline">
                {{ csrf_field() }}
                <input type="hidden" name="patient_baby_id" class="tracking_id" value="{{$data->patient_baby_id}}" />
                   <input type="hidden" name="tracking_id" class="tracking_id" value="{{$data->tracking_id}}" />
                    <input type="hidden" name="status" class="tracking_id" value="{{$data->status}}" />
                    <input type="hidden" name="type" class="tracking_id" value="{{$data->type}}" />
                    <input type="hidden" name="pregnantform_id" class="pregnantform_id" value="{{$data->pregnantform_id}}" />
                    <input type="hidden" name="patient_id" class="patient_id" value="{{$data->patient_id}}" />
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
                            <td>Record Number: <input type="text" class="form-control" name="record_no" placeholder="" value="<?php echo $data->record_no;?>" /></td>
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
                            <td colspan="4">Accompanied by the Health Worker: <input type="text" value="<?php echo $data->health_worker;?>" class="form-control" name="health_worker" style="width: 50%;" placeholder="Name of Health Worker"/> </td>
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
                                            <option  data-name="{{ $row->name }}" {{ ($data->referred_facility == $row->name ? 'selected' : '') }} value="{{ $row->id }}"> {{ $row->name }}</option>
                                                <!-- <option data-name="{{ $row->name }}" value="{{ $row->id }}">{{ $row->name }}</option> -->
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="referred_department" class="form-control select_department select_department_pregnant" required>
                                        <option value="{{$data->department_id}}">{{$data->department}}</option>
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
                            <input type="text" name="covid_number" style="width: 100%;" value="<?php echo $data->covid_number;?>">
                        </div>
                        <div class="col-md-4">
                            <small >Clinical Status</small><br>
                            <select name="clinical_status" id="" class="form-control-select" style="width: 100%;">
                                <option value="">Select option</option>
                                <option value="asymptomatic"
                                            <?php
                                if(isset($data->refer_clinical_status)){
                                    if($data->refer_clinical_status == 'asymptomatic'){
                                        echo 'selected';
                                    }
                                }
                            ?>
                                >Asymptomatic</option>
                                <option value="mild"
                                <?php
                                if(isset($data->refer_clinical_status)){
                                    if($data->refer_clinical_status == 'mild'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Mild</option>
                                <option value="moderate"
                                <?php
                                if(isset($data->refer_clinical_status)){
                                    if($data->refer_clinical_status == 'moderate'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Moderate</option>
                                <option value="severe"
                                <?php
                                if(isset($data->refer_clinical_status)){
                                    if($data->refer_clinical_status == 'severe'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Severe</option>
                                <option value="critical"
                                <?php
                                if(isset($data->refer_clinical_status)){
                                    if($data->refer_clinical_status == 'critical'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Critical</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Surveillance Category</small><br>
                            <select name="sur_category" id="" class="form-control-select" style="width: 100%;">
                                <option value="">Select option</option>
                                <option value="contact_pum" 
                                <?php
                                if(isset($data->refer_sur_category)){
                                    if($data->refer_sur_category == 'contact_pum'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Contact (PUM)</option>
                                <option value="suspect"
                                <?php
                                if(isset($data->refer_sur_category)){
                                    if($data->refer_sur_category == 'suspect'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Suspect</option>
                                <option value="probable"
                                <?php
                                if(isset($data->refer_sur_category)){
                                    if($data->refer_sur_category == 'probable'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Probable</option>
                                <option value="confirmed"
                                <?php
                                if(isset($data->refer_sur_category)){
                                    if($data->refer_sur_category == 'confirmed'){
                                        echo 'selected';
                                    }
                                }
                            ?>>Confirmed</option>
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
                                    <td colspan="3">Name: {{$data->woman_name}} <span class="text-danger patient_name"></span></td>
                                    <td>Age: {{$data->woman_age}}<span class="text-danger patient_age"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="4">Address:{{$data->address}} <span class="text-danger patient_address"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        Main Reason for Referral
                                        <label><input type="radio" name="woman_reason" value="None" <?php
                                if(isset($data->woman_reason)){
                                    if($data->woman_reason == 'None'){
                                        echo 'checked';
                                    }
                                }
                            ?> /> None </label>
                                        <label><input type="radio" name="woman_reason" value="Emergency" <?php
                                if(isset($data->woman_reason)){
                                    if($data->woman_reason == 'Emergency'){
                                        echo 'checked';
                                    }
                                }
                            ?> /> Emergency </label>
                                        <label><input type="radio" name="woman_reason" value="Non-Emergency" <?php
                                if(isset($data->woman_reason)){
                                    if($data->woman_reason == 'Non-Emergency'){
                                        echo 'checked';
                                    }
                                }
                            ?> /> Non-Emergency </label>
                                        <label><input type="radio" name="woman_reason" value="To accompany the baby" <?php
                                if(isset($data->woman_reason)){
                                    if($data->woman_reason == 'To accompany the baby'){
                                        echo 'checked';
                                    }
                                }
                            ?>  /> To accompany the baby </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Major Findings (Clinical and BP,Temp,Lab)
                                        <br />
                                        <textarea class="form-control" name="woman_major_findings" style="resize: none;width: 100%" rows="5" required>{{$data->woman_major_findings}}</textarea>
                                    </td>
                                </tr>
                                <tr class="bg-gray">
                                    <td colspan="4">Treatments Give Time</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Before Referral
                                        <br />
                                        <input type="text" class="form-control" name="woman_before_treatment" placeholder="Treatment Given" value="<?php echo $data->woman_before_treatment ?> " />
                                        <input type="text" class="form-control form_datetime" name="woman_before_given_time" placeholder="Date/Time Given" value="<?php echo $data->woman_before_given_time?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">During Transport
                                        <br />
                                        <input type="text" class="form-control" name="woman_during_treatment" placeholder="Treatment Given" value="<?php echo $data->woman_during_transport?> "  />
                                        <input type="text" class="form-control form_datetime" name="woman_during_given_time" placeholder="Date/Time Given"  value="<?php echo $data->woman_transport_given_time?> "/>
                            
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Information Given to the Woman and Companion About the Reason for Referral
                                        <br />
                                        <textarea class="form-control woman_information_given" name="woman_information_given" style="resize: none;width: 100%" rows="5" required>{{$data->woman_information_given}}</textarea>
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
                                    <td colspan="2">Name : {{$baby->baby_name}}<br />
                                        <input type="text" class="form-control" style="width: 100%" name="baby_fname" placeholder="First Name" value="<?php echo $baby->b_fname ?> " /><br />
                                        <input type="text" class="form-control" style="width: 100%" name="baby_mname" placeholder="Middle Name" value="<?php echo $baby->b_mname ?> "  /><br />
                                        <input type="text" class="form-control" style="width: 100%" name="baby_lname" placeholder="Last Name" value="<?php echo $baby->b_lname ?> "  />
                                    </td>
                                    <td style="vertical-align: top !important;">Date and Hour of Birth:
                                        <br />
                                        <input type="text" class="form-control  form_datetime" style="width: 100%" name="baby_dob" placeholder="Date/Time" value="<?php echo $baby->baby_dob ?> " /><br />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Birth Weight: <input type="text" class="form-control" style="width: 100%" name="baby_weight" placeholder="kg or lbs" value="<?php echo $baby->weight ?> " /><br /></td>
                                    <td>Gestational Age: <input type="text" class="form-control" style="width: 100%" name="baby_gestational_age" placeholder="age" value="<?php echo $baby->gestational_age ?>" /><br /></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        Main Reason for Referral
                                        <label><input type="radio" name="baby_reason" value="None" 
                                                    <?php
                                            if(isset($baby->baby_reason)){
                                                if($baby->baby_reason == 'None'){
                                                    echo 'checked';
                                                }
                                            }
                                        ?>/> None </label>
                                        <label><input type="radio" name="baby_reason" value="Emergency" <?php
                                if(isset($baby->baby_reason)){
                                    if($baby->baby_reason == 'Emergency'){
                                        echo 'checked';
                                    }
                                }
                            ?> /> Emergency </label>
                                        <label><input type="radio" name="baby_reason" value="Non-Emergency" <?php
                                if(isset($baby->baby_reason)){
                                    if($baby->baby_reason == 'Non-Emergency'){
                                        echo 'checked';
                                    }
                                }
                            ?> /> Non-Emergency </label>
                                        <label><input type="radio" name="baby_reason" value="To accompany the mother" <?php
                                if(isset($baby->baby_reason)){
                                    if($baby->baby_reason == 'To accompany the mother'){
                                        echo 'checked';
                                    }
                                }
                            ?> /> To accompany the mother </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Major Findings (Clinica and BP,Temp,Lab)
                                        <br />
                                        <textarea class="form-control" name="baby_major_findings" style="resize: none;width: 100%" rows="5">{{$baby->baby_major_findings}}</textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Last (Breast) Feed (Time): <input type="text" class="form-control form_datetime" style="width: 100%" name="baby_last_feed" placeholder="Date/Time" value="<?php echo $baby->baby_last_feed ?>" /><br /></td>
                                </tr>
                                <tr class="bg-gray">
                                    <td colspan="4">Treatments Give Time</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Before Referral
                                        <br />
                                        <input type="text" class="form-control" name="baby_before_treatment" placeholder="Treatment Given" value="<?php echo $baby->baby_before_treatment ?>" />
                                        <input type="text" class="form-control form_datetime" name="baby_before_given_time" placeholder="Date/Time Given" value="<?php echo $baby->baby_before_given_time ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">During Transport
                                        <br />
                                        <input type="text" class="form-control" name="baby_during_treatment" placeholder="Treatment Given" value="<?php echo $baby->baby_during_transport ?>" />
                                        <input type="text" class="form-control form_datetime" name="baby_during_given_time" placeholder="Date/Time Given" value="<?php echo $baby->baby_transport_given_time ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Information Given to the Woman and Companion About the Reason for Referral
                                        <br />
                                        <textarea class="form-control" name="baby_information_given" style="resize: none;width: 100%" rows="5">{{$baby->baby_information_given}}</textarea>
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
                    <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-send"></i> Update</button>
                </div>
                <div class="clearfix"></div>
            </div>
            </form>
@endif


<script>

     var FromEndDate = new Date();
    $('.form_datetime').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        minuteStep: 2,
        endDate: FromEndDate,
        endTime: FromEndDate,
        changeYear: true,
        defaultViewDate: {year: '2021'}
        
    });
       $(".select2").select2({ width: '100%' });
    var referred_facility = 0;
    var referring_facility = "{{ $user->facility_id }}";
    var referred_facility = '';
    var referring_facility_name = $(".referring_name").val();
    var patient_form_id = 0;
    var referring_md = "{{ $user->fname }} {{ $user->mname }} {{ $user->lname }}";
    var name,
        age,
        sex,
        address,
        form_type,
        reason,
        patient_id,
        civil_status,
        phic_status,
        phic_id,
        department_id,
        department_name;


    $('.select_facility').on('change',function(){
        var id = $(this).val();
        referred_facility = id;
        var url = "{{ url('location/facility/') }}";
        $.ajax({
            url: url+'/'+id,
            type: 'GET',
            success: function(data){
                /*$.get("<?php echo asset('inventory/append').'/'; ?>"+data.facility_id,function(inventory_body){
                    $(".inventory_body").html(inventory_body);
                });*/
                $('.facility_address').html(data.address);

                $('.select_department').empty()
                    .append($('<option>', {
                        value: '',
                        text : 'Select Department...'
                    }));
                jQuery.each(data.departments, function(i,val){
                    $('.select_department').append($('<option>', {
                        value: val.id,
                        text : val.description
                    }));

                });
            },
            error: function(error){
                //$('#serverModal').modal();
            }
        });
    });

    $('.select_department').on('change',function(){
        var id = $(this).val();
        var list = "{{ url('list/doctor') }}";
        if(referred_facility==0){
            referred_facility = "{{ $user->facility_id }}";
        }
        $.ajax({
            url: list+'/'+referred_facility+'/'+id,
            type: 'GET',
            success: function(data){
                $('.referred_md').empty()
                    .append($('<option>', {
                        value: '',
                        text : 'Any...'
                    }));
                jQuery.each(data, function(i,val){
                    $('.referred_md').append($('<option>', {
                        value: val.id,
                        text : 'Dr. '+val.fname+' '+val.mname+' '+val.lname+' - '+val.contact
                    }));

                });
            },
            error:function(){
                $('#serverModal').modal();
            }
        });
    });
  
                </script>