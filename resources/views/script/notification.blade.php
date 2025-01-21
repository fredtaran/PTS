<script type="module">
    import { app } from '{{ asset("js/firebase.js") }}'
    import { getDatabase, ref, onValue, onChildAdded } from 'https://www.gstatic.com/firebasejs/11.0.2/firebase-database.js'

    $(document).ready(function() {
        <?php $user = Auth::user();?>
        const db = getDatabase();
        const callRef = ref(db, 'Call');
        const acceptRef = ref(db, 'Accept');
        const rejectRef = ref(db, 'Reject');
        const arriveRef = ref(db, 'Arrival');
        const admitRef = ref(db, 'Admit');
        const dischargeRef = ref(db, 'Discharge');
        const transferRef = ref(db, 'Transfer');
        const feedbackRef = ref(db, 'Feedback');

        // Notification when a patient is accepted
        onChildAdded(acceptRef, (snapshot) => {
            console.log("Accept");
            console.log(snapshot.val());
            var data = snapshot.val();
            var action_md = data.action_md;
            var facility_name = data.facility_name;
            var patient_name = data.patient_name;

            var msg = patient_name + '  was accepted by Dr. ' + action_md + ' of ' + facility_name +
            '<br />' + data.date;

            var msg2 = patient_name + '  was accepted by Dr. ' + action_md + ' of ' + facility_name +
            '\n' + data.date;

            verify(data.code, 'success', 'Accepted', msg, msg2);
        });

        // Notification when a patient is rejected
        onChildAdded(rejectRef, (snapshot) => {
            var data = snapshot.val();
            var patient_name = data.patient_name;
            var action_md = data.action_md;
            var old_facility = data.old_facility;

            var msg = 'Dr. ' + action_md + ' of ' + old_facility + ' recommended to redirect ' + patient_name + ' to other facility.' +
            '<br />' + data.date;

            var msg2 = 'Dr. ' + action_md + ' of ' + old_facility + ' recommended to redirect ' + patient_name + ' to other facility.' +
            '\n' + data.date;

            verify(data.code, 'error', 'Redirected', msg, msg2);
        });

        // Notification when a call is requested
        onChildAdded(callRef, (snapshot) => {
            var data = snapshot.val();

            var action_md = data.action_md;
            var facility_calling = data.facility_calling;

            var msg = 'Dr. ' + action_md + ' of ' + facility_calling + ' is requesting a call from ' + data.referred_name +
            '<br />' + data.date;

            var msg2 = 'Dr. ' + action_md + ' of ' + facility_calling + ' is requesting a call from ' + data.referred_name +
            '\n' + data.date;

            verify(data.code, 'warning', 'Requesting a Call', msg, msg2);
        });

        // Notification when a patient arrives
        onChildAdded(arriveRef, (snapshot) => {
            var data = snapshot.val();

            var patient_name = data.patient_name;
            var current_facility = data.current_facility;

            var msg = patient_name + ' arrived at ' + current_facility +
            '<br />' + data.date;

            var msg2 = patient_name + ' arrived at ' + current_facility +
            '\n' + data.date;

            verify(data.code, 'success', 'Arrived', msg, msg2);
        });

        // Notification when a patient is admitted
        onChildAdded(admitRef, (snapshot) => {
            var data = snapshot.val();
            var patient_name = data.patient_name;
            var current_facility = data.current_facility;

            var msg = patient_name + ' admitted at ' + current_facility +
            '<br />' + data.date;

            var msg2 = patient_name + ' admitted at ' + current_facility +
            '\n' + data.date;

            verify(data.code, 'info', 'Admitted', msg, msg2);
        });
        
        // Notification when a patient is discharged
        onChildAdded(dischargeRef, (snapshot) => {
            var data = snapshot.val();
            var date = data.date;
            var patient_name = data.patient_name;
            var current_facility = data.current_facility;

            var msg = patient_name + ' discharged from ' + current_facility +
            '<br />' + data.date;

            var msg2 = patient_name + ' discharged from ' + current_facility +
            '\n' + data.date;

            verify(data.code, 'info', 'Discharged', msg, msg2);
        });

        // Notification when a patient is transferred
        onChildAdded(transferRef, (snapshot) => {
            var data = snapshot.val();
            var date = data.date;
            var patient_name = data.patient_name;
            var action_md = data.action_md;
            var old_facility = data.old_facility;
            var new_facility = data.new_facility;

            var msg = patient_name + '  was referred by Dr. ' + action_md + ' of ' + old_facility + ' to ' + new_facility +
            '<br />' + data.date;

            var msg2 = patient_name + '  was referred by Dr. ' + action_md + ' of ' + old_facility + ' to ' + new_facility +
            '<br />' + data.date;

            verify(data.code, 'warning', 'Transferred', msg, msg2);
        });

        // Lobibox function
        function lobibox(status, title, msg) {
            Lobibox.notify(status, {
                delay: false,
                title: title,
                msg: msg,
                img: "{{ url('img/logo.png') }}",
                sound: false
            });

            var audioElement2 = document.createElement('audio');
            audioElement2.setAttribute('src', "{{ url('warning.wav') }}");
            audioElement2.addEventListener('ended', function() {
                this.currentTime = 0;
                this.play();
            }, false);

            audioElement2.play();

            setTimeout(function() {
                audioElement2.pause();
                audioElement2.currentTime = 0;
            }, 6000); // Play the warning.wav file twice (3 seconds each)
        }

        // Verify function
        function verify(code, status, title, msg, msg2) {
            $.ajax({
                url: "{{ url('doctor/verify/') }}/" + code,
                type: "GET",
                success: function(data) {
                    console.log(data);
                    if(data == 1) {
                        lobibox(status, title, msg);
                        desktopNotification(title, msg2);
                    }
                }
            });
        }

        // Notification when a feedback is given
        onChildAdded(feedbackRef, (snapshot) => {
            var data = snapshot.val();
            var doctor_name = $.ajax({
                async: false,
                url: "{{ url('doctor/name/') }}/" + data.user_id,
                success: function(name) {
                    return name;
                }
            }).responseText;

            var msg = "From: " + doctor_name + "<br>Code: " + data.code + "<br>Message: " + data.msg;
            var msg2 = "From: " + doctor_name + "\nCode: " + data.code + "\nMessage: " + data.msg;
            verify(data.code, 'Success', 'New Feedback', msg, msg2);
            {{--if(data.user_id != "{{ $user->id }}"){--}}
            {{----}}
            {{--}--}}
        });

        var audioElement = document.createElement('audio');
        audioElement.setAttribute('src', "{{ url('dingdong.mp3') }}");
        audioElement.addEventListener('ended', function() {
            this.play();
        }, false);

        function play() {
            audioElement.play();

            setTimeout(function() {
                audioElement.pause();
                audioElement1.currentTime = 0;
            }, 5300);
        }

        var audioElement1 = document.createElement('audio');
        audioElement1.setAttribute('src', "{{ url('dingdong.mp3') }}");
        audioElement1.addEventListener('ended', function() {
            this.play1();
        }, false);

        function play1() {
            audioElement1.play();

            setTimeout(function() {
                audioElement1.pause();
                audioElement1.currentTime = 0;
            }, 5300);
        }

        var facility = "{{Auth::user()->facility_id}}";
        var user_id = "{{Auth::user()->id}}";
        var user_level = "{{Auth::user()->level}}";
        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
        });

        var channel = pusher.subscribe('preferred_channel');
        channel.bind('preferred_event', function(data) {
            if(user_id == data['referred_md'] && facility != data['referred_to']) {
                play();
                Lobibox.notify('success', {
                    title: "New Affiliated Referral" ,
                    msg: "From " + data['referring_facility_name'] + "To " + data['referred_to_name']  + " Referred by " + data['referring_md_name'],
                    img: "{{ url('img/logo.png') }}",
                    width: 450,
                    sound: false,
                    delay: false
                });
            }
        });

        var channel1 = pusher.subscribe('pregnant_channel');
        channel1.bind('pregnant_event', function(data) {
            $('#app_div').load(document.URL +  ' #app_div');
            if(facility == data['referred_to']) {
                if(data['status'] == 'highrisk') {
                    Lobibox.notify('error', {
                        title: "High-risk Pregnant Referral" ,
                        msg: "From: <b>" + data['referring_facility_name'] + "</><br> To: <b>" + data['referred_to_name']  + "</b><br> Referred by: " + data['referring_md_name'],
                        img: "{{ url('img/logo.png') }}",
                        width: 450,
                        sound: false,
                        delay: false
                    });
                    play1();
                } else if(data['status'] == 'moderate') {
                    Lobibox.notify('warning', {
                        title: "Moderate Pregnant Referral" ,
                        msg: "From: " + data['referring_facility_name'] + " To: " + data['referred_to_name']  + "<br> Referred by: " + data['referring_md_name'],
                        img: "{{ url('img/logo.png') }}",
                        width: 450,
                        sound: false,
                        delay: false
                    });
                    play();
                } else {
                    Lobibox.notify('success', {
                        title: "New Referral" ,
                        msg: "From: " + data['referring_facility_name'] + " To: " + data['referred_to_name']  + "<br> Referred by: " + data['referring_md_name'],
                        img: "{{ url('img/logo.png') }}",
                        width: 450,
                        sound: false,
                        delay: false
                    });
                    play();
                }
            }

            if(user_level == 'admin') {
                if(data['status'] == 'highrisk') {
                    Lobibox.notify('error', {
                        title: "High-risk Pregnant Referral" ,
                        msg: "From: " + data['referring_facility_name'] + " To: " + data['referred_to_name']  + "<br> Referred by: " + data['referring_md_name'],
                        img: "{{ url('img/logo.png') }}",
                        width: 450,
                        sound: false,
                        delay: false
                    });
                    play1();
                } else if(data['status'] == 'moderate') {
                    Lobibox.notify('warning', {
                        title: "Moderate Pregnant Referral" ,
                        msg: "From: " + data['referring_facility_name'] + " To: " + data['referred_to_name']  + "<br> Referred by: " + data['referring_md_name'],
                        img: "{{ url('img/logo.png') }}",
                        width: 450,
                        sound: false,
                        delay: false
                    }); 
                    play();
                } else {
                    Lobibox.notify('success', {
                        title: "New Referral" ,
                        msg: "From: " + data['referring_facility_name'] + " To: " + data['referred_to_name']  + "<br> Referred by: " + data['referring_md_name'],
                        img: "{{ url('img/logo.png') }}",
                        width: 450,
                        sound: false,
                        delay: false
                    });
                    play();
                }
            }
        });

        var channel3 = pusher.subscribe('my-channel');
        channel3.bind('my-event', function(data) {
            alert(JSON.stringify(data));
        });
    })
</script>