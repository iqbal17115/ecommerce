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

$(document).on('click', '#thana', function () {
    const upazilaId = $('#thana').val() || null;
    getDetails(`/checkout/cart/lists?upazila_id=${upazilaId}`, (data) => {
        cartData = data.results;
          console.log(cartData);
        CartActiveItemList.render(cartData);
    }, (error) => {
        console.error("Failed to load cart data:", error);
    });
});

$(document).on('click', '#placeOrderBtn', function () {
    const form = document.getElementById('checkoutForm');
    const formData = {};

    // Collect required fields into formData object
    const requiredFields = ['name', 'mobile', 'division', 'district', 'thana', 'address'];
    for (let field of requiredFields) {
        const value = form.elements[field]?.value?.trim() || '';
        if (!value) {
            toastrErrorMessage(`Please fill the required field: ${field}`);
            return;
        }
        formData[field] = value;
    }

    // Get payment method
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
    if (!paymentMethod) {
        toastrErrorMessage('Please select a payment method');
        return;
    }
    formData['payment_method'] = paymentMethod;

    // If you want to add other fields from the form that are not in requiredFields, do so here:
    // for example:
    // formData['email'] = form.elements['email']?.value || '';

    submitOrder(formData, '');
});

