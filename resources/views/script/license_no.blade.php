<?php
$user = Auth::user();
$license_no = App\Models\Facility::where('id',$user->facility_id)->Where('license_no','<>','')->pluck('license_no');
$level = $user->level;

if (count($license_no) === 0) {
    $count = 0;
}
else
{
    $count = 1;
}
?>
<script>

// $(document).ready(function(){
//         var license_no = "<?php echo $count; ?>"
//         var level = "<?php echo $level; ?>"

//           if( license_no == 0 && level == 'support' )
//           {  
//             Lobibox.alert(
//             'error', // Any of the following
//             {
//             title: "No License Number",
//             closeButton: false,
//             closeOnEsc: false,
//             msg: "Please Input Facility License Number",
//             rounded: true,
//             callback: function ($this, type, ev) {
//                 if(type == 'ok')
//                 {

//                         $('#license_noModal').modal({backdrop: 'static', keyboard: false}, 'show');
//                  }
//               }
//             });    
//           }
//     });   

    $('#license_submit').on('submit',function (e) {
        e.preventDefault();

         var license_no = $('#license_no').val();

        $.ajax({
            url: "{{ url('support/license_no') }}",
            type: 'POST',
            data: {
                license_no : license_no,
                _token: "{{ csrf_token() }}"
            },
            success: function(){
                location.reload();
            },
            error: function () {
                $('#serverModal').show();
                $('.loading').hide();
            }
        })
    });

    @if(Session::get('license_no_saved'))
        Lobibox.notify('success', {
            title: "",
            msg: "License number sucessfully saved!",
            size: 'mini',
            rounded: true
        });
    <?php
        Session::put("license_no_saved",false);
    ?>
    @endif
</script>
