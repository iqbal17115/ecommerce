function showCartTableData(data) {
    let total = 0;
    let total_shipping_charge = 0;
    let coupon_discount = 0;
    let checked_all_check_box = true;

    data.forEach((item) => {
        // Update vendor name (if you show only one vendor name at a time)
        $("#vendor_name").text(item.vendor_name);

        if (item.is_active == 1) {
            total += item.product_info.product_price * item.quantity;
            total_shipping_charge += parseFloat(item.shipping_charge);
            coupon_discount += item.coupon_discount;
        } else {
            checked_all_check_box = false;
        }

        // Generate variation info
        let variationInfo = '';
        if (item.variations && item.variations.length > 0) {
            variationInfo = item.variations.map(v => `${v.attribute_name}: ${v.attribute_value}`).join(', ');
        }

        // Generate cart row HTML
        const htmlContent = `
        <div class="cart_list_${item.id} p-3 mb-1 bg-white rounded shadow-sm" style="border: 1px solid #f1f1f1;">
            <div class="row align-items-center">
                <div class="col-10 col-md-7 d-flex">
                    <img src="${item.product_info.image_url}" alt="Product Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; margin-right: 15px;">
                    <div>
                        <div style="font-weight: 600; font-size: 16px;">${item.product_info.name}</div>
                        <div style="color: #6c757d; font-size: 13px;">${item.brand_name || 'No Brand'}, ${variationInfo}</div>
                        <div style="font-weight: bold; font-size: 16px; margin-top: 5px;">${item?.active_currency?.icon || ''} ${item.product_info.product_price * item.quantity}</div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mt-2 mt-md-0">
                    <div class="d-flex align-items-center justify-content-between justify-content-md-end">
                        <div class="d-flex align-items-center">
                            <button class="qty-btn-minus btn btn-light change_qty_cart_item" data-cart_item_id="${item.id}" style="width: 30px; height: 30px; font-size: 16px; padding: 0;">-</button>
                            <input type="text" name="qty" value="${item.quantity}" class="input-qty text-center mx-2" style="width: 40px; height: 30px; border: 1px solid #ddd; border-radius: 5px;">
                            <button class="qty-btn-plus btn btn-light change_qty_cart_item" data-cart_item_id="${item.id}" style="width: 30px; height: 30px; font-size: 16px; padding: 0;">+</button>
                        </div>
                        <button class="remove_from_cart btn btn-danger" data-cart_item_id="${item.id}">Remove</button>
                    </div>
                </div>
            </div>
        </div>
        `;

        // Replace the specific cart item block
        const $existingRow = $(`.cart_list_${item.id}`);
        if ($existingRow.length) {
            $existingRow.replaceWith(htmlContent);
        } else {
            $('#table_body').append(htmlContent); // or prepend depending on your design
        }

        // Update the quantity and price inside cart-product-info span
        $(`.card_product_qty_${item.id}`).text(item.quantity);
        $(`.product_price_${item.id}`).text(item.product_info.product_price);
    });

    // Update the drawer totals
    $('.cart_total_price').text(total.toFixed(2));
    $('.shipping_charge_amount').text(total_shipping_charge.toFixed(2));
    $('.coupon_discount').text(coupon_discount.toFixed(2));
    $('.grand_total').text((total + total_shipping_charge - coupon_discount).toFixed(2));

    // Update the cart count
    updateCartCount();

    // Handle "select all" checkbox
    if (data.length > 0 && checked_all_check_box === true) {
        $("#select_all_products").prop("checked", true);
    } else {
        $("#select_all_products").prop("checked", false);
        $('.proceed_to_checkout').addClass('disabled');
    }
}

function updateCartCount() {
    let totalQty = 0;

    // Loop through all cart items and sum up their quantities
    $('.input-qty').each(function() {
        totalQty += parseInt($(this).val()) || 0;
    });

    // Update the cart-count badge
    $('.cart-count').text(totalQty);
}

function updateCart(item) {
    $(".card_product_qty_" + item.id).text(item.quantity);
    $(".subtotal_price_" + item.id).html(`<span>${item?.active_currency.icon || ''}</span>
    <span>${item.quantity * item.product_info.product_price}</span>`);
}

