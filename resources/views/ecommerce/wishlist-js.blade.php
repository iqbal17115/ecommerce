<script>
    // Get the wishlist count when the page loads
    @if (Auth::user())
    updateWishlistDefaultCount();
    @endif

    // Function to update the wishlist count
    function updateWishlistDefaultCount() {
        var url = '/wishlist/count'; // Update with your route for fetching wishlist count

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update the wishlist count on the UI
                $('.wishlist-count').text(response.wishlist_count);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }
    // Function to update the wishlist count
    function updateWishlistCount(count) {
        $('.wishlist-count').text(count);
    }

    $(document).on('click', '.btn-icon-wish', function(e) {
        e.preventDefault();
        @guest
            window.location.href = '/customer-sign-in';
            return true;
         @endguest
        var product_id = $(this).data('product_id');
        var url = '/wishlist/add';
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                product_id: product_id
            },
            dataType: 'json',
            success: function(response) {
                // Handle success response
                console.log(response);
                // Optionally, update the UI to indicate that the product was added to the wishlist
                $(this).addClass('added-to-wishlist'); // Add a CSS class to the button
                $(this).attr('title', 'Remove From Wishlist'); // Update the tooltip text
                $(this).find('i').removeClass('icon-heart').addClass(
                    'icon-heart-filled'); // Update the heart icon
                // Update the wishlist count
                updateWishlistCount(response.wishlist_count);
            },
            error: function(xhr) {
                // Handle error response
                console.log(xhr);
            }
        });
    });

    $(document).on('click', '.btn-remove-wish', function(e) {
        e.preventDefault();

        var product_id = $(this).data('product-id');
        var url = '/wishlist/remove';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                product_id: product_id
            },
            dataType: 'json',
            success: function(response) {
                // Handle success response
                console.log(response);
                // Optionally, update the UI to indicate that the product was removed from the wishlist
                $(this).removeClass('added-to-wishlist'); // Remove the CSS class from the button
                $(this).attr('title', 'Add To Wishlist'); // Update the tooltip text
                $(this).find('i').removeClass('icon-heart-filled').addClass(
                    'icon-heart'); // Update the heart icon

                // Update the wishlist count
                updateWishlistCount(response.wishlist_count);
            },
            error: function(xhr) {
                // Handle error response
                console.log(xhr);
            }
        });
    });
</script>
