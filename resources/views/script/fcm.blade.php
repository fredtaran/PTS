<script>
    const messaging = firebase.messaging();

    navigator.serviceWorker.register("{{ url('sw.js') }}")
        .then(function (registration) {
            messaging.useServiceWorker(registration);
            messaging.requestPermission()
                .then(function () {
                    return messaging.getToken();
                })
                .then(function (currentToken) {
                    console.log(currentToken);
                    if(currentToken){
                        @if(!\Illuminate\Support\Facades\Session::get('tokenSaved'))
                        $.ajax({
                            url : "{{ url('token/save') }}/"+currentToken,
                            type : 'GET'
                        });
                        @endif

                    }else {
                        // Show permission request.
                        console.log('No Instance ID token available. Request permission to generate one.');
                    }
                })
                .catch(function (err) {
                    console.log('An error occurred while retrieving token. ', err);
                });
        });

    messaging.onMessage(function(payload) {
        console.log('Message received. ', payload.data);
    });

    messaging.onTokenRefresh(function() {
        messaging.getToken().then(function(refreshedToken) {
            console.log('Token refreshed.');
            $.ajax({
                url : "{{ url('token/save') }}/"+refreshedToken,
                type : 'GET'
            });
        }).catch(function(err) {
            console.log('Unable to retrieve refreshed token ', err);
            showToken('Unable to retrieve refreshed token ', err);
        });
    });

</script>