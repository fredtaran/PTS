<?php $user = Session::get('auth'); ?>
<script>
var proceed,user_id,user_info;
$('#addUserForm').on('submit',function(e){
    proceed = 0;
    e.preventDefault();
    $('.loading').show();
    var string = $('.username_1').val();
    var link = "{{ url('support/users/check_username') }}/"+string;
    console.log(link);
    $.ajax({
        url: link,
        type: "GET",
        success: function(data){
            if(data==1){
                $('.username-has-error').removeClass('hide');
            }else{
                $('.username-has-error').addClass('hide');
                proceed += 1;
            }

            var password1 = $('#password1').val();
            var password2 = $('#password2').val();
            if(password1 && password2){
                if(password1==password2){
                    proceed += 1;
                    $('.password-has-error').addClass('hide');
                    $('.password-has-match').removeClass('hide');
                }else{
                    $('.password-has-error').removeClass('hide');
                    $('.password-has-match').addClass('hide');
                }
            }

            if(proceed==2){
                $('#addUserForm').ajaxSubmit({
                    url:  "{{ url('support/users/store') }}",
                    type: "POST",
                    success: function(data){
                        setTimeout(function(){
                            window.location.reload(false);
                        },500);
                    },
                    error: function(){
                        $('#serverModal').modal();
                    }
                });
            }else{
                console.log('dont submit');
                $('.loading').hide();
            }
        }
    });


});

$('#updateUserForm').on('submit',function(e){
    proceed = 0;
    e.preventDefault();
    $('.loading').show();
    var string = $('.username').val();
    $.ajax({
        url: "{{ url('support/users/check_username/update/') }}/"+string+"/"+user_id,
        type: "GET",
        success: function(data){
            if(data==1){
                $('.username-has-error').removeClass('hide');
            }else{
                $('.username-has-error').addClass('hide');
                proceed += 1;
            }


            var password1 = $('.password_1').val();
            var password2 = $('.password_2').val();

            if(password1==password2){
                proceed += 1;
                $('.password-has-error').addClass('hide');
                $('.password-has-match').removeClass('hide');
            }else{
                $('.password-has-error').removeClass('hide');
                $('.password-has-match').addClass('hide');
            }

            if(proceed==2){
                $('#updateUserForm').ajaxSubmit({
                    url:  "{{ url('support/users/update') }}",
                    type: "POST",
                    success: function(data){
                        setTimeout(function(){
                            window.location.reload(false);
                        },500);
                    },
                    error: function(){
                        $('#serverModal').modal();
                    }
                });
            }else{
                console.log('dont submit');
                $('.loading').hide();
            }
            console.log(proceed);
        }
    });
});

$('a[href="#addUserModal"]').on('click',function(){
    $('.btn-add').removeClass('hide');
    $('.btn-update').addClass('hide');
});

$('.update_info').on('click',function(){
    user_id = $(this).data('id');
    $.ajax({
        url: "{{ url('support/users/info') }}/"+user_id,
        type: "GET",
        success: function(data)
        {
            user_info = data;
            updateProfile();
        },
        error: function(){
            $('#serverModal').modal();
        }
    });
});

function updateProfile() {
    $('.user_id').val(user_id);
    $('.fname').val(user_info.fname);
    $('.mname').val(user_info.mname);
    $('.lname').val(user_info.lname);
    $('.contact').val(user_info.contact);
    $('.email').val(user_info.email);
    $('.designation').val(user_info.designation);
    $('.department_id').val(user_info.department_id);
    $('.username').val(user_info.username);
    $('.status').val(user_info.status);
    $('.level').val(user_info.level);
}
</script>