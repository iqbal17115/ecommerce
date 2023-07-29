// Assume you have a function to fetch cart data and make the AJAX request
function calculateShippingCharges() {
    // ... Code to fetch cart data and construct the data object for the request

    // Make the AJAX request
    $.ajax({
        url: '/calculate-shipping-charge', // Your Laravel route to the controller method
        method: 'POST',
        dataType: 'json',
        success: function(response) {
            // The AJAX request was successful
            // Get the totalShippingCharge from the response JSON
            console.log(response.charge);
            // Set shipping charge
            $(".shipping_amount").text(response.charge);
            var totalAmount = parseFloat($(".cart_total_price").text()) + response.charge;
            $(".total-price").text(totalAmount);
        },
        error: function(xhr, status, error) {
            // Handle AJAX error, if any
            console.error('Error:', error);
        },
    });
}

calculateShippingCharges();
