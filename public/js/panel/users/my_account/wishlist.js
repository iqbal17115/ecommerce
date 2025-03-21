$(document).ready(function () {
    $('.wishlist-item-tab').on('click', function (e) {
        // Load wishlist data
        loadWishlistData();

        // Activate the target tab
        $('#my-account-wishlist').addClass('show active');

        // Deactivate other tabs (if necessary)
        $('.tab-pane').not('#my-account-wishlist').removeClass('show active');
    });


    function loadWishlistData() {
        getDetails(
            '/my-account/wishlist',
            function (data) {
                displayWishlist(data.results);
            },
            function (error) {
                $('#wishlist').html('<p>Error loading cart data.</p>');
                console.error("Error fetching cart data:", error); //Log the error to console.
            }
        );
    }

    function displayWishlist(wishlists) {
        let wishListHtml = '';
    
        if (wishlists.length > 0) {
            wishlists.forEach(function (wishlist) {
                let product = wishlist.product;
    
                wishListHtml += '<div style="border: 1px solid #ddd; border-radius: 8px; margin-bottom: 15px; padding: 15px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); background-color: white;" class="product-row wishlist_row_' + wishlist.id + '">' +
                    '<div style="display: flex; align-items: center; margin-bottom: 10px;">' +
                    '<img src="' + product.image_url.replace('http:', 'https:') + '" alt="" style="width: 70px; height: 70px; object-fit: cover; margin-right: 15px; border-radius: 4px;">' +
                    '<div>' +
                    '<h3 style="margin: 0;">' + product.name + '</h3>' +
                    '</div>' +
                    '</div>' +
                    '<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">' +
                    '<span>Price: ' + product.currency + '' + product.product_price.toFixed(2) + '</span>' +
                    '<span>' +
                    (product.already_added ?
                        '<span style="background-color: #e0e0e0; color: #555; padding: 5px 10px; border-radius: 4px; font-size: 0.85em;">Already in cart</span>' :
                        '<button class="add-to-cart btn-add-cart add_wishlist_to_cart_item brand_color" data-product_id="' + product.id + '" data-wishlist_id="' + wishlist.id + '" style="color: white; border: none; padding: 3px 12px; border-radius: 10px; cursor: pointer; font-size: 0.9em;">Add to Cart</button>'
                    ) +
                    '</span>' +
                    '</div>' +
                    // Add delete icon section
                    '<div style="text-align: right; margin-top: 10px;">' +
                    '<button class="delete-wishlist-item" data-wishlist_id="' + wishlist.id + '" style="background: none; border: none; cursor: pointer; font-size: 1.2em; color: #e74c3c;">' +
                    '<i class="fas fa-trash-alt remove-from-wishlist" data-id="' + wishlist.id + '"></i>' + // Font Awesome trash icon
                    '</button>' +
                    '</div>' +
                    '</div>';
            });
        } else {
            wishListHtml = '<p style="padding: 20px; text-align: center; color: #888;">Your wishlist is empty.</p>';
        }
    
        $('#my-account-wishlist').html(wishListHtml);
    }    

    function submitWishlistToCart(formData, selectedId = "", action) {
        saveAction(
            "update",
            "/api/wishlist-to-cart",
            formData,
            selectedId,
            (data) => {
                loadWishlistData();
            },
            (error) => {
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    }

    $(document).on('click', '.add_wishlist_to_cart_item', function () {
        const wishlist_id = $(this).data('wishlist_id');
        const product_id = $(this).data('product_id');
        const user_id = $("#temp_user_id").data('user_id');
        const formData = {
            user_id: user_id,
            wishlist_id: wishlist_id,
            product_id: product_id,
            quantity: 1,
        };

        submitWishlistToCart(formData, wishlist_id, this);
    });

    $(document).on('click', '.remove-from-wishlist', function () {
        const row_id = $(this).data('id');

        // Delete the company
        deleteAction(
            '/api/wishlist-remove/' + row_id,
            (data) => {
                $('.wishlist_row_' + row_id).remove();
                toastrSuccessMessage(data.message);
            },
            (error) => {
                // Error callback
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    });
});