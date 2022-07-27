function getEvents(clicked_id) {
    var Date = document.getElementById(clicked_id).id;

    console.log(Date);

    $.ajax({
        type: "GET",
        url: "/get-ajax",
        data: { date: Date },
        success: function (result) {
            var results = $.parseJSON(result);

            console.log(results);

            // Determine if data was found, then populate respective modal
            if(results[0] === 0) {
                $("#existing-event").css("display", "unset")
                $("#create-event").css("display", "none")

                $("#event-name").innerHTML = results[1];
                $("#event-location").innerHTML = results[2];
                $("#event-description").innerHTML = results[3];

                $("#existing-event").children('#event-name')[0].innerHTML = results[1];

                $("#existing-event").children('img')[0].src = results[4][1]

                for(let i = 0; i < results[4].length; i++) {
                    console.log(results[4][i]);
                }
            } else {
                $("#existing-event").css("display", "none")
                $("#create-event").css("display", "unset")
            }
        },
        error: function (data) {
            // Log error in console
            console.log(data);
            alert("Oops! Something went wrong :( Better call Phil");
        }
    });
}

function setDate(clicked_id) {
    sessionStorage.setItem("date", clicked_id);
}

$(".exit-modal").click(function() {
    $("#modal-background").addClass("opacity");
    $("#modal-background").removeClass("pointer-events");

    $(".modal").removeClass("pointer-events");
    $(".modal").removeClass("active-modal");
});

$("#modal-background").click(function() {
    $("#modal-background").addClass("opacity");
    $("#modal-background").removeClass("pointer-events");

    $(".modal").removeClass("pointer-events");
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

$('.date').click(function() {
    $("#modal-background").removeClass("opacity");
    $("#modal-background").addClass("pointer-events");

    $("#event-modal").addClass("pointer-events");
    $("#event-modal").addClass("active-modal");
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
