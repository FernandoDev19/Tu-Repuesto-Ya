const list = ["span-tiempo", "span-dinero"];
let index = 0;

document.addEventListener("DOMContentLoaded", function () {
    Transicion_Dinero_Tiempo();
    slider();
});

function Transicion_Dinero_Tiempo() {
    const strings = [
        '<span class="banner" id="span-tiempo">TIEMPO <img id="icon-reloj" decoding="async" src="../icon/reloj.png"></span>',
        '<span class="banner" id="span-dinero">DINERO <img id="icon-dinero" decoding="async" src="../icon/dinero.png"></span>'
    ];

    const typed = new Typed('.typed2', {
        strings: strings,
        typeSpeed: 50,
        backSpeed: 100,
        backDelay: 1000, // Tiempo de espera despues de que termina de escribir una palabra.
        loop: true
    });
}

function slider() {
    const imageSlider = new Swiper('.content_marcas', {
        direction: 'horizontal',
        autoplay: {
            delay: 800,
            disableOnInteraction: false
        },
        loop: false,
        spaceBetween: 10,
        mousewheel: {
            forceToAxis: true,
        },
        breakpoints: {
            100: {
                slidesPerView: 11,
                spaceBetween: 17
            },
            290: {
                slidesPerView: 11.7,
                spaceBetween: 18
            },
            320:{
                slidesPerView: 14.4,
                spaceBetween: 19
            },
            360: {
                slidesPerView: 14.6,
                spaceBetween: 18
            },
            390: {
                slidesPerView: 14.5,
                spaceBetween: 17
            },
            412: {
                slidesPerView: 14.7,
                spaceBetween: 19
            },
            530:{
                slidesPerView: 15.5,
                spaceBetween: 19
            },
            700:{
                slidesPerView: 5.6,
                spaceBetween: 20
            },
            750:{
                slidesPerView: 7.8,
                spaceBetween: 20
            },
            800: {
                slidesPerView: 8.3,
                spaceBetween: 20
            },
            900:{
                slidesPerView: 9.1,
                spaceBetween: 20
            },
            1000:{
                slidesPerView: 10,
                spaceBetween: 20
            },
            1280:{
                slidesPerView: 11.8,
                spaceBetween: 20
            },
            1300: {
                slidesPerView: 9.2,
                spaceBetween: 30
            },
            1500:{
                slidesPerView: 9.2,
                spaceBetween: 30
            },
            1600:{
                slidesPerView: 9.9,
                spaceBetween: 30
            },
            1700:{
                slidesPerView: 10.3,
                spaceBetween: 30
            },
            1800:{
                slidesPerView: 11,
                spaceBetween: 30
            },
            1900:{
                slidesPerView: 12.3,
                spaceBetween: 30
            }

        }
    });
}

