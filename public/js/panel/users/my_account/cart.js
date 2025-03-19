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
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); background-color: white; position: relative;">
                        
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <img src="${item.product.image_url}" alt="" 
                                style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <div>
                                <h3 style="margin: 0;">${item.product.name}</h3>
                                <span>Quantity: ${item.quantity}</span><br>
                                <span style="font-size: 0.9em; color: ${item.is_active ? 'green' : 'red'};">
                                    ${item.is_active ? 'Active' : 'Inactive'}
                                </span>
                            </div>
                        </div>
    
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <span>Price: ${item.currency} ${item.product.product_price.toFixed(2)}</span>
                        </div>
    
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span>Discount: ${item.currency} ${item.coupon_discount.toFixed(2)}</span>
                            <!-- Buy Now Button & Delete Icon Group -->
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <button style="background: #f4631b; color: white; border: none; padding: 4px 8px; 
                                               border-radius: 20px; cursor: pointer; font-size: 10px; font-weight: bold;">
                                    Buy Now
                                </button>
                                <!-- Trash Icon -->
                                <span class="delete-item" data-index="${index}" 
                                      style="cursor: pointer; color: #f4631b; font-size: 16px; display: flex; align-items: center;">
                                    <i class="fas fa-trash-alt"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                `;
            });
        } else {
            cartListHtml = '<p style="padding: 20px; text-align: center; color: #888;">Your cart is empty.</p>';
        }
    
        $('#my-account-cartitem').html(cartListHtml);
    
        // Add event listener for delete icon
        $('.delete-item').on('click', function () {
            let index = $(this).data('index');
            items.splice(index, 1); // Remove item from array
            displayCartItems(items); // Re-render cart
        });
    }
    
});