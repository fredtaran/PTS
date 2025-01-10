<script type="module">
    import { app } from '{{ asset("js/firebase.js") }}'
    import { getDatabase, ref, onValue, onChildAdded } from 'https://www.gstatic.com/firebasejs/11.0.2/firebase-database.js'

    $(document).ready(function() {
        <?php $user = Auth::user(); ?>
        const db = getDatabase();
        const seenRef = ref(db, 'Seen');
        const acceptRef = ref(db, 'Accept');
        const rejectRef = ref(db, 'Reject');
        const callRef = ref(db, 'Call');
        const arriveRef = ref(db, 'Arrive');
        const admitRef = ref(db, 'Admit');
        const dischargeRef = ref(db, 'Discharge');
        const referredRef = ref(db, 'Referred');
        var myfacility_name = {{ $user->facility_id }} == 0 ? 'DOH CHD-NM' : {{ \App\Models\Facility::find(0)?->name->first()->name }} + "";

        onChildAdded(seenRef, (snapshot) => {
                var data = snapshot.val();
                var item = '.code-' + data.code;
                var activity = '#activity-' + data.activity_id;
                var date = data.date;
                item = $(item).find('#item-' + data.item);

                $(item).removeClass('pregnant-section normal-section').addClass('read-section');
                $(item).find('.icon').removeClass('fa-ambulance').addClass('fa-eye');
                $(item).find('.date_activity').html(date);
                $(activity).removeClass('pregnant-section normal-section').addClass('read-section');
                $(activity).find('.icon').removeClass('fa-ambulance').addClass('fa-eye');
                $(activity).find('.date_activity').html(date);
        });

        var acceptContent = '';
        var rejectContent = '';
        onChildAdded(acceptRef, (snapshot) => {
            var data = snapshot.val();
            var date = data.date;
            var action_md = data.action_md;
            var facility_name = data.facility_name;
            var patient_name = data.patient_name;
            acceptContent = '<li>\n' +
                '    <div class="timeline-item read-section">\n' +
                '        <span class="time"><i class="fa fa-user-plus"></i> ' + date + '</span>\n' +
                '        <a>\n' +
                '            <div class="timeline-header no-border">\n' +
                '                ' + patient_name + '  was accepted by <span class="text-success">Dr. ' + action_md + '</span> of <span class="facility">' + facility_name + '</span>.</span>\n' +
                '            <br />' +
                '            <div class="text-remarks">Remarks: ' + data.reason + '</div>'+
                '            </div>\n' +
                '        </a>\n' +
                '\n' +
                '    </div>\n' +
                '</li>';
            $('.code-' + data.code + ' > li:nth-child(1)').after(acceptContent);
        });

        onChildAdded(rejectRef, (snapshot) => {
            var data = snapshot.val();
            var date = data.date;
            var patient_name = data.patient_name;
            var action_md = data.action_md;
            var old_facility = data.old_facility;
            var new_facility = data.new_facility;

            rejectContent = '<li><div class="timeline-item read-section">\n' +
                '    <span class="time"><i class="fa fa-user-times"></i> ' + date + '</span>\n' +
                '    <a>\n' +
                '        <div class="timeline-header no-border">\n' +
                '            <span class="text-danger">Dr. ' + action_md + '</span> of <span class="facility">' + old_facility + '</span> recommended to redirect <span class="text-success">' + patient_name + '</span> to other facility .\n' +
                '            <br />' +
                '            <div class="text-remarks">Remarks: ' + data.reason + '</div>';
            if(data.referred_from == "{{ $user->facility_id }}"){
                rejectContent += '<button class="btn btn-success btn-xs btn-referred" data-toggle="modal" data-target="#referredFormModal" data-activity_id="' + data.activity_id + '">\n' +
                    '    <i class="fa fa-ambulance"></i> Refer to other facility\n' +
                    '</button>';
            }

            rejectContent +='        </div>\n' +
                '    </a>\n' +
                '\n' +
                '</div></li>';
            $('.code-' + data.code +' > li:nth-child(1)').after(rejectContent);
            //$('.code-'+data.code).append(rejectContent);
        });

        var callContent = '';
        onChildAdded(callRef, (snapshot) => {
            var data = snapshot.val();

            var date = data.date;
            var action_md = data.action_md;
            var facility_calling = data.facility_calling;
            callContent = '<li><div class="timeline-item normal-section">\n' +
                '    <span class="time"><i class="fa fa-phone"></i> ' + date + '</span>\n' +
                '    <a>\n' +
                '        <div class="timeline-header no-border">\n' +
                '            <span class="text-info">Dr. ' + action_md + '</span> of <span class="facility">' + facility_calling + '</span> is requesting a call from <span class="facility">' + data.referred_name + '</span>. ';

            if(data.referred_from == "{{ $user->facility_id }}"){
                callContent += 'Please contact this number <span class="text-danger">(' + data.contact + ')</span>.</span>\n' +
                    '<br />\n' +
                    '  <button type="button" class="btn btn-success btn-sm btn-call"\n' +
                    '   data-action_md = "' + data.action_md + '"\n' +
                    '     data-facility_name = "' + data.facility_calling + '"\n' +
                    '      data-activity_id="' + data.activity_id + '"><i class="fa fa-phone"></i> Called</button>\n';
            }

            callContent += '        <div class="text-remarks hide"></div>' +
                '        </div>\n' +
                '    </a>\n' +
                '\n' +
                '</div></li>';
            $('.code-' + data.code + ' > li:nth-child(1)').after(callContent);
            //$('.code-'+data.code).append(callContent);
        });

        var arriveContent = '';
        onChildAdded(callRef, (snapshot) => {
            var data = snapshot.val();
            var date = data.date;
            var patient_name = data.patient_name;
            var current_facility = data.current_facility;

            arriveContent = '<li><div class="timeline-item read-section">\n' +
                '    <span class="time"><i class="fa fa-wheelchair"></i> ' + date + '</span>\n' +
                '    <a>\n' +
                '        <div class="timeline-header no-border">\n' +
                '            ' + patient_name + ' arrived at <span class="facility">' + current_facility + '</span>.\n' +
                '            <br />' +
                '            <div class="text-remarks">Remarks: ' + data.remarks + '</div>'+
                '        </div>\n' +
                '    </a>\n' +
                '\n' +
                '</div></li>';
            $('.code-' + data.code + ' > li:nth-child(1)').after(arriveContent);
            //$('.code-'+data.code).append(arriveContent);
        });

        var admitContent = '';
        onChildAdded(callRef, (snapshot) => {
            var data = snapshot.val();
            var date = data.date;
            var patient_name = data.patient_name;
            var current_facility = data.current_facility;

            admitContent = '<li><div class="timeline-item read-section">\n' +
                '    <span class="time"><i class="fa fa-stethoscope"></i> ' + date + '</span>\n' +
                '    <a>\n' +
                '        <div class="timeline-header no-border">\n' +
                '            ' + patient_name + ' admitted at <span class="facility">' + current_facility + '</span>.\n' +
                '        </div>\n' +
                '    </a>\n' +
                '\n' +
                '</div></li>';
            $('.code-' + data.code + ' > li:nth-child(1)').after(admitContent);
            //$('.code-'+data.code).append(admitContent);
        });

        var dischargeContent = '';
        onChildAdded(callRef, (snapshot) => {
            var data = snapshot.val();
            var date = data.date;
            var patient_name = data.patient_name;
            var current_facility = data.current_facility;

            dischargeContent = '<li><div class="timeline-item read-section">\n' +
                '    <span class="time"><i class="fa fa-wheelchair-alt"></i> ' + date + '</span>\n' +
                '    <a>\n' +
                '        <div class="timeline-header no-border">\n' +
                '            ' + patient_name + ' discharged from <span class="facility">' + current_facility + '</span>.\n' +
                '            <br />' +
                '            <div class="text-remarks">Remarks: ' + data.remarks + '</div>'+
                '        </div>\n' +
                '    </a>\n' +
                '\n' +
                '</div></li>';
            $('.code-' + data.code + ' > li:nth-child(1)').after(dischargeContent);
            // $('.code-'+data.code).append(dischargeContent);
        });

        var transferContent = '';
        onChildAdded(callRef, (snapshot) => {
            var data = snapshot.val();
            var date = data.date;
            var patient_name = data.patient_name;
            var action_md = data.action_md;
            var old_facility = data.old_facility;
            var new_facility = data.new_facility;

            transferContent = '<li><div class="timeline-item normal-section" id="activity-' + data.activity_id + '">\n' +
                '    <span class="time"><i class="icon fa fa-ambulance"></i> <span class="date_activity">' + date + '</span></span>\n' +
                '    <a>\n' +
                '        <div class="timeline-header no-border">\n' +
                '            ' + patient_name + '  was referred by <span class="text-success">Dr. ' + action_md + '</span> of <span class="facility">' + old_facility + '</span> to <span class="facility">' + new_facility + '.</span>\n';
                if(data.reason){
                    transferContent += '<br />' +
                        '            <div class="text-remarks">Remarks: ' + data.reason + '</div>';
                }
            transferContent += '        </div>\n' +
                '    </a>\n' +
                '</div></li>';
            $('.code-' + data.code + ' > li:nth-child(1)').after(transferContent);
            // $('.code-'+data.code).append(transferContent);
        });
    })
