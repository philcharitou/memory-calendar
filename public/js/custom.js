let slideIndex = 1;
var slideTimeout = null;
var bg_color = [
    '#83b0b6', // blue
    '#e25440', // orange
    '#feba4d', // yellow
    '#fff8e6', // cream
]
var text_color = [
    '#ffffff', // blue
    '#ffffff', // orange
    '#2b2726', // yellow
    '#e25440', // cream
]

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}

    slides[slideIndex-1].style.display = "block";
    slideTimeout = setTimeout(showSlides, 2000); // Change image every 2 seconds
}

function getEvents(clicked_id) {
    var Date = document.getElementById(clicked_id).id;

    console.log(Date);

    $.ajax({
        type: "GET",
        url: "/get-ajax",
        data: {date: Date},
        success: function (result) {
            var results = $.parseJSON(result);

            // Determine if data was found, then populate respective modal
            if (results[0] === 0) {
                var existing_event = $("#existing-event");

                $('#existing-event').children('.slideshow-container').remove();

                // Randomness for array key
                var key = Math.floor(Math.random() * 4)
                // Change CSS for randomness
                $("#event-modal").css("background", bg_color[key]);
                $("#event-modal").css("color", text_color[key]);

                existing_event.children('#event-date')[0].innerHTML = results[5] + "<sup>th</sup>";
                existing_event.children('#event-name')[0].innerHTML = results[1];
                existing_event.children('#event-location')[0].innerHTML = results[2];
                existing_event.children('#event-description')[0].innerHTML = results[3];

                $('#event-edit').attr("href", results[6])

                existing_event.append('<div class="slideshow-container">');

                existing_event.css("display", "unset")
                $("#create-event").css("display", "none")

                for (let i = 0; i < results[4].length; i++) {
                    existing_event.children('.slideshow-container').append(
                        '<div class="mySlides fade"> ' +
                        '<div class="numbertext">' + (i + 1) + ' / ' + results[4].length + '</div> ' +
                        '<img src="' + results[4][i] + '" style="width:100%"> ' +
                        '</div>'
                    );
                }

                showSlides();
            } else {
                $("#event-modal").css("background", '#ffffff');

                $("#existing-event").css("display", "none")
                $("#create-event").css("display", "flex")
            }

            $("#event-modal").addClass("active-modal");
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

$(".exit-modal").click(function () {
    $("#modal-background").addClass("opacity");
    $("#modal-background").removeClass("pointer-events");

    $(".modal").removeClass("pointer-events");
    $(".modal").removeClass("active-modal");

    if(slideTimeout){
        clearTimeout(slideTimeout);
    }
});

$("#modal-background").click(function () {
    $("#modal-background").addClass("opacity");
    $("#modal-background").removeClass("pointer-events");

    $(".modal").removeClass("pointer-events");
    $(".modal").removeClass("active-modal");

    if(slideTimeout){
        clearTimeout(slideTimeout);
    }
});

$('input[type="email"]').on('focus', function () {
    $(this).addClass('focused-input');
    $('.input-header').addClass('focused');
});

$('input[type="email"]').blur('focus', function () {
    if ($(this).val() == "") {
        $(this).removeClass('focused-input');
        $('.input-header').removeClass('focused');
    }
});

$('.password-toggle').click(function () {
    if ($('#login-password').attr('type') === 'password') {
        $("#login-password").prop("type", "text");
        $('.fa-eye').addClass('fa-eye-slash');
    } else {
        $("#login-password").prop("type", "password");
        $('.fa-eye').removeClass('fa-eye-slash');
    }
});

$('.date').click(function () {
    $("#modal-background").removeClass("opacity");
    $("#modal-background").addClass("pointer-events");

    $("#event-modal").addClass("pointer-events");
});

$(".page-down").click(function () {
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

$("#month-left").click(function () {
    if ((String(month) + String(year)) !== "42022") {
        value -= 100;
        month -= 1;

        if (month < 1) {
            month = 12;
        }

        document.getElementById("month-right").setAttribute("style", "pointer-events: all; opacity: 1;")
        document.getElementById("month").innerHTML = months[month] + ", " + year;
        document.getElementById("move-calendar").setAttribute("style", "margin-left: -" + value + "%")
    } else {
        document.getElementById("month-left").setAttribute("style", "pointer-events: none; opacity: 0.4;")
    }
});

$("#month-right").click(function () {
    if ((String(month) + String(year)) !== (String(original_month) + String(original_year))) {
        value += 100;
        month += 1;

        if (month > 12) {
            month = 1;
        }

        document.getElementById("month-left").setAttribute("style", "pointer-events: all; opacity: 1;")
        document.getElementById("month").innerHTML = months[month] + ", " + year;
        document.getElementById("move-calendar").setAttribute("style", "margin-left: -" + value + "%")
    } else {
        document.getElementById("month-right").setAttribute("style", "pointer-events: none; opacity: 0.4;")
    }
});
