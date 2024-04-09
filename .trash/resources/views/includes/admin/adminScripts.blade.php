
<script>
        document.oncontextmenu = function() {
        return false;
    };
    function sendPostRequest() {
        fetch('/ruta', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Reemplaza esto con el valor real del token CSRF
                },
                body: JSON.stringify({}) // Puedes enviar datos en el cuerpo si es necesario
            })
            .then(response => {
                // Manejar la respuesta de la solicitud POST
            })
            .catch(error => {
                // Manejar cualquier error
            });
    }
</script>

<script>
    setTimeout(function() {
        var registrationMessage = document.getElementById('registration-message');
        if (registrationMessage) {
            registrationMessage.remove();
        }
    }, 5000);
</script>

<script>
    setTimeout(function() {
        var Message = document.getElementById('message-error');
        if (Message) {
            Message.remove();
        }
    }, 8000);
</script>

