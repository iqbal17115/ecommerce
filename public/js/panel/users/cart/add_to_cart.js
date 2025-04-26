document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add_cart_item').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.product_id;
            CartManager.addItem(productId);
        });
    });
});
