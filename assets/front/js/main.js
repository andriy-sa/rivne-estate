
$('.social-link').tooltip();

$(document).ready(function () {

    $('.show-search').click(function () {
        $('.full-search').fadeIn(300);
        $('.full-search input').focus();
    });
    $('.full-search input').blur(function () {
        $('.full-search').fadeOut(300);
    });

    $('#front-slider').slick({
        dots: false,
        infinite: false,
        speed: 1000,
        fade: true,
        cssEase: 'linear',
        arrows: false,
        accessibility:false,
        draggable:false,
        swipe:false,
        touchMove: false,
        autoplay: true,
        autoplaySpeed: 5000,
    });
});

