function showCartTableData(data) {
    let htmlContent = '';
    let total = 0;
    let total_item_qty = 0;
    let total_shipping_charge = 0;
    let cheked_all_check_box = true;

    data.forEach((item) => {
        total += item.product_info.product_price * item.quantity;
        total_item_qty += item.quantity;
        total_shipping_charge += parseFloat(item.shipping_charge);

        htmlContent += `
    <tr class="product-row product_row product cart_${item.id}" data-id="${item.id}" style="box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.1);">
      <td style="padding: 8px; text-align: center;">
        <figure class="product-image-container" style="position: relative; display: flex; justify-content: center; align-items: center;">
          <a href="javascript:void(0);" class="product-image">
            <img src="${item.product_info.image_url}" style="width: 80px; height: 80px; object-fit: contain; border-radius: 5px;" alt="product">
          </a>
          <!-- Remove button positioned at the top-right corner -->
          <a href="javascript:void(0);" class="btn-remove remove-from-cart icon-cancel" data-id="${item.id}" title="Remove Product" style="position: absolute; top: 5px; right: 5px;"></a>
        </figure>
      </td>
      <td class="product-col" style="padding: 8px; display: flex; align-items: center;">
        <h5 class="product-title" style="font-size: 16px; font-weight: bold; margin-left: 10px;">
          <a style="text-decoration: none; color: #333;" href="javascript:void(0);">${item.product_info.name}</a>
        </h5>
      </td>
      <td style="padding: 8px; text-align: center; vertical-align: middle;">
        <div class="mb-3">
          <div class="qty-container" style="display: flex; justify-content: center; align-items: center; flex-direction: row;">
            <button class="qty-btn-minus btn-light change_qty_cart_item" data-cart_item_id="${item.id}" type="button" style="background-color: #f1f1f1; border: 1px solid #ccc; padding: 5px 10px; cursor: pointer;">
              <i class="fa fa-minus" style="font-size: 14px;"></i>
            </button>
            <input type="text" name="qty" value="${item.quantity}" class="input-qty" style="width: 40px; text-align: center; border: 1px solid #ccc; padding: 5px; margin: 0 5px;">
            <button class="qty-btn-plus btn-light change_qty_cart_item" data-cart_item_id="${item.id}" type="button" style="background-color: #f1f1f1; border: 1px solid #ccc; padding: 5px 10px; cursor: pointer;">
              <i class="fa fa-plus" style="font-size: 14px;"></i>
            </button>
          </div>
        </div>
      </td>
      <td class="text-right" style="padding: 8px; text-align: center; font-size: 16px;">
        <span class="subtotal-price subtotal_price_${item.id}">
          <span>${item?.active_currency.icon || ''}</span>
          <span>${item.quantity * item.product_info.product_price}</span>
        </span>
      </td>
    </tr>
  `;
    });

    if (cheked_all_check_box == true) {
        $("#select_all_products").prop("checked", true);
    }
    
    $('#table_body').html(htmlContent);
    $('.cart_total_price').text(total);
    $('.shipping_charge_amount').text(total_shipping_charge);
    $('.grand_total').text(total + total_shipping_charge);

    // Update the Subtotal text with the correct number of items and the total
    var itemText = total_item_qty <= 1 ? 'Item' : 'Items';  // Singular or plural based on count
    $('.cart-total-text').text('Subtotal(' + total_item_qty + ' ' + itemText + ')');

    // Responsive Design Adjustments
    const style = document.createElement('style');
    style.innerHTML = `
        @media (max-width: 768px) {
            .product-row td {
                display: block;
                width: 100%;
                text-align: left;
                padding: 10px;
            }

            .qty-container {
                flex-direction: row;
                justify-content: flex-start;
                align-items: center;
            }

            .qty-btn-minus, .qty-btn-plus {
                padding: 8px;
                margin: 0 5px;
            }

            .product-title {
                font-size: 16px;
            }

            .product-image img {
                width: 80px;
                height: 80px;
            }

            .brand_text_design {
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .product-title {
                font-size: 14px;
            }

            .product-image img {
                width: 60px;
                height: 60px;
            }

            .qty-container {
                flex-direction: row;
                justify-content: flex-start;
                align-items: center;
                margin-bottom: 10px;
            }

            .qty-btn-minus, .qty-btn-plus {
                padding: 8px;
            }

            .input-qty {
                width: 40px;
                text-align: center;
                padding: 5px;
            }

            .subtotal-price {
                font-size: 14px;
            }
        }
    `;
    document.head.appendChild(style);
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

});

var buttonPlus = $(".qty-btn-plus");
var buttonMinus = $(".qty-btn-minus");

$("body").on("click", ".qty-btn-plus", function () {
    var $n = $(this)
        .parent(".qty-container")
        .find(".input-qty");
    $n.val(Number($n.val()) + 1);
});

$("body").on("click", ".qty-btn-minus", function () {
    var $n = $(this)
        .parent(".qty-container")
        .find(".input-qty");
    var amount = Number($n.val());
    if (amount > 1) {
        $n.val(amount - 1);
    }
});

