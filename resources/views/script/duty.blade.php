<?php
    $duty = Session::get('duty');
    $user = Session::get('auth');
?>
<script>
    {{--@if(!$duty && $user->level=='doctor')--}}
        {{--$('#dutyModal').modal();--}}
    {{--@endif--}}

    $('#btn-on-duty').on('click',function(){
        $('.loading').show();
        duty('onduty');
    });

    $('#btn-off-duty').on('click',function(){
        $('.loading').show();
        duty('offduty');
    });

    function duty(option)
    {
        $.ajax({
            url: "{{ url('duty/') }}/"+option,
            type: "GET",
            success: function () {
                setTimeout(function () {
                    window.location.reload(false);
                },500);
            },
            error: function () {
                $('#serverModal').show();
            }
        });
    }
</script>