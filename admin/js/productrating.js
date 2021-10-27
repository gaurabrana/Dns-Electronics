(function($) {

    $(".actionforeview").on("click", function() {
        let elementid = $(this).attr("id");
        let reviewid = elementid.split("deleteReview")[1];
        alert("sad");
        return;
        $.ajax({
            url: "database/editrating.php",
            method: "POST",
            data: { action: deletereview, id: reviewid },
            cache: false,
            success: function(result) {
                var data = JSON.parse(result);
                if (data.statusCode == 200) {

                } else if (data.statusCode == 201) {

                }
            }
        });
    });

})(jQuery);