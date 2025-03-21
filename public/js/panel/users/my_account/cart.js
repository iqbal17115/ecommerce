$(document).ready(function () {
    $('.cart-item-tab').on('click', function (e) {
        loadCartData();

        // Activate the target tab
        $('#my-account-cartlist').addClass('show active');

        // Deactivate other tabs (if necessary)
        $('.tab-pane').not('#my-account-cartlist').removeClass('show active');
    });


    function loadCartData() {
        getDetails(
            '/my-account/cart',
            function (data) {
                displayCartItems(data.results);
            },
            function (error) {
                $('#cartlist').html('<p>Error loading cart data.</p>');
                console.error("Error fetching cart data:", error); //Log the error to console.
            }
        );
    }

    function displayCartItems(items) {
        let cartListHtml = '';
    
        if (items.length > 0) {
            items.forEach(function (item, index) {
                cartListHtml += `
                    <div style="border: 1px solid #ddd; border-radius: 8px; margin-bottom: 15px; padding: 15px; 
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); background-color: white; position: relative;" class="product cart_${item.id}" data-id="${item.id}">
                        
                        <!-- Trash Icon at the top -->
                        <span class="delete-item remove-from-cart" data-id="${item.id}" data-index="${index}" 
                              style="cursor: pointer; color: #f4631b; font-size: 1.5em; position: absolute; top: 10px; right: 10px;">
                            <i class="fas fa-trash-alt"></i>
                        </span>
                        
                        <!-- Product Info -->
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <img src="${item.product.image_url}" alt="" 
                                 style="width: 70px; height: 70px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <div>
                                <h3 style="margin: 0; font-size: 1.2em; font-weight: 600;">${item.product.name}</h3>
                                <span style="font-size: 1em;">Quantity: ${item.quantity}</span><br>
                                <span style="font-size: 1em; color: ${item.is_active ? 'green' : 'red'};">
                                    ${item.is_active ? 'Active' : 'Inactive'}
                                </span>
                            </div>
                        </div>
    
                        <!-- Price and Discount -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <span style="font-size: 1.1em; font-weight: bold;">Price: ${item.currency} ${item.product.product_price.toFixed(2)}</span>
                        </div>
    
                        <!-- Discount and Action Buttons -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                            <span style="font-size: 1em; font-weight: bold;">Discount: ${item.currency} ${item.coupon_discount.toFixed(2)}</span>
                            
                            <!-- Buy Now Button & Action Icons -->
                            <div style="display: flex; align-items: center; gap: 10px;">
                                  <button style="background: #f4631b; color: white; border: none; padding: 4px 8px; 
                                               border-radius: 20px; cursor: pointer; font-size: 10px; font-weight: bold;">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
        } else {
            cartListHtml = '<p style="padding: 20px; text-align: center; color: #888;">Your cart is empty.</p>';
        }
    
        $('#my-account-cartitem').html(cartListHtml);
    }    
    
    $(document).on('click', '.remove-from-cart', function () {
        const row_id = $(this).data('id');

        // Delete the company
        deleteAction(
            '/api/cart-remove/' + row_id,
            (data) => {
                $('.product.cart_' + row_id).remove();
                toastrSuccessMessage(data.message);
            },
            (error) => {
                // Error callback
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    });
});