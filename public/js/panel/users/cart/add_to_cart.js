document.addEventListener('DOMContentLoaded', () => {
    // For "Add to Cart" buttons
    document.querySelectorAll('.add_cart_item').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.product_id;
            CartManager.addItem(productId, 1, 0); // isBuyNow = 0
        });
    });

    // For "Buy Now" buttons
    document.querySelectorAll('.buy_now_with_quantity').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.product_id;
            CartManager.addItem(productId, 1, 1); // isBuyNow = 1
        });
    });
});
