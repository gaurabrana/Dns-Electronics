$(document).ready(function(e) {
    //on country change
    $(".billingcountry").on("change", function(e) {
        var uniqueid = $(this).attr("id");
        var ID = uniqueid.split("country")[1];
        var country = $(this).val().toLowerCase();
        $("#countryflag" + ID).attr("src", "../img/flags/" + country + ".png");
    });

    $(".shippingcountry").on("change", function(e) {
        var uniqueid = $(this).attr("id");
        var ID = uniqueid.split("shippingcountry")[1];
        var country = $(this).val().toLowerCase();
        $("#shippingcountryflag" + ID).attr("src", "../img/flags/" + country + ".png");
    });

    $(".checksameshipping").on("click", function() {
        var id = $(this).attr("id");
        var uniqeuid = id.split("sameshipping")[1];
        if ($(this).prop("checked") == true) {
            $("#containsShippingDetail" + uniqeuid + " input").prop("disabled", true);
            $("#containsShippingDetail" + uniqeuid + " select").prop("disabled", true);
        } else {
            $("#containsShippingDetail" + uniqeuid + " input").prop("disabled", false);
            $("#containsShippingDetail" + uniqeuid + " select").prop("disabled", false);
        }
    });

    $(".deletebilling").on("click", function(e) {
        var getid = $(this).attr("id");
        var uniqueid = getid.split("deletebillingdetail")[1];
        $.ajax({
            url: "updateaddressbook.php",
            data: { "deleteaddress": uniqueid },
            method: POST,
            cache: false,
            success: function(data) {
                var code = JSON.parse(data);
                if (code.statusCode == 200) {
                    //delete that div
                } else if (code.statusCode == 201) {
                    //show eerror
                }
            }
        });
    });
});