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
/*!****************************************************************!*\
  !*** ./resources/js/panel/users/cart/cart_active_item_list.js ***!
  \****************************************************************/
var CartActiveItemList = function () {
  function render(data) {
    var _data$cart;
    var container = document.getElementById('productBlockList');
    container.innerHTML = ''; // Clear previous content

    var total = 0;
    var total_shipping_charge = (data === null || data === void 0 ? void 0 : data.shipping_charge) || 0;
    var coupon_discount = 0;
    var total_item_qty = 0;
    data === null || data === void 0 || (_data$cart = data.cart) === null || _data$cart === void 0 || (_data$cart = _data$cart.data) === null || _data$cart === void 0 || _data$cart.forEach(function (item) {
      total += item.product_info.product_price * item.quantity;
      coupon_discount += item.coupon_discount;
      total_item_qty += parseInt(item.quantity);
      var variationInfo = '';
      if (item.variations && item.variations.length > 0) {
        variationInfo = item.variations.filter(function (v) {
          return v.attribute_name && v.attribute_value;
        }) // ignore null/empty
        .map(function (v) {
          return "".concat(v.attribute_name, ": ").concat(v.attribute_value);
        }).join(', ');
      }

      // build brand + variation line only if values exist
      var extraInfo = '';
      if (item.product_info.brand_name && item.product_info.brand_name !== 'null' || variationInfo) {
        var parts = [];
        if (item.product_info.brand_name && item.product_info.brand_name !== 'null') {
          parts.push("Brand: ".concat(item.product_info.brand_name));
        }
        if (variationInfo) parts.push(variationInfo);
        extraInfo = "<small>".concat(parts.join(', '), "</small>");
      }
      var productBlock = "\n            <div class=\"d-flex align-items-start mb-3  cart_list_".concat(item.id, "\">\n                <img src=\"").concat(item.product_info.image_url, "\" alt=\"Product Image\" class=\"img-thumbnail\" style=\"width: 80px; height: 80px; object-fit: cover;\">\n                <div class=\"ml-3\">\n                    <h6 class=\"mb-0 font-weight-bold\">").concat(item.product_info.name, "</h6>\n                    ").concat(extraInfo, "\n                    <div class=\"d-flex align-items-center\">\n                        <span class=\"font-weight-bold text-dark mr-3\">").concat(item.product_info.product_price, " Taka</span>\n                        <div class=\"quantity-control\">\n                            <button class=\"btn btn-qty btn-decrease qty-btn-minus\" type=\"button\" data-cart_item_id=\"").concat(item.id, "\">\u2212</button>\n                            <input type=\"text\" class=\"qty-input input-qty\" value=\"").concat(item.quantity, "\" data-cart_item_id=\"").concat(item.id, "\" readonly>\n                            <button class=\"btn btn-qty btn-increase qty-btn-plus\" type=\"button\" data-cart_item_id=\"").concat(item.id, "\">+</button>\n                        </div>\n                        <button class=\"btn btn-link text-danger p-0 remove-cart-item ms-auto\" \n                                data-cart_item_id=\"").concat(item.id, "\" title=\"Remove\">\n                            <i class=\"fa fa-trash text-danger\" style=\"font-size: 15px;\"></i>\n                        </button>\n                    </div>\n                </div>\n            </div>\n        ");
      $('.cart_total_price').text(total.toFixed(2));
      $('.shipping_charge_amount').text(total_shipping_charge);
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
    }, function (error) {
      var _error$responseJSON;
      toastrErrorMessage(((_error$responseJSON = error.responseJSON) === null || _error$responseJSON === void 0 ? void 0 : _error$responseJSON.message) || "Something went wrong.");
    });
  });
  $(document).on('click', '.remove-cart-item', function () {
    var cartItemId = $(this).data('cart_item_id');
    CartManager.removeItem(cartItemId);
  });
  initEvents();
  return {
    render: render
  };
}();
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!*********************************!*\
  !*** ./resources/js/address.js ***!
  \*********************************/
