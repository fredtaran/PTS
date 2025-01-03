<div class="modal fade" role="dialog" id="upload_modal" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
         <div class="modal-body upload_body">
             
            </div><!-- /.modal-content -->
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
                        <select name="delivery_outcome" class="form-control-select select2" required>
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
                        <select name="birth_attendant" class="form-control-select select2" required>
                            <option value="">Select Attendant...</option>
                            <option value="md">MD</option>
                            <option value="rn">RN</option>
                            <option value="rm">RM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="padding: 0px">Status on Discharge:</label>
                        <br />
                        <select name="status_on_discharge" class="form-control-select select2" required>
                            <option value="">Select Status...</option>
                            <option value="expired">Expired</option>
                            <option value="improved">Improved</option>
                            <option value="hama">HAMA</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="padding: 0px">Type of Delivery: </label>
                        <br />
                        <select name="type_of_delivery" class="form-control-select select2" required>
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
                                                        ->orderby('id', 'asc')
                                                        ->get();
                        ?>

                        <label> Final Diagnosis with ICD 10 code:   </label> 
                        <br />  
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
                            <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
                            
                            <select name="final_diagnosis[]" id="choices-multiple-remove-button" class="form-control" style="width: 100%" required multiple>
                                @foreach($data as $dataa)
                                    <option value="{{ $dataa->id }}">{{ $dataa->diagcode }} {{ $dataa->diagdesc}}</option>
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

<div class="modal fade" id="munisearchModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Search Patient</h4>
            </div>
            <form id="munisearchForm" method="POST">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="input-group input-group-lg">
                        <input type="text" id="patient_keyword" class="form-control">
                        <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" onclick="searchPatient()">Go!</button>
                        </span>
                    </div><br>
                    <div class="search_body"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    function searchPatient(){
        $(".search_body").html(loading);
        var url = "<?php echo asset('patient/search'); ?>";
        var json = {
            "_token" : "<?php echo csrf_token(); ?>",
            "patient_keyword" : $("#patient_keyword").val()
        };
        $.post(url,json,function(result){
            setTimeout(function(){
                if($("#patient_keyword").val()){
                    $(".search_body").html(result);
                } else {
                    $(".search_body").html("");
                }

            },500);
        });
    }
</script>