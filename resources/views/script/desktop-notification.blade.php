<script>
    function desktopNotification(title, body){
        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        } else {
            var notification = new Notification(title, {
                icon: "{{ url('img/logo.png') }}",
                body: body,
            });

            notification.onclick = function () {
                window.open("{{ url('/') }}");
            };
        }
    }

</script>