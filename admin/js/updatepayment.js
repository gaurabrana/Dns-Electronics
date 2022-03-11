(function($) {
    $(".paymentupdate").on("click", function(e) {
        e.preventDefault();
        let elementid = $(this).attr("id");
        let orderid = elementid.split("updatepayment")[1];
        let type = $("#holdpaymenttype" + orderid).val();
        let payamount = $("#val-payamount" + orderid).val();
        let date = $("#holdCalendar" + orderid + " input").val();
        let resultdisplay = $("#hold-payment-result" + orderid);
        let error = 0;
        //validate
        if (payamount.length == 0) {
            error++;
        } else {
            if (payamount == 0) {
                error++;
            }
        }

        if (date.length == 0) {
            error++;
        }

        if (error == 0) {
            var data = new FormData();
            data.append("type", type);
            data.append("orderid", orderid);
            data.append("payamount", payamount);
            data.append("paydate", date);
            data.append("action", "updatepayment");
            $.ajax({
                url: "database/updatepayment.php",
                method: "POST",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success: function(result) {
                    var dataresult = JSON.parse(result);
                    if (dataresult.statusCode == 200) {
                        showResult(resultdisplay, "alert-success", "Payment updated successfully.");
                        let row = $("#paymentfororder" + orderid).get(0);
                        var table = $(".paymenttable").DataTable();                        
                        let date = dataresult.date;
                        let status = dataresult.status;
                        let index = table.row(row).index();
                        table.cell({ row: index, column: 2 }).data(payamount);                        
                        table.cell({ row: index, column: 3 }).data(date);
                        table.cell({ row: index, column: 4 }).data(status);
                        table.cell({ row: index, column: 5 }).data("Job Done");
                    } else if (dataresult.statusCode == 201) {
                        showResult(resultdisplay, "alert-danger", "Failed to update payment. Please try again.");
                    } else if (dataresult.statusCode == 202) {
                        showResult(resultdisplay, "alert-danger", "Payment price not met. Please check.");
                    }
                }
            });
        } else {
            showResult(resultdisplay, "alert-danger", "Invalid fields found. Check and try again.");
        }

    });

    function showResult(a, b, c) {
        a.removeClass("hide-element");
        a.addClass(b);
        a.html(c);
        $(a).delay(2000).queue(function(next) {
            a.addClass("hide-element");
            a.removeClass(b);
            a.html("");
            next();
        });
    }

    $('.amountPaid').on('input', function() {
        let elementid = $(this).attr("id");
        let payamount = parseFloat($(this).val());
        let orderid = elementid.split("val-payamount")[1];
        let totalamount = parseFloat($(this).attr("max"));
        if (payamount > totalamount) {
            $("#val-remainingamount" + orderid).prop('value', "Over Payment");

        } else {
            let remainingamount = totalamount - payamount;
            $("#val-remainingamount" + orderid).prop('value', remainingamount);
        }
    });

})(jQuery);