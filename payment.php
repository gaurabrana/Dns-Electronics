<div id="smart-button-container">
      <div style="text-align: center;">
        <div id="paypal-button-container"></div>
      </div>
    </div>
  <script src="https://www.paypal.com/sdk/js?client-id=AewYHDSh-Vue_sRKeDe4kY7L7eK24L91m-WPqggZUcZtoCXYE9fs-QEUL-ndGql21tvXKUIeD3nurkbX&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
  <script>
    function initPayPalButton() {
      paypal.Buttons({
        style: {
          shape: 'rect',
          color: 'white',
          layout: 'horizontal',
          label: 'paypal',
          
        },

        createOrder: function(data, actions) {
            let getData = { "getData": "getData" };
            // This function sets up the details of the transaction, including the amount and line item details.
            //Get data from cart of logged in user
            return fetch('database/getorderamount.php', { method: 'POST', body: JSON.stringify(getData) })
                .then(response => {
                    console.log(response.json());
                    return response.json()
                })
                .then(data => {
                    console.log(data);
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
          return actions.order.capture().then(function(orderData) {
            
            // Full available details
            console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

            // Show a success message within this page, e.g.
            const element = document.getElementById('paypal-button-container');
            element.innerHTML = '';
            element.innerHTML = '<h3>Thank you for your payment!</h3>';

            // Or go to another URL:  actions.redirect('thank_you.html');
            
          });
        },

        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container');
    }
    initPayPalButton();
  </script>