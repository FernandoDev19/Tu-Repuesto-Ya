<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
<script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>

<script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Enviar cierre de sesión-->
<script>
    document.getElementById('logoutForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // You can add any additional logic here if needed

        this.submit(); // Submit the form
    });
</script>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<script>
    // Mostrar u ocultar el botón dependiendo del scroll
    window.onscroll = function() {
        showScrollButton();
    };

    function showScrollButton() {
        const scrollButton = document.getElementById("scrollButton");
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollButton.classList.add("show");
        } else {
            scrollButton.classList.remove("show");
        }
    }

    // Función para volver arriba
    function scrollToTop() {
        document.body.scrollTop = 0; // Para navegadores que no sean Chrome, Safari
        document.documentElement.scrollTop = 0; // Para Chrome, Safari, Edge, Opera
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.hash) {
            const targetSection = document.querySelector(window.location.hash);
            if (targetSection) {
                targetSection.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    });
</script>

<script>
    document.oncontextmenu = function() {
        return false;
    };

    //loader

    const form = document.getElementById('form_client');
    const overlay = document.getElementById('overlay');

    // Ocultar el loader inicialmente
    hideLoadingOverlay();

    form.addEventListener('submit', function() {
        showLoadingOverlay(); // Mostrar superposición y icono de carga
    });

    function showLoadingOverlay() {
        overlay.style.display = 'flex'; // Mostrar superposición
    }

    function hideLoadingOverlay() {
        overlay.style.display = 'none'; // Ocultar superposición
    }
</script>
