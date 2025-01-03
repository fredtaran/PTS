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
<div class="modal fade" role="dialog" id="vitalModal" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ url('doctor/patient') }}" method="POST" class="form-submit">
            <div class="jim-content">
                <div style="margin-left: 58%;margin-top:10%;position: absolute;font-size: 8pt;background-color: white;" class="inventory_body">

                </div>
                @include('include.header_form')
                <center>
                    <h2>Vital Signs Form</h2>
                </center>
                <div class="form-group-sm form-inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="patient_id" class="patient_id" value="" />
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
                            <span class="patient_name"></span>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Address</small><br>
                            <span class="patient_address"></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-success">Referred to</small> <span class="text-red">*</span><br>
                            <select name="referred_facility" class="select2 select_facility" required>
                                <option value="">Select Facility...</option>
                                @foreach($facilities as $row)
                                    <option data-name="{{ $row->name }}" value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Department</small> <span class="text-red">*</span><br>
                            <select name="referred_department" class="form-control-select select_department select_department_normal" style="width: 100%;" required>
                                <option value="">Select Option</option>
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
                            <span class="patient_age"></span>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Sex</small> <span class="text-red">*</span><br>
                            <select name="patient_sex" class="patient_sex form-control" style="width: 100%;" required>
                                <option value="">Select...</option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Civil Status</small> <span class="text-red">*</span><br>
                            <select name="civil_status" style="width: 100%;" class="civil_status form-control" required>
                                <option value="">Select...</option>
                                <option>Single</option>
                                <option>Married</option>
                                <option>Divorced</option>
                                <option>Separated</option>
                                <option>Widowed</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <small class="text-success">Covid Number</small><br>
                            <input type="text" name="covid_number" style="width: 100%;">
                        </div>
                        <div class="col-md-4">
                            <small class="text-success">Clinical Status</small><br>
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
                            <small class="text-success">Surveillance Category</small><br>
                            <select name="sur_category" id="" class="form-control-select" style="width: 100%;">
                                <option value="">Select option</option>
                                <option value="contact_pum">Contact (PUM)</option>
                                <option value="suspect">Suspect</option>
                                <option value="probable">Probable</option>
                                <option value="confirmed">Confirmed</option>
                            </select>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <!--
                        <tr>
                            <td colspan="6">
                                Diagnosis/Impression: <small class="text-primary">(Auto search from ICD10)</small>
                                <input type="text" value="" id="icd_code" name="icd_code" readonly><br>
                                <textarea class="form-control" onkeyup="Icd10Checker($(this))" id="diagnosis" rows="4" name="diagnosis" style="resize: none;width: 100%;margin-top: 1%" required></textarea>
                            </td>
                        </tr>
                        -->
                        <tr>
                            <td colspan="6">
                                <span class="text-success">Case Summary (pertinent Hx/PE, including meds, labs, course etc.):</span> <span class="text-red">*</span><br />
                                <textarea class="form-control" name="case_summary" style="resize: none;width: 100%;" rows="7" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <span class="text-success">Summary of ReCo (pls. refer to ReCo Guide in Referring Patients Checklist):</span> <span class="text-red">*</span>
                                <br />
                                <textarea class="form-control" name="reco_summary" style="resize: none;width: 100%;" rows="7" required></textarea>
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
                                <textarea class="form-control" rows="7" name="diagnosis" style="resize: none;width: 100%;margin-top: 1%" required></textarea>
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
                                <span class="text-success">Reason for referral:</span> <span class="text-red">*</span>
                                <br />
                                <textarea class="form-control reason_referral" name="reason" style="resize: none;width: 100%;" rows="7" required></textarea>
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

<div class="modal fade" role="dialog" id="patient_modal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body patient_body">
                <center>
                    <img src="{{ asset('img/loading.gif') }}" alt="">
                </center>
            </div><!-- /.modal-content -->
        </div>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Search ICD-10 by keyword</h4>
            </div>
            <div class="modal-body">
                <div class="input-group input-group-lg">
                    <input type="text" id="icd10_keyword" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" onclick="searchICD10()">Go!</button>
                    </span>
                </div><br>
                <div class="icd_body"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    function searchICD10(){
        $(".icd_body").html(loading);
        var url = "<?php echo asset('icd/search'); ?>";
        var json = {
            "_token" : "<?php echo csrf_token(); ?>",
            "icd_keyword" : $("#icd10_keyword").val()
        };
        $.post(url,json,function(result){
            setTimeout(function(){
                if($("#icd10_keyword").val()){
                    $(".icd_body").html(result);
                } else {
                    $(".icd_body").html("");
                }

            },500);
        });
    }
</script>
