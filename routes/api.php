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

// Coupon Settings
Route::controller(CouponProductController::class)->group(function () {
    Route::get('coupon-products/lists', 'lists')->name('coupon_products.lists');
    Route::get('coupon-products', 'index')->name("coupon_products.index");
    Route::get('coupon-products/{couponProduct}', 'show')->name("coupon_products.show");
    Route::post('coupon-products', 'store')->name("coupon_products.store");
    Route::put('coupon-products/{couponProduct}', 'update')->name("coupon_products.update");
    Route::delete('coupon-products/{couponProduct}', 'destroy')->name('coupon_products.destroy');
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
});

// Cart
Route::controller(CartController::class)->group(function () {
    Route::post('cart/add', 'addToCart')->name('cart_add');
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
    Route::delete('countries/{country}', 'destroy')->name('countries.delete');
    Route::get('countries/select-lists', 'select_country')->name('countries.select_lists');
});

// My Group Posts
Route::controller(AddressController::class)->group(function () {
    Route::get('user-address/lists', 'myAddressList')->name('user_address.lists');
    Route::get('user-address/{address}', 'show')->name('user_address.show');
    Route::get('user-address-instruction/{address}', 'addressInstructionShow')->name('user_address_instruction.show');
    Route::post('user-address', 'store')->name('user_address.store');
    Route::post('/user-address-instruction', 'storeInstruction')->name('user_address_instruction.store');
    Route::post('user-address/default', 'setAsDefault')->name('user_address_default.store');
    Route::put('user-address/{address}', 'update')->name('user_address.update');
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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