</script>

{{--Script for Call Button--}}
<script>
    $(document).ready(function() {
        $('body').on('click', '.btn-call', function() {
            $('.loading').show();
            var action_md = $(this).data('action_md');
            var facility_name = $(this).data('facility_name');
            var activity_id = $(this).data('activity_id');
            var md_name = "{{ $user->fname }} {{ $user->mname }} {{ $user->lname }}";
            var div = $(this).parent().closest('.timeline-item');
            div.removeClass('normal-section').addClass('read-section');
            $(this).hide();
            div.find('.text-remarks').removeClass('hide').html('Remarks: Dr. ' + md_name + ' called ' + facility_name);
            $.ajax({
                url: "{{ url('doctor/referral/call/') }}/" + activity_id,
                type: 'GET',
                success: function() {
                    setTimeout(function() {
                        $('.loading').hide();
                    }, 300);
                },
                error: function(){
                    $('#serverModal').modal();
                }
            });
        });
    });
</script>

{{--script for refer to other facility--}}
<script type="module">
import { app } from '{{ asset("js/firebase.js") }}'
import { getDatabase, ref, set, onValue, onChildAdded, remove } from 'https://www.gstatic.com/firebasejs/11.0.2/firebase-database.js'

    $(document).ready(function() {
        const db = getDatabase();
        const transferRef = ref(db, 'Transfer');

        $('.select_facility').on('change', function() {
            var id = $(this).val();
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

                    jQuery.each(data.departments, function(i, val) {
                        $('.select_department').append($('<option>', {
                            value: val.id,
                            text : val.description
                        }));
                    });
                },
                error: function() {
                    $('#serverModal').modal();
                }
            });
        });

        var activity_id = 0;
        $('body').on('click', '.btn-referred', function() {
            activity_id = $(this).data('activity_id');
        });

        $('body').on('submit', '#referredForm', function(e) {
            e.preventDefault();
            $('.loading').show();
            var referred_to = $('#referredForm').find('.new_facility').val();
            var department_name = $('.select_department_referred :selected').text();
            var department_id = $('.select_department_referred').val();
            $(this).ajaxSubmit({
                url: "{{ url('doctor/referral/redirect/') }}/" + activity_id,
                type: 'POST',
                success: function(data) {
                    if(data.status == 'pregnant') {
                        
                    } else {
                        transferRef.push({
                            date: data.date,
                            item: data.track_id,
                            new_facility: data.referred_facility,
                            old_facility: myfacility_name,
                            action_md: data.action_md,
                            patient_name: data.patient_name,
                            code: data.code,
                            activity_id: data.activity_id
                        });

                        transferRef.on('child_added', function(d) {
                            transferRef.child(d.key).remove();
                        });

                        var connRef = ref(db, 'Referral');
                        var refer_data = {
                            referring_name: myfacility_name,
                            patient_code: data.code,
                            name: data.patient_name,
                            age: data.age,
                            sex: data.sex,
                            date: data.date,
                            form_type: data.form_type,
                            tracking_id: data.track_id,
                            referring_md: data.action_md,
                            department_name: department_name,
                            department_id: department_id,
                            activity_id: data.activity_id,
                            referred_facility: data.referred_facility
                        };
                        connRef.child(referred_to).push(refer_data);

                        connRef.on('child_added', function(data) {
                            setTimeout(function() {
                                connRef.child(data.key).remove();
                                window.location.reload(false);
                            }, 500);
                        });

                        var data = {
                            "to": "/topics/ReferralSystem" + referred_to,
                            "data": {
                                "subject": "New Referral",
                                "date": data.date,
                                "body": data.patient_name + " was referred to your facility from " + myfacility_name + "!"
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
                                console.info(data);
                            }
                        });
                    }
                },
                error: function(){
                    $('#serverModal').modal();
                }
            });
        });
    })
