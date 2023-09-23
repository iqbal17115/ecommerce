<?php
use App\Http\Controllers\API\Panel\Address\AddressController;
use App\Http\Controllers\API\Panel\Address\CountryController;
use App\Http\Controllers\API\Panel\Address\DistrictController;
use App\Http\Controllers\API\Panel\Address\DivisionController;
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

// My Group Posts
Route::controller(AddressController::class)->group(function () {
    Route::get('user-address/lists', 'myAddressList')->name('user_address.lists');
    Route::get('user-address/{address}', 'show')->name('user_address.show');
    Route::post('user-address', 'store')->name('user_address.store');
    Route::post('user-address/default', 'setAsDefault')->name('user_address_default.store');
    Route::post('user-address/{address}', 'update')->name('user_address.update');
    Route::delete('user-address/{address}', 'destroy')->name('user_address.delete');
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
