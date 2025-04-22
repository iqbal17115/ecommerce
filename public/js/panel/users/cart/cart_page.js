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
    let htmlContent = '';
    let total = 0;
    let total_shipping_charge = 0;
    let coupon_discount = 0;
    let cheked_all_check_box = true;
    data.forEach((item) => {
        $("#vendor_name").text(item.vendor_name);
        if (item.is_active == 1) {
            total += item.product_info.product_price * item.quantity;
            total_shipping_charge += parseFloat(item.shipping_charge);
            coupon_discount += item.coupon_discount;
        } else {
            cheked_all_check_box = false;
        }
        
     variationInfo = '';
    // Loop through item.variations using forEach
    item.variations.forEach(function(variation, index) {
        // Append each variation's name and value
        variationInfo += `${variation.attribute_name}: ${variation.attribute_value}`;
        
        // Add a comma separator except for the last item
        if (index < item.variations.length - 1) {
            variationInfo += ', ';
        }
    });

    htmlContent += `
  <div class="cart_${item.id} p-3 mb-2 bg-white rounded shadow-sm" style="border: 1px solid #f1f1f1;">
    <div class="row align-items-center">

      <!-- Checkbox -->
      <div class="col-1 d-flex align-items-start pt-2">
        <input type="checkbox" class="item-checkbox" data-cart_item_id="${item.id}">
      </div>

      <!-- Product Info -->
      <div class="col-10 col-md-7 d-flex">
        <img src="${item.product_info.image_url}" alt="Product Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px; margin-right: 15px;">
        <div>
          <div style="font-weight: 600; font-size: 16px;">${item.product_info.name}</div>
          <div style="color: #6c757d; font-size: 13px;">${item.brand_name || 'No Brand'}, ${variationInfo}</div>
          <div style="font-weight: bold; font-size: 16px; margin-top: 5px;">${item?.active_currency.icon || ''} ${item.product_info.product_price}</div>
        </div>
      </div>

      <!-- Quantity and Remove -->
      <div class="col-12 col-md-4 mt-2 mt-md-0">
        <div class="d-flex align-items-center justify-content-between justify-content-md-end">
          <div class="d-flex align-items-center">
            <button class="qty-btn-minus btn btn-light change_qty_cart_item" data-cart_item_id="${item.id}" style="width: 30px; height: 30px; font-size: 16px; padding: 0;">-</button>
            <input type="text" name="qty" value="${item.quantity}" class="input-qty text-center mx-2" style="width: 40px; height: 30px; border: 1px solid #ddd; border-radius: 5px;">
            <button class="qty-btn-plus btn btn-light change_qty_cart_item" data-cart_item_id="${item.id}" style="width: 30px; height: 30px; font-size: 16px; padding: 0;">+</button>
          </div>
          <button class="btn btn-link text-danger p-0 remove-cart-item ms-2" data-cart_item_id="${item.id}" title="Remove">
            <i class="fa fa-trash text-danger" style="font-size: 18px;"></i>
          </button>
        </div>
      </div>

    </div>
  </div>
`;
    });

    if (data.length > 0 && cheked_all_check_box == true) {
        $("#select_all_products").prop("checked", true);
    } else {
        $("#select_all_products").prop("checked", true);
        $('.proceed_to_checkout').addClass('disabled');
    }

    $('#table_body').html(htmlContent);
    $('.cart_total_price').text(total);
    $('.shipping_charge_amount').text(total_shipping_charge);
    $('.coupon_discount').text(coupon_discount);
    $('.grand_total').text(total + total_shipping_charge - coupon_discount);
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
            "/api/user-info?user_id=" + user_id,
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
    window.addEventListener('pageshow', function(event) {
        // Check if the page was loaded from cache (e.g., after back/forward navigation)
        if (event.persisted) {
            console.log('Page is loaded from cache!');
            
            // Fetch the latest cart data again if it's loaded from cache
            getCartItem();
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

    $('.update-cart').click(function () {
        // Implement the logic to update the cart
        // Send an AJAX PUT request to the cart API
    });

    $(document).on('click', '.remove-from-cart-list', function () {
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