</script>

{{--show and hide activity--}}
<script>
    $(document).ready(function() {
        $('ul.timeline li').not(":first-child").not(":nth-child(2)").hide();
        $('.btn-activity').on('click', function() {
            var item = $(this).parent().parent().parent().parent().parent().parent().find('li');
            item.not(":first-child").not(":nth-child(2)").toggle();
        });
    })
</script>

{{--VIEW FORM--}}
<script>
    $(document).ready(function() {
        $(".lmp_date").inputmask("mm/dd/yyyy");
        $(".edc_edd").inputmask("mm/dd/yyyy");

        $(".prev_date").inputmask("mm/dd/yyyy");

        $(".td1").inputmask("mm/dd/yyyy");  
        $(".td2").inputmask("mm/dd/yyyy");  
        $(".td3").inputmask("mm/dd/yyyy");  
        $(".td4").inputmask("mm/dd/yyyy");  
        $(".td5").inputmask("mm/dd/yyyy");  

        $(".date_of_lab").inputmask("mm/dd/yyyy");

        var id = 0; 
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
                    var patient_address='';

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

                        var date = new Date(form.lmp);
                        var day = ("0" + date.getDate()).slice(-2);
                        var month = ("0" + (date.getMonth() + 1)).slice(-2);

                        var lmp_new = (month) + "/" + (day) + "/" + date.getFullYear() ;

                        var date2 = new Date(form.edc_edd);
                        var day2 = ("0" + date2.getDate()).slice(-2);
                        var month2 = ("0" + (date2.getMonth() + 1)).slice(-2);

                        var edc_edd = (month2) + "/" + (day2) + "/" + date2.getFullYear() ;

                        $("input[name='lmp']").val(lmp_new);
                        $("input[name='edc_edd']").val(edc_edd);
                        $("input[name='height']").val(form.height);
                        $("input[name='weigth']").val(form.weigth);
                        $("input[name='bp']").val(form.bp);
                        $("input[name='temp']").val(form.temp);

                        $("input[name='rr']").val(form.rr);
                        var td1 = form.td1 ? new Date(form.td1) : '';
                        var td2 = form.td2 ? new Date(form.td2) : '';
                        var td3 = form.td3 ? new Date(form.td3) : '';
                        var td4 = form.td4 ? new Date(form.td4) : '';
                        var td5 = form.td5 ? new Date(form.td5) : '';

                        (td1 != '') ? $('.td1').val( ((td1.getMonth() > 8) ? (td1.getMonth() + 1) : ('0' + (td1.getMonth() + 1))) + '/' + ((td1.getDate() > 9) ? td1.getDate() : ('0' + td1.getDate())) + '/' + td1.getFullYear() ) : '';
                        (td2 != '') ? $('.td2').val( ((td2.getMonth() > 8) ? (td2.getMonth() + 1) : ('0' + (td2.getMonth() + 1))) + '/' + ((td2.getDate() > 9) ? td2.getDate() : ('0' + td2.getDate())) + '/' + td2.getFullYear() ) : '';
                        (td3 != '') ? $('.td3').val( ((td3.getMonth() > 8) ? (td3.getMonth() + 1) : ('0' + (td3.getMonth() + 1))) + '/' + ((td3.getDate() > 9) ? td3.getDate() : ('0' + td3.getDate())) + '/' + td3.getFullYear() ) : '';
                        (td4 != '') ? $('.td4').val( ((td4.getMonth() > 8) ? (td4.getMonth() + 1) : ('0' + (td4.getMonth() + 1))) + '/' + ((td4.getDate() > 9) ? td4.getDate() : ('0' + td4.getDate())) + '/' + td4.getFullYear() ) : '';
                        (td5 != '') ? $('.td5').val( ((td5.getMonth() > 8) ? (td5.getMonth() + 1) : ('0' + (td5.getMonth() + 1))) + '/' + ((td5.getDate() > 9) ? td5.getDate() : ('0' + td5.getDate())) + '/' + td5.getFullYear() ) : ''; 

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
                        
                        $('.patient_dob').html($.datepicker.formatDate('M dd,  yy', new Date(dob)));
                        $('.patient_age').html(age);
                        $('.patient_contact').html(contact);
                    }

                    if(sign_symptoms != null) {
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

                    if(antepartum != null) {
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

                    if(lab_result.length > 0) {
                        console.log(lab_result);
                        var now = new Date(lab_result[0].date_of_lab);

                        var day = ("0" + now.getDate()).slice(-2);
                        var month = ("0" + (now.getMonth() + 1)).slice(-2);

                        var new_date_of_lab = (month) + "/" + (day) + "/" + now.getFullYear() ;

                        $('.date_of_lab').val(new_date_of_lab);
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
                            var now = new Date(lab_result[i].date_of_lab);

                            var day = ("0" + now.getDate()).slice(-2);
                            var month = ("0" + (now.getMonth() + 1)).slice(-2);

                            var new_date_of_lab = (month) + "/" + (day) + "/" + now.getFullYear() ;
                            var markup = '<tr><td> <input type="text" class="form-control date_of_lab" placeholder="mm/dd/yyyy" value="' + new_date_of_lab + '" name="date_of_lab[]" disabled></td><td><div class="row"><div class="col-md-6">Hgb: <input type="text" class="form-control" name="cbc_hgb[]" value="' + lab_result[i].cbc_hgb + '" disabled> </div><div class="col-md-6">WBC: <input type="text" class="form-control" name="cbc_wbc[]" value="' + lab_result[i].cbc_wbc + '" disabled></div></div><div class="row"><div class="col-md-6">RBC: <input type="text" class="form-control" name="cbc_rbc[]" value="' + lab_result[i].cbc_rbc + '" disabled> </div><div class="col-md-6">Platelet: <input type="text" class="form-control" value="' + lab_result[i].cbc_platelet + '" name="cbc_platelet[]" disabled></div></div><div class="row"><div class="col-md-12">Hct: <input type="text" class="form-control" value="' + lab_result[i].cbc_hct + '" name="cbc_hct[]" disabled></div></div></td><td><div class="row"><div class="col-md-6">Pus: <input type="text" class="form-control" value="' + lab_result[i].ua_pus + '" name="ua_pus[]" disabled> </div><div class="col-md-6">RBC: <input type="text" class="form-control" value="' + lab_result[i].ua_rbc + '" name="ua_rbc[]" disabled></div></div><div class="row"><div class="col-md-6">Sugar: <input type="text" class="form-control" value="' + lab_result[i].ua_sugar + '" name="ua_sugar[]" disabled> </div><div class="col-md-6">Specific Gravity: <input type="text" class="form-control" value="' + lab_result[i].ua_gravity + '" name="ua_gravity[]" disabled></div></div><div class="row"><div class="col-md-12">Albumin: <input type="text" class="form-control" value="' + lab_result[i].ua_albumin + '" name="ua_albumin[]" disabled></div></div></td><td> <textarea name="utz[]" class="form-control" disabled>' + lab_result[i].utz + '</textarea> </td><td><textarea name="lab_remarks[]" class="form-control" disabled>' + lab_result[i].lab_remarks + '</textarea> </td></tr>';

                            $('#blood_type_referred').attr('rowspan', function(i, rs) { return rs + 1; })
                            $('#hbsag_result_referred').attr('rowspan', function(i, rs) { return rs + 1; })
                            $('#vdrl_result_referred').attr('rowspan', function(i, rs) { return rs + 1; })

                            $('#table_lab_res_referred tr:last').after(markup);
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

        function getNormalForm() {
            $.ajax({
                url: "{{ url('doctor/referral/data/normal') }}/" + id,
                type: "GET",
                success: function(data) {
                    var print_url = "{{ url('doctor/print/form/') }}/" + id;
                    $('.btn-refer-normal').attr('href', print_url); 
                    $('.button_option').hide();
                
                    patient_name = data.patient_name;
                    referring_name = data.referring_name;

                    var address='';
                    var patient_address='';
                    var referred_address = '';

                    address += (data.facility_brgy) ? data.facility_brgy + ', ' : '';
                    address += (data.facility_muncity) ? data.facility_muncity + ', ' : '';
                    address += (data.facility_province) ? data.facility_province: '';

                    referred_address += (data.ff_brgy) ? data.ff_brgy + ', ' : '';
                    referred_address += (data.ff_muncity) ? data.ff_muncity + ', ' : '';
                    referred_address += (data.ff_province) ? data.ff_province : '';

                    patient_address += (data.patient_brgy) ? data.patient_brgy + ', ' : '';
                    patient_address += (data.patient_muncity) ? data.patient_muncity + ', ' : '';
                    patient_address += (data.patient_province) ? data.patient_province : '';

                    var case_summary = data.case_summary;
                    if (/\n/g.test(case_summary)) {
                        case_summary = case_summary.replace(/\n/g, '<br>');
                    }

                    var reco_summary = data.reco_summary;
                    if (/\n/g.test(reco_summary)) {
                        reco_summary = reco_summary.replace(/\n/g, '<br>');
                    }

                    var diagnosis = data.diagnosis;
                    if (/\n/g.test(diagnosis)) {
                        diagnosis = diagnosis.replace(/\n/g, '<br>');
                    }

                    var reason = data.reason;
                    if (/\n/g.test(reason)) {
                        reason = reason.replace(/\n/g, '<br>');
                    }

                    age = data.age;
                    sex = data.sex;
                    referring_contact = data.referring_contact;
                    referring_md_contact = data.referring_md_contact;
                    referred_name = data.referring_name;

                    $('span.referring_name').html(data.referring_name);
                    $('span.department_name').html(data.department);
                    $('span.referring_contact').html(data.referring_contact);
                    $('span.referring_address').html(address);
                    $('span.referred_name').html(data.referred_name);
                    $('span.referred_address').html(referred_address);
                    $('span.time_referred').html(data.time_referred);
                    $('span.patient_name').html(data.patient_name);
                    $('span.patient_age').html(data.age);
                    $('span.patient_sex').html(data.sex);
                    $('span.patient_status').html(data.civil_status);
                    $('span.patient_address').html(patient_address);
                    $('span.phic_status').html(data.phic_status);
                    $('span.phic_id').html(data.phic_id);
                    $('span.patient_bday').html(data.bday);
                    $('span.referring_license_no').html(data.referring_license_no);
                    $('span.covid_number').html(data.covid_number);
                    $('span.clinical_status').html(data.refer_clinical_status);
                    $('span.surveillance_category').html(data.refer_sur_category);

                    $('span.case_summary').append(case_summary);
                    $('span.reco_summary').html(reco_summary);
                    $('span.diagnosis').html(diagnosis);
                    $('span.reason').html(reason);
                    $('span.referring_md').html(data.md_referring);
                    $('span.referring_md_contact').html(data.referring_md_contact);
                    $('span.referred_md').html(data.md_referred);
                    $('.loading').hide();
                },
                error: function() {
                    $('#serverModal').modal();
                    $('.loading').hide();
                }
            });
        }

        function getPregnantForm() {
            $.ajax({
                url: "{{ url('doctor/referral/data/pregnant') }}/" + id,
                type: "GET",
                success: function(record) {
                    var print_url = "{{ url('doctor/print/form/') }}/" + id;
                    $('.btn-refer-pregnant').attr('href', print_url);
                    $('.button_option').hide();

                    var data = record.form;
                    var baby = record.baby;
                    var patient_address='';
                    var referred_address= '';
        
                    patient_address += (data.patient_brgy) ? data.patient_brgy + ', ' : '';
                    patient_address += (data.patient_muncity) ? data.patient_muncity + ', ' : '';
                    patient_address += (data.patient_province) ? data.patient_province : '';

                    referred_address += (data.ff_brgy) ? data.ff_brgy + ', ' : '';
                    referred_address += (data.ff_muncity) ? data.ff_muncity + ', ' : '';
                    referred_address += (data.ff_province) ? data.ff_province : '';

                    var woman_major_findings = data.woman_major_findings;
                    if (/\n/g.test(woman_major_findings)) {
                        woman_major_findings = woman_major_findings.replace(/\n/g, '<br>');
                    }

                    var woman_information_given = data.woman_information_given;
                    if (/\n/g.test(woman_information_given)) {
                        woman_information_given = woman_information_given.replace(/\n/g, '<br>');
                    }

                    if(baby) {
                        var baby_major_findings = baby.baby_major_findings;
                        if (/\n/g.test(baby_major_findings)) {
                            baby_major_findings = baby_major_findings.replace(/\n/g, '<br>');
                        }

                        var baby_information_given = baby.baby_information_given;
                        if (/\n/g.test(baby_information_given)) {
                            baby_information_given = baby_information_given.replace(/\n/g, '<br>');
                        }
                    }

                    age = data.woman_age;
                    sex = data.sex;
                    referring_contact = data.referring_contact;
                    referring_md_contact = data.referring_md_contact;
                    referred_name = data.referring_facility;

                    $('span.record_no').html(data.record_no);
                    $('span.referred_date').html(data.referred_date);
                    $('span.md_referring').html(data.md_referring);
                    $('span.referring_md_contact').html(data.referring_md_contact);
                    $('span.referring_facility').html(data.referring_facility);
                    $('span.referred_name').html(data.referred_facility);
                    $('span.referred_address').html(referred_address);
                    $('span.department_name').html(data.department);
                    $('span.referring_contact').html(data.referring_contact);
                    $('span.facility_brgy').html(data.facility_brgy);
                    $('span.facility_muncity').html(data.facility_muncity);
                    $('span.facility_province').html(data.facility_province);
                    $('span.health_worker').html(data.health_worker);
                    $('span.woman_name').html(data.woman_name);
                    $('span.woman_age').html(data.woman_age);
                    $('span.woman_bday').html(data.bday);
                    $('span.woman_address').html(patient_address);
                    $('span.woman_reason').html(data.woman_reason);
                    $('span.woman_major_findings').html(woman_major_findings);
                    $('span.woman_before_treatment').html(data.woman_before_treatment);
                    $('span.woman_before_given_time').html(data.woman_before_given_time);
                    $('span.woman_during_transport').html(data.woman_during_transport);
                    $('span.woman_transport_given_time').html(data.woman_transport_given_time);
                    $('span.woman_information_given').html(woman_information_given);
        
                    $('span.covid_number').html(data.covid_number);
                    $('span.clinical_status').html(data.refer_clinical_status);
                    $('span.surveillance_category').html(data.refer_sur_category);

                    if(baby) {
                        $('span.baby_name').html(baby.baby_name);
                        $('span.baby_dob').html(baby.baby_dob);
                        $('span.weight').html(baby.weight);
                        $('span.gestational_age').html(baby.gestational_age);
                        $('span.baby_reason').html(baby.baby_reason);
                        $('span.baby_major_findings').html(baby_major_findings);
                        $('span.baby_last_feed').html(baby.baby_last_feed);
                        $('span.baby_before_treatment').html(baby.baby_before_treatment);
                        $('span.baby_before_given_time').html(baby.baby_before_given_time);
                        $('span.baby_during_transport').html(baby.baby_during_transport);
                        $('span.baby_transport_given_time').html(baby.baby_transport_given_time);
                        $('span.baby_information_given').html(baby_information_given);
                    }

                    $('.loading').hide();
                },
                error: function() {
                    $('#serverModal').modal();
                    $('.loading').hide();
                }
            });
        }

        
    })
</script>

{{--SEEN BY--}}
<script>
    $(document).ready(function() {
        $('body').on('click', '.btn-seen', function() {
            var de = '<hr />\n' +
                '                    LOADING...\n' +
                '                    <br />\n' +
                '                    <br />';
            $('#seenBy_section').html(de);
            var id = $(this).data('id');

            var seenUrl = "{{ url('doctor/referral/seenBy/list/') }}/" + id;
            $.ajax({
                url: seenUrl,
                type: "GET",
                success: function(data) {
                    var content = '<div class="list-group">';

                    jQuery.each(data, function(i, val) {
                        content += '<a href="#" class="list-group-item clearfix">\n' +
                            '<span class="title-info">Dr. ' + val.user_md + '</span>\n' +
                            '<br />\n' +
                            '<small class="text-primary">\n' +
                            'Seen: ' + val.date_seen + '\n' +
                            '</small>\n' +
                            '<br />\n' +
                            '<small class="text-success">\n' +
                            'Contact: ' + val.contact + '\n' +
                            '</small>\n' +
                            '</a>';
                    });

                    content += '</div>';

                    setTimeout(function () {
                        $('#seenBy_section').html(content);
                    }, 500);
                },
                error: function () {
                    $('#serverModal').modal('show');
                }
            });
        });

        $('body').on('click', '.btn-caller', function() {
            var de = '<hr />\n' +
                '                    LOADING...\n' +
                '                    <br />\n' +
                '                    <br />';
            $('#callerBy_section').html(de);
            var id = $(this).data('id');
            var callerUrl = "{{ url('doctor/referral/callerBy/list/') }}/" + id;
            $.ajax({
                url: callerUrl,
                type: "GET",
                success: function(data) {
                    var content = '<div class="list-group">';

                    jQuery.each(data, function(i, val) {
                        content += '<a href="#" class="list-group-item clearfix">\n' +
                            '<span class="title-info">' + val.user_md + '</span>\n' +
                            '<br />\n' +
                            '<small class="text-primary">\n' +
                            'Time: ' + val.date_call + '\n' +
                            '</small>\n' +
                            '<br />\n' +
                            '<small class="text-success">\n' +
                            'Contact: ' + val.contact + '\n' +
                            '</small>\n' +
                            '</a>';
                    });

                    content += '</div>';
                    setTimeout(function () {
                        $('#callerBy_section').html(content);
                    }, 500);
                },
                error: function () {
                    $('#serverModal').modal('show');
                }
            });
        });
    })
</script>

{{--CANCEL REFERRAL--}}
<script>
    $(document).ready(function() {
        $('body').on('click', '.btn-cancel', function() {
            var id = $(this).data('id');
            var url = "{{ url('doctor/referred/cancel') }}/" + id;
            $("#cancelReferralForm").attr('action', url);
        });
    })
</script>
{{--<div class="list-group">--}}
{{--<a href="#" class="list-group-item clearfix">--}}
{{--<span class="title-info">Dr. Jimmy</span>--}}
{{--<br />--}}
{{--<small class="text-primary">--}}
{{--Seen: May 15, 2018 03:15 PM--}}
{{--</small>--}}
{{--<br />--}}
{{--<small class="text-success">--}}
{{--Contact: 0916-207-2427--}}
{{--</small>--}}
{{--</a>--}}

{{--</div>--}}