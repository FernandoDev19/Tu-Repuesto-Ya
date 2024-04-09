document.addEventListener("DOMContentLoaded", function () {
    slider();
});

function slider() {
    const imageSlider = new Swiper('.swiper', {
        direction: 'horizontal',
        autoplay: {
            delay: 800,
            disableOnInteraction: false
        },
        loop: true,
        spaceBetween: 10,
        mousewheel: {
            forceToAxis: true,
        },
        breakpoints: {
            100:{
              slidesPerView: 6,
              spaceBetween: 15
            },
            280: {
                slidesPerView: 6,
                spaceBetween: 18
            },
            320:{
                slidesPerView: 6,
                spaceBetween: 19
            },
            360: {
                slidesPerView: 7,
                spaceBetween: 18
            },
            390: {
                slidesPerView: 8,
                spaceBetween: 17
            },
            412: {
                slidesPerView: 9,
                spaceBetween: 19
            },
            530:{
                slidesPerView: 10,
                spaceBetween: 19
            },
            700:{
                slidesPerView:10,
                spaceBetween: 20
            },
            750:{
                slidesPerView:10,
                spaceBetween: 20
            },
            800: {
                slidesPerView:10.5,
                spaceBetween: 20
            },
            900:{
                slidesPerView:11,
                spaceBetween: 20
            },
            1000:{
                slidesPerView: 11,
                spaceBetween: 20
            },
            1100:{
                slidesPerView: 12,
                spaceBetween: 20
            },
            1200:{
                slidesPerView: 12.2,
                spaceBetween: 30
            },
            1280:{
                slidesPerView: 11.3,
                spaceBetween: 30
            },
            1300: {
                slidesPerView: 11,
                spaceBetween: 30
            },
            1500:{
                slidesPerView: 11.4,
                spaceBetween: 30
            },
            1600:{
                slidesPerView: 11.4,
                spaceBetween: 30
            },
            1700:{
                slidesPerView: 15,
                spaceBetween: 30
            },
            1800:{
                slidesPerView: 15,
                spaceBetween: 30
            },
            1900:{
                slidesPerView: 14,
                spaceBetween: 30
            },
            2000:{
                slidesPerView: 15,
                spaceBetween: 30
            }
        }
    });
}