$(document).ready(function () {

    function submitOrder(formData, selectedId = "") {

        saveAction(
            "store",
            "/order-place",
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

    $(document).on('click', '#btn_place_order', function () {
        const formData = {
            address_id: $('#default_address').data('address_id') ?? null,
            user_id: $("#temp_user_id").data('user_id') ?? null,
            payment_method: $('input[name="radio"]:checked').val() ?? null,
        };

        submitOrder(formData, '');
    });
    function calcaulateCartDetails(data) {
        let cartTotal = 0;
        let total_shipping_charge = 0;
        let total_item_qty = 0;
        data.forEach(item => {
            cartTotal += item.product_info.product_price * item.quantity;
            total_shipping_charge += parseFloat(item.shipping_charge);
            total_item_qty += parseInt(item.quantity);
        });

        $('.cart_total_price').text(cartTotal);
        $('.shipping_charge_amount').text(total_shipping_charge);
        $('.cart-count').text(total_item_qty);
        $('.grand_total').text(cartTotal + total_shipping_charge);
    }

    function calculateCartTotal() {
        const user_id = $("#temp_user_id").data('user_id');
        getDetails(
            "/api/checkout/cart/lists?user_id=" + user_id,
            (data) => {
                calcaulateCartDetails(data.results.data);
            },
            (error) => {

            }
        );
    }

    function getAllCartItem() {
        const user_id = $("#temp_user_id").data('user_id');

        getDetails(
            "/api/checkout/cart/lists?user_id=" + user_id,
            (data) => {
                showCartTableData(data.results.data);
            },
            (error) => {

            }
        );
    }

    // Call the function to fetch cart data
    getAllCartItem();

    // Detect if the page is loaded from the cache using the 'pageshow' event
    window.addEventListener('pageshow', function(event) {
        // Check if the page was loaded from cache (e.g., after back/forward navigation)
        if (event.persisted) {
            console.log('Page is loaded from cache!');
            
            // Fetch the latest cart data again if it's loaded from cache
            getAllCartItem();
        }
    });

    $(document).on('click', '.change_qty_cart_item', function () {
        const cart_item_id = $(this).data('cart_item_id');
        const inputQty = $(this).siblings('.input-qty');
        const quantity = parseInt(inputQty.val(), 10);

        const formData = {
            quantity: quantity,
        };

        submitAddItem(formData, cart_item_id);
    });

    function submitAddItem(formData, selectedId = "") {
        saveAction(
            "update",
            "/api/cart-update",
            formData,
            selectedId,
            (data) => {
                updateCart(data.results);
                calculateCartTotal();
            },
            (error) => {
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    }

    $(document).on('input', '.input-qty', function () {
        const cart_item_id = $(this).siblings('.qty-btn-minus').data('cart_item_id');
        const quantity = parseInt($(this).val(), 10);
        const formData = {
            quantity: quantity,
        };

        submitAddItem(formData, cart_item_id);
    });

    $(document).on('click', '.remove-from-cart', function () {
        const row_id = $(this).data('id');

        // Delete the company
        deleteAction(
            '/api/cart-remove/' + row_id,
            (data) => {
                $('.product.cart_' + row_id).remove();
                let cartCountElement = document.querySelector('.cart-count');
                let currentCount = parseInt(cartCountElement.textContent, 10);
                currentCount -= 1;
                cartCountElement.textContent = currentCount;
                calculateCartTotal();
                toastrSuccessMessage(data.message);
            },
            (error) => {
                // Error callback
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    });

    $(document).on('click', '.change_qty_cart_item', function () {
        const cartItemId = $(this).data('cart_item_id');
        const isPlus = $(this).hasClass('qty-btn-plus');
        const $qtyInput = $(this).siblings('input.input-qty');

        let currentQty = parseInt($qtyInput.val());
        if (isNaN(currentQty) || currentQty < 1) currentQty = 1;

        const newQty = isPlus ? currentQty + 1 : Math.max(1, currentQty - 1);
        $qtyInput.val(newQty); // Update the UI immediately

        // Call API with your custom saveAction
        updateCartQuantity(cartItemId, newQty);
    });

    function updateCartQuantity(cartItemId, quantity) {
        const formData = {
            quantity: quantity
        };

        saveAction(
            "update",
            `/cart-items`,
            formData,
            cartItemId,
            (data) => {
                // ✅ Successfully updated - Refresh the cart UI
                toastrSuccessMessage("Quantity updated successfully");

                // ✅ Refresh the cart UI using the returned data
                if (data?.results) {
                    showCartTableData(data.results);
                }
            },
            (error) => {
                toastrErrorMessage(error.responseJSON?.message || "Something went wrong.");
            }
        );
    }
});



