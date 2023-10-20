document.oncontextmenu = function() {
    return false;
};
document.addEventListener("DOMContentLoaded", function() {
    const sidebarToggleBtn = document.getElementById('sidebarToggle');
    const sidebarToggleTop = document.getElementById('sidebarToggleTop');
    const sidebar = document.getElementById('accordionSidebar');

    sidebarToggleBtn.addEventListener('click', function() {
        if (sidebar.classList.contains('toggled')) {
            // Si la barra lateral está oculta, la mostramos
            sidebar.classList.remove('toggled');
        } else {
            // Si la barra lateral está visible, la ocultamos
            sidebar.classList.add('toggled');
        }
    });

    sidebarToggleTop.addEventListener('click', function() {
        if (sidebar.classList.contains('toggled')) {
            // Si la barra lateral está oculta, la mostramos
            sidebar.classList.remove('toggled');
        } else {
            // Si la barra lateral está visible, la ocultamos
            sidebar.classList.add('toggled');
        }
    });
});