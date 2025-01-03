<?php
use App\VitalSigns;
use App\PhysicalExam;
use App\User;



$vital = 'vital';
$pexam = 'pexam';
$date= date('Y-m-d H:i:s');
$user = Session::get('auth');
$fac_id = $user->facility_id;
$vital_data = VitalSigns::where('patient_id',$row->id)
                ->where('void',1)
                ->orderBy('id','desc')
                ->get();
$administered_by = User::where('facility_id',$fac_id)
                ->where('level','!=','admin')
                ->where('level','!=','support')->get();
?>

<div class="modal fade" role="dialog" id="addvitalModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-user-secret"></i> SELECT OPTION
            </div>
            <div class="modal-body">
               
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item active">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Vital Signs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Physical Examination</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                  <form action="{{ url('doctor/addvital') }}" method="POST" class="form-submit ">
                <div class="jim-content">
                    <div style="margin-left: 58%;margin-top:10%;position: absolute;font-size: 8pt;background-color: white;">

                    </div>
                    <center>
                        <h2>Vital Signs Form</h2>

      
                    </center>
                    <div class="form-group-sm form-inline">
                        {{ csrf_field() }}
                        <small class="text-success">Consultation Date:</small><br>
                        <input type="datetime-local" id="consultation_date" name="consultation_date" style="width: 30%;" value="<?php echo date('Y-m-d\Th:i'); ?>" >
                        <input type="hidden" name="patient_id" class="patient_id" value="{{$patient_id}}" />
                        <input type="hidden" id="vital_id" name="vital_id"/>
                        <input type="hidden" name="type" value="{{$vital}}" />
                        <input type="hidden" name="source" value="{{ $source }}" />
                        <input type="hidden" class="referring_name" value="{{ $myfacility->name }}" />
                        <br>
                        <div class="row">
                            <div class="col-md-2">
                                <small class="text-success">Systolic:</small><br>
                                <input type="text" id="bps" name="bps" style="width: 100%;" placeholder = "-- mmHG -- ">
                            </div>
                            <div class="col-md-2">
                                <small class="text-success">Diastolic:</small><br>
                                <input type="text" id="bpd" name="bpd" style="width: 100%;" placeholder = "-- mmHG -- ">
                            </div>
                            <div class="col-md-3" style="margin-left:80px;">
                                <small class="text-success">Respirator Rate</small><br>
                                <input type="text" id="respiratory_rate" name="respiratory_rate" style="width: 100%;" placeholder = "-- cpm -- ">
                            </div>
                            <div class="col-md-3">
                            <small class="text-success">Body Temperature</small><br>
                                <input type="text" id="body_temperature" name="body_temperature" style="width: 100%;" placeholder = "-- C -- ">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            
                            <div class="col-md-3">
                            <small class="text-success">Heart Rate</small><br>
                                <input type="text" id="heart_rate" name="heart_rate" style="width: 100%;" placeholder = "">
                            </div>
                            <div class="col-md-3">
                                <small class="text-success">Normal Rate:</small><br>
                                <label>
                                    <input type="radio" id ="normal_rate" name="normal_rate" value="Yes"/>Yes
                                </label>
                                <label>
                                    <input type="radio" id ="normal_rate" name="normal_rate" value="No"/>No
                                </label>
                            </div>
                            <div class="col-md-3">
                            <small class="text-success">Regular Rhythm:</small><br>
                                <label>
                                    <input type="radio" id="regular_rhythm" name="regular_rhythm" value="Yes"/>Yes
                                </label>
                                <label>
                                    <input type="radio" id="regular_rhythm" name="regular_rhythm" value="No"/>No
                                </label>
                            </div>
                            <div class="col-md-3">
                            <small class="text-success">Pulse Rate: </small><br>
                                <input type="text" id="pulse_rate" name="pulse_rate" style="width: 100%;" placeholder = "-- bm --">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3">
                            <small class="text-success">Oxygen Saturation: </small><br>
                                <input type="text" id="oxygen_saturation" name="oxygen_saturation" style="width: 100%;" placeholder = "">
                            </div>
                            <div class="col-md-3">
                                <small class="text-success">Administered By:</small><br>
                                <select id="administered_by" name="administered_by" class="form-control" style="width: 100%;" >
                                    <option value ="">Select...</option>
                                    @foreach($administered_by as $row)
                                        <option data-name="{{ $row->fname }}" value="{{ $row->id }}">{{ $row->fname }} {{ $row->mname }} {{ $row->lname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                            <span class="text-success">Remarks :<br />
                                    <textarea class="form-control" id="remarks" name="remarks" style="resize: none;width: 100%;" rows="3" ></textarea>
                            </div> 
                        </div>
                        
                        <br>
                    </div>

                    <div class="form-fotter pull-right">
                    
                        <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Back</button>
                        <button type="submit" name="vital_submit_btn" class="btn btn-success btn-flat btn-submit"><i class="fa fa-send"></i> Submit</button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                </form> 
                <div class="table-responsive">
                    <table class="table table-striped"  style="white-space:nowrap;">
                        <tbody>
                        <tr>
                            <th>Systolic/Diastolic</th>
                            <th>Respirator Rate</th>
                            <th>Body Temperature</th>
                            <th>Heart Rate</th>
                            <th>Pulse Rate</th>
                            <th>Consultation Date</th>
                            <th>Action</th>
                        </tr>
                     @foreach($vital_data as $data)
                        <tr>
                            <td>
                            {{ $data->bps}} / {{ $data->bpd}}     
                            </td>
                            <td>
                            {{ $data->respiratory_rate}}
                            </td>
                            <td>
                            {{ $data->body_temperature}}
                            </td>
                            <td>
                            {{ $data->heart_rate}}
                            </td>
                            <td>
                            {{ $data->pulse_rate}}
                            </td>
                            <td>
                                <?php
                                    $cons_date = date("Y-m-d h:i A", strtotime($data->consultation_date));
                                ?>
                            {{ $cons_date }}
                            </td>
                            <td>
                                  <a href=""
                                       data-toggle="modal"
                                       data-id = "{{ $data->id }}"
                                       onclick="vitalId('<?php echo $data->id ?>')"
                                       class="btn btn-info btn-xs">
                                       <i class="fa fa-edit"></i>
                                       Edit
                                    </a>
                                    <a href=""
                                       onclick="removeId('<?php echo $data->id ?>')"
                                       class="btn btn-danger btn-xs">
                                        <i class="fa fa-minus-circle"></i>
                                        Remove
                                    </a>
                            </td>
                        </tr>
                      @endforeach
                        </tbody>
                        <button class="btn btn-default btn-flat" onclick="clearBtn()" id="clear_btn"><i class="fa fa-times"></i> Clear table</button> 
                    </table>
                </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                  <form action="{{ url('doctor/addvital') }}" method="POST" class="form-submit">
            <div class="jim-content">
                <div style="margin-left: 58%;margin-top:10%;position: absolute;font-size: 8pt;background-color: white;">
                </div>  
                <center>
                    <h2>Physical Examination Form</h2>
                </center>
                <div class="form-group-sm form-inline">
                    {{ csrf_field() }}
                    <input type="hidden" name="patient_id" class="patient_id" value="" />
                    <input type="hidden" name="date_referred" class="date_referred" value="{{ date('Y-m-d H:i:s') }}" />
                    <input type="hidden" name="type" value="{{$pexam}}" />
                    <input type="hidden" name="source" value="{{ $source }}" />
                    <input type="hidden" class="referring_name" value="{{ $myfacility->name }}" />
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                               <div class="col-md-3">
                                 <small class="text-success">Heigth:</small><br>
                                <input type="text" name="heigth" style="width: 100%;" placeholder = "" width="100%">
                                </div>
                                <div class="col-md-3">
                                <small class="text-success">Weigth:</small><br>
                                <input type="text" name="weigth" style="width: 100%;" placeholder = "" width="100%">
                                </div>
                        </div>
                        <div class="col-md-6">
                                 <span class="text-success">Head :</span> <span class="text-red">*</span><br />
                                <textarea class="form-control" name="head" style="resize: none;width: 100%;" rows="7" ></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-6">
                             <small class="text-success">Conjunctiva (eye anatomy): </small><br>
                                <label>
                                    <input type="checkbox" name="conjunctiva[]" value="Pale"/>Pale
                                </label>
                                <label>
                                    <input type="checkbox" name="conjunctiva[]" value="Yellowish"/>Yellowish
                                </label>
                        </div>
                       <div class="col-md-6">
                        <span class="text-success">Conjunctiva Remarks :</span> <span class="text-red">*</span><br />
                                <textarea class="form-control" name="conjunctiva_remarks" style="resize: none;width: 100%;" rows="7" ></textarea>
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-6">
                        <small class="text-success">Neck (eye anatomy): </small><br>
                                <label>
                                    <input type="checkbox" name="neck[]" value="Enlarged lymph nodes"/>Enlarged lymph nodes
                                </label>
                                <label>
                                    <input type="checkbox" name="neck[]" value="Enlarged thyroid"/>Enlarged thyroid
                                </label>
                        </div>
                        <div class="col-md-6">
                            <span class="text-success">Chest: </span> <span class="text-red">*</span><br />
                                    <textarea class="form-control" name="chest" style="resize: none;width: 100%;" rows="7" ></textarea>
                            </div>
                          
                    </div>
                    <br>
                    <div class="row">
                         <div class="col-md-6">
                            <small class="text-success">Breast: </small><br>
                                    <label>
                                        <input type="checkbox" name="breast[]" value="Enlarged axillary lymph nodes"/>Enlarged axillary lymph nodes
                                    </label>
                                    <label>
                                        <input type="checkbox" name="breast[]" value="Mass"/>Mass
                                    </label>
                                    <label>
                                        <input type="checkbox" name="breast[]" value="Nipple Discharge"/>Nipple Discharge
                                    </label>
                                    <label>
                                        <input type="checkbox" name="breast[]" value="Skin orange peel or dimpling"/>Skin orange peel or dimpling
                                    </label>
                         </div>
                         <div class="col-md-6">
                            <span class="text-success">Breast Remarks: </span> <span class="text-red">*</span><br />
                                    <textarea class="form-control" name="breast_remarks" style="resize: none;width: 100%;" rows="7" ></textarea>
                            </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                                <small class="text-success">Thorax: </small><br>
                                        <label>
                                            <input type="checkbox" name="thorax[]" value="Abnormal breath sounds/respiratory rate"/>Abnormal breath sounds/respiratory rate
                                        </label>
                                        <label>
                                            <input type="checkbox" name="thorax[]" value="Abnormal heart sounds/cardiac rate"/>Abnormal heart sounds/cardiac rate
                                        </label>
                            </div>
                         <div class="col-md-6">
                            <span class="text-success">Thorax Remarks: </span> <span class="text-red">*</span><br />
                                    <textarea class="form-control" name="thorax_remarks" style="resize: none;width: 100%;" rows="7" ></textarea>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                                <small class="text-success">Abdomen: </small><br>
                                        <label>
                                            <input type="checkbox" name="abdomen[]" value="Enlarged liver"/>Enlarged liver
                                        </label>
                                        <label>
                                            <input type="checkbox" name="abdomen[]" value="Mass"/>Mass
                                        </label>
                                        <label>
                                            <input type="checkbox" name="abdomen[]" value="Scar"/>Scar
                                        </label>
                                        <label>
                                            <input type="checkbox" name="abdomen[]" value="Tenderness"/>Tenderness
                                        </label>
                            </div>
                         <div class="col-md-6">
                            <span class="text-success">Abdomen Remarks: </span> <span class="text-red">*</span><br />
                                    <textarea class="form-control" name="abdomen_remarks" style="resize: none;width: 100%;" rows="7" ></textarea>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                                <small class="text-success">Genitals: </small><br>
                                        <label>
                                            <input type="checkbox" name="genitals[]" value="Bleeding"/>Bleeding
                                        </label>
                                        <label>
                                            <input type="checkbox" name="genitals[]" value="Cyst/Mass"/>Cyst/Mass
                                        </label>
                                        <label>
                                            <input type="checkbox" name="genitals[]" value="Discharges"/>Discharges
                                        </label>
                                        <label>
                                            <input type="checkbox" name="genitals[]" value="Laceration"/>Laceration
                                        </label>
                                        <label>
                                            <input type="checkbox" name="genitals[]" value="Scars"/>Scars
                                        </label>
                                        <label>
                                            <input type="checkbox" name="genitals[]" value="Warts"/>Warts
                                        </label>
                            </div>
                            <div class="col-md-6">
                            <span class="text-success">Genitals Remarks: </span> <span class="text-red">*</span><br />
                                    <textarea class="form-control" name="genitals_remarks" style="resize: none;width: 100%;" rows="7" ></textarea>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                                <small class="text-success">Extremities: </small><br>
                                        <label>
                                            <input type="checkbox" name="extremities[]" value="Edema"/>Edema
                                        </label>
                                        <label>
                                            <input type="checkbox" name="extremities[]" value="Gross Deformity"/>Gross Deformity
                                        </label>
                                        <label>
                                            <input type="checkbox" name="extremities[]" value="Varicosities"/>Varicosities
                                        </label>
                                        <label>
                                            <input type="checkbox" name="extremities[]" value="Full and Equal Pulses"/>Full and Equal Pulses
                                        </label>
                                        <label>
                                            <input type="checkbox" name="extremities[]" value="Normal Gait"/>Normal Gait
                                        </label>
                                        <label>
                                            <input type="checkbox" name="extremities[]" value="Pain or Forced Dorsiflexion"/>Pain or Forced Dorsiflexion
                                        </label>
                            </div>
                            <div class="col-md-6">
                            <span class="text-success">Extremities Remarks: </span> <span class="text-red">*</span><br />
                                    <textarea class="form-control" name="extremities_remarks" style="resize: none;width: 100%;" rows="7" ></textarea>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-4">
                                  <span class="text-success">Others: </span> <span class="text-red">*</span><br />
                                    <textarea class="form-control" name="others" style="resize: none;width: 100%;" rows="7" ></textarea>
                            </div>
                            <div class="col-md-4">
                                <small class="text-success">Waist Circumference:</small><br>
                                    <input type="text" name="waist_circumference" style="width: 100%;" placeholder = "">
                            </div>
                            <div class="col-md-4">
                                <small class="text-success">Administered By:</small><br>
                                <select name="administered_by" class="form-control" style="width: 100%;" >
                                    @foreach($administered_by as $row)
                                        <option data-name="{{ $row->fname }}" value="{{ $row->id }}">{{ $row->fname }} {{ $row->mname }} {{ $row->lname }}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                </div>
                <hr />
                <div class="form-fotter pull-right">
                    <button class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Back</button>
                    <button type="submit" class="btn btn-success btn-flat btn-submit"><i class="fa fa-send"></i> Submit</button>
                </div>
                <div class="clearfix"></div>
            </div>
            </form> 
                  </div>
                  
                </div>
              </div>
              <!-- /.card -->
            </div>


            </div>
            <div class="modal-footer"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>


function removeId(vital_id){
    $.ajax({
        url: "{{ url('doctor/patient/vital/remove') }}/"+vital_id,
        type: "GET",
        success: function(record){
            var message = record.message
            Lobibox.notify('success', {
            title: "",
            msg: message,
            sleep: 150000,
            size: 'mini',
            rounded: true
        });
        },
        error: function(){
            $('#serverModal').modal();
        }
     });

    }

    function clearBtn()
    {
         $('#vital_id').val("");
           $('#bps').val("");
           $('#bpd').val("");
           $('#respiratory_rate').val("");
           $('#body_temperature').val("");
           $('#heart_rate').val("");
           $('#pulse_rate').val("");
           $('#oxygen_saturation').val("");
           $("input[name=time]").val("");
           $('#administered_by').val("");
           $("#remarks").val("");
           $('input[name="normal_rate"]').prop('checked', false);
           $('input[name="regular_rhythm"]').prop('checked', false);
    }

  function vitalId(vital_id){
      
    $.ajax({
        url: "{{ url('doctor/patient/vital/') }}/"+vital_id,
        type: "GET",
        success: function(record){
           var data = record.data;

           var now = new Date(data.consultation_date);
            var day = now.getDate() < 10 ? "0" + now.getDate() : now.getDate();
            var month = now.getMonth() < 10 ? "0" + (now.getMonth() + 1) : (now.getMonth() + 1);
            var hrs = now.getHours() < 10 ? "0" + now.getHours(): now.getHours();
            var min = now.getMinutes() < 10 ? "0" + now.getMinutes(): now.getMinutes();
         

            var today = now.getFullYear()+"-"+(month)+"-"+(day)+"T"+(hrs)+":"+(min) ;
            console.log(today)
           $('#vital_id').val(data.id);
           $('#bps').val(data.bps);
           $('#bpd').val(data.bpd);
           $('#respiratory_rate').val(data.respiratory_rate);
           $('#body_temperature').val(data.body_temperature);
           $('#heart_rate').val(data.heart_rate);
           $('input[name=normal_rate][value=" + data.normal_rate + "]').prop('checked', true);
           $('input[name=regular_rhythm][value=" + data.regular_rhythm + "]').prop('checked', true);
           $('#pulse_rate').val(data.pulse_rate);
           $('#oxygen_saturation').val(data.oxygen_saturation);
           $('#administered_by').val(data.administered_by);
          // $('#consultation_date').val(d.getFullYear()+"-"+zeroPadded(d.getMonth() + 1)+"-"+zeroPadded(d.getDate())+"T"+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());
          $('#consultation_date').val(today)
           $("#remarks").val(data.remarks);
        },
        error: function(){
            $('#serverModal').modal();
        }
    });
    }
    
</script>
