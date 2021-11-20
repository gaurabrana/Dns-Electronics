(function($) {

    $(".actionforeview").on("click", function() {
        let elementid = $(this).attr("id");
        let reviewid = elementid.split("deleteReview")[1];
        $.ajax({
            url: "database/editrating.php",
            method: "POST",
            data: { action: "deletereview", id: reviewid },
            cache: false,
            success: function(result) {
                var data = JSON.parse(result);
                if (data.statusCode == 200) {
                    $("#holdReview" + reviewid).remove();
                    toastr.success('Product review deleted.', 'Product Review!');
                } else if (data.statusCode == 201) {
                    toastr.error('Failed to delete product review.', 'Product Review!');
                }
            }
        });
    });

})(jQuery);