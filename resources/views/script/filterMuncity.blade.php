<script>
    var province_id = 0;
    var muncity_id = 0;
    $('.filter_muncity').on('change',function(){
        muncity_id = $(this).val();
        if(muncity_id!='others'){
            $('.filter_muncity').val(muncity_id);
            var brgy = getBarangay();
            $('.barangay').empty()
                .append($('<option>', {
                    value: '',
                    text : 'Select Barangay...'
                }));
            jQuery.each(brgy, function(i,val){
                $('.barangay').append($('<option>', {
                    value: val.id,
                    text : val.description
                }));

            });
            $('.barangay_holder').show();
            $('.barangay').attr('required',true);
            $('.others_holder').addClass('hide');
            $('.others').attr('required',false);
        }else{
            $('.barangay_holder').hide();
            $('.barangay').attr('required',false);
            $('.others_holder').removeClass('hide');
            $('.others').attr('required',true);
        }

    });


    function getBarangay()
    {
        $('.loading').show();
        var url = "{{ url('location/barangay/') }}";
        var tmp;
        $.ajax({
            url: url+"/"+muncity_id,
            type: 'get',
            async: false,
            success : function(data){
                tmp = data;
                setTimeout(function(){
                    $('.loading').hide();
                },500);
            }
        });
        return tmp;

    }

    $('.filter_province').on('change',function(){
        province_id = $(this).val();
        if(province_id!='others'){
            $('.filter_province').val(province_id);
            var brgy = getProvince();
            $('.muncity').empty()
                .append($('<option>', {
                    value: '',
                    text : 'Select Municipality...'
                }));
            jQuery.each(brgy, function(i,val){
                $('.muncity').append($('<option>', {
                    value: val.id,
                    text : val.description
                }));

            });
            $('.muncity_holder').show();
            $('.muncity').attr('required',true);
            $('.others_holder').addClass('hide');
            $('.others').attr('required',false);
        }else{
            $('.muncity_holder').hide();
            $('.muncity').attr('required',false);
            $('.others_holder').removeClass('hide');
            $('.others').attr('required',true);
        }

    });

    function getProvince()
    {
        $('.loading').show();
        var url = "{{ url('location/muncity/') }}";
        var val;
        $.ajax({
            url: url+"/"+province_id,
            type: 'get',
            async: false,
            success : function(data){
                val = data;
                setTimeout(function(){
                    $('.loading').hide();
                },500);
            }
        });
        return val;

    }
</script>