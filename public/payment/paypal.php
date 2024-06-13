<div id="paypal-button"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<script>
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AeVWfTJqRk4cMaGwnVzWvsSOOnkxJtR7q5hlqETuRLBLBVni8UuY1XVqAk7t2OQ4pvRnLg_WCCD-QeUm',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'ar_EG',
    style: {
      size: 'small',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
            amount: {
                total: '20', //Package value
                currency: 'USD'
            },
            description: 'اشتراك في باقة زفاف المدفوعه',
            custom: '483:3', //userId:pavkageId

        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.alert('Thank you for your purchase!');
      });
    }
  }, '#paypal-button');
</script>

