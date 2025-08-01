<?php

use App\Http\Controllers\API\Panel\Address\AddressController;
use App\Http\Controllers\API\Panel\Address\CountryController;
use App\Http\Controllers\API\Panel\Address\DistrictController;
use App\Http\Controllers\API\Panel\Address\DivisionController;
use App\Http\Controllers\API\Panel\Address\UpazilaController;
use App\Http\Controllers\API\Panel\Admin\Coupon\CouponController;
use App\Http\Controllers\API\Panel\Admin\Coupon\CouponProductController;
use App\Http\Controllers\API\Panel\Admin\Product\ProductController;
use App\Http\Controllers\API\Panel\ShopSetting\ShopSettingCountryController;
use App\Http\Controllers\API\Panel\ShopSetting\ShopSettingDistrictController;
use App\Http\Controllers\API\Panel\ShopSetting\ShopSettingDivisionController;
use App\Http\Controllers\API\Panel\ShopSetting\ShopSettingUpazilaController;
use App\Http\Controllers\API\Panel\User\Cart\CartController;
use App\Http\Controllers\API\Panel\User\Coupon\ApplyCouponController;
use App\Http\Controllers\API\Panel\User\MyAccount\MyAccountWishlistController;
use App\Http\Controllers\API\Panel\User\MyAccount\MyReviewController;
use App\Http\Controllers\API\Panel\User\OrderController;
use App\Http\Controllers\API\Panel\User\UserInfoController;
use App\Http\Controllers\API\Panel\User\UserReviewController;
use App\Http\Controllers\API\Panel\User\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::middleware('web')->group(function () {

// User Review
Route::controller(UserReviewController::class)->group(function () {
    Route::get('all-reviews/lists', 'allReviews')->name('all_reviews.lists');
    Route::get('reviews/lists', 'lists')->name('reviews.lists');
    Route::post('reviews', 'store')->name("reviews.store");
    Route::put('reviews/{review}', 'update')->name("reviews.update");
});

// User Review
Route::controller(MyReviewController::class)->group(function () {
    Route::get('user-review/{user}', 'userReview')->name("user_review");
});

// User Info
Route::controller(UserInfoController::class)->group(function () {
    Route::get('user-info', 'userInfo')->name("user_info");
    Route::put('update-profile-photo/{user}', 'update')->name("update_profile_photo");
});

// My Account Wishlist
Route::controller(WishlistController::class)->group(function () {
    Route::get('wishlist-count', 'count')->name("wishlist_count");
});

// My Account Wishlist
Route::controller(MyAccountWishlistController::class)->group(function () {
    Route::get('my-account/wishlist', 'list')->name("my_account.wishlist");
    Route::delete('wishlist-remove/{wishlist}', 'removeWishlist')->name('wishlist_remove');
    Route::put('wishlist-to-cart/{wishlist}', 'wishlistToCart')->name('wishlist_to_cart');
});

// Coupon Settings
Route::controller(ApplyCouponController::class)->group(function () {
    Route::post('coupon-apply', 'apply')->name("coupon_apply");
});

// Coupon Settings
Route::controller(CouponProductController::class)->group(function () {
    Route::get('coupon-products/lists/{coupon}', 'lists')->name('coupon_products.lists');
    Route::get('coupon-products/{coupon}', 'index')->name("coupon_products.index");
    Route::get('coupon-products/{coupon}', 'show')->name("coupon_products.show");
    Route::post('coupon-products', 'store')->name("coupon_products.store");
    Route::put('coupon-products/{coupon}', 'update')->name("coupon_products.update");
    Route::delete('coupon-products/{couponProduct}', 'destroy')->name('coupon_products.destroy');
    Route::post('search/coupon-product', 'searchProduct')->name("search.coupon_product");
});

// Coupons
Route::controller(CouponController::class)->group(function () {
    Route::get('coupons/lists', 'lists')->name('coupons.lists');
    Route::get('coupons/select-lists', 'selectLists')->name('coupons.select_lists');
    Route::get('coupons', 'index')->name("coupons.index");
    Route::get('coupons/{coupon}', 'show')->name("coupons.show");
    Route::post('coupons', 'store')->name("coupons.store");
    Route::put('coupons/{coupon}', 'update')->name("coupons.update");
    Route::delete('coupons/{coupon}', 'destroy')->name('coupons.destroy');
    Route::put('coupons-status/{coupon}', 'statusUpdate')->name('coupons_status.update');
});

// Cart
Route::controller(CartController::class)->group(function () {
    Route::post('cart/add', 'addToCart')->name('cart_add');
    Route::post('cart/add-with-quantity', 'addToCartWithQuantity')->name('cart_add.with_quantity');
    Route::post('cart/buy-now-with-quantity', 'addToCartBuyNowWithQuantity')->name('cart_add.buy_now_with_quantity');
    Route::get('cart/lists', 'getCart');
    Route::put('cart-update/{cartItem}', 'updateCartItem')->name('cart_update');
    Route::put('cart-status-update/{cartItem}', 'updateCartItemStatus')->name('cart_status_update');
    Route::post('all-cart-status-update', 'updateCartAllItemStatus')->name('all_cart_status_update');
    Route::delete('cart-remove/{cartItem}', 'removeCartItem')->name('cart_remove');
    Route::get('checkout/cart/lists', 'getCheckoutCart')->name('checkout_cart_lists');
});

// Upazila
Route::controller(ProductController::class)->group(function () {
    Route::delete('delete-product-image/{productImage}', [ProductController::class, 'destroy'])->name('delete_product_image');
});


// Upazila
Route::controller(ShopSettingUpazilaController::class)->group(function () {
    Route::get('shop-setting-upazilas/lists', 'lists')->name('shop_setting_upazilas.lists');
    Route::get('upazilas/select-lists', 'selectLists')->name('upazilas.select_lists');
    Route::get('upazilas/{upazila}', 'show')->name('upazilas.show');
    Route::post('upazilas', 'store')->name('upazilas.store');
    Route::put('upazilas/{upazila}', 'update')->name('upazilas.update');
    Route::delete('upazilas/{upazila}', 'destroy')->name('upazilas.delete');
    Route::get('upazilas/select-lists', 'select_upazila')->name('upazilas.select_lists');
});


// District
Route::controller(ShopSettingDistrictController::class)->group(function () {
    Route::get('shop-setting-districts/lists', 'lists')->name('shop_setting_districts.lists');
    Route::get('districts/select-lists', 'selectLists')->name('districts.select_lists');
    Route::get('districts/{district}', 'show')->name('districts.show');
    Route::post('districts', 'store')->name('districts.store');
    Route::put('districts/{district}', 'update')->name('districts.update');
    Route::put('districts-location/{district}', 'locationUpdate')->name('districts_location.update');
    Route::put('districts-status/{district}', 'statusUpdate')->name('districts_status.update');
    Route::delete('districts/{district}', 'destroy')->name('districts.delete');
    Route::get('districts/select-lists', 'select_district')->name('districts.select_lists');
});

// Division
Route::controller(ShopSettingDivisionController::class)->group(function () {
    Route::get('shop-setting-divisions/lists', 'lists')->name('shop_setting_divisions.lists');
    Route::get('divisions/select-lists', 'selectLists')->name('divisions.select_lists');
    Route::get('divisions/{division}', 'show')->name('divisions.show');
    Route::post('divisions', 'store')->name('divisions.store');
    Route::put('divisions/{division}', 'update')->name('divisions.update');
    Route::delete('divisions/{division}', 'destroy')->name('divisions.delete');
    Route::get('divisions/select-lists', 'select_division')->name('divisions.select_lists');
});

// Country
Route::controller(ShopSettingCountryController::class)->group(function () {
    Route::get('shop-setting-countries/lists', 'lists')->name('shop_setting_countries.lists');
    Route::get('countries/select-lists', 'selectLists')->name('countries.select_lists');
    Route::get('countries/{country}', 'show')->name('countries.show');
    Route::post('countries', 'store')->name('countries.store');
    Route::put('countries/{country}', 'update')->name('countries.update');
    Route::put('countries-status/{country}', 'statusUpdate')->name('countries_status.update');
    Route::delete('countries/{country}', 'destroy')->name('countries.delete');
    Route::get('countries/select-lists', 'select_country')->name('countries.select_lists');
});

// My Group Posts
Route::controller(AddressController::class)->group(function () {
    Route::get('user-address/lists', 'myAddressList')->name('user_address.lists');
    Route::get('user-address/{address}', 'show')->name('user_address.show');
    Route::get('user-address-details/{address}', 'details')->name('user_address_details.show');
    Route::get('user-address-instruction/{address}', 'addressInstructionShow')->name('user_address_instruction.show');
    Route::post('user-address', 'store')->name('user_address.store');
    Route::post('/user-address-instruction', 'storeInstruction')->name('user_address_instruction.store');
    Route::post('user-address/default', 'setAsDefault')->name('user_address_default.store');
    Route::post('update-user-address', 'update')->name('update_user_address.update');
    Route::delete('/user-address/{address}', 'destroy')->name('user_address.delete');
});

Route::controller(UpazilaController::class)->group(function () {
    Route::get('areas-select/lists', 'lists')->name('districts.lists');
});

Route::controller(DistrictController::class)->group(function () {
    Route::get('districts-select/lists', 'lists')->name('districts.lists');
});

Route::controller(DivisionController::class)->group(function () {
    Route::get('divisions-select/lists', 'lists')->name('divisions.lists');
});

Route::controller(CountryController::class)->group(function () {
    Route::get('countries-select/lists', 'lists')->name('countries_lists.lists');
});
// });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
