$(document).on('ready', function() {
    $("#userprofile").submit(function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("userprofile"));
        var username = $("#fullusername").val().toUpperCase();
        data.append("action", "update");
        $.ajax({
            method: "POST",
            url: "database/updateprofile.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(result) {
                var resultData = JSON.parse(result);
                if (resultData.statusCode == 200) {
                    $("#customername").html(username);
                    toastr.success('User details updated.', 'User Profile!');
                } else if (resultData.statusCode == 201) {
                    toastr.error('Failed to update user details.', 'User Profile!');
                }
            }
        });
    });

    $("#usericon").on("click", function() {
        $("#image_upload_file").click();
    });

    $(document).on('change', '#image_upload_file', function() {
        var progressBar = $('.progressBarImageUpload'),
            bar = $('.progressBarImageUpload .bar'),
            percent = $('.progressBarImageUpload .percent');

        $('#image_upload_file').ajaxForm({
            beforeSend: function() {
                progressBar.css("display", "block");
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            success: function(html, statusText, xhr, $form) {
                obj = $.parseJSON(html);
                if (obj.status) {
                    var percentVal = '100%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                    $("#imgArea>img").prop('src', obj.image_medium);
                    toastr.success('Profile picture updated.', 'User Profile!');
                } else {
                    if (obj.error != "") {
                        toastr.error(obj.error, 'User Profile!');
                    } else {
                        toastr.error('Failed to update profile picture.', 'User Profile!');
                    }
                }
            },
            complete: function(xhr) {
                progressBar.css("display", "none");
            }
        }).submit();
    });

    $("#accountEmailChangeForm").submit(function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("accountEmailChangeForm"));
        data.append("action", "verifydetails");
        $.ajax({
            method: "POST",
            url: "database/updateemail.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(result) {
                var resultData = JSON.parse(result);
                if (resultData.statusCode == 200) {
                    toastr.success('OTP code sent to ' + resultData.email, 'Email Address Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 201) {
                    toastr.error('Incorrect account password.', 'Email Address Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 202) {
                    toastr.error('Failed to send email verification code', 'Email Address Change!', { positionClass: "toast-bottom-right" });
                }
            }
        });
    });

    $("#accountEmailChangeOTPcodeForm").submit(function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("accountEmailChangeOTPcodeForm"));
        data.append("action", "verifyOTP");
        $.ajax({
            method: "POST",
            url: "database/updateemail.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(result) {
                var resultData = JSON.parse(result);
                if (resultData.statusCode == 200) {
                    $("#usercurrentemail").val(resultData.email);
                    $('#usercurrentemail').trigger('change');
                    $("#accountEmailChangeOTPcodeForm").remove();
                    $("#holdemailupdateform").html("<p>Email changed successfully. Your new email is : <i><b>" + resultData.email + "</b></i>. You can now login with new email.</p>")
                    toastr.success('Email address changed to ' + resultData.email + " successfully.", 'Email Address Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 201) {
                    toastr.error('Incorrect code used.', 'Email Address Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 202) {
                    toastr.error('Failed to update email address.', 'Email Address Change!', { positionClass: "toast-bottom-right" });
                }
            }
        });
    });

    // set interval
    var tid = setInterval(mycode, 2000);
    mycode();
    var value = 0;

    function mycode() {

        $("#emailaddressprogressbar").css("width", value + "%");
        value += 20;
        if (value > 100) {
            abortTimer();
        }
        // do some stuff...
        // no need to recall the function (it's an interval, it'll loop forever)
    }

    function abortTimer() { // to be called when you want to stop the timer
        clearInterval(tid);
    }


    if ($("#timeleft").length != 0) {
        var getTime = $("#timeleft").text();
        $("#timeleft").countdown(getTime, function(event) {
            $(this).text(
                event.strftime('%M min :%S sec')
            );
        }).on('finish.countdown', function(event) {
            $.ajax({
                url: "database/updateemail.php",
                data: { "action": "changeStatus" },
                method: "POST",
                cache: false,
                success: function(result) {
                    var resultData = JSON.parse(result);
                    if (resultData.statusCode == 200) {
                        toastr.error('Your request to change email address has expired.', 'Email Address Change!', { positionClass: "toast-bottom-right" });
                    } else if (resultData.statusCode == 201) {
                        toastr.error('Internal Error. Please reload the page.', 'Email Address Change!', { positionClass: "toast-bottom-right" });
                    }
                }
            });
            $(this).text(": Has Been Expired. Please refresh the page.");
            $("#accountEmailChangeOTPcodeForm input").prop("disabled", true);
            $("#accountEmailChangeOTPcodeForm button").addClass("hide-element");
        });
    }


});