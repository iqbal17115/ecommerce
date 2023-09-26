<?php
use App\Http\Controllers\API\Panel\Address\AddressController;
use App\Http\Controllers\API\Panel\Address\CountryController;
use App\Http\Controllers\API\Panel\Address\DistrictController;
use App\Http\Controllers\API\Panel\Address\DivisionController;
use App\Http\Controllers\API\Panel\ShopSetting\ShopSettingCountryController;
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

// Country
Route::controller(ShopSettingCountryController::class)->group(function () {
    Route::get('shop-setting-countries/lists', 'lists')->name('shop_setting_countries.lists');
    Route::get('countries/select-lists', 'selectLists')->name('countries.select_lists');
    Route::get('countries/{country}', 'show')->name('countries.show');
    Route::post('countries', 'store')->name('countries.store');
    Route::put('countries/{country}', 'update')->name('countries.update');
    Route::delete('countries/{country}', 'destroy')->name('countries.delete');
});

// My Group Posts
Route::controller(AddressController::class)->group(function () {
    Route::get('user-address/lists', 'myAddressList')->name('user_address.lists');
    Route::get('user-address/{address}', 'show')->name('user_address.show');
    Route::post('user-address', 'store')->name('user_address.store');
    Route::post('user-address/default', 'setAsDefault')->name('user_address_default.store');
    Route::put('user-address/{address}', 'update')->name('user_address.update');
    Route::delete('/user-address/{address}', 'destroy')->name('user_address.delete');
});

Route::controller(DistrictController::class)->group(function () {
    Route::get('districts/lists', 'lists')->name('districts.lists');
});

Route::controller(DivisionController::class)->group(function () {
    Route::get('divisions/lists', 'lists')->name('divisions.lists');
});

Route::controller(CountryController::class)->group(function () {
    Route::get('countries/lists', 'lists')->name('countries.lists');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
