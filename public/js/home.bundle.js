/******/ (() => { // webpackBootstrap
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!********************************************!*\
  !*** ./resources/js/panel/users/common.js ***!
  \********************************************/
function setUserData(data) {
  var profileContent = "\n    <div class=\"profile\">\n        <div class=\"img-box\">\n            <img class=\"lazy-load\" data-src=\"".concat(data.profile_photo, "\" id=\"user_profile_img\">\n        </div>\n        <div class=\"user\">\n            <div class=\"text-white p-0 m-0\">Hello, ").concat(data.name, "</div>\n            <div class=\"text-white font-weight-bold\">Account & Lists</div>\n        </div>\n    </div>\n    <div class=\"profile_menu\">\n        <ul class=\"m-4\">\n            <li><a href=\"/my-account\" class=\"p-0 m-1\">&nbsp;My Account</a></li>\n            <li class=\"mt-1\"><a href=\"/customer-logout\" class=\"p-0 m-1\">&nbsp;Sign Out</a></li>\n        </ul>\n    </div>\n");
  $("#user_profile_info").html(profileContent);
}
$(document).ready(function () {
  function getUserInfo() {
    getDetails("/user-info", function (data) {
      if (data.results != null) {
        setUserData(data.results);
      }
    }, function (error) {});
  }
  getUserInfo();
  function getWishlist() {
    var user_id = $("#temp_user_id").data('user_id');
    getDetails("/api/wishlist-count?user_id=" + user_id, function (data) {
      $('.wishlist-count').text(data.results);
    }, function (error) {});
  }
  getWishlist();
});
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!******************************************************!*\
  !*** ./resources/js/panel/users/cart/add_to_cart.js ***!
  \******************************************************/
document.addEventListener('DOMContentLoaded', function () {
  var variationInput = document.getElementById('selected_variation_id');

  /**
   * Display error message via Toastr (fallback-safe)
   */
  var showError = function showError(message) {
    if (typeof toastrErrorMessage === 'function') {
      toastrErrorMessage(message);
    } else if (typeof toastr !== 'undefined') {
      toastr.error(message);
    } else {
      alert(message);
    }
  };

  /**
   * Handles cart actions (add to cart or buy now)
   * @param {HTMLElement} button
   * @param {boolean} isBuyNow
   */
  var handleCartAction = function handleCartAction(button) {
    var _document$getElementB, _document$getElementB2;
    var isBuyNow = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
    var productId = button.dataset.product_id;
    var hasVariation = button.dataset.has_variation === '1';
    var detailsUrl = button.dataset.details_url || null;
    var variationInput = document.getElementById('selected_variation_id');
    var currentProductQuantity = ((_document$getElementB = document.getElementById('current_product_quantity')) === null || _document$getElementB === void 0 ? void 0 : _document$getElementB.value) || 1;
    var isTotalItemQty = false;
    var isOnDetailsPage = !!variationInput;
    var productVariationId = (variationInput === null || variationInput === void 0 ? void 0 : variationInput.value) || null;
    if ((_document$getElementB2 = document.getElementById('current_product_quantity')) !== null && _document$getElementB2 !== void 0 && _document$getElementB2.value) {
      isTotalItemQty = true;
    }

    // If variation is required but not selected
    if (variationInput !== null && variationInput !== void 0 && variationInput.hasAttribute('required') && !productVariationId) {
      showError('Please select a product variation before proceeding.');
      return;
    }

    // If variation is required but not selected
    if (hasVariation && !isOnDetailsPage) {
      if (detailsUrl) {
        window.location.href = detailsUrl;
      } else {
        showError('Product has variations. Please select options from the product page.');
      }
      return;
    }
    CartManager.addItem(productId, currentProductQuantity, isBuyNow ? 1 : 0, productVariationId, isTotalItemQty);
  };

  // Add to Cart buttons
  document.addEventListener('click', function (e) {
    if (e.target.closest('.add_cart_item')) {
      var button = e.target.closest('.add_cart_item');
      handleCartAction(button, false);
    }
  });

  // Buy Now buttons
  document.addEventListener('click', function (e) {
    if (e.target.closest('.buy_now_with_quantity')) {
      var button = e.target.closest('.buy_now_with_quantity');
      handleCartAction(button, true);
    }
  });
});
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!*******************************************************!*\
  !*** ./resources/js/panel/users/cart/cart_manager.js ***!
  \*******************************************************/
var CartManager = function () {
  var cartData = [];
  function loadCartData() {
    var forceReload = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
    if (cartData.length > 0 && !forceReload) {
      renderAll();
      return;
    }
    getDetails('/cart/lists', function (data) {
      cartData = data.results.cart.data;
      renderAll();
    }, function (error) {
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
      var divisionId = $('#division').val() || null;
      var districtId = $('#district').val() || null;
      var upazilaId = $('#thana').val() || null;
      getDetails("/checkout/cart/lists?division_id=".concat(divisionId, "&district_id=").concat(districtId, "&upazila_id=").concat(upazilaId), function (data) {
        cartData = data.results;
        CartActiveItemList.render(cartData);
      }, function (error) {
        console.error("Failed to load cart data:", error);
      });
    }
    updateCartCount();
  }
  function addItem(productId) {
    var quantity = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
    var isBuyNow = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 0;
    var productVariationId = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
    var isTotalItemQty = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : false;
    saveAction("store", "/cart-items/store", {
      product_id: productId,
      quantity: quantity,
      is_buy_now: isBuyNow,
      product_variation_id: productVariationId,
      is_total_item_qty: isTotalItemQty
    }, "", function (data) {
      toastrSuccessMessage(data.message);
      loadCartData(true);

      // Redirect to checkout if Buy Now
      if (isBuyNow && data.redirect) {
        window.location.href = data.redirect;
      }
    }, function (error) {
      var response = JSON.parse(error.responseText);
      toastrErrorMessage(response.message);
    });
  }
  function removeItem(cartItemId) {
    deleteAction("/cart-items/".concat(cartItemId), function (data) {
      toastrSuccessMessage(data.message);
      loadCartData(true);
    }, function (error) {
      var _error$responseJSON$m, _error$responseJSON;
      toastrErrorMessage((_error$responseJSON$m = error === null || error === void 0 || (_error$responseJSON = error.responseJSON) === null || _error$responseJSON === void 0 ? void 0 : _error$responseJSON.message) !== null && _error$responseJSON$m !== void 0 ? _error$responseJSON$m : "Remove failed");
    });
  }
  function updateQuantity(cartItemId, quantity) {
    if (quantity <= 0) return;
    saveAction("update", '/cart-items', {
      quantity: quantity
    }, cartItemId, function (data) {
      toastrSuccessMessage(data.message);
      loadCartData(true);
    }, function (error) {
      var _error$responseJSON$m2, _error$responseJSON2;
      toastrErrorMessage((_error$responseJSON$m2 = error === null || error === void 0 || (_error$responseJSON2 = error.responseJSON) === null || _error$responseJSON2 === void 0 ? void 0 : _error$responseJSON2.message) !== null && _error$responseJSON$m2 !== void 0 ? _error$responseJSON$m2 : "Update failed");
    });
  }
  function updateCartCount() {
    var totalQty = cartData.reduce(function (sum, item) {
      return sum + parseInt(item.quantity);
    }, 0);
    document.querySelectorAll('.cart-count').forEach(function (el) {
      el.textContent = totalQty;
    });
  }
  return {
    loadCartData: loadCartData,
    addItem: addItem,
    removeItem: removeItem,
    updateQuantity: updateQuantity
  };
}();
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!******************************************************!*\
  !*** ./resources/js/panel/users/cart/cart_drawer.js ***!
  \******************************************************/
var CartDrawer = function () {
  var cartContainerId = 'cart_container';
  var cartCountClass = 'cart-count';
  var isLoaded = false;
  function load() {
    var forceReload = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
    if (isLoaded && !forceReload) return;
    getDetails('/cart-drawer/list', function (data) {
      renderCart(data.results);
      isLoaded = true;
    }, function (error) {
      console.error("Error fetching cart drawer:", error);
    });
  }
  function renderCart(data) {
    var totalQty = 0;
    var cartContainer = document.getElementById(cartContainerId);
    cartContainer.innerHTML = '';
    if (!data.length) {
      cartContainer.innerHTML = '<p>Your cart is empty.</p>';
      updateCartCount(0);
      return;
    }
    data.forEach(function (item) {
      var _item$product_info, _item$product_info2, _item$product_info3;
      totalQty += parseInt(item.quantity);
      var productDiv = document.createElement('div');
      productDiv.className = "product cart_".concat(item.id);
      productDiv.dataset.id = item.id;
      var productDetailsDiv = document.createElement('div');
      productDetailsDiv.className = 'product-details';
      productDetailsDiv.innerHTML = "\n                <h4 class=\"product-title\">\n                    <a href=\"#\">".concat(item === null || item === void 0 || (_item$product_info = item.product_info) === null || _item$product_info === void 0 ? void 0 : _item$product_info.name, "</a>\n                </h4>\n                <span class=\"cart-product-info\">\n                    <span class=\"cart-product-qty card_product_qty_").concat(item.id, "\">").concat(item.quantity, "</span> \xD7  \n                    <span class=\"brand_text_design\">").concat(item.active_currency, "</span>\n                    <span class=\"brand_text_design product_price_").concat(item.id, "\">").concat(item === null || item === void 0 || (_item$product_info2 = item.product_info) === null || _item$product_info2 === void 0 ? void 0 : _item$product_info2.product_price, "</span>\n                </span>\n            ");
      var productImageContainer = document.createElement('figure');
      productImageContainer.className = 'product-image-container';
      productImageContainer.innerHTML = "\n                <a href=\"#\" class=\"product-image\">\n                    <img src=\"".concat(item === null || item === void 0 || (_item$product_info3 = item.product_info) === null || _item$product_info3 === void 0 ? void 0 : _item$product_info3.image_url, "\" alt=\"product\" width=\"80\" height=\"80\">\n                </a>\n                <a href=\"javascript:void(0);\" class=\"btn-remove\" title=\"Remove Product\">\n                    <span class=\"remove-from-cart\" data-id=\"").concat(item.id, "\">\xD7</span>\n                </a>\n            ");
      productDiv.appendChild(productDetailsDiv);
      productDiv.appendChild(productImageContainer);
      cartContainer.appendChild(productDiv);
    });
    updateCartCount(totalQty);
  }
  function updateCartCount(count) {
    document.querySelectorAll(".".concat(cartCountClass)).forEach(function (el) {
      el.textContent = count;
    });
  }
  function removeCartItem(cartItemId) {
    deleteAction("/cart-items/".concat(cartItemId), function (data) {
      toastrSuccessMessage(data.message);
      load(true); // Reload cart UI
      loadCartCount(); // Update global cart count

      // Remove the 'added-to-cart' class from the corresponding button
      if (data.results.product_id) {
        var button = document.querySelector(".add_cart_item[data-product_id='".concat(data.results.product_id, "']"));
        if (button) {
          button.classList.remove("added-to-cart");
        }
      }

      // Remove from DOM if container exists
      var cartItemDiv = document.querySelector(".cart_list_".concat(cartItemId));
      if (cartItemDiv) {
        cartItemDiv.remove();
      }
    }, function (error) {
      toastrErrorMessage(error.responseJSON.message);
    });
  }
  function loadCartCount() {
    getDetails('/cart-drawer/count', function (data) {
      var _data$results$totalQt;
      var count = (_data$results$totalQt = data.results.totalQty) !== null && _data$results$totalQt !== void 0 ? _data$results$totalQt : 0;
      updateCartCount(count);
    }, function (error) {
      console.error('Error loading cart count:', error);
    });
  }
  function handleQuantityChange(cartItemId, newQty) {
    if (newQty <= 0) return;
    updateAction("/cart-items/".concat(cartItemId), {
      quantity: newQty
    }, function (data) {
      toastrSuccessMessage(data.message);
      load(true); // reload cart drawer
      loadCartCount(); // update badge
    }, function (error) {
      var _error$responseJSON$m, _error$responseJSON;
      toastrErrorMessage((_error$responseJSON$m = error === null || error === void 0 || (_error$responseJSON = error.responseJSON) === null || _error$responseJSON === void 0 ? void 0 : _error$responseJSON.message) !== null && _error$responseJSON$m !== void 0 ? _error$responseJSON$m : 'Update failed');
    });
  }
  function initEvents() {
    document.addEventListener('click', function (e) {
      if (e.target.classList.contains('remove-from-cart')) {
        var cartItemId = e.target.dataset.id;
        removeCartItem(cartItemId);
      }

      // Quantity increase/decrease buttons
      if (e.target.classList.contains('qty-update-btn')) {
        var _cartItemId = e.target.dataset.id;
        var newQty = parseInt(e.target.dataset.qty);
        handleQuantityChange(_cartItemId, newQty);
      }
    });

    // Manual input (blur event for direct changes)
    document.addEventListener('change', function (e) {
      if (e.target.classList.contains('manual-qty-input')) {
        var cartItemId = e.target.dataset.id;
        var newQty = parseInt(e.target.value);
        if (!isNaN(newQty)) {
          handleQuantityChange(cartItemId, newQty);
        }
      }
    });
  }
  initEvents();
  return {
    load: load,
    loadCartCount: loadCartCount
  };
}();
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!****************************************************!*\
  !*** ./resources/js/panel/users/cart/cart_list.js ***!
  \****************************************************/
var CartList = function () {
  function render(data) {
    var tableBody = document.getElementById('table_body');
    tableBody.innerHTML = '';
    var total = 0;
    var total_shipping_charge = 0;
    var coupon_discount = 0;
    data.forEach(function (item) {
      var _item$active_currency;
      if (item.is_active == 1) {
        total += item.product_info.product_price * item.quantity;
        total_shipping_charge += parseFloat(item.shipping_charge);
        coupon_discount += item.coupon_discount;
      }
      var variationInfo = '';
      if (item.variations && item.variations.length > 0) {
        variationInfo = item.variations.map(function (v) {
          return "".concat(v.attribute_name, ": ").concat(v.attribute_value);
        }).join(', ');
      }
      tableBody.innerHTML += "\n               <div class=\"cart_list_".concat(item.id, " p-3 mb-1 bg-white rounded shadow-sm\" style=\"border: 1px solid #f1f1f1;\">\n            <div class=\"row align-items-center\">\n                <div class=\"col-1 d-flex align-items-start pt-2\">\n                    <input type=\"checkbox\" class=\"item-checkbox\" data-cart_item_id=\"").concat(item.id, "\" ").concat(item.is_active == 1 ? 'checked' : '', ">\n                </div>\n                <div class=\"col-10 col-md-7 d-flex\">\n                    <img src=\"").concat(item.product_info.image_url, "\" alt=\"Product Image\" style=\"width: 80px; height: 80px; object-fit: cover; border-radius: 5px; margin-right: 15px;\">\n                    <div>\n                        <div style=\"font-weight: 600; font-size: 16px;\">").concat(item.product_info.name, "</div>\n                        <div style=\"color: #6c757d; font-size: 13px;\">").concat(item.product_info.brand_name || 'No Brand', ", ").concat(variationInfo, "</div>\n                        <div style=\"font-weight: bold; font-size: 16px; margin-top: 5px;\">").concat((item === null || item === void 0 || (_item$active_currency = item.active_currency) === null || _item$active_currency === void 0 ? void 0 : _item$active_currency.icon) || '', " ").concat(item.product_info.product_price * item.quantity, "</div>\n                    </div>\n                </div>\n                <div class=\"col-12 col-md-4 mt-2 mt-md-0\">\n                    <div class=\"d-flex align-items-center justify-content-between justify-content-md-end\">\n                        <div class=\"d-flex align-items-center\">\n                            <button class=\"qty-btn-minus btn btn-light change_qty_cart_item\" data-cart_item_id=\"").concat(item.id, "\" style=\"width: 30px; height: 30px; font-size: 16px; padding: 0;\">-</button>\n                            <input type=\"text\" name=\"qty\" value=\"").concat(item.quantity, "\" class=\"input-qty text-center mx-2\" style=\"width: 40px; height: 30px; border: 1px solid #ddd; border-radius: 5px;\">\n                            <button class=\"qty-btn-plus btn btn-light change_qty_cart_item\" data-cart_item_id=\"").concat(item.id, "\" style=\"width: 30px; height: 30px; font-size: 16px; padding: 0;\">+</button>\n                        </div>\n                        <button class=\"btn btn-link text-danger p-0 remove-cart-item ms-2\" data-cart_item_id=\"").concat(item.id, "\" title=\"Remove\">\n                            <i class=\"fa fa-trash text-danger\" style=\"font-size: 15px;\"></i>\n                        </button>\n                    </div>\n                </div>\n            </div>\n        </div>\n            ");
    });
    $('.cart_total_price').text(total.toFixed(2));
    $('.shipping_charge_amount').text(total_shipping_charge.toFixed(2));
    $('.coupon_discount').text(coupon_discount.toFixed(2));
    $('.grand_total').text((total + total_shipping_charge - coupon_discount).toFixed(2));
  }
  function initEvents() {
    $(document).on('click', '.qty-btn-minus, .qty-btn-plus', function () {
      var cartItemId = $(this).data('cart_item_id'); // FIXED here
      var $input = $(this).siblings('.input-qty'); // FIXED class name
      var currentQty = parseInt($input.val());
      if ($(this).hasClass('qty-btn-minus')) {
        currentQty = Math.max(1, currentQty - 1);
      } else {
        currentQty += 1;
      }
      CartManager.updateQuantity(cartItemId, currentQty);
    });
    $(document).on('change', '.input-qty', function () {
      var cartItemId = $(this).siblings('.qty-btn-minus').data('cart_item_id'); // or find from parent
      var newQty = parseInt($(this).val());
      if (!isNaN(newQty) && newQty > 0) {
        CartManager.updateQuantity(cartItemId, newQty);
      }
    });
    $(document).on('click', '.remove-cart-item', function () {
      var cartItemId = $(this).data('cart_item_id');
      CartManager.removeItem(cartItemId);
    });
  }
  $(document).on('change', '.item-checkbox', function () {
    var cartItemId = $(this).data('cart_item_id');
    var isActive = $(this).is(':checked') ? 1 : 0;
    var formData = {
      cartItemId: cartItemId,
      isActive: isActive
    };
    saveAction("update", "/cart-item-toggle-active", formData, cartItemId, function (data) {
      toastrSuccessMessage("Status updated successfully");
      CartManager.loadCartData(true);
    }, function (error) {
      var _error$responseJSON;
      toastrErrorMessage(((_error$responseJSON = error.responseJSON) === null || _error$responseJSON === void 0 ? void 0 : _error$responseJSON.message) || "Something went wrong.");
    });
  });
  initEvents();
  return {
    render: render
  };
}();
})();

/******/ })()
;