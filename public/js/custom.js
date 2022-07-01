$("#menu").click(function() {
    $("#menu").toggleClass("active");
    $(".popout-1").toggleClass("from-right");
    $(".popout-2").toggleClass("from-right");
    $(".popout-3").toggleClass("from-right");
    $(".popout-4").toggleClass("from-right");

    $(".popout-item").toggleClass("opacity");

    $("#popout-menu").toggleClass("from-right");
});