(function () {
  var addressSelect = {
    init: function init() {
      this.bindEvents();
      this.loadDistricts();
    },
    bindEvents: function bindEvents() {
      // const divisionSelect = document.getElementById('division');
      // const districtSelect = document.getElementById('district');

      // if (divisionSelect) {
      //     divisionSelect.addEventListener('change', function () {
      //         addressSelect.clearSelect('district');
      //         addressSelect.clearSelect('thana');

      //         if (this.value) {
      //             addressSelect.loadDistricts(this.value);
      //         }
      //     });
      // }

      // if (districtSelect) {
      //     districtSelect.addEventListener('change', function () {
      //         addressSelect.clearSelect('thana');

      //         if (this.value) {
      //             addressSelect.loadThanas(this.value);
      //         }
      //     });
      // }
    },
    loadDivisions: function loadDivisions() {
      getDetails('/divisions-select/lists', function (data) {
        addressSelect.populateSelect('division', data.results, 'Select Division');
      }, addressSelect.handleError);
    },
    loadDistricts: function loadDistricts(divisionId, callback) {
      getDetails("/districts-select/lists?division_id=".concat(divisionId), function (data) {
        addressSelect.populateSelect('district', data.results, 'Select District');
        if (typeof callback === 'function') callback();
      }, addressSelect.handleError);
    },
    loadThanas: function loadThanas(districtId, callback) {
      getDetails("/areas-select/lists?district_id=".concat(districtId), function (data) {
        addressSelect.populateSelect('thana', data.results, 'Select Thana');
        if (typeof callback === 'function') callback();
      }, addressSelect.handleError);
    },
    populateSelect: function populateSelect(elementId, items) {
      var placeholder = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'Select';
      var select = document.getElementById(elementId);
      if (!select) return;
      var options = "<option value=\"\">".concat(placeholder, "</option>");
      items.forEach(function (item) {
        options += "<option value=\"".concat(item.id, "\">").concat(item.name, "</option>");
      });
      select.innerHTML = options;
    },
    clearSelect: function clearSelect(elementId) {
      var select = document.getElementById(elementId);
      if (select) {
        select.innerHTML = '<option value="">Select</option>';
      }
    },
    handleError: function handleError(error) {
      if (error.responseJSON && error.responseJSON.message) {
        toastrErrorMessage(error.responseJSON.message);
      } else {
        toastrErrorMessage("An error occurred");
      }
    }
  };

  // Auto-init if loaded in the page
  window.addEventListener('DOMContentLoaded', function () {
    addressSelect.init();
  });

  // Expose to global scope if needed elsewhere
  window.addressSelect = addressSelect;
})();
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!**********************************************************!*\
  !*** ./resources/js/panel/users/checkout/place_order.js ***!
  \**********************************************************/
function submitOrder(formData) {
  var selectedId = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : "";
  saveAction("store", "/place-order", formData, selectedId, function (data) {
    if (typeof data.results !== 'undefined') {
      toastrSuccessMessage(data.message);
      // Assuming 'order_confirmation' is the route name
      var orderConfirmationRoute = "/order-confirmation/".concat(data.results.id);
      // Redirect to the order confirmation page
      window.location.href = orderConfirmationRoute;
    } else {
      toastrErrorMessage("Address Not Found");
    }
  }, function (error) {
    toastrErrorMessage(error.responseJSON.message);
  });
}
$(document).on('click', '#district', function () {
  var divisionId = $('#division').val() || null;
  var districtId = $('#district').val() || null;
  var upazilaId = $('#thana').val() || null;
  getDetails("/checkout/cart/lists?division_id=".concat(divisionId, "&district_id=").concat(districtId, "&upazila_id=").concat(upazilaId), function (data) {
    cartData = data.results;
    console.log(cartData);
    CartActiveItemList.render(cartData);
  }, function (error) {
    console.error("Failed to load cart data:", error);
  });
});

