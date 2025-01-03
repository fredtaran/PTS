<script>
    $('#resetForm').on('submit',function (e) {
        e.preventDefault();
        $('.loading').show();
        $('.password_success').addClass('hide');
        $('.password_error').addClass('hide');

        var current = $('#reset_password_current').val();
        var newPass = $('#reset_password_new').val();
        var confirm = $('#reset_password_confirm').val();

        $.ajax({
            url: "{{ url('reset/password') }}",
            type: 'POST',
            data: {
                current : current,
                newPass : newPass,
                confirm: confirm,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                console.log("success")
                setTimeout(function () {
                    $('.loading').hide();
                    if (data=='error') {
                        $('.password_error').removeClass('hide').find('.info').html('Your password is incorrect!');
                    } else if (data=='not_match'){
                        $('.password_error').removeClass('hide').find('.info').html('Password did not match!');
                    } else if (data=='length'){
                        $('.password_error').removeClass('hide').find('.info').html('Password should be minimum 6 characters');
                    } else {
                        $('.password_success').removeClass('hide').find('.info').html('Password changed!');
                        $('#resetForm').find('input[type="password"]').val('');
                    }
                }, 500);
                $('#reset_password_current').focus();
            },
            error: function (error) {
                console.log("error")
                $('#serverModal').show();
                $('.loading').hide();
            }
        })
    });
</script>