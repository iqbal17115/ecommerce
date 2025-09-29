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

$(document).on('click', '#district', function () {
    const divisionId = $('#division').val() || null;
    const districtId = $('#district').val() || null;
    const upazilaId = $('#thana').val() || null;
    getDetails(`/checkout/cart/lists?division_id=${divisionId}&district_id=${districtId}&upazila_id=${upazilaId}`, (data) => {
        cartData = data.results;
        console.log(cartData);
        CartActiveItemList.render(cartData);
    }, (error) => {
        console.error("Failed to load cart data:", error);
    });
});

/**
 * Validate Bangladeshi phone number
 * @param {string} phone
 * @returns {boolean}
 */
function isValidPhone(phone) {
    const phonePattern = /^(?:\+?88)?01[3-9]\d{8}$/;
    return phonePattern.test(phone.trim());
}

$(document).on('click', '#placeOrderBtn', function () {
    const form = document.getElementById('checkoutForm');
    const formData = {};

    // 1️⃣ Validate phone first
    const mobile = form.elements['mobile']?.value?.trim() || '';
    if (!mobile) {
        toastrErrorMessage('Please enter your phone number');
        return;
    }
    if (!isValidPhone(mobile)) {
        toastrErrorMessage('Please enter a valid Bangladeshi phone number (e.g., 017XXXXXXXX)');
        return;
    }
    formData['mobile'] = mobile;
    
    // Collect required fields into formData object
    const requiredFields = ['name', 'mobile', 'district', 'address'];
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

