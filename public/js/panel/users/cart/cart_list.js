const CartList = (() => {
    function render(data) {
        const tableBody = document.getElementById('table_body');
        tableBody.innerHTML = '';

        let total = 0;
        let total_shipping_charge = 0;
        let coupon_discount = 0;

        data.forEach(item => {
            total += item.product_info.product_price * item.quantity;
            total_shipping_charge += parseFloat(item.shipping_charge);
            coupon_discount += item.coupon_discount;

            let variationInfo = '';
            if (item.variations && item.variations.length > 0) {
                variationInfo = item.variations.map(v => `${v.attribute_name}: ${v.attribute_value}`).join(', ');
            }

            tableBody.innerHTML += `
               <div class="cart_list_${item.id} p-3 mb-1 bg-white rounded shadow-sm" style="border: 1px solid #f1f1f1;">
            <div class="row align-items-center">
                <div class="col-1 d-flex align-items-start pt-2">
                    <input type="checkbox" class="item-checkbox" data-cart_item_id="${item.id}" ${item.is_active == 1 ? 'checked' : ''}>
                </div>
                <div class="col-10 col-md-7 d-flex">
                    <img src="${item.product_info.image_url}" alt="Product Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; margin-right: 15px;">
                    <div>
                        <div style="font-weight: 600; font-size: 16px;">${item.product_info.name}</div>
                        <div style="color: #6c757d; font-size: 13px;">${item.product_info.brand_name || 'No Brand'}, ${variationInfo}</div>
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
        });

        $('.cart_total_price').text(total.toFixed(2));
        $('.shipping_charge_amount').text(total_shipping_charge.toFixed(2));
        $('.coupon_discount').text(coupon_discount.toFixed(2));
        $('.grand_total').text((total + total_shipping_charge - coupon_discount).toFixed(2));
    }

    function initEvents() {
        $(document).on('click', '.qty-btn-minus, .qty-btn-plus', function () {
            const cartItemId = $(this).data('cart_item_id'); // FIXED here
            const $input = $(this).siblings('.input-qty');   // FIXED class name
            let currentQty = parseInt($input.val());
        
            if ($(this).hasClass('qty-btn-minus')) {
                currentQty = Math.max(1, currentQty - 1);
            } else {
                currentQty += 1;
            }
        
            CartManager.updateQuantity(cartItemId, currentQty);
        });
        
        $(document).on('change', '.input-qty', function () {
            const cartItemId = $(this).siblings('.qty-btn-minus').data('cart_item_id'); // or find from parent
            let newQty = parseInt($(this).val());
            if (!isNaN(newQty) && newQty > 0) {
                CartManager.updateQuantity(cartItemId, newQty);
            }
        });

        $(document).on('click', '.remove-cart-item', function () {
            const cartItemId = $(this).data('cart_item_id');
            CartManager.removeItem(cartItemId);
        });
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
                toastrSuccessMessage("Status updated successfully");
            },
            (error) => {
                toastrErrorMessage(error.responseJSON?.message || "Something went wrong.");
            }
        );
    });

    initEvents();

    return {
        render
    };
})();
