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

$(document).on('click', '#btn_place_order', function () {
    const formData = {
        address_id: $('#default_address').data('address_id') ?? null,
        user_id: $("#temp_user_id").data('user_id') ?? null,
        payment_method: $('input[name="radio"]:checked').val() ?? null,
    };

    submitOrder(formData, '');
});