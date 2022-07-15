$("#login").click(function() {
    $("#modal-background").removeClass("opacity");
    $("#modal-background").addClass("pointer-events");

    $("#login-modal").addClass("active-modal");
    $(".lmb").addClass("active-modal");
});

$(".exit-modal").click(function() {
    $("#modal-background").addClass("opacity");
    $("#modal-background").removeClass("pointer-events");

    $(".modal").removeClass("active-modal");
});

$("#modal-background").click(function() {
    $("#modal-background").addClass("opacity");
    $("#modal-background").removeClass("pointer-events");

    $(".modal").removeClass("active-modal");
});

$('input[type="email"]').on('focus', function() {
    $(this).addClass('focused-input');
    $('.input-header').addClass('focused');
});

$('input[type="email"]').blur('focus', function() {
    if($(this).val() == "") {
        $(this).removeClass('focused-input');
        $('.input-header').removeClass('focused');
    }
});

$('.password-toggle').click(function() {
    if($('#login-password').attr('type') === 'password') {
        $("#login-password").prop("type", "text");
        $('.fa-eye').addClass('fa-eye-slash');
    } else {
        $("#login-password").prop("type", "password");
        $('.fa-eye').removeClass('fa-eye-slash');
    }
});

$("#menu").click(function() {
    $("#menu").toggleClass("active");

    $(".popout-1").toggleClass("from-right");
    $(".popout-2").toggleClass("from-right");
    $(".popout-3").toggleClass("from-right");
    $(".popout-4").toggleClass("from-right");

    $(".popout-item").toggleClass("opacity");
    $("#popout-background").toggleClass("opacity");
});

$(".page-down").click(function() {
    // Add scrolling JS here
});

var months = {
    1: "January",
    2: "February",
    3: "March",
    4: "April",
    5: "May",
    6: "June",
    7: "July",
    8: "August",
    9: "September",
    10: "October",
    11: "November",
    12: "December",
}

window.onload = function() {
    document.getElementById("move-calendar").setAttribute("style", "margin-left: -" + value + "%")
};

$("#month-left").click(function() {
    if((String(month) + String(year)) !== "42022") {
        value -= 100;
        month -= 1;

        if(month < 1) {
            month = 12;
        }

        document.getElementById("month-right").setAttribute("style", "pointer-events: all; opacity: 1;")
        document.getElementById("month").innerHTML = months[month] + ", " + year;
        document.getElementById("move-calendar").setAttribute("style", "margin-left: -" + value + "%")
    } else {
        document.getElementById("month-left").setAttribute("style", "pointer-events: none; opacity: 0.4;")
    }
});

$("#month-right").click(function() {
    if((String(month) + String(year)) !== (String(original_month) + String(original_year))) {
        value += 100;
        month += 1;

        if(month > 12) {
            month = 1;
        }

        document.getElementById("month-left").setAttribute("style", "pointer-events: all; opacity: 1;")
        document.getElementById("month").innerHTML = months[month] + ", " + year;
        document.getElementById("move-calendar").setAttribute("style", "margin-left: -" + value + "%")
    } else {
        document.getElementById("month-right").setAttribute("style", "pointer-events: none; opacity: 0.4;")
    }
});
