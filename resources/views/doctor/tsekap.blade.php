<?php
$user = Session::get('auth');
?>

@extends('layouts.app')

@section('content')
    <div class="col-md-3">
        @include('sidebar.'.$sidebar)
    </div>
    <div class="col-md-9">
        <div class="jim-content">
            <h3 class="page-header">Patient List</h3>
            @if(count($data))
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Barangay</th>
                            <th style="width:18%;">Action</th>
                        </tr>
                        @foreach($data as $row)
                            <tr>
                                <td>
                                    {{ $row->lname }}, {{ $row->fname }} {{ $row->mname }}<br />
                                    <small class="text-info">
                                        @if($source=='tsekap')
                                            Family ID: {{ $row->familyID }}
                                        @else

                                        @endif
                                    </small>
                                </td>
                                <td>{{ $row->sex }}</td>
                                <td>
                                    <?php $age = \App\Http\Controllers\ParamCtrl::getAge($row->dob);?>
                                    {{ $age }}
                                    <br />
                                    <small class="text-muted">{{ date('M d, Y',strtotime($row->dob)) }}</small>
                                </td>
                                <td>
                                    <?php
                                    $brgy_id = ($source=='tsekap') ? $row->barangay_id: $row->brgy;
                                    $city_id = ($source=='tsekap') ? $row->muncity_id: $row->muncity;
                                    $phic_id = ($source=='tsekap') ? $row->phicID: $row->phic_id;
                                    $phic_id_stat = 0;
                                    if($phic_id){
                                        $phic_id_stat = 1;
                                    }
                                    ?>
                                    @if($brgy_id!=0)
                                        {{ $brgy = \App\Barangay::find($brgy_id)->description }}<br />
                                        <small class="text-success">{{ $city = \App\Muncity::find($city_id)->description }}</small>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($row->sex=='Female' && ($age > 14 && $age < 50))
                                        <a href="#pregnantModal"
                                           data-patient_id = "{{ $row->id }}"
                                           data-toggle="modal"
                                           class="btn btn-primary btn-xs profile_info">
                                            <i class="fa fa-stethoscope"></i>
                                            Refer
                                        </a>
                                    @else
                                        <a href="#normalFormModal"
                                           data-patient_id = "{{ $row->id }}"
                                           data-backdrop="static"
                                           data-toggle="modal"
                                           class="btn btn-primary btn-xs profile_info">
                                            <i class="fa fa-stethoscope"></i>
                                            Refer
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <ul class="pagination pagination-sm no-margin pull-right">
                    {{ $data->links() }}
                </ul>

            @else
                <div class="alert alert-warning">
                <span class="text-warning">
                    <i class="fa fa-warning"></i> Patient not found!
                </span>
                </div>
            @endif
            <div class="clearfix"></div>
        </div>
    </div>
    @include('modal.pregnantModal')
    @include('modal.normal_form_editable')
    @include('modal.pregnant_form_editable')
@endsection

@section('js')
    @include('script.filterMuncity')
    @include('script.firebase')
    @include('script.datetime')
<script>
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

    $('.form-submit').on('submit',function(){
        $('.loading').show();
        $('.btn-submit').attr('disabled',true);
    });

    $('.select_facility').on('change',function(){
        var id = $(this).val();
        referred_facility = $(this).find(':selected').data('name');
        referred_facility = id;
        var url = "{{ url('location/facility/') }}";

        $.ajax({
            url: url+'/'+id,
            type: 'GET',
            success: function(data){
                console.log(data);
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
            error: function(){
                $('#serverModal').modal();
            }
        });

        var list = "{{ url('list/doctor') }}";
        $.ajax({
            url: list+'/'+id,
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

    $('.profile_info').on('click',function(){
        patient_id = $(this).data('patient_id');
        $.ajax({
            url: "{{ url('doctor/patient/tsekapinfo/') }}/"+patient_id,
            type: "GET",
            success: function(data){
                patient_id = data.id;
                name = data.patient_name;
                sex = data.sex;
                age = data.age;
                civil_status = data.civil_status;
                phic_status = data.phic_status;
                phic_id = data.phic_id;
                address = data.address;

                $('.patient_name').html(name);
                $('.patient_address').html(address);
                $('input[name="phic_status"][value="'+phic_status+'"]').attr('checked',true);
                $('.phic_id').val(phic_id);
                $('.patient_sex').val(sex);
                $('.patient_age').html(age);
                $('.civil_status').val(civil_status);
                $('.patient_id').val(patient_id);
            },
            error: function(){
                $('#serverModal').modal();
            }
        });
    });
</script>
<script>
    $('.normal_form').on('submit',function(e){
        e.preventDefault();
        reason = $('.reason_referral').val();
        form_type = '#normalFormModal';
        department_id = $('.select_department_normal').val();
        department_name = $('.select_department_normal :selected').text();

        $(this).ajaxSubmit({
            url: "{{ url('doctor/patient/refer/normal') }}",
            type: 'POST',
            success: function(data){
                sendNormalData(data);
            },
            error: function(){
                $('#serverModal').modal();
            }
        });

    });

    $('.pregnant_form').on('submit',function(e){
        e.preventDefault();
        form_type = '#pregnantFormModal';
        sex = 'Female';
        reason = $('.woman_information_given').val();
        department_id = $('.select_department_pregnant').val();
        department_name = $('.select_department_pregnant :selected').text();
        $(this).ajaxSubmit({
            url: "{{ url('doctor/patient/refer/pregnant') }}",
            type: 'POST',
            success: function(data){
                //console.log(data);
                sendNormalData(data);
            },
            error: function(){
                $('#serverModal').modal();
            }
        });

    });

    function sendNormalData(data)
    {
        console.log(data);
        if(data.id!=0){
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
            var dbRef = firebase.database();
            var connRef = dbRef.ref('Referral');
            connRef.child(referred_facility).push(form_data);

            var data = {
                "to": "/topics/ReferralSystem"+referred_facility,
                "data": {
                    "subject": "New Referral",
                    "date": data.referred_date,
                    "body": name+" was referred to your facility from "+referring_facility_name+"!"
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


            connRef.on('child_added',function(data){
                setTimeout(function(){
                    connRef.child(data.key).remove();
                    window.location.reload(false);
                },500);
            });
        }else{
            setTimeout(function(){
                window.location.reload(false);
            },500);
        }
    }
</script>
@endsection

