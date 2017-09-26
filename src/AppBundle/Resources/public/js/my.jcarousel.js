$(function () {
    var special = $("#special").owlCarousel({
        items: 3,
        itemsDesktop: [991, 2],
        itemsDesktopSmall: false,
        itemsTablet: [767, 1],
        itemsTabletSmall: false,
        itemsMobile: [479, 1],
        slideSpeed: 400,
        navigation: false,
        rewindNav: false,
        pagination: false
    });

    $("#special_next").click(function (e) {
        special.trigger('owl.next');
        e.preventDefault();
    });

    $("#special_prev").click(function (e) {
        special.trigger('owl.prev');
        e.preventDefault();
    });


    var urgent = $("#urgent").owlCarousel({
        items: 3,
        itemsDesktop: [991, 2],
        itemsDesktopSmall: false,
        itemsTablet: [767, 1],
        itemsTabletSmall: false,
        itemsMobile: false,
        slideSpeed: 400,
        navigation: false,
        rewindNav: false,
        pagination: false
    });

    $("#urgent_next").click(function (e) {
        urgent.trigger('owl.next');
        e.preventDefault();
    });

    $("#urgent_prev").click(function (e) {
        urgent.trigger('owl.prev');
        e.preventDefault();
    });


    var reviews = $("#reviews").owlCarousel({
        items: 3,
        itemsDesktop: [991, 2],
        itemsDesktopSmall: false,
        itemsTablet: [767, 1],
        itemsTabletSmall: false,
        itemsMobile: false,
        slideSpeed: 400,
        navigation: false,
        rewindNav: false,
        pagination: false
    });

    $("#reviews_next").click(function (e) {
        reviews.trigger('owl.next');
        e.preventDefault();
    });

    $("#reviews_prev").click(function (e) {
        reviews.trigger('owl.prev');
        e.preventDefault();
    });


    var collective = $("#collective").owlCarousel({
        items: 3,
        itemsDesktop: [991, 2],
        itemsDesktopSmall: false,
        itemsTablet: [767, 1],
        itemsTabletSmall: false,
        itemsMobile: false,
        slideSpeed: 400,
        navigation: false,
        rewindNav: false,
        pagination: false
    });

    $("#collective_next").click(function (e) {
        collective.trigger('owl.next');
        e.preventDefault();
    });

    $("#collective_prev").click(function (e) {
        collective.trigger('owl.prev');
        e.preventDefault();
    });


    var partners = $("#partners").owlCarousel({
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [991, 2],
        itemsTablet: [767, 1],
        itemsTabletSmall: [479, 1],
        itemsMobile: false,
        autoPlay: 7000,
        stopOnHover: true,
        slideSpeed: 500,
        navigation: false,
        rewindNav: true,
        pagination: false
    });

    $("#partners_next").click(function (e) {
        partners.trigger('owl.next');
        e.preventDefault();
    });

    $("#partners_prev").click(function (e) {
        partners.trigger('owl.prev');
        e.preventDefault();
    });


    var vacancy = $("#vacancy").owlCarousel({
        items: 3,
        itemsDesktop: [991, 2],
        itemsDesktopSmall: false,
        itemsTablet: [767, 1],
        itemsTabletSmall: false,
        itemsMobile: false,
        slideSpeed: 400,
        navigation: false,
        rewindNav: false,
        pagination: false
    });

    $("#vacancy_next").click(function (e) {
        vacancy.trigger('owl.next');
        e.preventDefault();
    });

    $("#vacancy_prev").click(function (e) {
        vacancy.trigger('owl.prev');
        e.preventDefault();
    });


    var news = $("#news").owlCarousel({
        items: 3,
        itemsDesktop: [991, 2],
        itemsDesktopSmall: false,
        itemsTablet: [767, 1],
        itemsTabletSmall: false,
        itemsMobile: false,
        slideSpeed: 400,
        navigation: false,
        rewindNav: false,
        pagination: false
    });

    $("#news_next").click(function (e) {
        news.trigger('owl.next');
        e.preventDefault();
    });

    $("#news_prev").click(function (e) {
        news.trigger('owl.prev');
        e.preventDefault();
    });

    $('.bxslider').bxSlider({
        auto: true,
        mode: 'fade'
    });

});