$(document).on('ready', function() {

    $('.input-group input').keypress(function(event) {
        if (event.keyCode == 13) {
            var id = $(this).attr("id");
            var productID = id.split("quantity")[1];
            var quantity = $("#quantity" + productID).val();
            updatecartquantity("middle", productID, quantity);
        }
    });

    $(".input-group .plus").on("click", function(e) {
        var id = $(this).attr("id");
        var productID = id.split("plus")[1];
        var quantity = parseInt($("#quantity" + productID).val(), 10);
        updatecartquantity("plus", productID, quantity);
    });

    $(".input-group .minus").on("click", function(e) {
        var id = $(this).attr("id");
        var productID = id.split("minus")[1];
        var quantity = parseInt($("#quantity" + productID).val(), 10);
        updatecartquantity("minus", productID, quantity);
    });

    $(".action p").on("click", function(e) {
        var id = $(this).attr("id");
        var productID = id.split("remove")[1];
        $.ajax({
            url: "database/updatecartquantity.php",
            type: "POST",
            data: { a: "delete", b: productID },
            cache: false,
            success: function(result) {
                var data = JSON.parse(result);
                var total = data.total;
                getItemInCart();
                $("#tablerow" + productID).remove();
                $("#totalpayment").html("Rs " + total);
                var totalWithoutDiscount = data.totalWithoutDiscount;
                $("#totalWithoutDiscount").html("Rs " + totalWithoutDiscount);
                var totalDiscount = data.totalDiscount;
                $("#totalDiscount").html("Rs " + totalDiscount);
            }
        });
    });

    function getItemInCart() {
        $.ajax({
            type: "POST",
            url: 'database/getcartdata.php',
            data: { action: "getData" },
            success: function(result) {
                $("#holdshoppingcart").html(result);
            }
        });
    }


    function updatecartquantity(j, k, l) {
        var m = $("#stock" + k).val();
        var l_a = parseInt(l, 10);
        var m_a = parseInt(m, 10);
        var isCheckout = $("#placeorder").val();
        if (l_a >= 1 && l_a <= m_a) {
            $.ajax({
                url: "database/updatecartquantity.php",
                type: "POST",
                data: { b: k, a: j, c: l },
                cache: false,
                success: function(result) {
                    var data = JSON.parse(result);
                    var total = data.total;
                    $("#totalpayment").html("Rs " + total);
                    var totalWithoutDiscount = data.totalWithoutDiscount;
                    $("#totalWithoutDiscount").html("Rs " + totalWithoutDiscount);
                    var subtotal = data.subtotal;
                    $("#subtotal" + k).html("Rs " + subtotal);
                    var totalDiscount = data.totalDiscount;
                    $("#totalDiscount").html("Rs " + totalDiscount);
                    if (isCheckout != null) {
                        $("#subTotalCheckout").html("Rs " + total);
                        $("#TotalCheckout").html("Rs " + total);
                    }
                }
            });
        } else {
            $("#cartError" + k).html("Quantity available for this product is 1 - " + m + ".");
            $("#cartError" + k).css('display', 'block');
            $("#cartError" + k)
                .delay(3000)
                .queue(function(next) {
                    $(this).css('display', 'none');
                    next();
                });
        }
    };
});