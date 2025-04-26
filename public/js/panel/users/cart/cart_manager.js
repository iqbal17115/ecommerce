const CartManager = (() => {
    let cartData = [];

    function loadCartData(forceReload = false) {
        if (cartData.length > 0 && !forceReload) {
            renderAll();
            return;
        }

        getDetails('/cart-drawer/list', (data) => {
            cartData = data.results;
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
            getDetails('/api/checkout/cart/lists', (data) => {
                cartData = data.results.data;
                CartActiveItemList.render(cartData);
            }, (error) => {
                console.error("Failed to load cart data:", error);
            });
        }

        updateCartCount();
    }

    function addItem(productId, quantity = 1, isBuyNow = 0) {
        saveAction(
            "store",
            "/cart-items/store",
            { product_id: productId, quantity, is_buy_now: isBuyNow },
            "",
            (data) => {
                toastrSuccessMessage(data.message);
                loadCartData(true);
            },
            (error) => {
                console.error("Add to cart failed", error);
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
