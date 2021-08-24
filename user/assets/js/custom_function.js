$(document).ready(function(e) {
    var country = $("#country").val().toLowerCase();
    $("#countryflag").attr("src", "../img/flags/" + country + ".png");
    $("#country").on("change", function(e) {
        var country = $("#country").val().toLowerCase();
        $("#countryflag").attr("src", "../img/flags/" + country + ".png");
    });

    $("#sameshipping").on("click", function() {
        if ($(this).prop("checked") == true) {
            $("#containsShippingDetail input").attr("disabled", "disabled");
        } else {
            $("#containsShippingDetail input").attr("enabled", "enabled");
        }
    });
});