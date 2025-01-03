<script>
$( ".affiliated_body_click" ).click(function() {
    $(".affiliated_body").html(loading);
        var url = "<?php echo asset('doctor/affiliated_body'); ?>";
        var json = {
            "_token" : "<?php echo csrf_token(); ?>"
        };
        $.post(url,json,function(result){
            setTimeout(function(){
                $(".affiliated_body").html(result);
            },500);
        });
});

$(document).ready( function () {
        $('#addFacilityModal').on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            changePage(page);
        });
    });

    function changePage(page) {
        var url = "<?php echo asset('doctor/affiliated_body');?>";
        url = url + "?page=" + page;

        var json = {
            "_token" : "<?php echo csrf_token(); ?>",
            "pagination_table" : "true",
            "icd_keyword" : $('#icd_keyword').val()
        };
        $.post(url,json,function(result){
            $('.affiliated_body').html(result);
        });
    }
    
    $( ".affi_find_btn" ).click(function() {
        $(".affiliated_body").html(loading);
        var url = "<?php echo asset('doctor/affiliated_body'); ?>";
        var json = {
            "_token" : "<?php echo csrf_token(); ?>",
            "keyword" : $("#affiliated_keyword").val()
        };
        $.post(url,json,function(result){
            setTimeout(function(){
                $(".affiliated_body").html(result);
            },500);
        });
    });

$( ".delete_affiliated_btn" ).click(function() {
     var id = $(this).data('id');
     var url = "<?php echo asset('doctor/affiliated/delete');?>";
    Lobibox.confirm({
            msg: "Are you sure you want to delete this facility??",
            callback: function ($this, type, ev) {
                if(type == 'yes')
                    var json = {
                    "_token" : "<?php echo csrf_token(); ?>",
                    "id" : id
                };
                $.post(url,json,function(result){
                    window.location.replace("{{ asset('doctor/affiliated') }}");
                });
            }
        });
});


@if(Session::get('affi_add'))
        Lobibox.notify('success', {
            title: "",
            msg: "Facility sucessfully added",
            size: 'mini',
            rounded: true
        });
    <?php
        Session::put("affi_add",false);
    ?>
@endif

@if(Session::get('affi_delete'))
        Lobibox.notify('warning', {
            title: "",
            msg: "Facility deleted!",
            size: 'mini',
            rounded: true
        });
    <?php
        Session::put("affi_delete",false);
    ?>
@endif

</script>