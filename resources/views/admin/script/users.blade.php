<?php $user = Auth::user(); ?>
<script>
    var proceed;
    $('#user_form').on('submit', function(e){
        proceed = 0;

        e.preventDefault();
        $('.loading').show();

        var string = $('.username_1').val();
        var user_id = $(".user_id").val();
        var link = "{{ url('admin/users/check_username') }}/" + string;

        $.ajax({
            url: link,
            type: "GET",
            success: function(data) {
                if (data == 1 && user_id == "no_id") {
                    $('.username-has-error').removeClass('hide');
                } else {
                    $('.username-has-error').addClass('hide');
                    proceed += 1;
                }

                var password1 = $('#password1').val();
                var password2 = $('#password2').val();

                if(password1 == password2) {
                    proceed += 1;
                    $('.password-has-error').addClass('hide');
                    $('.password-has-match').removeClass('hide');
                } else {
                    $('.password-has-error').removeClass('hide');
                    $('.password-has-match').addClass('hide');
                }

                if(proceed == 2) {
                    $('#user_form').ajaxSubmit({
                        url:  "{{ url('admin/users/store') }}",
                        type: "POST",
                        success: function(data) {
                            setTimeout(function() {
                                window.location.reload(false);
                            }, 500);
                        },
                        error: function() {
                            $('#serverModal').modal();
                        }
                    });
                } else {
                    console.log('dont submit');
                    $('.loading').hide();
                }
            }
        });
    });

    $('.update_info').on('click', function() {
        $(".users_body").html(loading);

        var user_id = $(this).data('id');
        $.ajax({
            url: "{{ url('admin/users/info') }}/" + user_id,
            type: "GET",
            success: function(data)
            {
                setTimeout(function() {
                    $(".users_body").html(data);
                }, 700);
            },
            error: function() {
                $('#serverModal').modal();
            }
        });
    });

    $('.add_info').on('click',function(){
        $(".users_body").html(loading);

        var user_id = $(this).data('id');
        $.ajax({
            url: "{{ url('admin/users/info') }}/"+user_id,
            type: "GET",
            success: function(data)
            {
                setTimeout(function(){
                    $(".users_body").html(data);
                },700);
            },
            error: function(){
                $('#serverModal').modal();
            }
        });
    });

</script>