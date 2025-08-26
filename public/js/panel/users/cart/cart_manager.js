const CartManager = (() => {
    let cartData = [];

    function loadCartData(forceReload = false) {
        if (cartData.length > 0 && !forceReload) {
            renderAll();
            return;
        }

        getDetails('/cart/lists', (data) => {
            cartData = data.results.cart.data;
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
            const divisionId = $('#division').val() || null;
            const districtId = $('#district').val() || null;
            const upazilaId = $('#thana').val() || null;

            getDetails(`/checkout/cart/lists?division_id=${divisionId}&district_id=${districtId}&upazila_id=${upazilaId}`, (data) => {
                cartData = data.results;
                CartActiveItemList.render(cartData);
            }, (error) => {
                console.error("Failed to load cart data:", error);
            });
        }

        updateCartCount();
    }

    function addItem(productId, quantity = 1, isBuyNow = 0, productVariationId = null, isTotalItemQty = false) {
        saveAction(
            "store",
            "/cart-items/store",
            { product_id: productId, quantity, is_buy_now: isBuyNow, product_variation_id: productVariationId, is_total_item_qty: isTotalItemQty },
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
                const response = JSON.parse(error.responseText);
                toastrErrorMessage(response.message);
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