/**
 * Validate Bangladeshi phone number
 * @param {string} phone
 * @returns {boolean}
 */
function isValidPhone(phone) {
  var phonePattern = /^(?:\+?88)?01[3-9]\d{8}$/;
  return phonePattern.test(phone.trim());
}
$(document).on('click', '#placeOrderBtn', function () {
  var _form$elements$mobile, _document$querySelect;
  var form = document.getElementById('checkoutForm');
  var formData = {};

  // 1️⃣ Validate phone first
  var mobile = ((_form$elements$mobile = form.elements['mobile']) === null || _form$elements$mobile === void 0 || (_form$elements$mobile = _form$elements$mobile.value) === null || _form$elements$mobile === void 0 ? void 0 : _form$elements$mobile.trim()) || '';
  if (!mobile) {
    toastrErrorMessage('Please enter your phone number');
    return;
  }
  if (!isValidPhone(mobile)) {
    toastrErrorMessage('Please enter a valid Bangladeshi phone number (e.g., 017XXXXXXXX)');
    return;
  }
  formData['mobile'] = mobile;

  // Collect required fields into formData object
  var requiredFields = ['name', 'mobile', 'district', 'address'];
  for (var _i = 0, _requiredFields = requiredFields; _i < _requiredFields.length; _i++) {
    var _form$elements$field;
    var field = _requiredFields[_i];
    var value = ((_form$elements$field = form.elements[field]) === null || _form$elements$field === void 0 || (_form$elements$field = _form$elements$field.value) === null || _form$elements$field === void 0 ? void 0 : _form$elements$field.trim()) || '';
    if (!value) {
      toastrErrorMessage("Please fill the required field: ".concat(field));
      return;
    }
    formData[field] = value;
  }

  // Get payment method
  var paymentMethod = (_document$querySelect = document.querySelector('input[name="payment_method"]:checked')) === null || _document$querySelect === void 0 ? void 0 : _document$querySelect.value;
  if (!paymentMethod) {
    toastrErrorMessage('Please select a payment method');
    return;
  }
  formData['payment_method'] = paymentMethod;

  // If you want to add other fields from the form that are not in requiredFields, do so here:
  // for example:
  // formData['email'] = form.elements['email']?.value || '';

  submitOrder(formData, '');
});
})();

// This entry needs to be wrapped in an IIFE because it needs to be isolated against other entry modules.
(() => {
/*!**************************************************!*\
  !*** ./resources/js/panel/users/apply_coupon.js ***!
  \**************************************************/
$(document).on('click', '#applyCouponBtn', function () {
  var couponCode = $('#coupon_code').val().trim();
  var $feedback = $('#couponFeedback');
  if (!couponCode) {
    $feedback.text('Please enter a coupon code.').css('color', 'red');
    return;
  }
  var formData = {
    coupon_code: couponCode
  };
  saveAction("store", "/coupon-apply", formData, null, function (response) {
    toastrSuccessMessage("Coupon applied successfully.");
    $feedback.text('Coupon applied successfully.').css('color', 'green');

    // Reload cart totals and UI
    CartManager.loadCartData(true);
  }, function (error) {
    console.error(error);
    var response = error.responseJSON;

    // Default fallback
    var message = "Invalid coupon.";

    // If Laravel `Message::error()` structure
    if (response !== null && response !== void 0 && response.message) {
      message = response.message;
    }

    // If Laravel validation error
    if (response !== null && response !== void 0 && response.errors) {
      var _Object$values;
      // Collect first validation message
      var firstError = (_Object$values = Object.values(response.errors)) === null || _Object$values === void 0 || (_Object$values = _Object$values[0]) === null || _Object$values === void 0 ? void 0 : _Object$values[0];
      if (firstError) {
        message = firstError;
      }
    }
    toastrErrorMessage(message);
  });
});
})();

/******/ })()
;