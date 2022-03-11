$(document).ready(function() {
    function initPayPalButton() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const id = urlParams.get('i');
        let totalAmount = 0;
        $.ajax({
            url: 'database/getorderamount.php',
            data: { "orderid": id },
            method: "POST",
            cache: false,
            success: function(result) {
                let data = JSON.parse(result);
                if (data.statusCode == 200) {
                    totalAmount = parseFloat(data.totalamount);
                } else {
                    return console.log("erorr");
                }
            }
        });

        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'white',
                layout: 'horizontal',
                label: 'paypal',

            },

            createOrder: function(data, actions) {
                const price = {
                    purchase_units: [{
                        amount: {
                            value: totalAmount
                        }
                    }]
                };
                return actions.order.create(price);
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    var paymentdata = JSON.stringify(orderData);
                    console.log(paymentdata);
                    // Full available details
                    $.ajax({
                        url: "savepayment.php",
                        data: { "i": paymentdata, "q": id, "d": totalAmount },
                        cache: false,
                        method: "POST",
                        success: function(result) {
                            var codes = JSON.parse(result);
                            console.log(codes);
                            if (codes.statusCode == 200) {
                                // successful data entry

                            } else if (codes.statusCode == 201) {
                                // unsuccessful data entry

                            } else if (codes.statusCode == 202) {
                                // price mismatch
                            }
                        }

                    });



                    // Show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<h3>Thank you for your payment!</h3>';

                    // Or go to another URL:  actions.redirect('thank_you.html');

                });
            },

            onError: function(err) {
                //console.log(err);
            }
        }).render('#paypal-button-container');
    }
    initPayPalButton();



});