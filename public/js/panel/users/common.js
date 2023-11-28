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
