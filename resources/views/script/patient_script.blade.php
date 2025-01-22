<script>
    $(document).ready(function() {
        $('#munisearchForm').on('submit', function(e) {
            $('.loading').show();
            e.preventDefault();
            var url = "{{ url('doctor/patient/request/') }}";
            $(this).ajaxSubmit({
                url: url,
                type: 'POST',
                success: function(data){
                    // setTimeout(function(){
                    //     window.location.reload(true);
                    // },500);
                },
                error: function(){
                    $('#serverModal').modal();
                }
            });
        });

        $('body').on('click','.upload_code', function() {
            var code = $(this).data('code');
            var url = "<?php echo asset('doctor/upload_body'); ?>";
            var json = {
                "code" : code,
                "_token" : "<?php echo csrf_token(); ?>"
            };

            $.post(url,json,function(result){
                $(".upload_body").html(result);
            });
        });

        $('body').on('click','.btn-action', function() {
            code = $(this).data('code');
            patient_name = $(this).data('patient_name');
            track_id = $(this).data('track_id');
            unique_id = $(this).data('unique_id');
        });

        $('#dischargeForm2').on('submit', function(e) {
            $('.loading').show();
            e.preventDefault();
            var remarks = $(this).find('.remarks').val();

            $(this).ajaxSubmit({
                url: "{{ url('doctor/referral/discharge/') }}/" + track_id + "/" + unique_id,
                type: 'POST',
                success: function(data) {
                    setTimeout(function() {
                        window.location.reload(false);
                    }, 500);
                },
                error: function() {
                    $('#serverModal').modal();
                }
            });
        });

        @if(Session::get('upload_file'))
            Lobibox.notify('success', {
                title: "",
                msg: "<?php echo Session::get("upload_file_message"); ?>",
                size: 'mini',
                rounded: true,
                sound: false
            });

            $('#upload_modal').modal('show');

            var code = "<?php echo Session::get("unique_referral_code"); ?>"
            var url = "<?php echo asset('doctor/upload_body'); ?>"

            var json = {
                "code" : code,
                "_token" : "<?php echo csrf_token(); ?>"
            };

            $.post(url,json,function(result){
                $(".upload_body").html(result);
            });

            <?php
                Session::put("upload_file",false);
                Session::put("upload_file_message",false)
            ?>
        @endif

        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount:10,
            searchResultLimit:10,
            renderChoiceLimit:10,
        }); 

        $(".return_date_of_visit").inputmask("mm/dd/yyyy");
        $(".lmp_date_return").inputmask("mm/dd/yyyy");  

        $(".add_lmp_date").inputmask("mm/dd/yyyy");
        $(".add_date_of_visit").inputmask("mm/dd/yyyy");

        $(".new_refer_date_of_visit").inputmask("mm/dd/yyyy");
        $(".new_refer_lmp_date").inputmask("mm/dd/yyyy");

        $(document).on("click",".btn_add_diag", function(e){
            e.preventDefault();
            var markup = "<span><input list='diagnosis' name='diagnosis[]' class='form-control' rows='7' style='resize: none;width: 90%;'><datalist id = 'diagnosis'>@foreach($data as $dataa)<option value='{{ $dataa->diagcode }} {{ $dataa->diagdesc}}'></option>@endforeach</datalist><input class='checkbox' type='checkbox'></span>";
            $(".add_col").append(markup);
        });

        $(document).on("click",".btn_delete_diag", function(e) {
            var val = []; 
            e.preventDefault(); 
            $(':checkbox:checked').each(function(i) {
                val[i] = $(this).val();
                if($(this).val() == "on") {
                    $(this).parents("span").remove();
                }
            });
        });

        $("#pregnantFormModalTrack").on("hidden.bs.modal", function () {
            $('.new_blood_type').val(null).trigger('change');
            $('.new_hbsag_result').val(null).trigger('change');
            $('.new_vdrl_result').val(null).trigger('change');
            document.getElementById("pregnant_form_new").reset();
        });

        $("#pregnantAddData").on("hidden.bs.modal", function () {
            document.getElementById("pregnant_add_form").reset();
        });

        $("#patientReturnModal").on("hidden.bs.modal", function () {
            document.getElementById("pregnant_form_return").reset();
        });

        $('#RefferedpregnantFormModalTrack').on('hidden.bs.modal', function () {
            $('.pregnant_modal_content').load(document.URL +  ' .pregnant_modal_content');
        })

        $(document).on("click", ".new_btn_add_lab", function(e) {
            e.preventDefault();
            var markup = '<tr><td> <input type="text" class="form-control date_of_lab" placeholder="mm/dd/yyyy" name="date_of_lab[]"></td><td><div class="row"><div class="col-md-6">Hgb: <input type="text" class="form-control" name="cbc_hgb[]"> </div><div class="col-md-6">WBC: <input type="text" class="form-control" name="cbc_wbc[]"></div></div><div class="row"><div class="col-md-6">RBC: <input type="text" class="form-control" name="cbc_rbc[]"> </div><div class="col-md-6">Platelet: <input type="text" class="form-control" name="cbc_platelet[]"></div></div><div class="row"><div class="col-md-12">Hct: <input type="text" class="form-control" name="cbc_hct[]"></div></div></td><td><div class="row"><div class="col-md-6">Pus: <input type="text" class="form-control" name="ua_pus[]"> </div><div class="col-md-6">RBC: <input type="text" class="form-control" name="ua_rbc[]"></div></div><div class="row"><div class="col-md-6">Sugar: <input type="text" class="form-control" name="ua_sugar[]"> </div><div class="col-md-6">Specific Gravity: <input type="text" class="form-control" name="ua_gravity[]"></div></div><div class="row"><div class="col-md-12">Albumin: <input type="text" class="form-control" name="ua_albumin[]"></div></div></td><td> <textarea name="utz[]" class="form-control"></textarea> </td><td><textarea name="lab_remarks[]" class="form-control"></textarea> </td></tr>';
            $('#new_table_lab_res tr:last').after(markup);

            $('#blood_type').attr('rowspan', function(i, rs) { return rs + 1; })
            $('#hbsag_result').attr('rowspan', function(i, rs) { return rs + 1; })
            $('#vdrl_result').attr('rowspan', function(i, rs) { return rs + 1; })
            $(".date_of_lab").inputmask("mm/dd/yyyy");  
            var rowCount = $('#new_table_lab_res tr').length;

            if(rowCount <= 2) {
                $('.new_btn_delete_lab').prop("disabled", true);
            } else {
                $('.new_btn_delete_lab').prop("disabled", false);
            }

            $(".date_of_lab").inputmask("mm/dd/yyyy");  
        });

        $(document).on("click", ".new_btn_delete_lab", function(e) {
            e.preventDefault(); 
            $('#new_table_lab_res tr:last').remove();

            var rowCount = $('#new_table_lab_res tr').length;

            if(rowCount <= 2) {
                $('.new_btn_delete_lab').prop("disabled", true);
            } else {
                $('.new_btn_delete_lab').prop("disabled", false);
            }
        });

        var rowCount = $('#new_table_lab_res tr').length;

        if(rowCount <= 2) {
            $('.new_btn_delete_lab').prop("disabled", true);
        } else {
            $('.new_btn_delete_lab').prop("disabled", false);
        }

        $(document).on("click",".return_btn_add_lab", function(e){
            e.preventDefault();
            var markup = '<tr><td> <input type="text" class="form-control date_of_lab" placeholder="mm/dd/yyyy" name="date_of_lab[]"></td><td><div class="row"><div class="col-md-6">Hgb: <input type="text" class="form-control" name="cbc_hgb[]"> </div><div class="col-md-6">WBC: <input type="text" class="form-control" name="cbc_wbc[]"></div></div><div class="row"><div class="col-md-6">RBC: <input type="text" class="form-control" name="cbc_rbc[]"> </div><div class="col-md-6">Platelet: <input type="text" class="form-control" name="cbc_platelet[]"></div></div><div class="row"><div class="col-md-12">Hct: <input type="text" class="form-control" name="cbc_hct[]"></div></div></td><td><div class="row"><div class="col-md-6">Pus: <input type="text" class="form-control" name="ua_pus[]"> </div><div class="col-md-6">RBC: <input type="text" class="form-control" name="ua_rbc[]"></div></div><div class="row"><div class="col-md-6">Sugar: <input type="text" class="form-control" name="ua_sugar[]"> </div><div class="col-md-6">Specific Gravity: <input type="text" class="form-control" name="ua_gravity[]"></div></div><div class="row"><div class="col-md-12">Albumin: <input type="text" class="form-control" name="ua_albumin[]"></div></div></td><td> <textarea name="utz[]" class="form-control"></textarea> </td><td><textarea name="lab_remarks[]" class="form-control"></textarea> </td></tr>';
            $('#return_table_lab_res tr:last').after(markup);

            $('#blood_type').attr('rowspan', function(i, rs) { return rs + 1; })
            $('#hbsag_result').attr('rowspan', function(i, rs) { return rs + 1; })
            $('#vdrl_result').attr('rowspan', function(i, rs) { return rs + 1; })
            $(".date_of_lab").inputmask("mm/dd/yyyy");  
            var rowCount = $('#return_table_lab_res tr').length;

            if(rowCount <= 2)
            {
                $('.return_btn_delete_lab').prop("disabled", true);
            }else{
                $('.return_btn_delete_lab').prop("disabled", false);
            }
        });

        $(document).on("click",".return_btn_delete_lab", function(e) {
            e.preventDefault(); 
            $('#return_table_lab_res tr:last').remove();

            var rowCount = $('#return_table_lab_res tr').length;

            if(rowCount <= 2) {
                $('.return_btn_delete_lab').prop("disabled", true);
            } else {
                $('.return_btn_delete_lab').prop("disabled", false);
            }
        });

        var rowCount = $('#return_table_lab_res tr').length;

        if(rowCount <= 2) {
            $('.return_btn_delete_lab').prop("disabled", true);
        } else {
            $('.return_btn_delete_lab').prop("disabled", false);
        }

        $(document).on("click", ".add_btn_add_lab", function(e) {
            e.preventDefault();
            var markup = '<tr><td> <input type="text" class="form-control date_of_lab" placeholder="mm/dd/yyyy" name="date_of_lab[]"></td><td><div class="row"><div class="col-md-6">Hgb: <input type="text" class="form-control" name="cbc_hgb[]"> </div><div class="col-md-6">WBC: <input type="text" class="form-control" name="cbc_wbc[]"></div></div><div class="row"><div class="col-md-6">RBC: <input type="text" class="form-control" name="cbc_rbc[]"> </div><div class="col-md-6">Platelet: <input type="text" class="form-control" name="cbc_platelet[]"></div></div><div class="row"><div class="col-md-12">Hct: <input type="text" class="form-control" name="cbc_hct[]"></div></div></td><td><div class="row"><div class="col-md-6">Pus: <input type="text" class="form-control" name="ua_pus[]"> </div><div class="col-md-6">RBC: <input type="text" class="form-control" name="ua_rbc[]"></div></div><div class="row"><div class="col-md-6">Sugar: <input type="text" class="form-control" name="ua_sugar[]"> </div><div class="col-md-6">Specific Gravity: <input type="text" class="form-control" name="ua_gravity[]"></div></div><div class="row"><div class="col-md-12">Albumin: <input type="text" class="form-control" name="ua_albumin[]"></div></div></td><td> <textarea name="utz[]" class="form-control"></textarea> </td><td><textarea name="lab_remarks[]" class="form-control"></textarea> </td></tr>';
            $('#add_table_lab_res tr:last').after(markup);

            $('#blood_type').attr('rowspan', function(i, rs) { return rs + 1; })
            $('#hbsag_result').attr('rowspan', function(i, rs) { return rs + 1; })
            $('#vdrl_result').attr('rowspan', function(i, rs) { return rs + 1; })
            $(".date_of_lab").inputmask("mm/dd/yyyy");  
            var rowCount = $('#add_table_lab_res tr').length;

            if(rowCount <= 2) {
                $('.add_btn_delete_lab').prop("disabled", true);
            } else {
                $('.add_btn_delete_lab').prop("disabled", false);
            }
        });

        $(document).on("click", ".add_btn_delete_lab", function(e) {
            e.preventDefault(); 
            $('#add_table_lab_res tr:last').remove();
            var rowCount = $('#add_table_lab_res tr').length;

            if(rowCount <= 2) {
                $('.add_btn_delete_lab').prop("disabled", true);
            } else {
                $('.add_btn_delete_lab').prop("disabled", false);
            }
        });

        var rowCount = $('#add_table_lab_res tr').length;

        if(rowCount <= 2) {
            $('.add_btn_delete_lab').prop("disabled", true);
        } else {
            $('.add_btn_delete_lab').prop("disabled", false);
        }

        $('.return_date_of_visit').change(function() {
            var start = new Date($('.lmp_date_return').val()),
            end   = new Date($(this).val()),
            diff  = new Date(end - start),
            days  = diff/1000/60/60/24;
            weeks = days / 7;

            n = weeks.toFixed(1);
            whole = Math.floor(n);      // 1
            fraction = n - whole; // .25

            if(weeks.toFixed(1) > 1) {
                var gcd = function(a, b) {
                    if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
                    return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
                };

                var fraction = fraction.toFixed(1);
                var len = fraction.toString().length - 2;

                var denominator = Math.pow(10, len);
                var numerator = fraction * denominator;

                var divisor = gcd(numerator, denominator);    // Should be 5

                numerator /= divisor;                         // Should be 687
                denominator /= divisor;                       // Should be 2000

                $('.new_aog').val(whole + ' ' + Math.floor(numerator) + '/' + Math.floor(denominator) + " " + "weeks");
                $('.new_aog').change();
            } else {
                var gcd = function(a, b) {
                    if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
                    return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
                };

                var fraction = fraction.toFixed(1);
                var len = fraction.toString().length - 2;

                var denominator = Math.pow(10, len);
                var numerator = fraction * denominator;

                var divisor = gcd(numerator, denominator);    // Should be 5

                numerator /= divisor;                         // Should be 687
                denominator /= divisor;                       // Should be 2000

                $('.new_aog').val(whole + ' '+ Math.floor(numerator) + '/' + Math.floor(denominator) + " " + "week");
                $('.new_aog').change();
            }
        });

        $('.add_date_of_visit').change(function() {
            var start = new Date($('.add_lmp_date').val()),
            end   = new Date($(this).val()),
            diff  = new Date(end - start),
            days  = diff/1000/60/60/24;
            weeks = days / 7;

            n = weeks.toFixed(1);
            whole = Math.floor(n);      // 1
            fraction = n - whole; // .25

            if(weeks.toFixed(1) > 1) 
            {
                var gcd = function(a, b) {
                    if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
                    return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
                };

                var fraction = fraction.toFixed(1);
                var len = fraction.toString().length - 2;

                var denominator = Math.pow(10, len);
                var numerator = fraction * denominator;

                var divisor = gcd(numerator, denominator);    // Should be 5

                numerator /= divisor;                         // Should be 687
                denominator /= divisor;                       // Should be 2000

                $('.new_aog').val(whole + ' ' + Math.floor(numerator) + '/' + Math.floor(denominator) + " " + "weeks");
                $('.new_aog').change();
            } else {
                var gcd = function(a, b) {
                    if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
                    return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
                };

                var fraction = fraction.toFixed(1);
                var len = fraction.toString().length - 2;

                var denominator = Math.pow(10, len);
                var numerator = fraction * denominator;

                var divisor = gcd(numerator, denominator);    // Should be 5

                numerator /= divisor;                         // Should be 687
                denominator /= divisor;                       // Should be 2000

                $('.new_aog').val(whole + ' ' + Math.floor(numerator) + '/' + Math.floor(denominator) + " " + "week");
                $('.new_aog').change();
            }
        });

        $('.new_refer_date_of_visit').change(function() {
            var start = new Date($('.new_refer_lmp_date').val()),
            end   = new Date($(this).val()),
            diff  = new Date(end - start),
            days  = diff/1000/60/60/24;
            weeks = days / 7;

            n = weeks.toFixed(1);
            whole = Math.floor(n);      // 1
            fraction = n - whole; // .25

            if(weeks.toFixed(1) > 1) {
                var gcd = function(a, b) {
                    if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
                    return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
                };

                var fraction = fraction.toFixed(1);
                var len = fraction.toString().length - 2;

                var denominator = Math.pow(10, len);
                var numerator = fraction * denominator;

                var divisor = gcd(numerator, denominator);    // Should be 5

                numerator /= divisor;                         // Should be 687
                denominator /= divisor;                       // Should be 2000

                $('.new_aog').val( whole+ ' '+ Math.floor(numerator) + '/' + Math.floor(denominator)+ " " + "weeks");
                $('.new_aog').change();
            } else {
                var gcd = function(a, b) {
                    if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
                    return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
                };

                var fraction = fraction.toFixed(1);
                var len = fraction.toString().length - 2;

                var denominator = Math.pow(10, len);
                var numerator = fraction * denominator;

                var divisor = gcd(numerator, denominator);    // Should be 5

                numerator /= divisor;                         // Should be 687
                denominator /= divisor;                       // Should be 2000

                $('.new_aog').val(whole + ' ' + Math.floor(numerator) + '/' + Math.floor(denominator) + " " + "week");
                $('.new_aog').change();
            }
        });

        $('.view_form').on('click', function() {
            $('.loading').show();
            code = $(this).data('code');
            form_type = $(this).data('type');
            id = $(this).data('id');

            $('#normalFormModal').find('span').html('');
            $('#RefferedpregnantFormModalTrack').find('span').html('');

            if(form_type == 'normal') {
                getNormalForm();
            } else {
                // getPregnantForm();
                getPregnantFormv2();
            }
        });

        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });

        function getPregnantFormv2() {
            $.ajax({
                url: "{{ url('doctor/referral/data/pregnantv2') }}/" + id,
                type: "GET",
                success: function(data) {
                    $('.button_option').hide();
                    var form = data.form;
                    var antepartum = data.antepartum;
                    var sign_symptoms = data.sign_symptoms;
                    var lab_result  = data.lab_result;
                    var preg_vs = data.preg_vs;
                    var preg_outcome = data.preg_outcome;
                    var patient_address= '';

                    if(form) {
                        patient_address += (form.patient_brgy) ? form.patient_brgy + ', ' : '';
                        patient_address += (form.patient_muncity) ? form.patient_muncity + ', ' : '';
                        patient_address += (form.patient_province) ? form.patient_province : '';
                        referring_facility_name = data.referring_facility_name;
                        patient_id = form.id;
                        name = form.woman_name;
                        sex = form.sex;
                        age = form.woman_age;
                        civil_status = form.woman_status;
                        phic_status = form.phic_status;
                        phic_id = form.phic_id;
                        address = form.address;
                        contact = form.contact;
                        dob = form.bday;
                        religion = form.religion;
                        ethnicity = form.ethnicity;
                        sibling_rank = form.sibling_rank;
                        out_of = form.out_of;
                        educ_attainment = form.educ_attainment;
                        family_income = form.family_income;

                        $('.referring_facility_name').val(referring_facility_name);  
                        $('.referring_address').html(form.facility_brgy + form.facility_muncity + form.facility_province);
                        $("input[name='gravidity']").val(form.gravidity);
                        $("input[name='parity']").val(form.parity);
                        $("input[name='ftpal']").val(form.ftpal);
                        $("input[name='bmi']").val(form.bmi);
                        $("input[name='fundic_height']").val(form.fundic_height);
                        $("input[name='hr']").val(form.hr);

                        $("input[name='lmp']").val(form.lmp);
                        $("input[name='edc_edd']").val(form.edc_edd);
                        $("input[name='height']").val(form.height);
                        $("input[name='weigth']").val(form.weigth);
                        $("input[name='bp']").val(form.bp);
                        $("input[name='temp']").val(form.temp);

                        $("input[name='rr']").val(form.rr);
                        $("input[name='td1']").val(form.td1);
                        $("input[name='td2']").val(form.td2);
                        $("input[name='td3']").val(form.td3);
                        $("input[name='td4']").val(form.td4);
                        $("input[name='td5']").val(form.td5);

                        $('.religion').val(religion);   
                        $('.ethnicity').val(ethnicity);   
                        $('.sibling_rank').val(sibling_rank);   
                        $('.out_of').val(out_of);   

                        $('.educ_attainment').val(educ_attainment);   
                        $('.family_income').val(family_income);   
                        
                        $('.phic_id').html(phic_id);    
                        $('.civil_status').val(civil_status);    
                        $('.preg_civil_status').html(civil_status);
                        
                        $('.patient_id').val(patient_id);
                        $('.patient_name').html(name);
                        $('.patient_address').html(patient_address);
                        $('.patient_sex').val(sex);
                        $('.preg_patient_sex').html(sex);
                        
                        $('.patient_dob').html($.datepicker.formatDate('M dd, yy', new Date(dob)));
                        $('.patient_age').html(age);
                        $('.patient_contact').html(contact);
                    }

                    if(sign_symptoms !=null) {
                        $(".prev_trimester").val(sign_symptoms.no_trimester);
                        $(".prev_visit").val(sign_symptoms.no_visit);

                        $(".new_visit_no").val(sign_symptoms.new_visit_no);
                    
                        $('.prev_date').val(sign_symptoms.date_of_visit);

                        if(sign_symptoms.vaginal_spotting == 'yes') {
                            $('.prev_viganal_bleeding').prop('checked', true);
                        }

                        if(sign_symptoms.severe_nausea == 'yes') {
                            $('.prev_severe_nausea').prop('checked', true);
                        }

                        if(sign_symptoms.significant_decline == 'yes') {
                            $('.prev_significant_decline').prop('checked', true);
                        }

                        if(sign_symptoms.persistent_contractions == 'yes') {
                            $('.prev_persistent_contractions').prop('checked', true);
                        }

                        if(sign_symptoms.premature_rupture == 'yes') {
                            $('.prev_premature_rupture').prop('checked', true);
                        }

                        if(sign_symptoms.fetal_pregnancy == 'yes') {
                            $('.prev_multi_pregnancy').prop('checked', true);
                        }

                        if(sign_symptoms.severe_headache == 'yes') {
                            $('.prev_persistent_severe').prop('checked', true);
                        }

                        if(sign_symptoms.abdominal_pain == 'yes') {
                            $('.prev_abdominal_pain').prop('checked', true);
                        }

                        if(sign_symptoms.edema_hands == 'yes') {
                            $('.prev_edema_hands').prop('checked', true);
                        }

                        if(sign_symptoms.fever_pallor == 'yes') {
                            $('.prev_fever_pallor').prop('checked', true);
                        }

                        if(sign_symptoms.seizure_consciousness == 'yes') {
                            $('.prev_seiszure_consciousness').prop('checked', true);
                        }

                        if(sign_symptoms.difficulty_breathing == 'yes') {
                            $('.prev_difficulty_breathing').prop('checked', true);
                        }

                        if(sign_symptoms.painful_urination == 'yes') {
                            $('.prev_painful_urination').prop('checked', true);
                        }

                        if(sign_symptoms.elevated_bp == 'yes') {
                            $('.prev_elevated_bp').prop('checked', true);
                        }

                        $('.prev_subjective').val(sign_symptoms.subjective); 

                        $('.prev_aog').val(sign_symptoms.aog);

                        $('.prev_bp').val(sign_symptoms.bp);
                        $('.prev_hr').val(sign_symptoms.hr);
                        $('.prev_fh').val(sign_symptoms.fh);

                        $('.prev_temp').val(sign_symptoms.temp);
                        $('.prev_rr').val(sign_symptoms.rr);
                        $('.prev_fht').val(sign_symptoms.fht);

                        $('.prev_other_exam').val(sign_symptoms.other_physical_exam);
                        $('.prev_assestment_diagnosis').val(sign_symptoms.assessment_diagnosis);
                        $('.prev_plan_intervention').val(sign_symptoms.plan_intervention);
                    }

                    if(antepartum !=null) {
                        if(antepartum.hypertension == 'yes') {
                            $('.hypertension').prop('checked', true);
                        }

                        if(antepartum.anemia == 'yes') {
                            $('.anemia').prop('checked', true);
                        }

                        if(antepartum.malaria == 'yes') {
                            $('.malaria').prop('checked', true);
                        }

                        if(antepartum.cancer == 'yes') {
                            $('.cancer').prop('checked', true);
                        }

                        if(antepartum.allergies == 'yes') {
                            $('.allergies').prop('checked', true);
                        }

                        if(antepartum.renal_disease == 'yes') {
                            $('.renal_disease').prop('checked', true);
                        }

                        if(antepartum.typhoid_disorders == 'yes') {
                            $('.typhoid_disorders').prop('checked', true);
                        }

                        if(antepartum.hypo_hyper == 'yes') {
                            $('.hypo_hyperthyroidism').prop('checked', true);
                        }

                        if(antepartum.tuberculosis == 'yes') {
                            $('.tuberculosis').prop('checked', true);
                        }

                        if(antepartum.diabetes_mellitus == 'yes') {
                            $('.diabetes_mellitus').prop('checked', true);
                        }

                        if(antepartum.hepatatis_b == 'yes') {
                            $('.hepatitisb_infection').prop('checked', true);
                        }

                        if(antepartum.hiv_sti == 'yes') {
                            $('.hiv_sti').prop('checked', true);
                        }

                        if(antepartum.seizure_disorder == 'yes') {
                            $('.seizure_disorder').prop('checked', true);
                        }

                        if(antepartum.cardiovascular_disease == 'yes') {
                            $('.cadiovascular_disease').prop('checked', true);
                        }

                        if(antepartum.malnutrition == 'yes') {
                            $('.malnutrition').prop('checked', true);
                        }

                        if(antepartum.hemotilgic_disorder == 'yes') {
                            $('.hemotilgic_bleeding').prop('checked', true);
                        }

                        if(antepartum.substance_abuse == 'yes') {
                            $('.alcohol_abuse').prop('checked', true);
                        }

                        if(antepartum.anti_phospholipid == 'yes') {
                            $('.phospholipid_syndrome').prop('checked', true);
                        }

                        if(antepartum.restrictive_pulmonary == 'yes') {
                            $('.asthma').prop('checked', true);
                        }

                        if(antepartum.mental_retardation == 'yes') {
                            $('.psychiatric_mental').prop('checked', true);
                        }

                        if(antepartum.habitual_abortion == 'yes') {
                            $('.habitual_abortion').prop('checked', true);
                        }

                        if(antepartum.fetus_congenital == 'yes') {
                            $('.fetus_congenital').prop('checked', true);
                        }

                        if(antepartum.previous_caesarean == 'yes') {
                            $('.caesarean_section').prop('checked', true);
                        }

                        if(antepartum.preterm_delivery == 'yes') {
                            $('.neonatal_death').prop('checked', true);
                        }

                        $('.ante_subjective').val(antepartum.subjective);

                        $('.ante_bp').val(antepartum.bp);
                        $('.ante_hr').val(antepartum.hr);
                        $('.ante_fh').val(antepartum.fh);

                        $('.ante_temp').val(antepartum.temp);
                        $('.ante_rr').val(antepartum.rr);
                        $('.ante_fht').val(antepartum.fht);

                        $('.ante_other_physical_exam').val(antepartum.other_physical_exam);
                        $('.ante_assessment_diagnosis').val(antepartum.assessment_diagnosis);
                        $('.ante_plan_intervention').val(antepartum.plan_intervention);

                        $('.bp_15').val(preg_vs.bp_15);
                        $('.bp_30').val(preg_vs.bp_30);
                        $('.bp_45').val(preg_vs.bp_45);
                        $('.bp_60').val(preg_vs.bp_60);
                        $('.bp_remarks').val(preg_vs.bp_remarks);

                        $('.temp_15').val(preg_vs.temp_15);
                        $('.temp_30').val(preg_vs.temp_30);
                        $('.temp_45').val(preg_vs.temp_45);
                        $('.temp_60').val(preg_vs.temp_60);
                        $('.temp_remaks').val(preg_vs.temp_remaks);

                        $('.hr_15').val(preg_vs.hr_15);
                        $('.hr_30').val(preg_vs.hr_30);
                        $('.hr_45').val(preg_vs.hr_45);
                        $('.hr_60').val(preg_vs.hr_60);
                        $('.hr_remarks').val(preg_vs.hr_remarks);

                        $('.rr_15').val(preg_vs.rr_15);
                        $('.rr_30').val(preg_vs.rr_30);
                        $('.rr_45').val(preg_vs.rr_45);
                        $('.rr_60').val(preg_vs.rr_60);
                        $('.rr_remarks').val(preg_vs.rr_remarks);

                        $('.o2sat_15').val(preg_vs.o2sat_15);
                        $('.o2sat_30').val(preg_vs.o2sat_30);
                        $('.o2sat_45').val(preg_vs.o2sat_45);
                        $('.o2sat_60').val(preg_vs.o2sat_60);
                        $('.o2sat_remaks').val(preg_vs.o2sat_remaks);

                        $('.fht_15').val(preg_vs.fht_15);
                        $('.fht_30').val(preg_vs.fht_30);
                        $('.fht_45').val(preg_vs.fht_45);
                        $('.fht_60').val(preg_vs.fht_60);
                        $('.fht_remarks').val(preg_vs.fht_remarks);
                    }

                    // $.each( lab_result, function( key, value ) {
                    
                    // var index = key + 1;
                    // console.log(lab_result[1].date_of_lab);
                    //     if(key > 0){
                    //         var markup = '<tr><td><input type="date" class="form-control" value="" name="date_of_lab[]"></td><td><input type="text" class="form-control" name="cbc_result[]"> </td><td><input type="text" class="form-control" name="ua_result[]"> </td><td><input type="text" class="form-control" name="utz[]"> </td><td><textarea name="lab_remarks[]" class="form-control"></textarea> </td></tr>';
                    //     $('#table_lab_res tr:last').after(markup);
                    //     }
                    // });

                    if(lab_result.length > 0) {
                        $('.date_of_lab').val(lab_result[0].date_of_lab);
                        $('.cbc_hgb').val(lab_result[0].cbc_hgb);
                        $('.cbc_wbc').val(lab_result[0].cbc_wbc);
                        $('.cbc_rbc').val(lab_result[0].cbc_rbc);
                        $('.cbc_platelet').val(lab_result[0].cbc_platelet);
                        $('.cbc_hct').val(lab_result[0].cbc_hct);

                        $('.ua_pus').val(lab_result[0].ua_pus);
                        $('.ua_rbc').val(lab_result[0].ua_rbc);
                        $('.ua_sugar').val(lab_result[0].ua_sugar);
                        $('.ua_gravity').val(lab_result[0].ua_gravity);
                        $('.ua_albumin').val(lab_result[0].ua_albumin);

                        $('.utz').val(lab_result[0].utz);
                        $('.blood_type').val(lab_result[0].blood_type);
                        $('.hbsag_result').val(lab_result[0].hbsag_result);
                        $('.vdrl_result').val(lab_result[0].vdrl_result);
                        $('.lab_remarks').val(lab_result[0].lab_remarks);

                        for (let i = 1; i < lab_result.length; i++) {
                            var markup = '<tr><td> <input type="date" class="form-control" value="' + lab_result[i].date_of_lab + '" name="date_of_lab[]" disabled></td><td><div class="row"><div class="col-md-6">Hgb: <input type="text" class="form-control" name="cbc_hgb[]" value="' + lab_result[i].cbc_hgb + '" disabled> </div><div class="col-md-6">WBC: <input type="text" class="form-control" name="cbc_wbc[]" value="' + lab_result[i].cbc_wbc + '" disabled></div></div><div class="row"><div class="col-md-6">RBC: <input type="text" class="form-control" name="cbc_rbc[]" value="' + lab_result[i].cbc_rbc + '" disabled> </div><div class="col-md-6">Platelet: <input type="text" class="form-control" value="' + lab_result[i].cbc_platelet + '" name="cbc_platelet[]" disabled></div></div><div class="row"><div class="col-md-12">Hct: <input type="text" class="form-control" value="' + lab_result[i].cbc_hct + '" name="cbc_hct[]" disabled></div></div></td><td><div class="row"><div class="col-md-6">Pus: <input type="text" class="form-control" value="' + lab_result[i].ua_pus + '" name="ua_pus[]" disabled> </div><div class="col-md-6">RBC: <input type="text" class="form-control" value="' + lab_result[i].ua_rbc + '" name="ua_rbc[]" disabled></div></div><div class="row"><div class="col-md-6">Sugar: <input type="text" class="form-control" value="' + lab_result[i].ua_sugar + '" name="ua_sugar[]" disabled> </div><div class="col-md-6">Specific Gravity: <input type="text" class="form-control" value="' + lab_result[i].ua_gravity + '" name="ua_gravity[]" disabled></div></div><div class="row"><div class="col-md-12">Albumin: <input type="text" class="form-control" value="' + lab_result[i].ua_albumin + '" name="ua_albumin[]" disabled></div></div></td><td> <textarea name="utz[]" class="form-control" disabled>' + lab_result[i].utz + '</textarea> </td><td><textarea name="lab_remarks[]" class="form-control" disabled>' + lab_result[i].lab_remarks + '</textarea> </td></tr>';
                            $('#table_lab_res_referred tr:last').after(markup);

                            $('#blood_type_referred').attr('rowspan', function(i, rs) { return rs + 1; })
                            $('#hbsag_result_referred').attr('rowspan', function(i, rs) { return rs + 1; })
                            $('#vdrl_result_referred').attr('rowspan', function(i, rs) { return rs + 1; })
                        }
                    }
                            
                    if(preg_outcome) {
                        $('.delivery_outcome').val(preg_outcome.delivery_outcome);   
                        $('.birth_attendant').val(preg_outcome.birth_attendant);
                        $('.status_on_discharge').val(preg_outcome.status_on_discharge);   
                        $('.type_of_delivery').val(preg_outcome.type_of_delivery);

                        $('.final_diagnosis').val(preg_outcome.final_diagnosis);
                    }

                    var print_url = "{{ url('doctor/print/form/') }}/" + form.tracking_id;
                    $('.btn-refer-pregnant').attr('href',print_url);
                    $('.loading').hide();
                },
                error: function() {
                    $('#serverModal').modal();
                    $('.loading').hide();
                }
            });
        }

        function VitalBody(patient_id) {
            $('.loading').show();
            var url = "<?php echo asset('doctor/patient/vitalbody'); ?>";
            var json = {
                "patient_id" : patient_id,
                "_token" : "<?php echo csrf_token(); ?>"
            };

            $.post(url,json, function(result) {
                $('.loading').hide();
                $(".vital_body").html(result);
            });
        }

        $('a[click="PatientBody"]').on('click', function() {
            patient_id = $(this).attr('data-id');
            var url = "<?php echo asset('doctor/patient/update'); ?>";
            var json = {
                "patient_id" : patient_id,
                "_token" : "<?php echo csrf_token(); ?>"
            };

            $.post(url,json,function(result){
                $(".patient_body").html(result);
            });
        })

        $(".select2").select2({ width: '100%' });
        var referred_facility = 0;
        var referring_facility = "{{ $user->facility_id }}";
        var referred_facility = '';
        var referring_facility_name = $(".referring_name").val();
        var patient_form_id = 0;
        var referring_md = "{{ $user->fname }} {{ $user->mname }} {{ $user->lname }}";
        var name, age, sex, address, form_type, reason, patient_id, civil_status, phic_status, phic_id, department_id, department_name, contact;

        $('.form-submit').on('submit', function() {
            $('.loading').show();
            $('.btn-submit').attr('disabled',true);
        });

        $('.select_facility').on('change', function() {
            var id = $(this).val();
            referred_facility = id;
            var url = "{{ url('location/facility/') }}";

            $.ajax({
                url: url + '/' + id,
                type: 'GET',
                success: function(data) {
                    $('.facility_address').html(data.address);

                    $('.select_department').empty()
                        .append($('<option>', {
                            value: '',
                            text : 'Select Department...'
                        }));

                    jQuery.each(data.departments, function(i,val) {
                        $('.select_department').append($('<option>', {
                            value: val.id,
                            text : val.description
                        }));
                    });
                },
                error: function(error){
                    $('#serverModal').modal();
                }
            });
        });

        $('.select_facility_walkin').on('change', function() {
            var id = $(this).val();
            referred_facility = "{{ $user->facility_id }}";
            var url = "{{ url('location/facility/') }}";
            referring_facility_name = $(this).find(':selected').data('name');

            $.ajax({
                url: url + '/' + id,
                type: 'GET',
                success: function(data) { 
                    $('.facility_address').html(data.address);
                },
                error: function(){
                    $('#serverModal').modal();
                }
            });
        });

        $('.select_department').on('change', function() {
            var id = $(this).val();
            var list = "{{ url('list/doctor') }}";
             
            if(referred_facility == 0) {
                referred_facility = "{{ $user->facility_id }}";
            }

            $.ajax({
                url: list + '/' + referred_facility + '/' + id,
                type: 'GET',
                success: function(data) {
                    $('.referred_md').empty()
                        .append($('<option>', {
                            value: '',
                            text : 'Any...'
                        }));
                        
                    jQuery.each(data, function(i, val) {
                        $('.referred_md').append($('<option>', {
                            value: val.id,
                            text : 'Dr. '+val.fname+' '+val.mname+' '+val.lname+' - '+val.contact
                        }));
                    });
                },
                error:function() {
                    $('#serverModal').modal();
                }
            });
        });

        $('.discharge_button').removeClass('hide');
        $('.upload_code').removeClass('hide');
        $('.btn_refer_preg').removeClass('hide');
        $('.profile_info').removeClass('hide');
        $('.vital_info').removeClass('hide');

        $('.btn_refer_preg').on('click', function() {
            var patient_id = $(this).data('patient_id');
            var unique_id = $(this).data('unique_id');
            
            $.ajax({
                url: "{{ url('doctor/patient/info/') }}/" + patient_id,
                type: "GET",
                success: function(data) {
                    var sign = data.sign;
                    var form = data.form;
                    var ante = data.ante;
                    var lab = data.lab;
                    var data = data.data;
                
                    name = data.patient_name;
                    sex = data.sex;
                    age = data.age;
                    civil_status = data.civil_status;
                    phic_status = data.phic_status;
                    phic_id = data.phic_id;
                    address = data.address;
                    contact = data.contact;
                    dob = data.dob;

                    var now = new Date();

                    var day = ("0" + now.getDate()).slice(-2);
                    var month = ("0" + (now.getMonth() + 1)).slice(-2);

                    var new_date_of_visit = (month) + "/" + (day) + "/" + now.getFullYear() ;

                    $('.new_refer_date_of_visit').val(new_date_of_visit);

                    $('input[name="phic_status"][value="' + phic_status + '"]').attr('checked',true);
                    $('.phic_id').html(phic_id);    
                    $('.civil_status').val( data.civil_status);    
                    $('.preg_civil_status').html( data.civil_status);

                    $('.unique_id').val(form ? form.unique_id : null);
                    $('.code').val(form ? form.code : null);
                    
                    $('.patient_id').val(patient_id);
                    $('.patient_name').html(name);
                    $('.patient_address').html(address);
                    $('.patient_sex').val(sex);
                    $('.preg_patient_sex').html(sex);
                    
                    $('.patient_dob').html($.datepicker.formatDate('M dd,  yy', new Date(dob)));
                    $('.patient_age').html(age);
                    $('.patient_contact').html(contact);

                    if(form) {
                        var date = new Date(form.lmp);
                        var day = ("0" + date.getDate()).slice(-2);
                        var month = ("0" + (date.getMonth() + 1)).slice(-2);

                        var lmp_new = (month) + "/" + (day) + "/" + date.getFullYear() ;

                        var date2 = new Date(form.edc_edd);
                        var day2 = ("0" + date2.getDate()).slice(-2);
                        var month2 = ("0" + (date2.getMonth() + 1)).slice(-2);

                        var edc_edd = (month2) + "/" + (day2) + "/" + date2.getFullYear() ;

                        $('.new_refer_lmp_date').val(lmp_new);
                        $('.edc_edd').val(edc_edd);
                
                        $('.educ_attainment').val(form.educ_attainment);
                        $('.family_income').val(form.family_income);
                        $('.religion').val(form.religion);
                        $('.ethnicity').val(form.ethnicity);
                        $('.sibling_rank').val(form.sibling_rank);
                        $('.out_of').val(form.out_of); 
                        $('.patient_woman_id').val(form.patient_woman_id); 
                        $('.unique_id').val(form.unique_id); 
                        $('.code').val(form.code);

                        $('.gravidity').val(form.gravidity);
                        $('.parity').val(form.parity);
                        $('.ftpal').val(form.ftpal);
                        $('.bmi').val(form.bmi);
                        $('.fh_personnal').val(form.fundic_height);
                        $('.hr_personnal').val(form.hr);
                        $('.bp_personnal').val(form.bp); 
                        $('.temp_personnal').val(form.temp);
                        $('.height').val(form.height); 
                        $('.weigth').val(form.weigth); 

                        var td1 = form.td1 ? new Date(form.td1) : '';
                        var td2 = form.td2 ? new Date(form.td2) : '';
                        var td3 = form.td3 ? new Date(form.td3) : '';
                        var td4 = form.td4 ? new Date(form.td4) : '';
                        var td5 = form.td5 ? new Date(form.td5) : '';

                        $('.rr_personnal').val(form.gravidity);
                        (td1 != '') ? $('.td1').val( ((td1.getMonth() > 8) ? (td1.getMonth() + 1) : ('0' + (td1.getMonth() + 1))) + '/' + ((td1.getDate() > 9) ? td1.getDate() : ('0' + td1.getDate())) + '/' + td1.getFullYear() ) : '';
                        (td2 != '') ? $('.td2').val( ((td2.getMonth() > 8) ? (td2.getMonth() + 1) : ('0' + (td2.getMonth() + 1))) + '/' + ((td2.getDate() > 9) ? td2.getDate() : ('0' + td2.getDate())) + '/' + td2.getFullYear() ) : '';
                        (td3 != '') ? $('.td3').val( ((td3.getMonth() > 8) ? (td3.getMonth() + 1) : ('0' + (td3.getMonth() + 1))) + '/' + ((td3.getDate() > 9) ? td3.getDate() : ('0' + td3.getDate())) + '/' + td3.getFullYear() ) : '';
                        (td4 != '') ? $('.td4').val( ((td4.getMonth() > 8) ? (td4.getMonth() + 1) : ('0' + (td4.getMonth() + 1))) + '/' + ((td4.getDate() > 9) ? td4.getDate() : ('0' + td4.getDate())) + '/' + td4.getFullYear() ) : '';
                        (td5 != '') ? $('.td5').val( ((td5.getMonth() > 8) ? (td5.getMonth() + 1) : ('0' + (td5.getMonth() + 1))) + '/' + ((td5.getDate() > 9) ? td5.getDate() : ('0' + td5.getDate())) + '/' + td5.getFullYear() ) : ''; 

                        var start = new Date(form.lmp),
                        end   = new Date($('.new_refer_date_of_visit').val()),
                        diff  = new Date(end - start),
                        days  = diff/1000/60/60/24;
                        weeks = days / 7;

                        n = weeks.toFixed(1);
                        whole = Math.floor(n); // 1
                        fraction = n - whole; // .25
                        var gcd = function(a, b) {
                            if (b < 0.0000001) return a; // Since there is a limited precision we need to limit the value.
                            return gcd(b, Math.floor(a % b)); // Discard any fractions due to limitations in precision.
                        };

                        var fraction = fraction.toFixed(1);
                        var len = fraction.toString().length - 2;

                        var denominator = Math.pow(7, len);
                        var numerator = fraction * denominator;

                        $('.new_aog').val(whole + ' ' + Math.floor(numerator.toFixed()) + '/' + Math.floor(denominator.toFixed()));
                        $('.new_aog').change();

                        if( whole <= '12' ) {
                            $(".new_trimester").val('1st');
                        } else if( whole <= '28' ) {
                            $(".new_trimester").val('2nd');
                        } else if( whole <= '40' ) {
                            $(".new_trimester").val('3rd');
                        } else {
                            $(".new_trimester").val('3rd');
                        }
                    }
                
                    if(ante) {
                        if(ante.hypertension == 'yes') {
                            $('.hypertension').prop('checked', true);
                        }

                        if(ante.anemia == 'yes') {
                            $('.anemia').prop('checked', true);
                        }

                        if(ante.malaria == 'yes') {
                            $('.malaria').prop('checked', true);
                        }

                        if(ante.cancer == 'yes') {
                            $('.cancer').prop('checked', true);
                        }

                        if(ante.allergies == 'yes') {
                            $('.allergies').prop('checked', true);
                        }

                        if(ante.renal_disease == 'yes') {
                            $('.renal_disease').prop('checked', true);
                        }

                        if(ante.typhoid_disorders == 'yes') {
                            $('.typhoid_disorders').prop('checked', true);
                        }

                        if(ante.hypo_hyper == 'yes') {
                            $('.hypo_hyperthyroidism').prop('checked', true);
                        }

                        if(ante.tuberculosis == 'yes') {
                            $('.tuberculosis').prop('checked', true);
                        }

                        if(ante.diabetes_mellitus == 'yes') {
                            $('.diabetes_mellitus').prop('checked', true);
                        }

                        if(ante.hepatatis_b == 'yes') {
                            $('.hepatitisb_infection').prop('checked', true);
                        }

                        if(ante.hiv_sti == 'yes') {
                            $('.hiv_sti').prop('checked', true);
                        }

                        if(ante.seizure_disorder == 'yes') {
                            $('.seizure_disorder').prop('checked', true);
                        }

                        if(ante.cardiovascular_disease == 'yes') {
                            $('.cardiovascular_disease').prop('checked', true);
                        }

                        if(ante.malnutrition == 'yes') {
                            $('.malnutrition').prop('checked', true);
                        }

                        if(ante.hemotilgic_disorder == 'yes') {
                            $('.hemotilgic_bleeding').prop('checked', true);
                        }

                        if(ante.substance_abuse == 'yes') {
                            $('.alcohol_abuse').prop('checked', true);
                        }

                        if(ante.anti_phospholipid == 'yes') {
                            $('.phospholipid_syndrome').prop('checked', true);
                        }

                        if(ante.restrictive_pulmonary == 'yes') {
                            $('.asthma').prop('checked', true);
                        }

                        if(ante.mental_retardation == 'yes') {
                            $('.psychiatric_mental').prop('checked', true);
                        }

                        if(ante.habitual_abortion == 'yes') {
                            $('.habitual_abortion').prop('checked', true);
                        }

                        if(ante.fetus_congenital == 'yes') {
                            $('.fetus_congenital').prop('checked', true);
                        }

                        if(ante.previous_caesarean == 'yes') {
                            $('.previous_caesarean').prop('checked', true);
                        }

                        if(ante.preterm_delivery == 'yes') {
                            $('.neonatal_death').prop('checked', true);
                        }

                        $('.new_ante_subjective').val(ante.subjective);

                        $('.bp_antepartum').val(ante.bp);
                        $('.hr_antepartum').val(ante.hr);
                        $('.fh_antepartum').val(ante.fh);

                        $('.temp_antepartum').val(ante.temp);
                        $('.rr_antepartum').val(ante.rr);
                        $('.antepartum_fht').val(ante.fht);

                        $('.new_ante_other_physical_exam').val(ante.other_physical_exam);
                        $('.new_ante_assessment_diagnosis').val(ante.assessment_diagnosis);
                        $('.new_ante_plan_intervention').val(ante.plan_intervention);

                        $('.new_others').val(ante.others);
                    }

                    if(lab) {
                        $('.new_blood_type').val(lab.blood_type).trigger('change');
                        $('.new_hbsag_result').val(lab.hbsag_result).trigger('change');
                        $('.new_vdrl_result').val(lab.vdrl_result).trigger('change');
                    }
                    
                    if(sign) { 
                        $(".prev_trimester").val(sign.no_trimester);
                        $(".prev_visit").val(sign.no_visit);
                        $(".new_visit_no").val("1st");
                    
                        $('.prev_date').val(sign.date_of_visit);

                        $('.prev_subjective').val(sign.subjective); 

                        $('.prev_aog').val(sign.aog);

                        $('.prev_bp').val(sign.bp);
                        $('.prev_hr').val(sign.hr);
                        $('.prev_fh').val(sign.fh);

                        $('.prev_temp').val(sign.temp);
                        $('.prev_rr').val(sign.rr);
                        $('.prev_fht').val(sign.fht);

                        $('.prev_other_exam').val(sign.other_physical_exam);
                        $('.prev_assestment_diagnosis').val(sign.assessment_diagnosis);
                        $('.prev_plan_intervention').val(sign.plan_intervention);

                        if(sign.vaginal_spotting == 'yes') {
                            $('.prev_viganal_bleeding').prop('checked', true);
                        }

                        if(sign.severe_nausea == 'yes') {
                            $('.prev_severe_nausea').prop('checked', true);
                        }

                        if(sign.significant_decline == 'yes') {
                            $('.prev_significant_decline').prop('checked', true);
                        }

                        if(sign.premature_rupture == 'yes') {
                            $('.prev_premature_rupture').prop('checked', true);
                        }

                        if(sign.fetal_pregnancy == 'yes') {
                            $('.prev_multi_pregnancy').prop('checked', true);
                        }

                        if(sign.severe_headache == 'yes') {
                            $('.prev_persistent_severe').prop('checked', true);
                        }

                        if(sign.abdominal_pain == 'yes') {
                            $('.prev_abdominal_pain').prop('checked', true);
                        }

                        if(sign.edema_hands == 'yes') {
                            $('.prev_edema_hands').prop('checked', true);
                        }

                        if(sign.fever_pallor == 'yes') {
                            $('.prev_fever_pallor').prop('checked', true);
                        }

                        if(sign.seizure_consciousness == 'yes') {
                            $('.prev_seiszure_consciousness').prop('checked', true);
                        }

                        if(sign.difficulty_breathing == 'yes') {
                            $('.prev_difficulty_breathing').prop('checked', true);
                        }

                        if(sign.painful_urination == 'yes') {
                            $('.prev_painful_urination').prop('checked', true);
                        }

                        if(sign.elevated_bp == 'yes') {
                            $('.prev_elevated_bp').prop('checked', true);
                        }
                    } else {
                        val = "1" + "st";
                        $(".new_visit_no").val(val);
                    }
                    
                    if( $( ".new_visit_no" ).val() == "1st" ) {
                        $(".bp_personnal").keyup(function() {
                            $(".bp_antepartum").val(this.value);
                        });

                        $(".temp_personnal").keyup(function() {
                            $(".temp_antepartum").val(this.value);
                        });

                        $(".hr_personnal").keyup(function() {
                            $(".hr_antepartum").val(this.value);
                        });

                        $(".rr_personnal").keyup(function() {
                            $(".rr_antepartum").val(this.value);
                        });

                        $(".fh_personnal").keyup(function() {
                            $(".fh_antepartum").val(this.value);
                        });

                        //3rd tab
                        $(".bp_personnal").keyup(function() {
                            $(".bp_signsymptoms").val(this.value);
                        });

                        $(".temp_personnal").keyup(function() {
                            $(".temp_signsymptoms").val(this.value);
                        });

                        $(".hr_personnal").keyup(function() {
                            $(".hr_signsymptoms").val(this.value);
                        });

                        $(".rr_personnal").keyup(function() {
                            $(".rr_signsymptoms").val(this.value);
                        });

                        $(".fh_personnal").keyup(function() {
                            $(".fh_signsymptoms").val(this.value);
                        });
                    } else {
                        $(".bp_personnal").unbind("keyup");
                        $(".temp_personnal").unbind("keyup");
                        $(".hr_personnal").unbind("keyup");
                        $(".rr_personnal").unbind("keyup");
                        $(".fh_personnal").unbind("keyup");
                    }
                },
                error: function(){
                    $('#serverModal').modal();
                }
            });
        });

        $('.profile_info').on('click', function() {
            var patient_id = $(this).data('patient_id');
            var unique_id = $(this).data('unique_id');

            $.ajax({
                url: "{{ url('doctor/patient/info/') }}/" + patient_id,
                type: "GET",
                success: function(data) {
                    var sign = data.sign;
                    var form = data.form
                    var data = data.data;
                    patient_id = data.id;
                    name = data.patient_name;
                    sex = data.sex;
                    age = data.age;
                    civil_status = data.civil_status;
                    phic_status = data.phic_status;
                    phic_id = data.phic_id;
                    address = data.address;
                    contact = data.contact;
                    dob = data.dob;

                    var now = new Date();

                    var day = ("0" + now.getDate()).slice(-2);
                    var month = ("0" + (now.getMonth() + 1)).slice(-2);

                    var new_date_of_visit = (month) + "/" + (day) + "/" + now.getFullYear() ;

                    $('.add_date_of_visit').val(new_date_of_visit);
                    $('.return_date_of_visit').val(new_date_of_visit);

                    $('input[name="phic_status"][value="' + phic_status + '"]').attr('checked',true);
                    $('.phic_id').html(phic_id);    
                    $('.civil_status').val(civil_status);    
                    $('.preg_civil_status').html(civil_status);
                    
                    $('.patient_id').val(patient_id);
                    $('.patient_name').html(name);
                    $('.patient_address').html(address);
                    $('.patient_sex').val(sex);
                    $('.preg_patient_sex').html(sex);
                    
                    $('.patient_dob').html($.datepicker.formatDate('M dd, yy', new Date(dob)));
                    $('.patient_age').html(age);
                    $('.patient_contact').html(contact);

                    if(form) {
                        var now = new Date(form.lmp);
                        var day = ("0" + now.getDate()).slice(-2);
                        var month = ("0" + (now.getMonth() + 1)).slice(-2);

                        var lmp_new = (month) + "/" + (day) + "/" +now.getFullYear() ;

                        $('.lmp_date_return').val(lmp_new);
                
                        $('.educ_attainment').val(form.educ_attainment);
                        $('.family_income').val(form.family_income);
                        $('.religion').val(form.religion);
                        $('.ethnicity').val(form.ethnicity);
                        $('.sibling_rank').val(form.sibling_rank);
                        $('.out_of').val(form.out_of); 
                        $('.patient_woman_id').val(form.patient_woman_id); 
                        $('.unique_id').val(form.unique_id); 
                        $('.code').val(form.code);
                        
                        var months = dateRange(form.lmp, form.edc_edd)

                        var d = new Date(),

                        n = d.getMonth() + 1,

                        y = d.getFullYear();
                        
                        for(var i = 1; i <= months.length; i++) {
                            if(n == months[0] || n == months[1] || n == months[2] || n == months[3]) {
                                $(".new_trimester").val('1st');
                            } else if(n == months[4] || n == months[5] || n == months[6]) {
                                $(".new_trimester").val('2nd');
                            } else if(n == months[7] || n == months[8] || n == months[9]) {
                                $(".new_trimester").val('3rd');
                            } else {
                                $(".new_trimester").val('3rd');
                            }
                        }

                        var start = new Date(form.lmp),
                        end   = new Date($('.return_date_of_visit').val()),
                        diff  = new Date(end - start),
                        days  = diff/1000/60/60/24;
                        weeks = days / 7;

                        n = weeks.toFixed(1);
                        whole = Math.floor(n);      // 1
                        fraction = n - whole; // .25

                        if(weeks.toFixed(1) > 1) {
                            var gcd = function(a, b) {
                                if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
                                return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
                            };

                            var fraction = fraction.toFixed(1);
                            var len = fraction.toString().length - 2;

                            var denominator = Math.pow(10, len);
                            var numerator = fraction * denominator;

                            var divisor = gcd(numerator, denominator);    // Should be 5

                            numerator /= divisor;                         // Should be 687
                            denominator /= divisor;                       // Should be 2000

                            $('.new_aog').val( whole+ ' '+ Math.floor(numerator) + '/' + Math.floor(denominator));
                            $('.new_aog').change();
                        } else {
                            var gcd = function(a, b) {
                                if (b < 0.0000001) return a;                // Since there is a limited precision we need to limit the value.
                                return gcd(b, Math.floor(a % b));           // Discard any fractions due to limitations in precision.
                            };

                            var fraction = fraction.toFixed(1);
                            var len = fraction.toString().length - 2;

                            var denominator = Math.pow(10, len);
                            var numerator = fraction * denominator;

                            var divisor = gcd(numerator, denominator);    // Should be 5

                            numerator /= divisor;                         // Should be 687
                            denominator /= divisor;                       // Should be 2000

                            $('.new_aog').val(whole+ ' '+ Math.floor(numerator) + '/' + Math.floor(denominator));
                            $('.new_aog').change();
                        }
                    }
                
                    //preg_prev
                    if (sign) {
                        $(".prev_trimester").val(sign.no_trimester);
                        $(".prev_visit").val(sign.no_visit);
                    
                        $(".new_visit_no").val("1st");
                        
                    
                        $('.prev_date').val(sign.date_of_visit);

                        $('.prev_subjective').val(sign.subjective); 

                        $('.prev_aog').val(sign.aog);

                        $('.prev_bp').val(sign.bp);
                        $('.prev_hr').val(sign.hr);
                        $('.prev_fh').val(sign.fh);

                        $('.prev_temp').val(sign.temp);
                        $('.prev_rr').val(sign.rr);
                        $('.prev_fht').val(sign.fht);

                        $('.prev_other_exam').val(sign.other_physical_exam);
                        $('.prev_assestment_diagnosis').val(sign.assessment_diagnosis);
                        $('.prev_plan_intervention').val(sign.plan_intervention);

                        if(sign.vaginal_spotting == 'yes') {
                            $('.prev_viganal_bleeding').prop('checked', true);
                        }

                        if(sign.severe_nausea == 'yes') {
                            $('.prev_severe_nausea').prop('checked', true);
                        }

                        if(sign.significant_decline == 'yes') {
                            $('.prev_significant_decline').prop('checked', true);
                        }

                        if(sign.premature_rupture == 'yes') {
                            $('.prev_premature_rupture').prop('checked', true);
                        }

                        if(sign.fetal_pregnancy == 'yes') {
                            $('.prev_multi_pregnancy').prop('checked', true);
                        }

                        if(sign.severe_headache == 'yes') {
                            $('.prev_persistent_severe').prop('checked', true);
                        }

                        if(sign.abdominal_pain == 'yes') {
                            $('.prev_abdominal_pain').prop('checked', true);
                        }

                        if(sign.edema_hands == 'yes') {
                            $('.prev_edema_hands').prop('checked', true);
                        }

                        if(sign.fever_pallor == 'yes') {
                            $('.prev_fever_pallor').prop('checked', true);
                        }

                        if(sign.seizure_consciousness == 'yes') {
                            $('.prev_seiszure_consciousness').prop('checked', true);
                        }

                        if(sign.difficulty_breathing == 'yes') {
                            $('.prev_difficulty_breathing').prop('checked', true);
                        }

                        if(sign.painful_urination == 'yes') {
                            $('.prev_painful_urination').prop('checked', true);
                        }

                        if(sign.elevated_bp == 'yes') {
                            $('.prev_elevated_bp').prop('checked', true);
                        }
                    } else {
                        val = "1" + "st";
                        $(".new_visit_no").val(val);
                    }
                    
                    if ( $( ".new_visit_no" ).val() == "1st" ) {
                        $(".bp_personnal").keyup(function() {
                            $(".bp_antepartum").val(this.value);
                        });

                        $(".temp_personnal").keyup(function() {
                            $(".temp_antepartum").val(this.value);
                        });

                        $(".hr_personnal").keyup(function() {
                            $(".hr_antepartum").val(this.value);
                        });

                        $(".rr_personnal").keyup(function() {
                            $(".rr_antepartum").val(this.value);
                        });

                        $(".fh_personnal").keyup(function() {
                            $(".fh_antepartum").val(this.value);
                        });

                        //3rd tab
                        $(".bp_personnal").keyup(function() {
                            $(".bp_signsymptoms").val(this.value);
                        });

                        $(".temp_personnal").keyup(function() {
                            $(".temp_signsymptoms").val(this.value);
                        });

                        $(".hr_personnal").keyup(function() {
                            $(".hr_signsymptoms").val(this.value);
                        });

                        $(".rr_personnal").keyup(function() {
                            $(".rr_signsymptoms").val(this.value);
                        });

                        $(".fh_personnal").keyup(function() {
                            $(".fh_signsymptoms").val(this.value);
                        });
                    } else {
                        $(".bp_personnal").unbind("keyup");
                        $(".temp_personnal").unbind("keyup");
                        $(".hr_personnal").unbind("keyup");
                        $(".rr_personnal").unbind("keyup");
                        $(".fh_personnal").unbind("keyup");
                    }
                },
                error: function() {
                    $('#serverModal').modal();
                }
            });
        });

        function dateRange(startDate, endDate) {
            var start      = startDate.split('-');
            var end        = endDate.split('-');
            var startYear  = parseInt(start[0]);
            var endYear    = parseInt(end[0]);
            var dates      = [];

            for(var i = startYear; i <= endYear; i++) {
                var endMonth = i != endYear ? 11 : parseInt(end[1])-1;
                var startMon = i === startYear ? parseInt(start[1])-1 : 0;
                for(var j = startMon; j <= endMonth; j = j > 12 ? j % 12 || 11 : j+1) {
                    var month = j+1;
                    var displayMonth = month < 10 ? month : month;
                    dates.push(displayMonth);
                }
            }

            return dates;
        }

        $('.normal_form').on('submit', function(e) {
            e.preventDefault();
            reason = $('.reason_referral').val();
            form_type = '#normalFormModal';
            department_id = $('.select_department_normal').val();
            department_name = $('.select_department_normal :selected').text();
            $(this).ajaxSubmit({
                url: "{{ url('doctor/patient/refer/normal') }}",
                type: 'POST',
                success: function(data) {
                    //location.reload();
                    sendNormalData(data);
                },
                error: function(){
                    $('#serverModal').modal();
                }
            });
        });

        $('.normal_form_walkin').on('submit', function(e) {
            e.preventDefault();
            reason = $('.reason_referral').val();
            form_type = '#normalFormModal';
            department_id = $('.select_department_normal').val();
            department_name = $('.select_department_normal :selected').text();
            $(this).ajaxSubmit({
                url: "{{ url('doctor/patient/refer/walkin/normal') }}",
                type: 'POST',
                success: function(data) {
                    setTimeout(function() {
                        window.location.reload(false);
                    }, 500);
                },
                error: function() {
                    $('#serverModal').modal();
                }
            });
        });

        $('.pregnant_form').on('submit', function(e) {
            e.preventDefault();
            form_type = '#pregnantFormModal';
            sex = 'Female';
            reason = $('.woman_information_given').val();
            department_id = $('.select_department_pregnant').val();
            department_name = $('.select_department_pregnant :selected').text();
            $(this).ajaxSubmit({
                url: "{{ url('doctor/patient/refer/pregnant') }}",
                type: 'POST',
                success: function(data) {
                    //console.log(data);
                    sendNormalData(data);
                },
                error: function(){
                    $('#serverModal').modal();
                }
            });
        });

        $('.pregnant_form_walkin').on('submit', function(e) {
            e.preventDefault();
            form_type = '#pregnantFormModal';
            sex = 'Female';
            reason = $('.woman_information_given').val();
            department_id = $('.select_department_pregnant').val();
            department_name = $('.select_department_pregnant :selected').text();
            $(this).ajaxSubmit({
                url: "{{ url('doctor/patient/refer/walkin/pregnant') }}",
                type: 'POST',
                success: function(data) {
                    setTimeout(function() {
                        window.location.reload(false);
                    }, 500);
                },
                error: function() {
                    $('#serverModal').modal();
                }
            });
        });

        function sendNormalData(data) {
            if(data.id != 0) {
                var form_data = {
                    referring_name: referring_facility_name,
                    patient_code: data.patient_code,
                    name: name,
                    age: age,
                    sex: sex,
                    date: data.referred_date,
                    form_type: form_type,
                    tracking_id: data.id,
                    referring_md: referring_md,
                    referred_from: referring_facility,
                    department_id: department_id,
                    department_name: department_name
                };

                // var dbRef = firebase.database();
                // var connRef = dbRef.ref('Referral');
                // connRef.child(referred_facility).push(form_data);

                var data = {
                    "to": "/topics/ReferralSystem" + referred_facility,
                    "data": {
                        "subject": "New Referral",
                        "date": data.referred_date,
                        "body": name+" was referred to your facility from " + referring_facility_name + "!"
                    }
                };

                $.ajax({
                    url: 'https://fcm.googleapis.com/fcm/send',
                    type: 'post',
                    data: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'key=AAAAJjRh3xQ:APA91bFJ3YMPNZZkuGMZq8MU8IKCMwF2PpuwmQHnUi84y9bKiozphvLFiWXa5I8T-lP4aHVup0Ch83PIxx8XwdkUZnyY-LutEUGvzk2mu_YWPar8PmPXYlftZnsJCazvpma3y5BI7QHP'
                    },
                    dataType: 'json',
                    success: function (data) {
                        //window.location.reload(false);
                        setTimeout(function () {
                            console.log("Force refresh!");
                            window.location.reload(false);
                        }, 15000);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        console.log("Status: " + textStatus); console.log("Error: " + errorThrown);
                    }
                });

                connRef.on('child_added', function(data) {
                    setTimeout(function() {
                        connRef.child(data.key).remove();
                        window.location.reload(false);
                    }, 500);
                });
            } else {
                setTimeout(function(){
                    window.location.reload(false);
                }, 500);
            }
        }

        @if(Session::get('patient_update_save'))
            Lobibox.notify('success', {
                title: "",
                msg: "<?php echo Session::get("patient_message"); ?>",
                size: 'mini',
                rounded: true,
                sound: false
            });
            <?php
                Session::put("patient_update_save", false);
                Session::put("patient_message", false)
            ?>
        @endif

        @if(Session::get('remove_var'))
            Lobibox.notify('success', {
                title: "",
                msg: "<?php echo Session::get("remove_message"); ?>",
                size: 'mini',
                rounded: true,
                sound: false
            });
            <?php
                Session::put("remove_var", false);
                Session::put("remove_message", false)
            ?>
        @endif

        @if(Session::get('vital_sign_update'))
            Lobibox.notify('success', {
                title: "",
                msg: "<?php echo Session::get("vital_update_message"); ?>",
                size: 'mini',
                rounded: true,
                sound: false
            });
            $('#vital_modal').modal('show');

            var patient_id = "<?php echo Session::get("patient_id_unique"); ?>"
            var url = "<?php echo asset('doctor/patient/vitalbody'); ?>";
            var json = {
                "patient_id" : patient_id,
                "_token" : "<?php echo csrf_token(); ?>"
            };
            $.post(url, json, function(result) {
                $(".vital_body").html(result);
            });
            <?php
                Session::put("vital_sign_update", false);
                Session::put("vital_update_message", false)
            ?>
        @endif

        @if(Session::get('vital_sign_save'))
            Lobibox.notify('success', {
                title: "",
                msg: "<?php echo Session::get("vital_sign_message"); ?>",
                size: 'mini',
                rounded: true,
                sound: false
            });
            $('#vital_modal').modal('show');

            var patient_id = "<?php echo Session::get("patient_id_unique"); ?>"
            var url = "<?php echo asset('doctor/patient/vitalbody'); ?>";
            var json = {
                "patient_id" : patient_id,
                "_token" : "<?php echo csrf_token(); ?>"
            };
            $.post(url, json, function(result) {
                $(".vital_body").html(result);
            });
            <?php
                Session::put("vital_sign_save", false);
                Session::put("vital_sign_message", false)
            ?>
        @endif

        @if(Session::get('physical_exam_save'))
            Lobibox.notify('success', {
                title: "",
                msg: "<?php echo Session::get("physical_exam_message"); ?>",
                size: 'mini',
                rounded: true,
                sound: false
            });
            $('#vital_modal').modal('show');

            var patient_id = "<?php echo Session::get("patient_id_unique"); ?>"
            var url = "<?php echo asset('doctor/patient/vitalbody'); ?>";
            var json = {
                "patient_id" : patient_id,
                "_token" : "<?php echo csrf_token(); ?>"
            };
            $.post(url, json, function(result) {
                $(".vital_body").html(result);
            });
            <?php
                Session::put("physical_exam_save", false);
                Session::put("physical_exam_message", false)
            ?>
        @endif

        @if(Session::get('refer_patient'))
            Lobibox.notify('success', {
                title: "Sucessfully",
                msg: "Referred Patient!",
                sound: false
            });
            <?php
            Session::put("refer_patient", false);
            ?>
        @endif

        @if(Session::get('return_pregnant'))
            Lobibox.notify('success', {
                title: "",
                msg: "Successfully Added Information",
                size: 'mini',
                rounded: true,
                sound: false
            });
            <?php
                Session::put("return_pregnant",false);
            ?>
        @endif   
    })
</script>