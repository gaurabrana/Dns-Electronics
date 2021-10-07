(function($) {

    $(".answerproductquery").on("click", function() {
        let elementid = $(this).attr("id");
        let qid = elementid.split("savereply")[1];
        let reply = $("#reply" + qid).val();
        let resultdisplay = $("#queryresult" + qid);
        if (reply.length == 0) {
            resultdisplay.removeClass("hide-element");
            resultdisplay.addClass("alert-danger");
            resultdisplay.text("Empty Reply.");
            resultdisplay.delay(4000).queue(function(next) {
                resultdisplay.removeClass("alert-danger");
                resultdisplay.addClass("hide-element");
                next();
            });
            return;
        }
        $.ajax({
            url: "database/productquery.php",
            method: "POST",
            data: { reply: reply, qid: qid },
            cache: false,
            success: function(result) {
                var data = JSON.parse(result);
                resultdisplay.removeClass("hide-element");
                var color;
                if (data.statusCode == 200) {
                    color = "alert-success";
                    resultdisplay.text("Replied successfully.");
                    $("#" + elementid).text("Update");
                    $("#toggleanswer" + qid).text("See answer");
                } else if (data.statusCode == 201) {
                    color = "alert-danger";
                    resultdisplay.text("Failed to reply the question.");
                }
                resultdisplay.addClass(color);
                resultdisplay.delay(4000).queue(function(next) {
                    resultdisplay.removeClass(color);
                    resultdisplay.addClass("hide-element");
                    next();
                });
            }
        });

    });

})(jQuery);