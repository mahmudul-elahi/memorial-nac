$(function () {
    window.onscroll = function () {
        stickyNavbar();
    };

    const navbar = document.querySelector('.mobileNavbar');
    const stickyPoint = 200;

    function stickyNavbar() {
        if (window.pageYOffset > stickyPoint) {
            navbar.classList.add('sticky');
        } else {
            navbar.classList.remove('sticky');
        }
    }

})

$(document).ready(function () {
    $('.slick-slider').slick({
        slidesToShow: 3,
        centerMode: true,
        centerPadding: '5px',
        infinite: true,
        autoplay: false,
        dots: true,
        arrows: true,
        prevArrow:
            '<div class="arrow left"><i class="fas fa-angle-left"></i></div>',
        nextArrow:
            '<div class="arrow right"><i class="fas fa-angle-right"></i></div>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    vertical: true,
                    verticalSwiping: false,
                    infinite: false,
                    autoplay: false,
                    arrows: false,
                    dots: false,
                    draggable: false,
                    swipe: false,
                },
            },
        ],
    })




    $('.slider').slick({
        slidesToShow: 1,
        centerMode: true,
        adaptiveHeight: true,
        infinite: true,
        autoplay: false,
        arrows: false,

        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    })

    $('#prev-btn').on('click', function () {
        $('.slider').slick('slickPrev');
    });

    // Custom Next Button
    $('#next-btn').on('click', function () {
        $('.slider').slick('slickNext');
    });
});


$(document).ready(function () {
    $('.blog-images-slider').slick({
        slidesToShow: 2,
        infinite: true,
        autoplay: false,
        dots: false,
        arrows: false,
        prevArrow:
            '<div class="arrow left"><i class="fas fa-angle-left"></i></div>',
        nextArrow:
            '<div class="arrow right"><i class="fas fa-angle-right"></i></div>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    vertical: true,
                    verticalSwiping: false,
                    infinite: false,
                    autoplay: false,
                    arrows: false,
                    dots: false,
                    draggable: false,
                    swipe: false,
                },
            },
        ],
    })

});


