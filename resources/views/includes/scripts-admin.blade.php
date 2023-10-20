<!--   Core JS Files   -->
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/argon-dashboard.js"></script>
@stack('js')

<script>
    document.oncontextmenu = function() {
        return false;
    };

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
