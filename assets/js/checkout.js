$(document).on('ready', function() {
    $("#cbox").on("click", function(e) {
        if ($(this).prop("checked") == true) {

            $("#shippingInfo input").prop("disabled", false);
        } else {

            $("#shippingInfo input").prop("disabled", true);
        }
    });


    $(document).on("submit", "defaultaddress", function(e) {
        e.preventDefault();
        //billing info
        var radios = document.querySelectorAll('input[type="radio"]:checked');
        var value = radios.length > 0 ? radios[0].value : null;
        if (value == null) {
            $("#paymenterror").html("Payment method not selected.");
            $("#paymenterror").css("display", "block");
            $("#paymenterror")
                .delay(3000)
                .queue(function(next) {
                    $(this).css('display', 'none');
                    next();
                });
            return;
        } else {
            $("#triggerConfirmation").click();
            return false;
        }
    });

    $("#placeorder").on("click", function(e) {
        var addressCheck = $("#newaddressbook").val();

        // has no address book
        if (addressCheck == "true") {
            $("#submitButton").click();
        }
        // has already address book        
        else {
            var radios = document.querySelectorAll('input[type="radio"]:checked');
            var value = radios.length > 0 ? radios[0].value : null;
            if (value == null) {
                $("#paymenterror").html("Payment method not selected.");
                $("#paymenterror").css("display", "block");
                $("#paymenterror")
                    .delay(3000)
                    .queue(function(next) {
                        $(this).css('display', 'none');
                        next();
                    });
                return;
            } else {
                $("#triggerConfirmation").click();
                return false;
            }
        }
    });

    $("#country").on("change", function() {
        var a = $(this).val().toLowerCase();
        $("#billingcountryflag").attr("src", "img/flags/" + a + ".png");
    });

    $("#shippingcountry").on("change", function() {
        var a = $(this).val().toLowerCase();
        $("#shippingcountryflag").attr("src", "img/flags/" + a + ".png");
    });

    $("#confirmOrder").on("click", function(e) {

        $("#closeModalBox").click();
        close();
        var addressCheck = $("#newaddressbook").val();
        var payment = $('input[type="radio"]:checked').val();
        alert("sad");
        // has no address book
        if (addressCheck == "true") {
            var billingfname = $("#billingfname").val();
            var billinglname = $("#billinglname").val();
            var billingemail = $("#billingemail").val();
            var billingphone = $("#billingphone").val();
            var country = $("#country").val();
            var billingaddressone = $("#billingaddressone").val();
            var billingaddresstwo = $("#billingaddresstwo").val();
            var billingpostalcode = $("#billingpostalcode").val();

            if ($(this).prop("checked") == true) {
                var shippingname = $("#shippingname").val();
                var shippingphone = $("#shippingphone").val();
                var shippingemail = $("#shippingemail").val();
                var shippingcountry = $("#shippingcountry").val();
                var shippingaddressone = $("#shippingaddressone").val();
                var shippingaddresstwo = $("#shippingaddresstwo").val();
                var shippingpostalcode = $("#shippingpostalcode").val();
                $.ajax({
                    url: "database/confirmorder.php",
                    type: "POST",
                    data: {
                        info: "includeshipping",
                        billingfname: billingfname,
                        billinglname: billinglname,
                        billingemail: billingemail,
                        billingphone: billingphone,
                        country: country,
                        billingaddressone: billingaddressone,
                        billingaddresstwo: billingaddresstwo,
                        billingpostalcode: billingpostalcode,
                        shippingname: shippingname,
                        shippingphone: shippingphone,
                        shippingemail: shippingemail,
                        shippingcountry: shippingcountry,
                        shippingaddressone: shippingaddressone,
                        shippingaddresstwo: shippingaddresstwo,
                        shippingpostalcode: shippingpostalcode,
                        payment: payment
                    },
                    cache: false,
                    success: function(result) {
                        if (data.statusCode == 200) {
                            //if paypal or esewa send to respective part
                        } else if (data.statusCode == 201) {
                            //order placing failed
                        } else if (data.statusCode == 202) {
                            // billing or shipping detail add failed
                        }
                    }
                });
            } else {
                $.ajax({
                    url: "database/confirmorder.php",
                    type: "POST",
                    data: {
                        info: "onlybilling",
                        billingfname: billingfname,
                        billinglname: billinglname,
                        billingemail: billingemail,
                        billingphone: billingphone,
                        country: country,
                        billingaddressone: billingaddressone,
                        billingaddresstwo: billingaddresstwo,
                        billingpostalcode: billingpostalcode,
                        payment: payment
                    },
                    cache: false,
                    success: function(result) {
                        if (data.statusCode == 200) {
                            //if paypal or esewa send to respective part
                        } else if (data.statusCode == 201) {
                            //order placing failed
                        } else if (data.statusCode == 202) {
                            // billing or shipping detail add failed
                        }
                    }
                });
            }
        }
        // has already address book        
        else {
            alert("already address boook");
            $.ajax({
                url: "database/confirmorder.php",
                type: "POST",
                data: { defaultaddress: "usedefault", payment: payment },
                cache: false,
                success: function(result) {
                    var data = JSON.parse(result);
                    if (data.statusCode == 200) {
                        //if paypal or esewa send to respective part
                        if (payment == "Paypal") {
                            const api = "https://api.exchangerate-api.com/v4/latest/USD";
                            fetch(`${api}`)
                                .then(currency => {
                                    return currency.json();
                                }).then(getOrderAmountInUSD);
                        } else if (payment == "COD") {

                        } else if (payment == "Esewa") {

                        }
                    } else if (data.statusCode == 201) {
                        //order placing failed
                    } else if (data.statusCode == 202) {
                        // billing or shipping detail add failed
                    }
                }

            });
        }
    });

    function getOrderAmountInUSD(currency) {
        let resultFrom = "NPR";
        let resultTo = "USD";
        let fromRate = currency.rates[resultFrom];
        let toRate = currency.rates[resultTo];
        $.ajax({
            url: "database/getorderamount.php",
            method: "POST",
            data: { "getData": "getData", "fromCurrency": resultFrom, "toCurrency": resultTo, "fromRate": fromRate, "toRate": toRate },
            cache: false,
            success: function(result) {
                var data = JSON.parse(result);
                Totalamount = data.price;
                convertCurrency();
            }
        });
        convertedamount =
            ((toRate / fromRate) * Totalamount);

        //reverse value
        var reverse = ((fromRate / toRate) * convertedamount);

        console.log(convertedamount + " // " + reverse);
    }
});