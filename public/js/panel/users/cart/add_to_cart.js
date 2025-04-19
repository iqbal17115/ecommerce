document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add_cart_item').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.product_id;
            const quantity = 1;
            const isBuyNow = 0;

            const formData = {
                product_id: productId,
                quantity: quantity,
                is_buy_now: isBuyNow
            };

            saveAction(
                "store",
                "/cart-items/store",
                formData,
                "",
                (data) => {
                    toastrSuccessMessage(data.message);
                    CartDrawer.loadCartCount();
                    CartDrawer.load(true);
                },
                (error) => {
                    if (error?.responseJSON?.errors) {
                        console.error("Validation failed:", error.responseJSON.errors);
                    } else {
                        console.error("Something went wrong");
                    }
                }
            );
        });
    });
});
