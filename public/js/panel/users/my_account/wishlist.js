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

                wishListHtml += '<div style="border: 1px solid #ddd; border-radius: 8px; margin-bottom: 15px; padding: 15px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); background-color: white;">' +
                    '<div style="display: flex; align-items: center; margin-bottom: 10px;">' +
                    '<img src="' + product.image_url.replace('http:', 'https:') + '" alt="" style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px; border-radius: 4px;">' +
                    '<div>' +
                    '<h3 style="margin: 0;">' + product.name + '</h3>' +
                    '</div>' +
                    '</div>' +
                    '<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">' +
                    '<span>Price: ' + product.currency + '' + product.product_price.toFixed(2) + '</span>' +
                    '<span>' +
                    (product.already_added ?
                        '<span style="background-color: #e0e0e0; color: #555; padding: 5px 10px; border-radius: 4px; font-size: 0.85em;">Already in cart</span>' :
                        '<button class="add-to-cart btn-add-cart add_wishlist_to_cart_item" data-product_id="' + product.id + '" style="background-color: #007bff; color: white; border: none; padding: 3px 12px; border-radius: 4px; cursor: pointer; font-size: 0.9em;">Add to Cart</button>'
                    ) +
                    '</span>' +
                    '</div>' +
                    '</div>';
            });
        } else {
            wishListHtml = '<p style="padding: 20px; text-align: center; color: #888;">Your wishlist is empty.</p>';
        }

        $('#my-account-wishlist').html(wishListHtml);
    }
});