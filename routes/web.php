<?php

use App\Http\Controllers\Backend\Currency\CurrencyController;
use App\Http\Controllers\Backend\Customer\CustomerController;
use App\Http\Controllers\Backend\Order\OrderController;
use App\Http\Controllers\Ecommerce\HomeController;
use App\Http\Controllers\Ecommerce\ProductDetailController;
use App\Http\Controllers\FrontEnt\LoginController;
use App\Http\Controllers\Backend\Product\UnitController;
use App\Http\Controllers\Backend\Product\VariantController;
use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\MaterialController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\ConditionController;
use App\Http\Controllers\Backend\Product\ProductFeatureController;
use App\Http\Controllers\Backend\WebSetting\AdvertisementController;
use App\Http\Controllers\Backend\WebSetting\BlockController;
use App\Http\Controllers\Backend\WebSetting\CompanyInfoController;
use App\Http\Controllers\Backend\WebSetting\CouponController;
use App\Http\Controllers\Backend\WebSetting\FeatureSettingController;
use App\Http\Controllers\Backend\WebSetting\ShippingChargeController;
use App\Http\Controllers\Backend\WebSetting\SliderController;
use App\Http\Controllers\Ecommerce\AuthController;
use App\Http\Controllers\Ecommerce\ShopController;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\CheckoutController;
use App\Http\Controllers\FrontEnd\ReplyController;
use App\Http\Controllers\FrontEnd\ReviewController;
use App\Http\Controllers\Language\LanguageController;
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
// Review
Route::controller(ReviewController::class)->group(function () {
    Route::get('/reviews', 'getReview')->name('reviews');
    Route::post('/reviews', 'store')->name('reviews.store');
});

Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::get('/', function () {
    return view('auth.login');
});
// Language
Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/get_sidebar_content', [HomeController::class, 'getSidebarContent'])->name('get_sidebar_content');
Route::get('/check_sub_category', [HomeController::class, 'checkSubCategory'])->name('check_sub_category');
Route::get('/get_sub_category', [HomeController::class, 'getSubCategory'])->name('get_sub_category');
Route::get('/get_parent_category', [HomeController::class, 'getParentCategory'])->name('get_parent_category');
Route::get('/catalog/{id}', [ShopController::class, 'shop'])->name('catalog');
Route::get('/catalog/{name}', [ShopController::class, 'shop'])->name('catalog.show');
Route::get('/get-main-content', [HomeController::class, 'getMainContent'])->name('get-main-content');
Route::get('/search/{q?}', [ShopController::class, 'shopSearch'])->name('search');
Route::get('pagination/shop-pagination-data', [ShopController::class, 'shopPagination']);
Route::get('pagination/shop-pagination-total-data', [ShopController::class, 'shopPaginationTotal']);
Route::get('pagination/shop-order-total-data', [ShopController::class, 'productOrderBy']);
Route::get('shop/products/{name}', [ProductDetailController::class, 'productDetail'])->name('products.show');
Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::get('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove-from-cart');
Route::post('increase-product-qty', [CartController::class, 'increaseQty']);
Route::post('decrease-product-qty', [CartController::class, 'decreaseQty']);
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('get-district', [CheckoutController::class, 'getDistrict'])->name('get-district');
Route::get('get-upazila', [CheckoutController::class, 'getUpazila'])->name('get-upazila');
Route::get('get-union', [CheckoutController::class, 'getUnion'])->name('get-union');
Route::post('confirm-order', [CheckoutController::class, 'confirmOrder'])->name('confirm.order');
Route::get('contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
Route::get('about', [HomeController::class, 'aboutUs'])->name('about');
Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('terms-condition', [HomeController::class, 'termsAndCondition'])->name('terms-condition');
Route::get('shipping-and-delivery', [HomeController::class, 'addShippingAndDelivery'])->name('shipping-and-delivery');
Route::get('customer-sign-in', [AuthController::class, 'index'])->name('customer-sign-in');
Route::Post('customer-sign-in', [AuthController::class, 'authenticate'])->name('customer-sign-in');
Route::get('sign-up', [AuthController::class, 'signUpIndex'])->name('sign-up');
Route::post('customer-register', [AuthController::class, 'customRegistration'])->name('customer-register');
Route::get('customer-logout', [AuthController::class, 'logout'])->name('customer-logout');
Route::post('customer-login', [AuthController::class, 'authenticate'])->name('customer-login');
//
Route::group(['middleware' => ['role:admin|user|manager|editor']], function () {
    Route::get('admin', [HomeController::class, 'adminDashboard'])->name('dashboard')->middleware(['auth:sanctum', 'verified']);

    // Customer
    Route::controller(CustomerController::class)->group(function () {
        Route::get('manage-customer', 'manageCustomer')->name('manage.customer');
    });

    // Reply
    Route::controller(ReplyController::class)->group(function () {
        Route::post('/reply', 'submitReply')->name('reply');
    });

    // Review
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/reviews', 'reviews')->name('reviews.index');
        Route::post('/review-status', 'statusChange');
        Route::post('/reviews/submitReply', [ReviewController::class, 'submitReply'])->name('reviews.submitReply');
    });

    // Order Start
    Route::controller(OrderController::class)->group(function () {
        Route::get('new-order', 'index')->name('new-order');
        Route::get('order-detail', 'orderDetail')->name('order-detail');
        Route::get('/orders/{order}', 'destroy')->name('orders.destroy');
        Route::get('/invoices-detail/{order}', 'invoicesDetail')->name('invoices-detail');
        Route::get('confirm-order/{order}', 'confirmOrderShow')->name('confirm-order');
        Route::get('cancel-order/{order}', 'cancelOrderShow')->name('cancel-order');
        Route::get('all-order', 'allOrderIndex')->name('all-order');
    });

    // Start Manage Company
    Route::group(
        [],
        function () {
            Route::get('company-info', [CompanyInfoController::class, 'index'])->name('company-info');
            Route::post('add-company_vital_info', [CompanyInfoController::class, 'addVitalInfo'])->name('add.company_vital_info');
            Route::post('add-add_link', [CompanyInfoController::class, 'addLink'])->name('add.add_link');
            Route::post('add-about_us', [CompanyInfoController::class, 'addAboutUs'])->name('add.about_us');
            Route::post('add-terms_condition', [CompanyInfoController::class, 'addTermsCondition'])->name('add.terms_condition');
            Route::post('add-privacy_policy', [CompanyInfoController::class, 'addPrivacyPolicy'])->name('add.privacy_policy');
            Route::post('add-return_policy', [CompanyInfoController::class, 'addReturnPolicy'])->name('add.return_policy');
            Route::post('add-shipping_and_delivery', [CompanyInfoController::class, 'addShippingAndDelivery'])->name('add.shipping_and_delivery');
            Route::post('keyword', [CompanyInfoController::class, 'keyword'])->name('add.key_word');
            Route::post('description', [CompanyInfoController::class, 'description'])->name('add.description');
            Route::post('add-status', [CompanyInfoController::class, 'addStatus'])->name('add.status');
        }
    );
    // End Manage Company

    // Unit Start
    Route::group(
        [],
        function () {
            Route::get('product-unit', [UnitController::class, 'index'])->name('product-unit');
            Route::post('add-unit', [UnitController::class, 'addUnit'])->name('add.unit');
            Route::post('delete-unit', [UnitController::class, 'deleteUnit'])->name('delete.unit');
            Route::get('pagination/unit-pagination-data', [UnitController::class, 'pagination']);
            Route::get('search-unit', [UnitController::class, 'searchUnit'])->name('search.unit');
        }
    );
    // Unit Start

    // Unit Start
    Route::group(
        [],
        function () {
            Route::get('product-variant', [VariantController::class, 'index'])->name('product-variant');
            Route::post('add-variant', [VariantController::class, 'addVariant'])->name('add.variant');
            Route::post('delete-variant', [VariantController::class, 'deleteVariant'])->name('delete.variant');
            Route::get('pagination/variant-pagination-data', [VariantController::class, 'pagination']);
            Route::get('search-variant', [VariantController::class, 'searchVariant'])->name('search.variant');
            Route::get('get-variant/{type}', [VariantController::class, 'getVariant'])->name('get-variant');
            Route::get('variant/{id}', [VariantController::class, 'getVariantById'])->name('variant');
        }
    );
    // End Start

    // Unit Brand
    Route::group(
        [],
        function () {
            Route::get('product-brand', [BrandController::class, 'index'])->name('product-brand');
            Route::post('add-brand', [BrandController::class, 'addBrand'])->name('add.brand');
            Route::post('delete-brand', [BrandController::class, 'deleteBrand'])->name('delete.brand');
            Route::get('pagination/brand-pagination-data', [BrandController::class, 'pagination']);
            Route::get('search-brand', [BrandController::class, 'searchBrand'])->name('search.brand');
        }
    );
    // Unit Brand

    // Unit Category
    Route::group(
        [],
        function () {
            Route::get('product-category', [CategoryController::class, 'index'])->name('product-category');
            Route::post('add-category', [CategoryController::class, 'addCategory'])->name('add.category');
            Route::post('delete-category', [CategoryController::class, 'deleteCategory'])->name('delete.category');
            Route::get('pagination/category-pagination-data', [CategoryController::class, 'pagination']);
            Route::get('category.hierarchy', [CategoryController::class, 'categoryHierarchy'])->name('category.hierarchy');
            Route::get('category', [CategoryController::class, 'searchCategory'])->name('search.category');
        }
    );
    // Unit Category

    // Material Start
    Route::group(
        [],
        function () {
            Route::get('product-material', [MaterialController::class, 'index'])->name('product-material');
            Route::post('add-material', [MaterialController::class, 'addMaterial'])->name('add.material');
            Route::post('delete-material', [MaterialController::class, 'deleteMaterial'])->name('delete.material');
            Route::get('pagination/material-pagination-data', [MaterialController::class, 'pagination']);
            Route::get('search-material', [MaterialController::class, 'searchMaterial'])->name('search.material');
        }
    );
    // Material End

    // Start Condition
    Route::group(
        [],
        function () {
            Route::get('condition', [ConditionController::class, 'index'])->name('condition');
            Route::post('add-condition', [ConditionController::class, 'addCondition'])->name('add.condition');
            Route::post('delete-condition', [ConditionController::class, 'deleteCondition'])->name('delete.condition');
            Route::get('pagination/condition-pagination-data', [ConditionController::class, 'pagination']);
            Route::get('search-condition', [ConditionController::class, 'searchCondition'])->name('search.condition');
            Route::get('get-condition', [ConditionController::class, 'getCondition'])->name('get-condition');
        }
    );
    // End Condition
    // Start Product Feature
    Route::group(
        [],
        function () {
            Route::get('feature', [ProductFeatureController::class, 'index'])->name('feature');
            Route::post('add-feature', [ProductFeatureController::class, 'addProductFeature'])->name('add.feature');
            Route::post('delete-feature', [ProductFeatureController::class, 'deleteProductFeature'])->name('delete.feature');
            Route::get('pagination/feature-pagination-data', [ProductFeatureController::class, 'pagination']);
            Route::get('search-feature', [ProductFeatureController::class, 'searchProductFeature'])->name('search.feature');
            Route::get('get-feature', [ProductFeatureController::class, 'getProductFeature'])->name('get-feature');
        }
    );
    // End Product Feature
    // Start Product
    Route::group(
        [],
        function () {
            Route::get('product-product', [ProductController::class, 'index'])->name('product-product');
            Route::get('get-category/{id}', [ProductController::class, 'getCategory'])->name('get-category');
            Route::post('add-product_identity', [ProductController::class, 'addProductIdentity'])->name('add.product_identity');
            Route::post('add-vital_info', [ProductController::class, 'addVitalInfo'])->name('add.vital_info');
            Route::post('add-add_product_detail_info', [ProductController::class, 'addProductDetailInfo'])->name('add.add_product_detail_info');
            Route::post('add-add_product_image_info', [ProductController::class, 'addProductImageInfo'])->name('add.add_product_image_info');
            Route::post('add-add_product_description_info', [ProductController::class, 'addProductDescriptionInfo'])->name('add.add_product_description_info');
            Route::post('add-add_product_keyword', [ProductController::class, 'addProductKeywordInfo'])->name('add.add_product_keyword');
            Route::post('add-add_product_compliance', [ProductController::class, 'addProductComplianceInfo'])->name('add.add_product_compliance');
            Route::post('add-add_product_more_detail', [ProductController::class, 'addProductMoreDetailInfo'])->name('add.add_product_more_detail');
            Route::post('add-add_variant_variant', [ProductController::class, 'addProductVariantInfo'])->name('add.add_variant_variant');
            Route::post('delete-product', [ProductController::class, 'deleteProduct'])->name('delete.product');
            Route::get('product_list', [ProductController::class, 'productList'])->name('product_list');
            Route::get('pagination/product-pagination-data', [ProductController::class, 'pagination']);
            Route::get('search-product', [ProductController::class, 'searchProduct'])->name('search.product');
        }
    );
    // End Product

    // Start Slider
    Route::group(
        [],
        function () {
            Route::get('shipping-charge', [ShippingChargeController::class, 'index'])->name('shipping-charge');
            Route::post('add-shipping-charge', [ShippingChargeController::class, 'addShippingCharge'])->name('add.shipping-charge');
            Route::post('delete-shipping-charge', [ShippingChargeController::class, 'deleteShippingCharge'])->name('delete.shipping-charge');
            Route::get('pagination/shipping-charge-pagination-data', [ShippingChargeController::class, 'pagination']);
        }
    );
    // End Slider

    // Start Slider
    Route::group(
        [],
        function () {
            Route::get('slider', [SliderController::class, 'index'])->name('slider');
            Route::post('add-slider', [SliderController::class, 'addSlider'])->name('add.slider');
            Route::post('delete-slider', [SliderController::class, 'deleteSlider'])->name('delete.slider');
            Route::get('pagination/slider-pagination-data', [SliderController::class, 'pagination']);
        }
    );
    // End Slider

    // Start Feature Setting
    Route::group(
        [],
        function () {
            Route::get('feature-setting', [FeatureSettingController::class, 'index'])->name('feature-setting');
            Route::post('add-feature_setting', [FeatureSettingController::class, 'addFeatureSetting'])->name('add.feature_setting');
            Route::get('feature-setting-list', [FeatureSettingController::class, 'featureSettingList'])->name('feature-setting-list');

        }
    );
    // End Feature Setting

    // Start Advertisement
    Route::group(
        [],
        function () {
            Route::get('advertisement', [AdvertisementController::class, 'index'])->name('advertisement');
            Route::post('add-advertisement', [AdvertisementController::class, 'addAdvertisement'])->name('add.advertisement');
            Route::post('delete-advertisement', [AdvertisementController::class, 'deleteAdvertisement'])->name('delete.advertisement');
            Route::get('pagination/advertisement-pagination-data', [AdvertisementController::class, 'pagination']);
            Route::get('search-advertisement', [AdvertisementController::class, 'searchAdvertisement'])->name('search.advertisement');
            Route::get('get-product-feature', [ProductFeatureController::class, 'getFeature'])->name('get-product-feature');
        }
    );
    // End Advertisement

    // Start Coupon
    Route::group(
        [],
        function () {
            Route::get('coupon', [CouponController::class, 'index'])->name('coupon');
            Route::post('add-coupon', [CouponController::class, 'addCoupon'])->name('add.coupon');
            Route::post('delete-coupon', [CouponController::class, 'deleteCoupon'])->name('delete.coupon');
            Route::get('pagination/coupon-pagination-data', [CouponController::class, 'pagination']);
            Route::get('search-coupon', [CouponController::class, 'searchCoupon'])->name('search.coupon');
        }
    );
    // End Coupon

    // Start Block
    Route::group(
        [],
        function () {
            Route::get('block', [BlockController::class, 'index'])->name('block');
            Route::post('add-block', [BlockController::class, 'addBlock'])->name('add.block');
            Route::post('delete-block', [BlockController::class, 'deleteBlock'])->name('delete.block');
            Route::get('pagination/block-pagination-data', [BlockController::class, 'pagination']);
            Route::get('search-block', [BlockController::class, 'searchBlock'])->name('search.block');
        }
    );
    // End Block

    // Start Currency
    Route::group(
        [],
        function () {
            Route::get('currency', [CurrencyController::class, 'index'])->name('currency');
            Route::post('add-currency', [CurrencyController::class, 'addCurrency'])->name('add.currency');
            Route::post('delete-currency', [CurrencyController::class, 'deleteCurrency'])->name('delete.currency');
            Route::get('pagination/currency-pagination-data', [CurrencyController::class, 'pagination']);
            Route::get('search-currency', [CurrencyController::class, 'searchCurrency'])->name('search.currency');
        }
    );
    // End Currency

});
