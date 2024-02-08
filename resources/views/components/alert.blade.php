<style>
    #success_message,
    #error_message {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10000;
        width: 50%;
        height: 300px;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: white;
    }

    #btn-close-success,
    #btn-close-error {
        cursor: pointer;
        position: relative;
        width: 100%;
        display: flex;
        justify-content: flex-end;
        font-size: 1.5rem;
    }

    .text-alert {
        height: 100%;
        max-height: 100%;
        max-width: 100%;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .text-alert i {
        text-align: center;
        font-size: 7rem;
        transform: translate(0, -15px);
    }

    .background-alert {
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.407);
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 10000;
    }

</style>

@if (session('message'))
    <div class="background-alert" id="success-alert">
        <div class="alert alert-info" id="success_message">

            <div id="btn-close-success">×</div>

            <div class="text-alert">
                <i class="fa fa-check" style="color: #5593e8;"></i>
                <strong>{{ session('message') }}</strong>
            </div>

        </div>
    </div>

    <script>
        let btnClose = document.getElementById('btn-close-success');
        let message = document.getElementById('success-alert');
        btnClose.addEventListener('click', function() {
            enableScroll();
            message.remove();
        });

        function disableScroll() {
            // Previene el desplazamiento del mouse
            window.addEventListener('wheel', preventScroll, {
                passive: false
            });

            document.addEventListener('touchmove', preventDefault, {
                passive: false
            });

        }

        // Función para permitir el desplazamiento
        function enableScroll() {
            // Remueve el evento que previene el desplazamiento del mouse
            window.removeEventListener('wheel', preventScroll, {
                passive: false
            });

            document.removeEventListener('touchmove', preventDefault, {
                passive: false
            });

        }

        // Función que se llama para prevenir el desplazamiento
        function preventScroll(e) {
            e.preventDefault();
        }

        function preventDefault(e) {
            e.preventDefault();
        }

        if (message) {
            disableScroll();
        }
    </script>
@endif

@if (session('error'))
    <div class="background-alert" id="error-alert">
        <div class="alert alert-danger" id="error_message">

            <div id="btn-close-error">×</div>

            <div class="text-alert">
                <i class="fa fa-ban"></i>
                <strong>{{ session('error') }}</strong>
            </div>

        </div>
    </div>

    <script>
        let btnClose = document.getElementById('btn-close-error');
        let message = document.getElementById('error-alert');
        btnClose.addEventListener('click', function() {
            enableScroll();
            message.remove();
        });

        function disableScroll() {
            // Previene el desplazamiento del mouse
            window.addEventListener('wheel', preventScroll, {
                passive: false
            });

            document.addEventListener('touchmove', preventDefault, {
                passive: false
            });

        }

        // Función para permitir el desplazamiento
        function enableScroll() {
            // Remueve el evento que previene el desplazamiento del mouse
            window.removeEventListener('wheel', preventScroll, {
                passive: false
            });

            document.removeEventListener('touchmove', preventDefault, {
                passive: false
            });

        }

        // Función que se llama para prevenir el desplazamiento
        function preventScroll(e) {
            e.preventDefault();
        }

        function preventDefault(e) {
            e.preventDefault();
        }

        if (message) {
            disableScroll();
        }
    </script>
@endif
