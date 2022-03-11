$(document).on('ready', function() {

    $(".toggleData").on("click", function() {
        // off
        if ($(this).hasClass("buttonData")) {
            $(this).html("Show less..");
            $(this).removeClass("buttonData");
        }
        // on
        else {
            $(this).html("Expand more..");
            $(this).addClass("buttonData");
        }
    });

});