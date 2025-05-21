document.addEventListener('DOMContentLoaded', () => {
    const variationInput = document.getElementById('selected_variation_id');

    /**
     * Display error message via Toastr (fallback-safe)
     */
    const showError = (message) => {
        if (typeof toastrErrorMessage === 'function') {
            toastrErrorMessage(message);
        } else if (typeof toastr !== 'undefined') {
            toastr.error(message);
        } else {
            alert(message);
        }
    };

    /**
     * Handles cart actions (add to cart or buy now)
     * @param {HTMLElement} button
     * @param {boolean} isBuyNow
     */
    const handleCartAction = (button, isBuyNow = false) => {
        const productId = button.dataset.product_id;
        const hasVariation = button.dataset.has_variation === '1';
        const detailsUrl = button.dataset.details_url || null;
        const variationInput = document.getElementById('selected_variation_id');
        const currentProductQuantity = document.getElementById('current_product_quantity')?.value || 1;
        let isTotalItemQty = false;
        const isOnDetailsPage = !!variationInput;
        const productVariationId = variationInput?.value || null;

        if (document.getElementById('current_product_quantity')?.value) {
            isTotalItemQty = true;
        }

        // If variation is required but not selected
        if (variationInput?.hasAttribute('required') && !productVariationId) {
            showError('Please select a product variation before proceeding.');
            return;
        }

        // If variation is required but not selected
        if (hasVariation && !isOnDetailsPage) {
            if (detailsUrl) {
                window.location.href = detailsUrl;
            } else {
                showError('Product has variations. Please select options from the product page.');
            }
            return;
        }

        CartManager.addItem(productId, currentProductQuantity, isBuyNow ? 1 : 0, productVariationId, isTotalItemQty);
    };

    // Add to Cart buttons
    document.querySelectorAll('.add_cart_item').forEach(button => {
        button.addEventListener('click', () => handleCartAction(button, false));
    });

    // Buy Now buttons
    document.querySelectorAll('.buy_now_with_quantity').forEach(button => {
        button.addEventListener('click', () => handleCartAction(button, true));
    });
});
