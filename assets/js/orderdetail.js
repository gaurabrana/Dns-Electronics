$(document).ready(function() {

    $(".paymentOptions").on("click", () => {
        // check payment type
        var paymenttype = $("#holdPaymentType").val();
        var orderid = $("#holdOrderId").val();
        var data = { "payment": paymenttype, "orderid": orderid };
        $.ajax({
            url: "payment.php",
            type: "POST",
            data: data,
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    });

    $(".paypalbtn").on("click", function(e) {
        $(".paypal-button").click();
    });



});