function submitOrder(formData, selectedId = "") {
    saveAction(
        "store",
        "/place-order",
        formData,
        selectedId,
        (data) => {
            if (typeof data.results !== 'undefined') {
                toastrSuccessMessage(data.message);
                // Assuming 'order_confirmation' is the route name
                const orderConfirmationRoute = `/order-confirmation/${data.results.id}`;
                // Redirect to the order confirmation page
                window.location.href = orderConfirmationRoute;
            } else {
                toastrErrorMessage("Address Not Found");
            }
        },
        (error) => {
            toastrErrorMessage(error.responseJSON.message);
        }
    );
}

// document.getElementById('placeOrderBtn').addEventListener('click', function () {
//     alert(111);
//     const form = document.getElementById('checkoutForm');
//     const formData = new FormData(form);

//     // Basic validation example
//     const requiredFields = ['name', 'phone', 'district', 'thana', 'address'];
//     for (let field of requiredFields) {
//         if (!formData.get(field)) {
//             alert(`Please fill the required field: ${field}`);
//             return;
//         }
//     }

//     // Here you would submit the form using AJAX or normal POST
//     alert("Order placed! (This is a placeholder action)");
// });

$(document).on('click', '#placeOrderBtn', function () {
    const form = document.getElementById('checkoutForm');
    const orderData = new FormData(form);

    // Basic validation example
    const requiredFields = ['name', 'phone', 'district', 'thana', 'address'];
    for (let field of requiredFields) {
        if (!orderData.get(field)) {
            toastrErrorMessage(`Please fill the required field: ${field}`);
            return;
        }
    }

    const formData = {
        // address_id: $('#default_address').data('address_id') ?? null,
        // user_id: $("#temp_user_id").data('user_id') ?? null,
        // payment_method: $('input[name="radio"]:checked').val() ?? null,
    };

    submitOrder(formData, '');
});