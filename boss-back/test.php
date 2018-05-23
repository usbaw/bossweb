<?php 
session_start();
$event_id = $_SESSION['event_id'];
$event_id = $_SESSION['id_user'];


?>

<!DOCTYPE html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>

<body>


    <div id="paypal-button"></div>

    <script>
        paypal.Button.render({

            env: 'sandbox', // sandbox | production

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                sandbox:    'ARyzAmTW0oqZpXZemE7poVhu4f_R-FmTSIi4MjAkCzCqAg2vGC3eyxADq2XLowRtKkrHSmimx1cmi4hO',
                production: 'AWAJz3eA62xzvRT2hD0mk5UW6MW0rUJXwcKZ3kUkRokpWXzld37RQRYrcp7oI-JJC0Tya0NJNhZy2S19'
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {

                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { total: '5', currency: 'EUR' }
                            }
                        ]
                    }
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                    window.alert('Payment Complete!');
                });
            }

        }, '#paypal-button');

    </script>
</body>
    