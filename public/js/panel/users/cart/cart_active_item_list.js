const CartActiveItemList = (() => {

    function render(data) {
        const container = document.getElementById('productBlockList');
        container.innerHTML = ''; // Clear previous content

        let total = 0;
        let total_shipping_charge = data?.shipping_charge || 0;
        let coupon_discount = 0;
        let total_item_qty = 0;

        data?.cart?.data?.forEach(item => {
            total += item.product_info.product_price * item.quantity;
            coupon_discount += item.coupon_discount;
            total_item_qty += parseInt(item.quantity);

            let variationInfo = '';
            if (item.variations && item.variations.length > 0) {
                variationInfo = item.variations
                    .filter(v => v.attribute_name && v.attribute_value) // ignore null/empty
                    .map(v => `${v.attribute_name}: ${v.attribute_value}`)
                    .join(', ');
            }

            // build brand + variation line only if values exist
            let extraInfo = '';
            if ((item.product_info.brand_name && item.product_info.brand_name !== 'null') || variationInfo) {
                let parts = [];
                if (item.product_info.brand_name && item.product_info.brand_name !== 'null') {
                    parts.push(`Brand: ${item.product_info.brand_name}`);
                }
                if (variationInfo) parts.push(variationInfo);

                extraInfo = `<small>${parts.join(', ')}</small>`;
            }

            const productBlock = `
            <div class="d-flex align-items-start mb-3  cart_list_${item.id}">
                <img src="${item.product_info.image_url}" alt="Product Image" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                <div class="ml-3">
                    <h6 class="mb-0 font-weight-bold">${item.product_info.name}</h6>
                    ${extraInfo}
                    <div class="d-flex align-items-center">
                        <span class="font-weight-bold text-dark mr-3">${item.product_info.product_price} Taka</span>
                        <div class="quantity-control">
                            <button class="btn btn-qty btn-decrease qty-btn-minus" type="button" data-cart_item_id="${item.id}">−</button>
                            <input type="text" class="qty-input input-qty" value="${item.quantity}" data-cart_item_id="${item.id}" readonly>
                            <button class="btn btn-qty btn-increase qty-btn-plus" type="button" data-cart_item_id="${item.id}">+</button>
                        </div>
                        <button class="btn btn-link text-danger p-0 remove-cart-item ms-auto" 
                                data-cart_item_id="${item.id}" title="Remove">
                            <i class="fa fa-trash text-danger" style="font-size: 15px;"></i>
                        </button>
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

        // Update total item count
        // Update total item count
        $('.total_item_count').text(total_item_qty);

        // Change "Item" vs "Items"
        if (total_item_qty === 1) {
            $('.item_label').text('Item');
        } else {
            $('.item_label').text('Items');
        }
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

     $(document).on('click', '.remove-cart-item', function () {
            const cartItemId = $(this).data('cart_item_id');

            CartManager.removeItem(cartItemId);
        });

    initEvents();

    return {
        render
    };
})();
