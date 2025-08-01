const CartActiveItemList = (() => {

    function render(data) {
        const container = document.getElementById('productBlockList');
        container.innerHTML = ''; // Clear previous content

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

            const productBlock = `
            <div class="d-flex align-items-start mb-3">
                <img src="${item.product_info.image_url}" alt="Product Image" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                <div class="ml-3">
                    <h6 class="mb-0 font-weight-bold">${item.product_info.name}</h6>
                    <small>Brand: ${item.product_info.brand_name}, ${variationInfo}</small>
                    <div class="d-flex align-items-center">
                        <span class="font-weight-bold text-dark mr-3">${item.product_info.product_price} Taka</span>
                        <div class="quantity-control">
                            <button class="btn btn-qty btn-decrease" type="button">−</button>
                            <input type="text" class="qty-input" value="${item.quantity}" readonly>
                            <button class="btn btn-qty btn-increase" type="button">+</button>
                        </div>
                    </div>
                </div>
            </div>
        `;

            $('.cart_total_price').text(total.toFixed(2));
            $('.shipping_charge_amount').text(total_shipping_charge.toFixed(2));
            $('.coupon_discount').text(coupon_discount.toFixed(2));
            $('.grand_total_price').text((total + total_shipping_charge - coupon_discount).toFixed(2));

            container.insertAdjacentHTML('beforeend', productBlock);
        });
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
