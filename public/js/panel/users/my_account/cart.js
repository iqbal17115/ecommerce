$(document).ready(function () {
    const productBaseUrl = 'https://www.aladdinne.com/product-details';

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
                const shareUrl = generateProductShareUrl(item?.product?.name, item?.product?.seller_sku);

                cartListHtml += `
                    <div style="border: 1px solid #ddd; border-radius: 8px; margin-bottom: 15px; padding: 15px; 
                                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); background-color: white; position: relative;" class="product cart_${item.id}" data-id="${item.id}">
                        
                        <!-- Trash Icon at the top -->
                        <span class="delete-item remove-from-cart" data-id="${item?.id}" data-index="${index}" 
                              style="cursor: pointer; color: #f4631b; font-size: 1.5em; position: absolute; top: 10px; right: 10px;">
                            <i class="fas fa-trash-alt"></i>
                        </span>
                        
                        <!-- Product Info -->
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <img src="${item?.product?.image_url}" alt="" 
                                 style="width: 70px; height: 70px; object-fit: cover; margin-right: 15px; border-radius: 4px;">
                            <div>
                                <h3 style="margin: 0; font-size: 1.2em; font-weight: 600;">${item?.product?.name}</h3>
                                <span style="font-size: 1em;">Quantity: ${item?.quantity}</span><br>
                                <span style="font-size: 1em; color: ${item?.is_active ? 'green' : 'red'};">
                                    ${item?.is_active ? 'Active' : 'Inactive'}
                                </span>
                            </div>
                        </div>
    
                        <!-- Price and Discount -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <span style="font-size: 1.1em; font-weight: bold;">Price: ${item?.currency} ${item?.product?.product_price.toFixed(2)}</span>
                        </div>
    
                        <!-- Discount and Action Buttons -->
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                            <span style="font-size: 1em; font-weight: bold;">Discount: ${item?.currency} ${item?.coupon_discount.toFixed(2)}</span>
                            
                            <!-- Buy Now Button & Action Icons -->
                            <div style="display: flex; align-items: center; gap: 10px;">
                                  <button style="background: #f4631b; color: white; border: none; padding: 4px 8px; 
                                               border-radius: 20px; cursor: pointer; font-size: 10px; font-weight: bold;">
                                    Buy Now
                                </button>

                                 <button class="open-share-modal" 
                                    data-url="${shareUrl}" 
                                    style="background: #007bff; color: white; border: none; padding: 4px 8px; 
                                        border-radius: 20px; cursor: pointer; font-size: 10px; font-weight: bold;">
                                <i class="fas fa-share-alt"></i> Share
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

    $(document).on('click', '.open-share-modal', function () {
        const productUrl = $(this).data('url');
    
        const fbAppId = 'YOUR_APP_ID'; // Replace with your real Facebook App ID
    
        const shareHtml = `
            <a href="https://wa.me/?text=${encodeURIComponent(productUrl)}" target="_blank" title="WhatsApp">
                <i class="fab fa-whatsapp" style="font-size: 1.8em; color: #25d366;"></i>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(productUrl)}" target="_blank" title="Facebook">
                <i class="fab fa-facebook" style="font-size: 1.8em; color: #1877f2;"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url=${encodeURIComponent(productUrl)}" target="_blank" title="Twitter">
                <i class="fab fa-twitter" style="font-size: 1.8em; color: #1da1f2;"></i>
            </a>
            <a href="https://www.facebook.com/dialog/send?app_id=${fbAppId}&link=${encodeURIComponent(productUrl)}&redirect_uri=${encodeURIComponent(window.location.origin)}"
               target="_blank" title="Messenger">
                <i class="fab fa-facebook-messenger" style="font-size: 1.8em; color: #0084ff;"></i>
            </a>
        `;
    
        $('#shareLinks').html(shareHtml);
        $('#shareModal').fadeIn();
    });
    
      // Handle share modal opening
      $(document).on('click', '.open-share-modal', function () {
        const shareUrl = $(this).data('url');

        $('#shareLinks').html(`
            <a href="javascript:void(0);" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(productUrl)}', '_blank')" target="_blank">
                <i class="fab fa-facebook fa-2x" style="color:#3b5998;"></i>
            </a>
            <a href="https://wa.me/?text=${encodeURIComponent(shareUrl)}" target="_blank">
                <i class="fab fa-whatsapp fa-2x" style="color:#25D366;"></i>
            </a>
            <a href="https://www.messenger.com/share?link=${encodeURIComponent(shareUrl)}" target="_blank">
                <i class="fab fa-facebook-messenger fa-2x" style="color:#0084FF;"></i>
            </a>
            <a href="mailto:?subject=Check this product&body=${encodeURIComponent(shareUrl)}">
                <i class="fas fa-envelope fa-2x" style="color:#6c757d;"></i>
            </a>
        `);

        $('#shareModal').fadeIn();
        $('body').addClass('modal-open');
    });

    // Close share modal
    $('#closeShareModal').click(function () {
        $('#shareModal').fadeOut();
        $('body').removeClass('modal-open');
    });

    $('#shareModal').click(function (e) {
        if (e.target === this) {
            $(this).fadeOut();
            $('body').removeClass('modal-open');
        }
    });

function generateProductShareUrl(name, sku) {
    const encodedName = encodeURIComponent(name);
    return `${productBaseUrl}/${encodedName}/${sku}`;
}
});