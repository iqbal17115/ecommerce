function setUserData(data) {
    console.log(data);
    var profileContent = `
    <div class="profile">
        <div class="img-box">
            <img src="${data.profile_photo}">
        </div>
        <div class="user">
            <div class="text-white p-0 m-0">Hello, ${data.name}</div>
            <div class="text-white font-weight-bold">Account & Lists</div>
        </div>
    </div>
    <div class="profile_menu">
        <ul class="m-4">
            <li><a href="/my-account" class="p-0 m-1">&nbsp;My Account</a></li>
            <li class="mt-1"><a href="/customer-logout" class="p-0 m-1">&nbsp;Sign Out</a></li>
        </ul>
    </div>
`;

    $("#user_profile_info").html(profileContent);
}

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
                <div class="col-1 d-flex align-items-start pt-2">
                    <input type="checkbox" class="item-checkbox" data-cart_item_id="${item.id}" ${item.is_active == 1 ? 'checked' : ''}>
                </div>
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
                        <button class="btn btn-link text-danger p-0 remove-cart-item ms-2" data-cart_item_id="${item.id}" title="Remove">
                            <i class="fa fa-trash text-danger" style="font-size: 15px;"></i>
                        </button>
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

// Function to update the cart count (sum of quantities)
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

    function getUserInfo() {
        const user_id = $("#temp_user_id").data('user_id');
        getDetails(
            "/user-info",
            (data) => {
                setUserData(data.results);
            },
            (error) => {

            }
        );
    }

    getUserInfo();

    function calcaulateCartDetails(data) {
        let cartTotal = 0;
        let total_shipping_charge = 0;
        let total_item_qty = 0;
        let coupon_discount = 0;
        data.forEach(item => {
            if (item.is_active == 1) {
                cartTotal += item.product_info.product_price * item.quantity;
                total_shipping_charge += parseFloat(item.shipping_charge);
                coupon_discount += parseFloat(item.coupon_discount);
            }
            total_item_qty += parseInt(item.quantity);
        });

        $('.cart_total_price').text(cartTotal);
        $('.shipping_charge_amount').text(total_shipping_charge);
        $('.cart-count').text(total_item_qty);
        $('.coupon_discount').text(coupon_discount);
        $('.grand_total').text(cartTotal + total_shipping_charge - coupon_discount);
    }

    function calculateCartTotal() {
        const user_id = $("#temp_user_id").data('user_id');
        getDetails(
            "/api/cart/lists?user_id=" + user_id,
            (data) => {
                calcaulateCartDetails(data.results.data);
            },
            (error) => {

            }
        );
    }

    // Function to handle form submission
    function submitForm(formData, selectedId = "") {
        saveAction(
            "store",
            "/api/coupon-apply",
            formData,
            selectedId,
            (data) => {
                calculateCartTotal();
                $('#apply_coupon')[0].reset();
                if (data.message == "Coupon applied successfully") {
                    toastrSuccessMessage(data.message);
                } else {
                    toastrErrorMessage(data.message);
                }
            },
            (error) => {

            }
        );
    }

    $("#apply_coupon").submit(function (event) {
        event.preventDefault();

        const formData = {
            user_id: $("#temp_user_id").data('user_id'),
            coupon_code: $("#coupon_code").val()
        };

        submitForm(formData, '');
    });

    function getCartItem() {
        const user_id = $("#temp_user_id").data('user_id');
        getDetails(
            "/api/cart/lists?user_id=" + user_id,
            (data) => {
                showCartTableData(data.results.data);
            },
            (error) => {

            }
        );
    }

    getCartItem();

    // Detect if the page is loaded from the cache using the 'pageshow' event
    window.addEventListener('pageshow', function (event) {
        // Check if the page was loaded from cache (e.g., after back/forward navigation)
        if (event.persisted) {
            console.log('Page is loaded from cache!');

            // Fetch the latest cart data again if it's loaded from cache
            getCartItem();
        }
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

    $(document).on('change', '.item-checkbox', function () {
        const cartItemId = $(this).data('cart_item_id');
        const isActive = $(this).is(':checked') ? 1 : 0;

        const formData = {
            cartItemId: cartItemId,
            isActive: isActive
        };
    
        saveAction(
            "update",
            `/cart-item-toggle-active`,
            formData,
            cartItemId,
            (data) => {
                // Optionally refresh cart data or update 
                toastrSuccessMessage("Status updated successfully");
            },
            (error) => {
                toastrErrorMessage(error.responseJSON?.message || "Something went wrong.");
            }
        );
    });
    
});

