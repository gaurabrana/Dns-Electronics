$(document).on('ready', function() {
    $("#submitquery").on("click", function() {
        var query = $("#query").val();
        var productcode = $("#productidforquery").val();
        var no_of_queries = $("#holdNumberOfQueries").text();
        if (query.length != 0) {
            $.ajax({
                url: "database/addquery.php",
                method: "POST",
                data: { "query": query, "code": productcode },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.statusCode == 200) {
                        $("#resultmsg").html("Question has been added. We will response shortly.");
                        $("#resultmsg").css("color", "green");
                        $("#query").val("");
                        $("#leaveaquestion").collapse('hide');
                        $("#holdNumberOfQueries").text(parseInt(no_of_queries) + 1);
                        $(".comments").append(data.queries);
                    } else if (data.statusCode == 201) {
                        $("#resultmsg").html("Failed to add question. Please try again.");
                        $("#resultmsg").css("color", "#ed1c24");
                    } else if (data.statusCode == 202) {
                        $("#resultmsg").html("Please login first to leave a question.");
                        $("#resultmsg").css("color", "#ed1c24");
                    }
                }
            });
        } else {
            $("#resultmsg").html("Please type your question before posting.");
            $("#resultmsg").css("color", "#ed1c24");
        }
        $("#resultmsg").delay(2000).queue(function(next) {
            $("#resultmsg").html("");
            next();
        });
    });

    $(document).on("click", ".querybutton button", function(e) {
        let elementid = $(this).attr("id");
        let splitter;
        var no_of_queries = $("#holdNumberOfQueries").text();
        if (elementid.indexOf("deleteQuestionButton") >= 0) {
            splitter = "deleteQuestionButton";
            let queryid = elementid.split(splitter)[1];
            $.ajax({
                url: "database/addquery.php",
                data: { "action": "delete", "id": queryid },
                method: "POST",
                cache: false,
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.statusCode == 200) {
                        toastr.success('Question deleted.', 'Product Queries!');
                        $("#holdQueryOfCustomers" + queryid).remove();
                        $("#holdNumberOfQueries").text(no_of_queries - 1);
                    } else if (data.statusCode == 201) {
                        toastr.error('Failed to delete question. Please try again.', 'Product Queries!');
                    }
                }
            });
        } else if (elementid.indexOf("hideDeleteQuestionDiv") >= 0) {
            splitter = "hideDeleteQuestionDiv";
            let queryid = elementid.split(splitter)[1];
            $("#deleteQuestionDiv" + queryid).collapse('hide');
        }
    });

    $(document).on("click", "#submitreview", function(e) {
        var review = $("#review").val();
        var stars = $(".star-rating").val();
        var productcode = $("#productidforreview").val();
        if (stars.length != 0 && review.length != 0) {
            $.ajax({
                url: "database/addreview.php",
                method: "POST",
                data: { "review": review, "code": productcode, "rating": stars },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.statusCode == 200) {
                        $("#resultreview").html("Your review has been added for this product. Thank you.");
                        $("#resultreview").css("color", "green");
                        $("#deletereview").css("display", "inline-block");
                        $("#submitreview").html("Update");
                        $("#submitreview").attr("id", "updatereview");
                        $("#actionTitle").html("Update your review");
                        $(".review-title").html("Reviews (" + data.count + ")");
                        $(".testimonial-box-container").append(data.reviews);
                    } else if (data.statusCode == 201) {
                        $("#resultreview").html("Failed to add the review. Please try again.");
                        $("#resultreview").css("color", "#ed1c24");
                    } else if (data.statusCode == 202) {
                        $("#resultreview").html("Please login first to review this product.");
                        $("#resultreview").css("color", "#ed1c24");
                    }
                }
            });
        } else {
            $("#resultreview").css("color", "#ed1c24");
            if (stars.length == 0) {
                $("#resultreview").html("Please give this product a rating before posting.");
            } else {
                $("#resultreview").html("Please leave your review before posting.");
            }
        }
    });

    $(document).on("click", "#updatereview", function(e) {
        var review = $("#review").val();
        var stars = $(".star-rating").val();
        var productcode = $("#productidforreview").val();
        if (stars.length != 0 && review.length != 0) {
            $.ajax({
                url: "database/addreview.php",
                method: "POST",
                data: { "update": "true", "review": review, "code": productcode, "rating": stars },
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.statusCode == 200) {
                        $("#resultreview").html("Your review has been updated for this product. Thank you.");
                        $("#resultreview").css("color", "green");
                        $("#testimonials").css("visibility", "visible");
                        $("#reviewOfCurrentUser").html(data.reviews);
                        $("#actionTitle").delay(2000).queue(function(next) {
                            $("#actionTitle").click();
                            next();
                        });
                    } else if (data.statusCode == 201) {
                        $("#resultreview").html("Failed to update the review. Please try again.");
                        $("#resultreview").css("color", "#ed1c24");
                    } else if (data.statusCode == 202) {
                        $("#resultreview").html("Please login first to review this product.");
                        $("#resultreview").css("color", "#ed1c24");
                    }
                }
            });
        } else {
            $("#resultreview").css("color", "#ed1c24");
            if (stars.length == 0) {
                $("#resultreview").html("Please give this product a rating before posting.");
            } else {
                $("#resultreview").html("Please leave your review before posting.");
            }
        }
    });

    $("#deletereview").on("click", function(e) {
        var productcode = $("#productidforreview").val();
        $.ajax({
            url: "database/addreview.php",
            method: "POST",
            data: { "action": "delete", "code": productcode },
            success: function(result) {
                var data = JSON.parse(result);
                if (data.statusCode == 200) {
                    $("#resultreview").html("Your review has been deleted.");
                    $("#resultreview").css("color", "#ed1c24");
                    $("#reviewOfCurrentUser").remove();
                    $("#deletereview").css("display", "none");
                    $("#updatereview").html("Post");
                    if (data.count == 0) {
                        $(".review-title").html("No Reviews Yet");
                    } else {
                        $(".review-title").html("Reviews (" + data.count + ")");
                    }
                    $("#updatereview").attr("id", "submitreview");
                    $("#actionTitle").html("Leave a review");
                } else if (data.statusCode == 201) {
                    $("#resultreview").html("Failed to delete review. Please try again.");
                    $("#resultreview").css("color", "#ed1c24");
                }
            }
        })
    });
});