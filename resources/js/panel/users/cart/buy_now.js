$(document).on('click', '.buy_now_item', function () {
    const productId = this.dataset.product_id;
    const quantity = 1;
    const isBuyNow = 1;

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

            if (data.redirect) {
                window.location.href = data.redirect;
            }
        },
        (error) => {
            console.error("Buy Now error:", error);
        }
    );
});
