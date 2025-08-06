$(document).on('click', '#applyCouponBtn', function () {
    const couponCode = $('#coupon_code').val().trim();
    const $feedback = $('#couponFeedback');

    if (!couponCode) {
        $feedback.text('Please enter a coupon code.').css('color', 'red');
        return;
    }

    const formData = {
        coupon_code: couponCode
    };

    saveAction(
        "store",
        "/coupon-apply",
        formData,
        null,
        (response) => {
            toastrSuccessMessage("Coupon applied successfully.");
            $feedback.text('Coupon applied successfully.').css('color', 'green');

            // Reload cart totals and UI
            CartManager.loadCartData(true);
        },
        (error) => {
            console.error(error);

            const response = error.responseJSON;

            // Default fallback
            let message = "Invalid coupon.";

            // If Laravel `Message::error()` structure
            if (response?.message) {
                message = response.message;
            }

            // If Laravel validation error
            if (response?.errors) {
                // Collect first validation message
                const firstError = Object.values(response.errors)?.[0]?.[0];
                if (firstError) {
                    message = firstError;
                }
            }

            toastrErrorMessage(message);
        }
    );
});
