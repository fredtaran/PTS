<?php
$user = Auth::user();
$myfacility = \App\Models\Facility::find($user->facility_id);
$facility = \App\Http\Controllers\LocationCtrl::facilityAddress($myfacility->id);
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
                <div class="title-form">CENTER OF HEALTH DEVELOPMENT Northern Mindanao REGION REFERRAL SYSTEM<br /><small>Clinical Referral Form</small></div>

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

                    <tr>
                        <td colspan="6">
                            Summary of ReCo (pls. refer to ReCo Guide in Referring Patients Checklist):
                            <br />
                            <span class="reco_summary"></span>
                        </td>
                    </tr>

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

                <div class="pull-right">
                    <a href="{{ url('doctor/print/form') }}" target="_blank" class="btn-refer-normal btn btn-success btn-flat"><i class="fa fa-print"></i> Print Form</a>
                    <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" role="dialog" id="pregnantFormModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="jim-content">
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
                        <td colspan="2">Name of referring MD/HCW: <span class="md_referring"></span></td>
                        <td colspan="2">Arrival Date: <span class="arrival_date"></span></td>
                    </tr>

                    <tr>
                        <td colspan="4">Contact # of referring MD/HCW: <span class="referring_md_contact"></span></td>
                    </tr>

                    <tr>
                        <td colspan="4">Referring Facility: <span class="referring_facility"></span></td>
                    </tr>

                    <tr>
                        <td colspan="4">Facility Contact #: <span class="referring_contact"></span></td>
                    </tr>

                    <tr>
                        <td colspan="4">Accompanied by the Health Worker: <span class="health_worker"></span></td>
                    </tr>

                    <tr>
                        <td colspan="2">Referred To: <span class="referred_name"></span></td>
                        <td colspan="2">Department: <span class="department_name"></span></td>
                    </tr>

                    <tr>
                        <td colspan="4">Address: <span class="referred_address"></span></td>
                    </tr>
                </table>

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

                <div class="clearfix"></div>

                <hr />
                
                <div class="pull-right">
                    <a href="{{ url('doctor/print/form') }}" target="_blank" class="btn-refer-pregnant btn btn-success btn-flat"><i class="fa fa-print"></i> Print Form</a>
                    <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                </div>

                <div class="clearfix"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->