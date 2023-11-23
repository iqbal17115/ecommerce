$(document).ready(function () {
    function getWishlist() {
        const user_id = $("#temp_user_id").data('user_id');
        getDetails(
            "/api/wishlist-count?user_id=" + user_id,
            (data) => {
                $('.wishlist-count').text(data.results);
            },
            (error) => {

            }
        );
    }
    getWishlist();
});
