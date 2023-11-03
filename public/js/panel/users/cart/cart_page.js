function showCartTableData(data) {
    let htmlContent = '';
    let total = 0;
    let total_shipping_charge = 0;
    let cheked_all_check_box = true;
    data.forEach((item) => {
        if (item.is_active == 1) {
            total += item.product_info.product_price * item.quantity;
            total_shipping_charge += parseFloat(item.shipping_charge);
        } else {
            cheked_all_check_box = false;
        }
        htmlContent += `
    <tr class="product-row product_row shadow product cart_${item.id}" data-id="${item.id}">
      <td class="checkbox-col">
        <input type="checkbox" class="product-checkbox"
          data-cart_item_id="${item.id}"
          data-product-status="1" ${item.is_active == 1 ? 'checked' : ''}>
      </td>
      <td>
        <figure class="product-image-container">
          <a href="javascript:void(0);" class="product-image">
            <img src="${item.product_info.image_url}" style="width:100px; height: 40px;" alt="product">
          </a>
          <a href="javascript:void(0);" class="btn-remove remove-from-cart icon-cancel" data-id="${item.id}" title="Remove Product"></a>
        </figure>
      </td>
      <td class="product-col">
        <h5 class="product-title">
          <a style="text-decoration: none;">${item.product_info.name}</a>
        </h5>
      </td>
      <td class="mx-2">${item.currency?.icon || ''}${item.product_info.product_price}</td>
      <td>
      <div class="mb-3">
      <div class="qty-container">
          <button class="qty-btn-minus btn-light change_qty_cart_item" data-cart_item_id="${item.id}" type="button"><i class="fa fa-minus"></i></button>
          <input type="text" name="qty" value="${item.quantity}" class="input-qty"/>
          <button class="qty-btn-plus btn-light change_qty_cart_item" data-cart_item_id="${item.id}" type="button"><i class="fa fa-plus"></i></button>
      </div>
  </div>
      </td>
      <td class="text-right">
        <span class="subtotal-price subtotal_price_${item.id}">${item.quantity * item.product_info.product_price}</span>
      </td>
    </tr>
  `;
    });

    if(cheked_all_check_box == true) {
        $("#select_all_products").prop("checked", true);
    }
    $('#table_body').html(htmlContent);
    $('.cart_total_price').text(total);
    $('.shipping_charge_amount').text(total_shipping_charge);
    $('.grand_total').text(total + total_shipping_charge);

}

function updateCart(item) {
    $(".card_product_qty_" + item.id).text(item.quantity);
    $(".subtotal_price_" + item.id).text(item.quantity * item.product_info.product_price);
}

function showHeaderCartData(data) {
    let total = 0;
    let total_item_qty = 0;
    const cartContainer = document.getElementById('cart_container');
    if (data.length > 0) {
        data.forEach(item => {
            const totalItemPrice = item.product_info.product_price * item.quantity;
            total += totalItemPrice;
            total_item_qty += parseInt(item.quantity);

            const productDiv = document.createElement('div');
            productDiv.className = `product cart_${item.id}`;
            productDiv.setAttribute('data-id', item.id);

            const productDetailsDiv = document.createElement('div');
            productDetailsDiv.className = 'product-details';

            const productTitle = document.createElement('h4');
            productTitle.className = 'product-title';
            productTitle.innerHTML = `<a href="#">${item.product_info.name}</a>`;

            const cartProductInfo = document.createElement('span');
            cartProductInfo.className = 'cart-product-info';
            cartProductInfo.innerHTML = `<span class="cart-product-qty card_product_qty_${item.id}">${item.quantity}</span> × ${item.product_info.product_price}`;

            productDetailsDiv.appendChild(productTitle);
            productDetailsDiv.appendChild(cartProductInfo);

            const productImageContainer = document.createElement('figure');
            productImageContainer.className = 'product-image-container';

            const productImage = document.createElement('a');
            productImage.className = 'product-image lazy-load';
            productImage.href = '';
            productImage.innerHTML = `<img src="${item.product_info.image_url}" alt="product" width="80" height="80">`;

            const removeButton = document.createElement('a');
            removeButton.className = 'btn-remove';
            removeButton.href = 'javascript:void(0);';
            removeButton.title = 'Remove Product';
            removeButton.innerHTML = `<span class="remove-from-cart" data-id="${item.id}">×</span>`;
            productImageContainer.appendChild(productImage);
            productImageContainer.appendChild(removeButton);

            productDiv.appendChild(productDetailsDiv);
            productDiv.appendChild(productImageContainer);

            cartContainer.appendChild(productDiv);
        });
    }

    $('.cart-count').text(total_item_qty);
}

$(document).ready(function () {

    function calcaulateCartDetails(data) {
        let cartTotal = 0;
        let total_shipping_charge = 0;
        let total_item_qty = 0;
        data.forEach(item => {
            if (item.is_active == 1) {
                cartTotal += item.product_info.product_price * item.quantity;
                total_shipping_charge += parseFloat(item.shipping_charge);
            }
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
            "/api/cart/lists?user_id=" + user_id,
            (data) => {
                calcaulateCartDetails(data.results.data);
            },
            (error) => {

            }
        );
    }

    function getCartItem() {
        const user_id = $("#temp_user_id").data('user_id');
        getDetails(
            "/api/cart/lists?user_id=" + user_id,
            (data) => {
                showCartTableData(data.results.data);
                showHeaderCartData(data.results.data);
            },
            (error) => {

            }
        );
    }
    getCartItem();
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

    $('.update-cart').click(function () {
        // Implement the logic to update the cart
        // Send an AJAX PUT request to the cart API
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
                toastrSuccessMessage(data.message);
            },
            (error) => {
                // Error callback
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    });

    function submitAllCartItemStatus(formData, selectedId = "") {
        saveAction(
            "store",
            "/api/all-cart-status-update",
            formData,
            selectedId,
            (data) => {
                $(".product-checkbox").prop("checked", formData.is_checked);
                calculateCartTotal();
            },
            (error) => {
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    }

    // Handle the "select_all_products" checkbox change event
    $("#select_all_products").on("change", function () {
        var is_checked = $(this).prop("checked");
        var user_id = $("#temp_user_id").data('user_id');
        const formData = {
            user_id: user_id,
            is_checked: is_checked
        };

        submitAllCartItemStatus(formData, "");
    });

    function submitCartItemStatus(formData, selectedId = "") {
        saveAction(
            "update",
            "/api/cart-status-update",
            formData,
            selectedId,
            (data) => {
                calculateCartTotal();
            },
            (error) => {
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    }

    // Handle individual product checkbox change event
    $(document).on("change", ".product-checkbox", function () {
        var allChecked = $(".product-checkbox:checked").length === $(".product-checkbox").length;
        var is_checked = $(this).prop("checked");
        var cart_item_id = $(this).data('cart_item_id');
        const formData = {
            is_checked: is_checked
        };
        submitCartItemStatus(formData, cart_item_id);
        $("#select_all_products").prop("checked", allChecked);
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