$(document).on('ready', function() {

    $("#getintouch").on("submit", function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("getintouch"));
        data.append("action", "fromcontactpage");
        $.ajax({
            url: "database/managecontact.php",
            data: data,
            cache: false,
            method: "POST",
            processData: false,
            contentType: false,
            success: function(result) {
                var data = JSON.parse(result);
                if (data.statusCode == 200) {
                    $("#getintouch input").val("");
                    $("#getintouch textarea").val("");
                    toastr.success('Your message has been received. Thank you.', 'Message to the team!');
                } else if (data.statusCode == 201) {
                    toastr.error('Failed to get your message. Please try again.', 'Message to the team!');
                }
            }
        });
    });


});