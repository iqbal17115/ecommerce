// Assume you have a function to fetch cart data and make the AJAX request
function calculateShippingCharges(shipping_method_id = 'ee1f0de6-223e-11ee-aaf7-5811220534bb') {
    // ... Code to fetch cart data and construct the data object for the request

    // Make the AJAX request
    $.ajax({
        url: '/calculate-shipping-charge', // Your Laravel route to the controller method
        method: 'POST',
        dataType: 'json',
        data: {
            'shipping_method_id': shipping_method_id
        },
        success: function(response) {
            // The AJAX request was successful;
            updateTotalPrice(response.sub_total, response.charge);
        },
        error: function(xhr, status, error) {
            // Handle AJAX error, if any
            console.error('Error:', error);
        },
    });
}

calculateShippingCharges();
