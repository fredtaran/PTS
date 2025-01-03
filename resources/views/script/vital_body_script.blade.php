<script>

function pexamRemove(vital_id){
    $.ajax({
        url: "{{ url('doctor/patient/pexam/remove') }}/"+vital_id,
        type: "GET",
        success: function(record){
            var message = record.message
            Lobibox.notify('success', {
            title: "",
            msg: message,
            sleep: 150000,
            size: 'mini',
            rounded: true
        });

      
        },
        error: function(){
            $('#serverModal').modal();
        }
     });
    }

function removeId(vital_id){
    $.ajax({
        url: "{{ url('doctor/patient/vital/remove') }}/"+vital_id,
        type: "GET",
        success: function(record){
            var message = record.message
            Lobibox.notify('success', {
            title: "",
            msg: message,
            sleep: 150000,
            size: 'mini',
            rounded: true
        });
        },
        error: function(){
            $('#serverModal').modal();
        }
     });

    }


    function clearBtn()
    {

          var now = new Date();
            var day = now.getDate() < 10 ? "0" + now.getDate() : now.getDate();
            var month = now.getMonth() < 10 ? "0" + (now.getMonth() + 1) : (now.getMonth() + 1);
            var hrs = now.getHours() < 10 ? "0" + now.getHours(): now.getHours();
            var min = now.getMinutes() < 10 ? "0" + now.getMinutes(): now.getMinutes();
            var today1 = now.getFullYear()+"-"+(month)+"-"+(day)+"T"+(hrs)+":"+(min) ;
            $('#consultation_date').val(today1);
          $('#vital_id').val("");
           $('#bps').val("");
           $('#bpd').val("");
           $('#respiratory_rate').val("");
           $('#body_temperature').val("");
           $('#heart_rate').val("");
           $('#pulse_rate').val("");
           $('#oxygen_saturation').val("");
           $("input[name=time]").val("");
           $('#administered_by').val("");
           $("#remarks").val("");
           $('input[name="normal_rate"]').prop('checked', false);
           $('input[name="regular_rhythm"]').prop('checked', false);
    }

  function vitalId(vital_id){
      
    $.ajax({
        url: "{{ url('doctor/patient/vital/') }}/"+vital_id,
        type: "GET",
        success: function(record){
           var data = record.data;

           var now = new Date(data.consultation_date);
            var day = now.getDate() < 10 ? "0" + now.getDate() : now.getDate();
            var month = now.getMonth() < 10 ? "0" + (now.getMonth() + 1) : (now.getMonth() + 1);
            var hrs = now.getHours() < 10 ? "0" + now.getHours(): now.getHours();
            var min = now.getMinutes() < 10 ? "0" + now.getMinutes(): now.getMinutes();
         

            var today = now.getFullYear()+"-"+(month)+"-"+(day)+"T"+(hrs)+":"+(min) ;
            console.log(today)
           $('#vital_id').val(data.id);
           $('#bps').val(data.bps);
           $('#bpd').val(data.bpd);
           $('#respiratory_rate').val(data.respiratory_rate);
           $('#body_temperature').val(data.body_temperature);
           $('#heart_rate').val(data.heart_rate);
           $('input[name=normal_rate][value=" + data.normal_rate + "]').prop('checked', true);
           $('input[name=regular_rhythm][value=" + data.regular_rhythm + "]').prop('checked', true);
           $('#pulse_rate').val(data.pulse_rate);
           $('#oxygen_saturation').val(data.oxygen_saturation);
           $('#administered_by').val(data.administered_by);
          // $('#consultation_date').val(d.getFullYear()+"-"+zeroPadded(d.getMonth() + 1)+"-"+zeroPadded(d.getDate())+"T"+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds());
          $('#consultation_date').val(today)
           $("#remarks").val(data.remarks);
        },
        error: function(){
            $('#serverModal').modal();
        }
    });
    }
    

    function clearBtn2()
    {
        $('input:checkbox').removeAttr('checked');
        $(this).val('check all');  
    }
    
    function clearTable()
    {
        var now = new Date();
            var day = now.getDate() < 10 ? "0" + now.getDate() : now.getDate();
            var month = now.getMonth() < 10 ? "0" + (now.getMonth() + 1) : (now.getMonth() + 1);
            var hrs = now.getHours() < 10 ? "0" + now.getHours(): now.getHours();
            var min = now.getMinutes() < 10 ? "0" + now.getMinutes(): now.getMinutes();
            var today2 = now.getFullYear()+"-"+(month)+"-"+(day)+"T"+(hrs)+":"+(min) ;
        $('#consultation_date1').val(today2);
        $('#pexam_id').val("");
        $('input:checkbox').removeAttr('checked');
        $(this).val('check all'); 
        $("#heigth").val("");
         $("#weigth").val("");
         $("#head").val("");
         $("#conjunctiva_remarks").val("");
        $("#chest").val("");
        $("#breast_remarks").val("");
        $("#thorax_remarks").val("");
        $("#abdomen_remarks").val("");
        $("#genitals_remarks").val("");
        $("#extremities_remarks").val("");
    }

    function pexamId(vital_id){
      
      $.ajax({
          url: "{{ url('doctor/patient/pexam/') }}/"+vital_id,
          type: "GET",
          success: function(record){
             var data = record.data;
            //var conjunctiva = data.conjunctiva.replace(/ /g , '');
             var neck = data.neck.split(',');
             var breast = data.breast.split(','); 
             var thorax = data.thorax.split(',');
             var abdomen = data.abdomen.split(',');
             var genitals = data.genitals.split(',');
             var extremities = data.extremities.split(',');
  
             var now = new Date(data.consultation_date);
              var day = now.getDate() < 10 ? "0" + now.getDate() : now.getDate();
              var month = now.getMonth() < 10 ? "0" + (now.getMonth() + 1) : (now.getMonth() + 1);
              var hrs = now.getHours() < 10 ? "0" + now.getHours(): now.getHours();
              var min = now.getMinutes() < 10 ? "0" + now.getMinutes(): now.getMinutes();
             var today = now.getFullYear()+"-"+(month)+"-"+(day)+"T"+(hrs)+":"+(min);
            

            var conjunctiva = data.conjunctiva.split(',');


             for(var i = 0; i < conjunctiva.length; i++){
                $("input[value='" + conjunctiva[i] + "']").prop('checked', true);
            }
            for(var i = 0; i < neck.length; i++){
                $("input[value='" + neck[i] + "']").prop('checked', true);
            }

            for(var i = 0; i < breast.length; i++){
                $("input[value='" + breast[i] + "']").prop('checked', true);
            }
            
            for(var i = 0; i < thorax.length; i++){
                $("input[value='" + thorax[i] + "']").prop('checked', true);
            }

            for(var i = 0; i < abdomen.length; i++){
                $("input[value='" + abdomen[i] + "']").prop('checked', true);
            }

            for(var i = 0; i < genitals.length; i++){
                $("input[value='" + genitals[i] + "']").prop('checked', true);
            }

            for(var i = 0; i < extremities.length; i++){
                $("input[value='" + extremities[i] + "']").prop('checked', true);
            }
            $('#pexam_id').val(data.id);
            $("#heigth").val(data.heigth);
            $("#weigth").val(data.weigth);
            $("#head").val(data.head);
            $("#conjunctiva_remarks").val(data.conjunctiva_remarks);
            $("#chest").val(data.chest);
            $("#breast_remarks").val(data.breast_remarks);
            $("#thorax_remarks").val(data.thorax_remarks);
            $("#abdomen_remarks").val(data.abdomen_remarks);
            $("#genitals_remarks").val(data.genitals_remarks);
            $("#extremities_remarks").val(data.extremities_remarks);
            $("#others").val(data.others);
            $("#waist_circumference").val(data.waist_circumference);
            $('#administered_by1').val(data.administered_by);
            $('#consultation_date1').val(today)
          },
          error: function(){
              $('#serverModal').modal();
          }
      });
      }

</script>
