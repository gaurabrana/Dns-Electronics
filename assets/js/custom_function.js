$(document).ready(function(e) {
    //on country change
    $(".billingcountry").on("change", function(e) {
        var uniqueid = $(this).attr("id");
        var ID = uniqueid.split("country")[1];
        var country = $(this).val().toLowerCase();
        $("#countryflag" + ID).attr("src", "img/flags/" + country + ".png");
    });

    $(".shippingcountry").on("change", function(e) {
        var uniqueid = $(this).attr("id");
        var ID = uniqueid.split("shippingcountry")[1];
        var country = $(this).val().toLowerCase();
        $("#shippingcountryflag" + ID).attr("src", "img/flags/" + country + ".png");
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

    $("#newAddressSameShipping").on("click", function() {
        if ($(this).prop("checked") == true) {
            $(".new-shipping-address" + " input").prop("disabled", true);
            $(".new-shipping-address" + " select").prop("disabled", true);
        } else {
            $(".new-shipping-address" + " input").prop("disabled", false);
            $(".new-shipping-address" + " select").prop("disabled", false);
        }
    });

    $(".deletebilling").on("click", function(e) {
        var getid = $(this).attr("id");
        var uniqueid = getid.split("deletebillingdetail")[1];
        $.ajax({
            url: "database/updateaddressbook.php",
            data: { "deleteaddress": uniqueid },
            method: "POST",
            cache: false,
            success: function(data) {
                var code = JSON.parse(data);
                if (code.statusCode == 200) {
                    //delete that div
                    toastr.success('Address book has been deleted successfully', 'Address Book!');
                    $("#holdingaddressbook" + uniqueid).remove();
                    $('html, body').animate({
                        scrollTop: $(".holdnewaddress").offset().top
                    }, 500);

                } else if (code.statusCode == 201) {
                    toastr.error('Failed to delete address book', 'Address Book!');
                }
            }
        });
    });

    $("#newBook").submit(function(e) {
        e.preventDefault();
        var data = new FormData(document.getElementById("newBook"));
        if ($("#newAddressSameShipping").prop("checked") == false) {
            data.append("newAddressSameShipping", "true");
        }
        data.append("newaddressbook", "allow");
        var displayresult = $("#newAddressBookResult");
        $.ajax({
            method: "POST",
            enctype: 'multipart/form-data',
            url: "database/addaddressbook.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(result) {
                var resultData = JSON.parse(result);
                if (resultData.statusCode == 200) {
                    toastr.success('Address Book Added. Please refresh to see changes.', 'Address Book!');
                    document.getElementById("newBook").reset();
                } else if (resultData.statusCode == 201) {
                    toastr.error('Failed to add address book.', 'Address Book!');
                } else if (resultData.statusCode == 202) {
                    toastr.error('Internal system error. Try again.', 'Address Book!');
                } else {
                    toastr.error('Please try again later.', 'Address Book!');
                }
            }
        });
    });

    $(".activechange").on("click", function() {
        let elementid = $(this).attr("id");
        let infoid = elementid.split("statusbillingdetail")[1];
        $.ajax({
            url: "database/updateaddressbook.php",
            method: "POST",
            data: { "setactive": infoid },
            cache: false,
            success: function(e) {
                var resultData = JSON.parse(e);
                if (resultData.statusCode == 200) {
                    toastr.success('Active Address Book Changed. Please refresh to see changes.', 'Address Book!');
                    document.getElementById("newBook").reset();
                } else if (resultData.statusCode == 201) {
                    toastr.error('Failed to change active address book.', 'Address Book!');
                } else if (resultData.statusCode == 202) {
                    toastr.error('Internal system error. Try again.', 'Address Book!');
                } else {
                    toastr.error('Please try again later.', 'Address Book!');
                }
            }
        });
    });
});