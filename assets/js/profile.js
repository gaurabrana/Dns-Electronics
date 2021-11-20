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
    var value = 0;
    var tid;
    $(document).on("submit", "#accountEmailChangeForm", function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("accountEmailChangeForm"));
        data.append("action", "verifydetails");
        $("#holdemailaddressprogressbar").removeClass("hide-element");
        tid = setInterval(mycode, 2000);
        $.ajax({
            method: "POST",
            url: "database/updateuserdetail.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function() {
                mycode(tid);
            },
            success: function(result) {
                var resultData = JSON.parse(result);
                $("#emailaddressprogressbar").css("width", 100 + "%");
                value = 0;
                abortTimer(tid);
                $(this).delay(2000).queue(function(next) {
                    $("#holdemailaddressprogressbar").addClass("hide-element");
                    $("#emailaddressprogressbar").css("width", 0 + "%");
                    next();
                });
                if (resultData.statusCode == 200) {
                    $("#OtpCode").removeClass("hide-element");
                    $("#OtpCode input").prop("disabled", false);
                    $("#newEmailAddressChangeOldPassword").prop("disabled", true);
                    $("#newEmailAddressChange").prop("disabled", true);
                    $("#holdEmail").addClass("hide-element");
                    $("#holdPassword").addClass("hide-element");
                    $("#holdInfo").removeClass("hide-element");
                    $("#requesttimeleft").html(resultData.valid_date);
                    countdownvalid("#requesttimeleft");
                    $("#holdNewEmailAddress").html(resultData.email);
                    $("#submitFormButton").text("Verify Code");
                    $("form#accountEmailChangeForm").prop('id', 'accountEmailChangeOTPcodeForm');
                    $("#holdSubmitFormButton").removeClass("col-md-12");
                    $("#holdSubmitFormButton").addClass("col-md-6");
                    $("#ResetRequest").removeClass("hide-element");
                    toastr.success('OTP code sent to ' + resultData.email, 'Email Address Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 201) {
                    toastr.error('Incorrect account password.', 'Email Address Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 202) {
                    toastr.error('Failed to send email verification code', 'Email Address Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 203) {
                    toastr.error(resultData.email + ' is currently linked with this account', 'Email Address Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 204) {
                    toastr.error('Invalid email address used.', 'Email Address Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 205) {
                    toastr.error('New email is associated with another account.', 'Email Address Change!', { positionClass: "toast-bottom-right" });
                }
            }
        });
    });
    $(document).on("submit", "#accountEmailChangeOTPcodeForm", function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("accountEmailChangeOTPcodeForm"));
        data.append("action", "verifyOTP");
        $.ajax({
            method: "POST",
            url: "database/updateuserdetail.php",
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

    $(document).on("submit", "#accountPasswordChangeForm", function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("accountPasswordChangeForm"));
        data.append("action", "changePassword");
        $.ajax({
            method: "POST",
            url: "database/updateuserdetail.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(result) {
                var resultData = JSON.parse(result);
                if (resultData.statusCode == 200) {
                    toastr.success('Account Password Changed successfully.', 'Account Password Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 201) {
                    toastr.error('Incorrect account password used.', 'Account Password Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 202) {
                    toastr.error('Failed to update account password.', 'Account Password Change!', { positionClass: "toast-bottom-right" });
                } else if (resultData.statusCode == 203) {
                    toastr.error('Invalid new account password used.', 'Account Password Change!', { positionClass: "toast-bottom-right" });
                }
            }
        });
    });

    $("#ResetRequest").on("click", function(e) {
        $.ajax({
            url: "database/updateuserdetail.php",
            data: { "action": "resetRequest" },
            cache: false,
            method: "POST",
            success: function(result) {
                var data = JSON.parse(result);
                if (data.statusCode == 200) {
                    $("#OtpCode").addClass("hide-element");
                    $("#OtpCode input").prop("disabled", true);

                    $("#newEmailAddressChangeOldPassword").prop("disabled", false);
                    $("#newEmailAddressChange").prop("disabled", false);
                    $("#holdEmail").removeClass("hide-element");
                    $("#holdPassword").removeClass("hide-element");

                    $("#holdCodeSubmitButton").addClass("hide-element");
                    $("#holdCodeSubmitButton button").prop("disabled", true);

                    $("#holdSubmitFormButton").removeClass("col-md-6");
                    $("#holdSubmitFormButton").addClass("col-md-12");
                    $("#holdSubmitFormButton").removeClass("hide-element");

                    $("#holdInfo").addClass("hide-element");
                    $("#requesttimeleft").countdown('stop');
                    $("#submitFormButton").text("Send OTP Code");
                    $("#submitFormButton").prop("disabled", false);
                    $("form#accountEmailChangeOTPcodeForm").prop('id', 'accountEmailChangeForm');

                    $("#ResetRequest").addClass("hide-element");
                } else if (data.statusCode == 201) {
                    toastr.error('Failed to reset request. Please refresh the page.', 'Reset Email Address Change Request!', { positionClass: "toast-bottom-right" });
                }
            }
        });
    });
    // set interval
    function mycode(tid) {

        $("#emailaddressprogressbar").css("width", value + "%");
        value += 20;
        if (value > 80) {
            abortTimer(tid);
        }
        // do some stuff...
        // no need to recall the function (it's an interval, it'll loop forever)
    }

    function abortTimer(tid) { // to be called when you want to stop the timer
        clearInterval(tid);
    }

    if ($("#timeleft").length != 0) {
        countdownvalid("#timeleft");
    }

    function countdownvalid(a) {
        var getTime = $(a).text();
        $(a).countdown(getTime, function(event) {
            $(this).text(
                event.strftime('%M min :%S sec')
            );
        }).on('finish.countdown', function(event) {
            $.ajax({
                url: "database/updateuserdetail.php",
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