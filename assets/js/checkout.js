$(document).on('ready', function() {
    $("#shippingInfo input").prop("disabled", true);
    $("#cbox").on("click", function(e) {
        if ($(this).prop("checked") == true) {

            $("#shippingInfo input").prop("disabled", false);
        } else {

            $("#shippingInfo input").prop("disabled", true);
        }
    });


    $(document).on("submit", "#newBook", function(e) {
        //billing info
        e.preventDefault();
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
            confirmOrder();
            return false;
        }
    });

    $("#placeorder").on("click", function(e) {
        var addressCheck = $("#newaddressbook").html();

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
                confirmOrder();
                return false;
            }
        }
    });

    $("#billingcountry").on("change", function() {
        var a = $(this).val().toLowerCase();
        $("#billingcountryflag").attr("src", "img/flags/" + a + ".png");
    });

    $("#shippingcountry").on("change", function() {
        var a = $(this).val().toLowerCase();
        $("#shippingcountryflag").attr("src", "img/flags/" + a + ".png");
    });

    function confirmOrder() {
        var addressCheck = $("#newaddressbook").html();
        var payment = $('input[type="radio"]:checked').val();
        // has no address book
        if (addressCheck == "true") {
            var setdefault = $("#setdefault").prop("checked") == true ? true : false;
            var billingfname = $("#billingfname").val();
            var billinglname = $("#billinglname").val();
            var billingemail = $("#billingemail").val();
            var billingphone = $("#billingphone").val();
            var country = $("#billingcountry").val();
            var billingaddressone = $("#billingaddressone").val();
            var billingaddresstwo = $("#billingaddresstwo").val();
            var billingpostalcode = $("#billingpostalcode").val();

            if ($("#cbox").prop("checked") == true) {
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
                        setdefault: setdefault,
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
                        var data = JSON.parse(result);
                        if (data.statusCode == 200) {
                            //order placed succesfully
                            toastr.success('Order placed successfully.', 'Order Placement!');
                            $(this).delay(2000).queue(function(next) {
                                window.location.href = "orderdetail.php?i=" + data.orderid;
                                next();
                            });
                        } else if (data.statusCode == 201) {
                            toastr.error('Order placing failed. Please try again.', 'Order Placement!');
                            //order placing failed
                        } else if (data.statusCode == 202) {
                            toastr.error('Failed to add order details.', 'Order Placement!');
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
                        setdefault: setdefault,
                        billingaddressone: billingaddressone,
                        billingaddresstwo: billingaddresstwo,
                        billingpostalcode: billingpostalcode,
                        payment: payment
                    },
                    cache: false,
                    success: function(result) {
                        var data = JSON.parse(result);
                        resultForOrder(data);
                    }
                });
            }
        }
        // has already address book        
        else {
            $.ajax({
                url: "database/confirmorder.php",
                type: "POST",
                data: { defaultaddress: "usedefault", payment: payment },
                cache: false,
                success: function(result) {
                    var data = JSON.parse(result);
                    resultForOrder(data);
                }

            });
        }
    }

    function resultForOrder(data) {
        if (data.statusCode == 200) {
            //order placed succesfully
            toastr.success('Order placed successfully.', 'Order Placement!');
            $(this).delay(2000).queue(function(next) {
                window.location.href = "orderdetail.php?i=" + data.orderid;
                next();
            });
        } else if (data.statusCode == 201) { //order placing failed             
            toastr.error('Order placing failed. Please try again.', 'Order Placement!');
        } else if (data.statusCode == 202) { // billing or shipping detail add failed
            toastr.error('Failed to add billing and shipping details.', 'Order Placement!');
        } else if (data.statusCode == 203) { // product details not inserted into database.
            toastr.error('Failed to add order product details.', 'Order Placement!');
        }
    }
});