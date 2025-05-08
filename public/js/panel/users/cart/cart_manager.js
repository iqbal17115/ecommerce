const CartManager = (() => {
    let cartData = [];

    function loadCartData(forceReload = false) {
        if (cartData.length > 0 && !forceReload) {
            renderAll();
            return;
        }

        getDetails('/cart/lists', (data) => {
            cartData = data.results.data;
            renderAll();
        }, (error) => {
            console.error("Failed to load cart data:", error);
        });
    }

    function renderAll() {
        if (typeof CartDrawer !== 'undefined') {
            CartDrawer.load(true);
        }

        if (window.hasCartList && typeof CartList !== 'undefined') {
            CartList.render(cartData);
        }

        if (window.hasCartActiveItemList && typeof CartActiveItemList !== 'undefined') {
            getDetails('/checkout/cart/lists', (data) => {
                cartData = data.results.data;
                CartActiveItemList.render(cartData);
            }, (error) => {
                console.error("Failed to load cart data:", error);
            });
        }

        updateCartCount();
    }

    function addItem(productId, quantity = 1, isBuyNow = 0, productVariationId = null) {
        saveAction(
            "store",
            "/cart-items/store",
            { product_id: productId, quantity, is_buy_now: isBuyNow, product_variation_id: productVariationId },
            "",
            (data) => {
                toastrSuccessMessage(data.message);
                loadCartData(true);

                // Redirect to checkout if Buy Now
                if (isBuyNow && data.redirect) {
                    window.location.href = data.redirect;
                }
            },
            (error) => {
                // Handle 401 Unauthorized response and redirect to login page
                if (error.status === 401 && error.responseJSON.redirect) {
                    window.location.href = error.responseJSON.redirect;
                } else {
                    console.error("Add to cart failed", error);
                }
            }
        );
    }

    function removeItem(cartItemId) {
        deleteAction(
            `/cart-items/${cartItemId}`,
            (data) => {
                toastrSuccessMessage(data.message);
                loadCartData(true);
            },
            (error) => {
                toastrErrorMessage(error?.responseJSON?.message ?? "Remove failed");
            }
        );
    }

    function updateQuantity(cartItemId, quantity) {
        if (quantity <= 0) return;
        saveAction(
            "update",
            '/cart-items',
            { quantity },
            cartItemId,
            (data) => {
                toastrSuccessMessage(data.message);
                loadCartData(true);
            },
            (error) => {
                toastrErrorMessage(error?.responseJSON?.message ?? "Update failed");
            }
        );
    }

    function updateCartCount() {
        let totalQty = cartData.reduce((sum, item) => sum + parseInt(item.quantity), 0);
        document.querySelectorAll('.cart-count').forEach(el => {
            el.textContent = totalQty;
        });
    }

    return {
        loadCartData,
        addItem,
        removeItem,
        updateQuantity,
    };
})();
