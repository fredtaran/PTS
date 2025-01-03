<script>
    var audioElement = document.createElement('audio');
    audioElement.setAttribute('src', "{{ url('dingdong.mp3') }}");
    audioElement.addEventListener('ended', function() {
        this.play();
    }, false);

    function play()
    {
        audioElement.play();

        setTimeout(function(){
            audioElement.pause();
        },5300);
    }

    // var dbRef = firebase.database();
    // var connRef = dbRef.ref('Referral');
    var myfacility = "{{ $user->facility_id }}";
    var count_referral = $('.count_referral').html();

    // connRef.child(myfacility).on('child_added', function(snapshot) {
    //     play();
    //     var data = snapshot.val();
    //     Lobibox.notify('success', {
    //         delay: false,
    //         title: 'New Referral',
    //         msg: data.name + ' was referred by Dr. ' + data.referring_md + ' of ' + data.referring_name,
    //         img: "{{ url('img/dohro12logo2.png') }}",
    //         sound: false
    //     });
     
    //     count_referral = parseInt(count_referral);
    //     count_referral += 1;
    //     $('.count_referral').html(count_referral);
    // });
</script>