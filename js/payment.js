var Totalamount = 200;
paypal.Buttons({
    style: {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function(data, actions) {
        let getData = { "getData": "getData" };
        // This function sets up the details of the transaction, including the amount and line item details.
        //Get data from cart of logged in user
        return fetch('database/getorderamount.php', { method: 'POST', body: JSON.stringify(getData) })
            .then(response => {
                return response.json()
            })
            .then(data => {
                const price = {
                    purchase_units: [{
                        amount: {
                            value: data
                        }
                    }]
                };
                return actions.order.create(price);
            })
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {

        })
    },
    onCancel: function(data) {}
}).render('body');