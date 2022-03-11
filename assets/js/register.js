$(document).ready(function() {

    progressBarData(4);

    function progressBarData(steps) {
        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;
        var current = 1;

        setProgressBar(current, steps);

        $(document).on("click", ".next", function() {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            if ($(next_fs)[0].nodeName != "FIELDSET") {
                next_fs = $(this).parent().next().next();
            }
            //Add Class Active        
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({ 'opacity': opacity });
                },
                duration: 500
            });
            setProgressBar(++current, steps);

        });

        $(document).on("click", ".previous", function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            if ($(previous_fs)[0].nodeName != "FIELDSET") {
                previous_fs = $(this).parent().prev().prev();
            }
            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({ opacity: 0 }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({ 'opacity': opacity });
                },
                duration: 500
            });
            setProgressBar(--current, steps);
        });

    }

    function setProgressBar(curStep, steps) {
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
            .css("width", percent + "%")
    }

    $('html, body').animate({
        scrollTop: $('#heading').offset().top
    }, 'slow');

    $("#forBusinessButton").on("click", function(e) {
        $('html, body').animate({
            scrollTop: $('#heading').offset().top
        }, 1200);
    });

    $('#isWholesaleUser').on("click", function(e) {
        //is wholesale user
        var data = $("#businessInfo").html();
        var bardata = $("#payment").html();
        if ($(this).prop("checked") == true) {
            // is wholesale user
            $(".totalsteps").html("5");
            $(".ImageUploadSpan").html("4");
            $(".finalStepSpan").html("5");
            $(".holdFullName").removeClass("col-12");
            $(".holdFullName").addClass("col-8");
            $("#holdCustomerAge").removeClass("col-12");
            $("#holdCustomerAge").addClass("col-4");
            $("#holdCustomerContact").removeClass("col-12");
            $("#holdCustomerContact").addClass("col-8");
            $("#holdCustomerGender").removeClass("col-12");
            $("#holdCustomerGender").addClass("col-4");

            $("#holdCustomerCitizenship").removeClass("hide");
            $("#citizenship_image_hold_back").removeClass("hide");
            $("#citizenship_image_hold_front").removeClass("hide");
            $("#citizenshipNumber").prop("disabled", false);
            $("#holdCustomerCurr").removeClass("hide");
            $("#holdCustomerPerm").removeClass("hide");
            $("#currentAddress").prop("disabled", false);

            $("#permanentAddress").prop("disabled", false);
            $("#customer_citizenship_front").prop("disabled", false);
            $("#customer_citizenship_back").prop("disabled", false);
            $(".finalStageText").html('<h5 class="purple-text text-center">Your form has been submitted and is waiting for approval. Thank you.</h5>' +
                '<h5 class="purple-text text-center">Redirecting to homepage...</h5>');
            $("#payment").replaceWith($('<li id="payment">' + bardata + '</li>'));
            $("#progressbar li").css("width", "20%");
            //$("#holdForm").addClass("fadeOut");
            $("#businessInfo").replaceWith($('<fieldset id="businessInfo">' + data + '</fieldset>'));
            progressBarData(5);
        } else {
            $(".finalStageText").html('<h5 class="purple-text text-center">An email verification link has been sent to your email. Please verify before logging in.</h5>' +
                '<h5 class="purple-text text-center">Redirecting to homepage...</h5>');
            // is retail user
            $(".holdFullName").addClass("col-12");
            $(".holdFullName").removeClass("col-8");
            $(".holdBackRow").addClass("col-12");
            $(".holdBackRow").removeClass("col-4");

            $(".totalsteps").html("4");
            $(".ImageUploadSpan").html("3");
            $(".finalStepSpan").html("4");

            $("#holdCustomerCitizenship").addClass("hide");
            $("#citizenship_image_hold_back").addClass("hide");
            $("#citizenship_image_hold_front").addClass("hide");
            $("#holdCustomerCurr").addClass("hide");
            $("#holdCustomerPerm").addClass("hide");
            $("#citizenshipNumber").prop("disabled", true);
            $("#currentAddress").prop("disabled", true);

            $("#permanentAddress").prop("disabled", true);
            $("#customer_citizenship_front").prop("disabled", true);
            $("#customer_citizenship_back").prop("disabled", true);

            $("#payment").replaceWith($('<span id="payment" class="hide">' + bardata + '</span>'));
            $("#progressbar li").css("width", "25%");
            //$("#holdForm ").addClass("fadeOut");
            $("#businessInfo").replaceWith($('<div id="businessInfo" class="hide">' + data + '</div>'));
            progressBarData(4);
        }
    });

    $(document).on('change', '#profilePicture', function(e) {
        if ($("#profilePicture").val() == "") {

        } else {
            uploadImages(e, "usericon");
        }


    });
    $(document).on('change', '#customer_citizenship_front', function(e) {
        uploadImages(e, "citizenship_front");

    });
    $(document).on('change', '#customer_citizenship_back', function(e) {
        uploadImages(e, "citizenship_back");
    });

    function uploadImages(e, a) {
        var fileName = e.target.files[0].name;
        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById(a).src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(e.target.files[0]);
    }
});