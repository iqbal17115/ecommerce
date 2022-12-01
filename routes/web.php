<?php

use App\Http\Controllers\FrontEnt\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\FrontEnt\LoginController;
use App\Http\Controllers\Backend\Product\UnitController;
use App\Http\Controllers\Backend\Product\VariantController;
use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\MaterialController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\WebSetting\SliderController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::post('change-password-customer', [HomeController::class, 'ChangePassword'])->name('change-password-customer');
Route::post('change-profile-photo', [HomeController::class, 'ChangeProfilePhoto'])->name('change-profile-photo');
Route::post('upazila-search', [HomeController::class, 'SearchUpazila'])->name('upazila-search');
Route::get('edit/{id?}', [HomeController::class, 'EditContact'])->name('edit');
Route::post('edit', [HomeController::class, 'EditContactById']);
Route::post('edit-shipping-address', [HomeController::class, 'EditShippingAddress'])->name('edit-shipping-address');
Route::get('seller-create', [HomeController::class, 'SellerCreateForm'])->name('seller-create');
Route::post('seller-create', [HomeController::class, 'CreateSeller']);

Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/customer_login', [HomeController::class, 'CustomerLogin'])->name('customer_login');
Route::get('/check-out', [HomeController::class, 'checkOut'])->name('check-out');
Route::get('/offer', [HomeController::class, 'Offer'])->name('offer');
Route::get('/product-search/', [HomeController::class, 'productSearch'])->name('product-search');
Route::get('/feature-wise/{feature}', [HomeController::class, 'FeatureWise'])->name('feature-wise');
Route::get('/all-category-wise/{id?}', [HomeController::class, 'allCategoryWise'])->name('all-category-wise');
Route::get('/category/{id?}', [HomeController::class, 'Category'])->name('category');
Route::get('/sub-category/{id?}', [HomeController::class, 'SubCategory'])->name('sub-category');
Route::get('/sub-sub-category/{id?}', [HomeController::class, 'SubSubCategory'])->name('sub-sub-category');
Route::get('/search-category-wise/{id?}', [HomeController::class, 'searchByCategory'])->name('search-category-wise');
Route::get('/search-subCategory-wise/{id?}', [HomeController::class, 'searchBySubCategory'])->name('search-subCategory-wise');
Route::get('/search-subSubCategory-wise/{id?}', [HomeController::class, 'searchBySubSubCategory'])->name('search-subSubCategory-wise');
Route::get('/search-brand-wise/{id?}', [HomeController::class, 'searchByBrand'])->name('search-brand-wise');
Route::post('/ajax/add-to-card-store', [HomeController::class, 'addToCardStore'])->name('ajax-add-to-card-store');
Route::post('/ajax/add-to-card-quantity-update', [HomeController::class, 'cartProductQuantityUpdate'])->name('ajax-add-to-card-quantity-update');
Route::post('/ajax/add-to-card-product-delete', [HomeController::class, 'cartProductDelete'])->name('ajax-add-to-card-product-delete');
Route::get('/confirm-order', [HomeController::class, 'HomePage'])->name('confirm-order');
Route::post('/confirm-order', [HomeController::class, 'confirmOrder'])->name('confirm-order');
Route::post('/ajax/send-message', [HomeController::class, 'messages'])->name('send-message');
Route::get('/order-completed/{id?}', [HomeController::class, 'orderComplete'])->name('order-completed');
Route::get('product-details/{id?}', [HomeController::class, 'productDetails'])->name('product-details');
Route::get('my-account', [HomeController::class, 'MyAccount'])->name('my-account');
Route::get('order-details/{id?}', [HomeController::class, 'OrderDetail'])->name('order-details');
Route::get('contact', [HomeController::class, 'Contact'])->name('contact');
Route::get('about', [HomeController::class, 'About'])->name('about');
Route::get('privacy-policy', [HomeController::class, 'PrivacyPolicy'])->name('privacy-policy');
Route::get('terms-condition', [HomeController::class, 'TermsAndCondition'])->name('terms-condition');
Route::Post('customer_sign_in', [LoginController::class, 'authenticate'])->name('customer_sign_in');

Route::group(['middleware' => ['role:admin|user|manager|editor']], function () {
    Route::get('/admin', [HomeController::class, 'adminDashboard'])->name('dashboard')->middleware(['auth:sanctum', 'verified']);

    // Unit Start
    Route::group([], function () {
        Route::get('product-unit', [UnitController::class, 'index'])->name('product-unit');
        Route::post('add-unit', [UnitController::class, 'addUnit'])->name('add.unit');
        Route::post('delete-unit', [UnitController::class, 'deleteUnit'])->name('delete.unit');
        Route::get('pagination/unit-pagination-data', [UnitController::class, 'pagination']);
        Route::get('search-unit', [UnitController::class, 'searchUnit'])->name('search.unit');
    });
    // Unit Start

    // Unit Start
    Route::group([], function () {
        Route::get('product-variant', [VariantController::class, 'index'])->name('product-variant');
        Route::post('add-variant', [VariantController::class, 'addVariant'])->name('add.variant');
        Route::post('delete-variant', [VariantController::class, 'deleteVariant'])->name('delete.variant');
        Route::get('pagination/variant-pagination-data', [VariantController::class, 'pagination']);
        Route::get('search-variant', [VariantController::class, 'searchVariant'])->name('search.variant');
    });
    // End Start

    // Unit Brand
    Route::group([], function () {
        Route::get('product-brand', [BrandController::class, 'index'])->name('product-brand');
        Route::post('add-brand', [BrandController::class, 'addBrand'])->name('add.brand');
        Route::post('delete-brand', [BrandController::class, 'deleteBrand'])->name('delete.brand');
        Route::get('pagination/brand-pagination-data', [BrandController::class, 'pagination']);
        Route::get('search-brand', [BrandController::class, 'searchBrand'])->name('search.brand');
    });
    // Unit Brand

    // Unit Category
    Route::group([], function () {
        Route::get('product-category', [CategoryController::class, 'index'])->name('product-category');
        Route::post('add-category', [CategoryController::class, 'addCategory'])->name('add.category');
        Route::post('delete-category', [CategoryController::class, 'deleteCategory'])->name('delete.category');
        Route::get('pagination/category-pagination-data', [CategoryController::class, 'pagination']);
        Route::get('search-category', [CategoryController::class, 'searchCategory'])->name('search.category');
    });
    // Unit Category

    // Material Start
    Route::group([], function () {
        Route::get('product-material', [MaterialController::class, 'index'])->name('product-material');
        Route::post('add-material', [MaterialController::class, 'addMaterial'])->name('add.material');
        Route::post('delete-material', [MaterialController::class, 'deleteMaterial'])->name('delete.material');
        Route::get('pagination/material-pagination-data', [MaterialController::class, 'pagination']);
        Route::get('search-material', [MaterialController::class, 'searchMaterial'])->name('search.material');
    });
    // Material End

    // Start Product
    Route::group([], function () {
        Route::get('product-product', [ProductController::class, 'index'])->name('product-product');
    });
    // End Product

    // Start Slider
    Route::group([], function () {
        Route::get('slider', [SliderController::class, 'index'])->name('slider');
        Route::post('add-slider', [SliderController::class, 'addSlider'])->name('add.slider');
        Route::post('delete-slider', [SliderController::class, 'deleteSlider'])->name('delete.slider');
        Route::get('pagination/slider-pagination-data', [SliderController::class, 'pagination']);
    });
    // End Slider

});