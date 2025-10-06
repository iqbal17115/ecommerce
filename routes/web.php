<?php

use App\Http\Controllers\API\Panel\Address\AddressController;
use App\Http\Controllers\API\Panel\Address\CountryController;
use App\Http\Controllers\API\Panel\Address\DistrictController;
use App\Http\Controllers\API\Panel\Address\DivisionController;
use App\Http\Controllers\API\Panel\Address\UpazilaController;
use App\Http\Controllers\API\Panel\User\Cart\CartDrawerController;
use App\Http\Controllers\API\Panel\User\Cart\UserCartItemController;
use App\Http\Controllers\Api\Panel\User\MyAccount\MyAccountPaymentController;
use App\Http\Controllers\Ecommerce\MyAccount\MyAccountWishlistController;
use App\Http\Controllers\Backend\Currency\CurrencyController;
use App\Http\Controllers\Backend\Customer\CustomerController;
use App\Http\Controllers\Backend\Order\AllOrderController;
use App\Http\Controllers\Backend\Order\OrderController;
use App\Http\Controllers\API\Panel\User\OrderController as PlaceOrderOrderController;
use App\Http\Controllers\Backend\OrderNotificationController;
use App\Http\Controllers\Backend\OrderPaymentController;
use App\Http\Controllers\Backend\OrderProduct\OrderProductCancellationController;
use App\Http\Controllers\Backend\OrderProduct\OrderProductReturnController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Ecommerce\HomeController;
use App\Http\Controllers\Ecommerce\MyAccount\CancelOrderController;
use App\Http\Controllers\Ecommerce\ProductDetailController;
use App\Http\Controllers\Backend\Product\UnitController;
use App\Http\Controllers\Backend\Product\VariantController;
use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\MaterialController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\ConditionController;
use App\Http\Controllers\Backend\Product\ProductFeatureController;
use App\Http\Controllers\Backend\Purchase\PurchaseController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\RoleViewController;
use App\Http\Controllers\Backend\Seo\SeoPageController;
use App\Http\Controllers\Backend\Shipping\ShippingChargeController;
use App\Http\Controllers\Backend\ShippingChargeController as BackendShippingChargeController;
use App\Http\Controllers\Backend\Shipping\ShippingMethodController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserViewController;
use App\Http\Controllers\Backend\WebSetting\AdvertisementController;
use App\Http\Controllers\Backend\WebSetting\BlockController;
use App\Http\Controllers\Backend\WebSetting\CompanyInfoController;
use App\Http\Controllers\Backend\WebSetting\FeatureSettingController;
use App\Http\Controllers\Backend\WebSetting\SliderController;
use App\Http\Controllers\Ecommerce\AuthController;
use App\Http\Controllers\Ecommerce\ShopController;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\CheckoutController;
use App\Http\Controllers\Ecommerce\MyAccount\MyAccountController;
use App\Http\Controllers\Ecommerce\MyAccount\MyAccountReturnProductController;
use App\Http\Controllers\Ecommerce\MyAccount\MyAccountCartController;
use App\Http\Controllers\Ecommerce\MyAccount\MyAccountTransactionController;
use App\Http\Controllers\Ecommerce\Wishlist\WishlistController;
use App\Http\Controllers\Frontend\OrderTracking\OrderTrackingController;
use App\Http\Controllers\FrontEnd\ReplyController;
use App\Http\Controllers\FrontEnd\ReviewController;
use App\Http\Controllers\Invoice\MyAccountInvoiceController;
use App\Http\Controllers\Language\LanguageController;
use App\Http\Controllers\Panel\AttributeController;
use App\Http\Controllers\Panel\AttributeValueController;
use App\Http\Controllers\Panel\ProductVariationController;
use App\Http\Controllers\Web\Panel\Coupon\CouponController;
use App\Http\Controllers\Web\Panel\Coupon\CouponProductController;
use App\Http\Controllers\Web\Panel\ShopSetting\ShopSettingCountryController;
use App\Http\Controllers\Web\Panel\ShopSetting\ShopSettingDistrictController;
use App\Http\Controllers\Web\Panel\ShopSetting\ShopSettingDivisionController;
use App\Http\Controllers\Web\Panel\ShopSetting\ShopSettingUpazilaController;
use App\Http\Controllers\API\Panel\User\Cart\CartController as APIUserCartController;
use App\Http\Controllers\API\Panel\User\Coupon\ApplyCouponController;
use App\Http\Controllers\API\Panel\User\UserInfoController;
use App\Http\Controllers\Backend\CatalogController;
use App\Http\Controllers\Backend\GiftCardController;
use App\Http\Controllers\Backend\Order\OrderEditController;
use App\Http\Controllers\Backend\RewardPointRuleController;
use App\Http\Controllers\Backend\ShippingInsideOutsideController;
use App\Http\Controllers\Backend\ShippingRateController;
use App\Http\Controllers\Backend\ShippingZoneController;
use App\Http\Controllers\Backend\ShippingZoneLocationController;
use App\Http\Controllers\Backend\View\GiftCardViewController;
use App\Http\Controllers\Backend\View\RewardPointRuleViewController;
use App\Http\Controllers\Backend\View\ShippingChargeViewController;
use App\Http\Controllers\Backend\View\ShippingRateViewController;
use App\Http\Controllers\Backend\View\ShippingZoneLocationViewController;
use App\Http\Controllers\Backend\View\ShippingZoneViewController;
use App\Http\Controllers\Ecommerce\PlaceOrderController;
use App\Http\Controllers\Ecommerce\UserAddressController;
use App\Http\Controllers\Ecommerce\UserRewardPointController;
use App\Http\Controllers\Panel\CourierController;
use App\Http\Controllers\SystemCacheController;
use App\Models\ShippingCharge;
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

Route::group(['middleware' => 'web'], function () {
    // Review
    Route::controller(ReviewController::class)->group(function () {
        Route::post('reviews/store', 'store')->name('reviews.store');
        Route::get('reviews/{product}', 'index')->name('reviews.index');
    });

    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::post('/update-product-status', [CartController::class, 'updateProductStatus'])->name('update-product-status');

    Route::get('/', function () {
        return view('auth.login');
    });

    // Language
    Route::get('lang/{lang}', [LanguageController::class, 'switchLang'])->name('lang.switch');

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/home/categories', [HomeController::class, 'loadCategories'])->name('home.categories');
    Route::get('/home/top-features', [HomeController::class, 'loadTopFeatures'])->name('home.top_features');
    Route::get('/home/feature-products', [HomeController::class, 'loadFeatureProducts'])->name('home.feature_products');

    Route::get('/get_sidebar_content', [HomeController::class, 'getSidebarContent'])->name('get_sidebar_content');
    Route::get('/check_sub_category', [HomeController::class, 'checkSubCategory'])->name('check_sub_category');
    Route::get('/get_sub_category', [HomeController::class, 'getSubCategory'])->name('get_sub_category');
    Route::get('/get_parent_category', [HomeController::class, 'getParentCategory'])->name('get_parent_category');
    Route::get('/catalog/{id}', [ShopController::class, 'shop'])->name('catalog');
    Route::get('product-search', [ShopController::class, 'searchProduct'])->name('product_search');
    Route::get('/catalog/{name?}', [ShopController::class, 'shop'])->name('catalog.show');
    Route::get('/get-main-content', [HomeController::class, 'getMainContent'])->name('get-main-content');
    Route::get('/search/{q?}', [ShopController::class, 'shopSearch'])->name('search');
    Route::get('shop/products', [ShopController::class, 'list'])->name('products.show');
    Route::get('product-details/{name?}/{seller_sku?}', [ProductDetailController::class, 'productDetail'])->name('products.details');
    Route::get('/categories/{category}/subcategories', [ShopController::class, 'getSubcategories']);

    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('get-district', [CheckoutController::class, 'getDistrict'])->name('get-district');
    Route::get('get-upazila', [CheckoutController::class, 'getUpazila'])->name('get-upazila');
    Route::get('get-union', [CheckoutController::class, 'getUnion'])->name('get-union');
    Route::post('confirm-order', [CheckoutController::class, 'confirmOrder'])->name('confirm_order');
    Route::post('save-shipping-address', [CheckoutController::class, 'addShippingAddress'])->name('save_shipping_address');
    Route::get('order-confirmation/{order}', [CheckoutController::class, 'showOrderConfirmation'])->name('order_confirmation');
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

    Route::group(['middleware' => 'auth'], function () {
        // My Account
        Route::controller(OrderTrackingController::class)->group(function () {
            Route::get('/orders-tracking/{id}', 'orderTracking')->name('orders.tracking');
        });
    });

    // Define the route for the calculateShippingCharge method
    Route::post('/calculate-shipping-charge', [ShippingChargeController::class, 'calculateShippingCharge'])->name('calculateShippingCharge');

    Route::group(['middleware' => 'auth'], function () {

        // Order
        Route::controller(PlaceOrderOrderController::class)->group(function () {
            Route::post('order-place', 'store')->name("order_place");
            Route::get('/user-orders/lists', 'lists')->name('user_orders.lists');
            Route::get('/user-orders/order-details', 'orderDetails')->name('user_orders.order_details');
        });

        // Order Notification
        Route::controller(OrderNotificationController::class)->group(function () {
            Route::get('order-notification', 'index')->name('order.notification');
        });

        // My Account Transaction
        Route::controller(MyAccountPaymentController::class)->group(function () {
            Route::get('my-payments', 'index')->name('my_payments');
        });

        // My Account Transaction
        Route::controller(MyAccountTransactionController::class)->group(function () {
            Route::get('my-trasaction', 'index')->name('my_trasaction');
        });

        Route::get('coupon-product-view', [CouponProductController::class, 'index'])->name('coupon_products.view');
        Route::get('coupons', [CouponController::class, 'index'])->name('coupons.view');
        Route::get('countries', [ShopSettingCountryController::class, 'index'])->name('countries.view');
        Route::get('divisions', [ShopSettingDivisionController::class, 'index'])->name('divisions.view');
        Route::get('districts', [ShopSettingDistrictController::class, 'index'])->name('districts.view');
        Route::get('upazilas', [ShopSettingUpazilaController::class, 'index'])->name('upazilas.view');

        // View Route
        Route::controller(CancelOrderController::class)->group(function () {
            Route::get('user-cancel-order/{code}', 'index')->name('user_cancel_order.view');
            Route::post('user-cancellation-product', 'storeOrUpdate')->name('user_cancellation_product');
        });

        // Manage Cancellation Order Product
        Route::controller(OrderProductReturnController::class)->group(function () {
            Route::get('return-product/{order}', 'index')->name('return_product');
        });

        // Manage Cancellation Order Product
        Route::controller(OrderProductCancellationController::class)->group(function () {
            Route::get('cancellation-product/{order}', 'index')->name('cancellation_product.show');
            Route::post('cancellation-product', 'storeOrUpdate')->name('cancellation_product');
        });

        // My account
        Route::controller(MyAccountController::class)->group(function () {
            Route::get('my-account', 'index')->name('my.account');
            Route::get('my-account-wishlist', 'wishlist')->name('my_account_wishlist');
        });

        // Wishlist
        Route::controller(WishlistController::class)->group(function () {
            Route::post('wishlist/add', 'addToWishlist');
            Route::post('wishlist/remove', 'removeFromWishlist');
            Route::get('wishlist', 'getWishlist');
            Route::get('/wishlist/count', 'getWishlistCount');
        });

        // My account
        Route::controller(MyAccountReturnProductController::class)->group(function () {
            Route::get('my-account/order-list', 'index')->name('my_account.order_list');
            Route::get('my-account/order-details/{order}', 'orderDetails')->name('my_account.order_details');
            Route::post('my-account/return-product', 'store')->name('my_account.return_product.store');
        });

        // My Account Cart
        Route::controller(MyAccountCartController::class)->group(function () {
            Route::get('my-account/cart', 'index')->name('my_account.cart');
        });

        // My Account Cart
        Route::controller(MyAccountWishlistController::class)->group(function () {
            Route::get('my-account/wishlist', 'index')->name('my_account.wishlist');
        });
    });

    //
    Route::group([], function () {
        Route::get('admin', [HomeController::class, 'adminDashboard'])->name('dashboard')->middleware(['auth:sanctum', 'verified']);
        // Route::middleware(['permission'])->group(function () {
        Route::get('users', UserViewController::class)->name('users.view');
        // });
        // User
        Route::controller(UserController::class)->group(function () {
            Route::get('users/lists', 'lists')->name('users.lists');
            Route::get('users/{user}', 'show')->name('users.show');
            Route::post('users', 'store')->name('users.store');
            Route::put('users/{user}', 'update')->name('users.update');
            Route::delete('users/{user}', 'destroy')->name('users.delete');
        });

        Route::get('roles', RoleViewController::class)->name('roles.view');

        //Role
        Route::controller(RoleController::class)->group(function () {
            Route::get('roles/lists', 'lists')->name('roles.lists');
            Route::get('roles/{role}', 'show')->name('roles.show');
            Route::post('roles', 'store')->name('roles.store');
            Route::put('roles/{role}', 'update')->name('roles.update');
            Route::delete('roles/{role}', 'destroy')->name('roles.delete');
            Route::post('role/set-selected-role', 'setSelectedRole')->name('roles.set_selected_role')->withoutMiddleware(['permission']);
            Route::get('permissions', 'permissions')->name('permissions.show');
            Route::get('role-permissions/{role}', 'getRolePermissions')->name('role_permissions');
            Route::put('assign-permissions/{role}', 'storeAssignPermission')->name('assign_permissions');
        });

        //Supplier
        Route::controller(SupplierController::class)->group(function () {
            Route::get('suppliers', 'index')->name("suppliers.index");
            Route::get('suppliers/lists', 'lists')->name("suppliers.lists");
            Route::get('suppliers/select-lists', 'selectLists')->name('suppliers.select_lists');
            Route::get('suppliers/{user}', 'show')->name("suppliers.show");
            Route::post('suppliers', 'store')->name("suppliers.store");
            Route::put('suppliers/{user}', 'update')->name("suppliers.update");
            Route::delete('suppliers', 'destroy')->name("suppliers.delete");
        });

        //Purchase
        Route::controller(PurchaseController::class)->group(function () {
            Route::get('purchases', 'index')->name("purchases.index");
            Route::get('purchases/{purchase}', 'show')->name("purchases.show");
            Route::post('purchases', 'store')->name("purchases.store");
            Route::put('purchases/{purchase}', 'update')->name("purchases.update");
            Route::delete('purchases', 'destroy')->name("purchases.delete");
        });

        // Shipping Method
        Route::controller(ShippingMethodController::class)->group(function () {
            Route::get('/shipping_methods', 'index')->name('shipping_methods.index');
            Route::patch('/shipping_methods/{shippingMethod}', 'update')->name('shipping_methods.update');
            Route::get('/shipping_method_setting', 'setting')->name('shipping_method_setting.index');
            Route::patch('/shipping_methods/{shippingMethod}/update_status', 'updateStatus')->name('shipping_methods.update_status');
        });

        // SeoPage
        Route::controller(SeoPageController::class)->group(function () {
            Route::get('/seo-pages', 'index')->name('seo-pages.index');
            Route::get('/seo-pages-create', 'create')->name('seo_pages_create');
            Route::post('/seo-pages', 'store')->name('seo-pages.store');
            Route::get('/seo-pages/{seoPage}/edit', 'edit')->name('seo-pages.edit');
            Route::post('/seo-pages/{seoPage}', 'update')->name('seo-pages.update');
            Route::delete('/seo-pages/{seoPage}', 'destroy')->name('seo-pages.destroy');
        });

        // Customer
        Route::controller(CustomerController::class)->group(function () {
            Route::get('manage-customer', 'manageCustomer')->name('manage.customer');
            Route::get('customers-search', 'search')->name('customers.search');
            Route::get('all-customers-search', 'allCustomerSearch')->name('all.customers.search');
            Route::get('customers-profile/{user}', 'profile')->name('customers.profile');
            Route::put('/customers/{id}/customer-status', 'customerStatus')->name('customers.customerStatus');
            Route::get('all-customer', 'allCustomerIndex')->name('all.customer');
            Route::delete('/customers/{user}', 'destroy')->name('customers.delete');
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

        // Start All Order
        Route::controller(AllOrderController::class)->group(function () {
            Route::get('all-order', 'index')->name('all-order');
            Route::get('advance-edit', 'advanceEdit')->name('advance.edit');
            Route::post('/cancel-order/advance-edit/{order}', 'cancelOrder')->name('cancel_order.advance_edit');
            Route::post('/confirm-order/{order}', 'confirmOrder')->name('confirm.order');
            Route::post('/track-status/{order}', 'createUpdateStatus')->name('track_status.order');
            Route::post('/order-note/{order}', 'orderNote')->name('order.note');
            Route::post('/order-payment/{order}', 'orderPaymentStatus')->name('order_payment.status');
            Route::post('/order-payment-submit/{order}', 'orderPaymentSave')->name('order_payment.submit');
            Route::post('/order-payment-note-submit/{order}', 'orderNotePaymentSave')->name('order_payment_note.submit');
            Route::post('/order-fulfilment-note-submit/{order}', 'orderFulfilmentNotetSave')->name('order_fulfilment_note.submit');
            Route::post('/order-package-submit/{order}', 'orderPackageSave')->name('order_package.submit');
            Route::get('/generate-package_barcodes/{order}', 'generatePackageBarcodes')->name('package_barcodes.barcodes');
            Route::post('/update-order-address', 'updateOrderAddress')->name('.submit');
        });
        // End All Order

        // Order Start
        Route::controller(OrderController::class)->group(function () {
            Route::get('pending-order', 'pendingOrderPage')->name('pending-order');
            Route::get('processing-order', 'processingOrderPage')->name('processing-order');
            Route::get('shipped-order', 'shippedOrderPage')->name('shipped-order');
            Route::get('in_transit-order', 'inTransitOrderPage')->name('in_transit-order');
            Route::get('arrival_at_distribution_center-order', 'arrivalAtDistributionCenterOrderPage')->name('arrival_at_distribution_center-order');
            Route::get('out_for_delivery-order', 'outForDeliveryOrderPage')->name('out_for_delivery-order');
            Route::get('delivery_attempted-order', 'deliveryAttemptedOrderPage')->name('delivery_attempted-order');
            Route::get('delivery_rescheduling-order', 'deliveryReschedulingOrderPage')->name('delivery_rescheduling-order');
            Route::get('delivered-order', 'deliveredOrderPage')->name('delivered-order');
            Route::get('payment_collected-order', 'paymentCollectedOrderPage')->name('payment_collected-order');
            Route::get('completed-order', 'completedOrderPage')->name('completed-order');
            Route::get('hold-order', 'holdOrderPage')->name('hold-order');
            Route::get('failed-order', 'failedOrderPage')->name('failed-order');
            Route::get('cancelled-order', 'cancelledOrderPage')->name('cancelled-order');
            Route::get('returned-order', 'returnedOrderPage')->name('returned-order');
            Route::get('refunded-order', 'refundedOrderPage')->name('refunded-order');
            Route::get('pre_order-order', 'preOrderOrderPage')->name('pre_order-order');
            Route::get('backordered-order', 'backOrderedOrderPage')->name('backordered-order');
            Route::get('partially_shipped-order', 'partiallyShippedOrderPage')->name('partially_shipped-order');
            Route::get('order_data', 'orderData')->name('order_data');
            Route::get('order-detail', 'orderDetail')->name('order-detail');
            Route::get('/orders/{order}', 'destroy')->name('orders.destroy');
            Route::get('/invoices-detail', 'invoicesDetail')->name('invoices-detail');
            Route::get('confirm-order', 'confirmOrderShow')->name('confirm-order');
            Route::get('cancel-order', 'cancelOrderShow')->name('cancel-order');
            Route::get('/generate-barcodes', 'generateBarcodes')->name('generate.barcodes');
            Route::get('/orders/{order}/track', 'getOrderWithTracking')->name('orders.track');
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
                Route::post('title', [CompanyInfoController::class, 'Title'])->name('add.title');
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

        // Attribute
        Route::group(
            [],
            function () {
                Route::get('attribute', [AttributeController::class, 'index'])->name('attribute');
                Route::post('add-attribute', [AttributeController::class, 'addAttribute'])->name('add.attribute');
                Route::post('delete-attribute', [AttributeController::class, 'deleteAttribute'])->name('delete.attribute');
                Route::get('pagination/attribute-pagination-data', [AttributeController::class, 'pagination']);
                Route::get('search-attribute', [AttributeController::class, 'searchAttribute'])->name('search.attribute');
            }
        );
        // Attribute

        // Attribute Value
        Route::group(
            [],
            function () {
                Route::get('attribute-value', [AttributeValueController::class, 'index'])->name('attribute-value');
                Route::post('add-attribute-value', [AttributeValueController::class, 'addAttributeValue'])->name('add.attribute_value');
                Route::post('delete-attribute-value', [AttributeValueController::class, 'deleteAttributeValue'])->name('delete.attribute_value');
                Route::get('pagination/attribute-value-pagination-data', [AttributeValueController::class, 'pagination']);
                Route::get('attribute.hierarchy', [AttributeValueController::class, 'attributeHierarchy'])->name('attribute_value.hierarchy');
                Route::get('attribute_value', [AttributeValueController::class, 'searchAttributeValue'])->name('search.attribute_value');
            }
        );
        // Attribute Value

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
                Route::post('/generate-sku', [ProductController::class, 'generateSku'])->name('generate.sku');
                Route::post('add-product_identity', [ProductController::class, 'addProductIdentity'])->name('add.product_identity');
                Route::post('add-vital_info', [ProductController::class, 'addVitalInfo'])->name('add.vital_info');
                Route::post('add-add_product_detail_info', [ProductController::class, 'addProductDetailInfo'])->name('add.add_product_detail_info');
                Route::post('add-add_product_image_info', [ProductController::class, 'addProductImageInfo'])->name('add.add_product_image_info');
                Route::post('add-add_product_description_info', [ProductController::class, 'addProductDescriptionInfo'])->name('add.add_product_description_info');
                Route::post('add-add_product_keyword', [ProductController::class, 'addProductKeywordInfo'])->name('add.add_product_keyword');
                Route::post('add-add_product_compliance', [ProductController::class, 'addProductComplianceInfo'])->name('add.add_product_compliance');
                Route::post('add-add_product_more_detail', [ProductController::class, 'addProductMoreDetailInfo'])->name('add.add_product_more_detail');
                Route::post('add-add_variant_variant', [ProductController::class, 'addProductVariantInfo'])->name('add.add_variant_variant');
                Route::post('/product/save', [ProductController::class, 'saveProduct'])->name('product.save');

                // Product Variation
                Route::post('products/variations', [ProductVariationController::class, 'storeVariations'])->name('products.store-variations');
                Route::post('delete-product', [ProductController::class, 'deleteProduct'])->name('delete.product');
                Route::post('product-stock-qty', [ProductController::class, 'updateStockQty'])->name('product_stock_qty.update');
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

        Route::prefix('shipping-charges')->group(function () {
            Route::get('/', [BackendShippingChargeController::class, 'index'])->name('shipping-charges.index');
            Route::get('/{id}', [BackendShippingChargeController::class, 'show'])->name('shipping-charges.show');
            Route::post('/', [BackendShippingChargeController::class, 'store'])->name('shipping-charges.store');
            Route::put('/{id}', [BackendShippingChargeController::class, 'update'])->name('shipping-charges.update');
            Route::delete('/{id}', [BackendShippingChargeController::class, 'destroy'])->name('shipping-charges.destroy');
        });

        Route::prefix('admin')->group(function () {
            Route::get('/shipping-zones', [ShippingZoneController::class, 'index']);
            Route::get('/shipping-zones/select-lists', [ShippingZoneController::class, 'selectLists']);
            Route::get('/shipping-zones/{id}', [ShippingZoneController::class, 'show']);
            Route::post('/shipping-zones', [ShippingZoneController::class, 'store']);
            Route::put('/shipping-zones/{id}', [ShippingZoneController::class, 'update']);
            Route::put('/shipping-zone-status/{id}', [ShippingZoneController::class, 'updateStatus']);
            Route::delete('/shipping-zones/{id}', [ShippingZoneController::class, 'destroy']);
        });

        Route::prefix('admin')->group(function () {
            Route::get('/shipping-zone-locations', [ShippingZoneLocationController::class, 'index']);
            Route::get('/shipping-zone-locations/create', [ShippingZoneLocationController::class, 'create']);
            Route::post('/shipping-zone-locations/store', [ShippingZoneLocationController::class, 'store']);
            Route::delete('/shipping-zone-locations/{id}', [ShippingZoneLocationController::class, 'destroy']);
        });

        Route::prefix('admin')->group(function () {
            // shipping rates (non inside_outside)
            Route::get('/shipping-rates', [ShippingRateController::class, 'index']);
            Route::get('/shipping-rates/{id}', [ShippingRateController::class, 'show']);
            Route::post('/shipping-rates', [ShippingRateController::class, 'store']);
            Route::put('/shipping-rates/{id}', [ShippingRateController::class, 'update']);
            Route::delete('/shipping-rates/{id}', [ShippingRateController::class, 'destroy']);
            Route::get('/shipping-rates/by-zone/{zone}', [ShippingRateController::class, 'byZone']);

            // inside/outside
            Route::get('/shipping-inside-outside/{zoneId}', [ShippingInsideOutsideController::class, 'showByZone']);
            Route::post('/shipping-inside-outside', [ShippingInsideOutsideController::class, 'storeOrUpdate']);
        });

        Route::controller(CourierController::class)->group(function () {
            Route::post('couriers/{order}/send', 'sendOrder')->name('couriers.sendOrder');
            Route::get('couriers/check-status/{order}', 'checkStatus')->name('couriers.checkStatus');
        });

        Route::prefix('orders')->group(function () {
            Route::put('edit-address/{order}', [OrderEditController::class, 'updateAddress'])->name('orders.edit.updateAddress');
            Route::put('edit-items/{order}', [OrderEditController::class, 'updateItems'])->name('orders.edit.updateItems');
        });

        // Catalog
        Route::controller(CatalogController::class)->group(function () {
            Route::post('export/facebook-catalog', 'export')->name('facebook.catalog.export');
        });
    });

    // Review
    Route::controller(MyAccountInvoiceController::class)->group(function () {
        Route::get('/my-orders/invoice/{order}', 'orderInvoice')->name('my_order.invoice');
    });

    // Order Payment
    Route::controller(OrderPaymentController::class)->group(function () {
        Route::get('order-payments/{order}', 'show')->name("order_payments.show");
        Route::post('order-payments', 'store')->name("order_payments.store");
    });

    // Cart Drawer
    Route::controller(CartDrawerController::class)->group(function () {
        Route::get('cart-drawer/list', 'index')->name('cart-drawer.list');
        Route::get('cart-drawer/count', 'count')->name('cart-drawer.count');
    });

    // User Cart Item Controller
    Route::controller(UserCartItemController::class)->group(function () {
        Route::get('cart-items/list', 'list')->name('cart-items.list');
        Route::post('cart-items/store', 'store')->name('cart-items.store');
        Route::put('cart-items/{cartItem}', 'updateQuantity')->name('cart-items.update');
        Route::put('cart-item-toggle-active/{cartItem}', 'updateIsActive')->name('cart-items.toggle-active');
        Route::delete('cart-items/{cartItem}', 'destroy')->name('cart_items.destroy');
    });

    // Checkout Cart
    Route::controller(APIUserCartController::class)->group(function () {
        Route::get('checkout/cart/lists', 'getCheckoutCart')->name('checkout_cart_lists');
        Route::get('cart/lists', 'getCart');
    });

    Route::controller(PlaceOrderController::class)->group(function () {
        Route::post('place-order', 'placeOrder')->name('place_order');
    });

    Route::controller(UpazilaController::class)->group(function () {
        Route::get('areas-select/lists', 'lists')->name('districts.lists');
        Route::get('upazila-select/lists', 'shippingZoneWiseUpazilas')->name('upazilas.lists');
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

    Route::controller(AddressController::class)->group(function () {});

    Route::controller(UserAddressController::class)->group(function () {
        Route::get('user-address/lists', 'list')->name('user_address.lists');
        Route::get('/user-address/set-default/{userAddress}', 'setDefault')->name('user_address.set_default');
        Route::post('/user-address/store-or-update', 'storeOrUpdate');
        Route::get('/user-address/{id}', 'show');
        Route::get('/user-address-default', 'default');
        Route::delete('user-address/{userAddress}', 'destroy')->name('user_address.destroy');
    });

    Route::controller(UserInfoController::class)->group(function () {
        Route::get('user-info', 'userInfo')->name("user_info");
        Route::put('update-profile-photo/{user}', 'update')->name("update_profile_photo");
    });

    Route::controller(ProductDetailController::class)->group(function () {
        Route::get('products', 'index')->name("products.index");
    });

    // Reward Point
    Route::controller(RewardPointRuleViewController::class)->group(function () {
        Route::get('reward-point-rule-view', 'index')->name('reward_point_rules.view');
    });

    // Shipping Zone View
    Route::controller(ShippingZoneViewController::class)->group(function () {
        Route::get('shipping-zones', 'index')->name('shipping_zones.view');
    });

    // Shipping Zone Location View
    Route::controller(ShippingZoneLocationViewController::class)->group(function () {
        Route::get('shipping-zone-locations', 'index')->name('shipping_zone_locations.view');
    });

    // Shipping Rate View
    Route::controller(ShippingRateViewController::class)->group(function () {
        Route::get('shipping-rates', 'index')->name('shipping_rates.view');
    });


    // Reward Point
    Route::controller(RewardPointRuleController::class)->group(function () {
        Route::get('reward-point-rules', 'index')->name("reward_point_rules.index");
        Route::put('reward-point-rules/update-status/{categoryId}', 'updateStatus')->name("reward_point_rules.update_status");
        Route::get('reward-point-rules/{rewardPointRule}', 'show')->name("reward_point_rules.show");
        Route::post('reward-point-rules', 'store')->name("reward_point_rules.store");
        Route::put('reward-point-rules/{rewardPointRule}', 'update')->name("reward_point_rules.update");
        Route::put('reward-point-rule-status/{rewardPointRule}', 'statusUpdate')->name('reward_point_rules.update_status');
        Route::delete('reward-point-rules/{rewardPointRule}', 'destroy')->name("reward_point_rules.destroy");
    });

    // Gift Card
    Route::controller(GiftCardViewController::class)->group(function () {
        Route::get('gift-card-view', 'index')->name('gift_cards.view');
    });

    // Reward Point
    Route::controller(GiftCardController::class)->group(function () {
        Route::get('gift-cards', 'index')->name("gift_cards.index");
        Route::put('gift-cards/update-status/{categoryId}', 'updateStatus')->name("gift_cards.update_status");
        Route::get('gift-cards/{rewardPointRule}', 'show')->name("gift_cards.show");
        Route::post('gift-cards', 'store')->name("gift_cards.store");
        Route::put('gift-cards/{rewardPointRule}', 'update')->name("gift_cards.update");
        Route::delete('gift-cards/{rewardPointRule}', 'destroy')->name("gift_cards.destroy");
    });

    // Reward Point
    Route::controller(UserRewardPointController::class)->group(function () {
        Route::get('user-reward-point', 'userRewardPoint')->name('user_reward_point');
        Route::get('user-reward-point-summary', 'summary')->name('user_reward_point_summary');
    });

    // Coupon Settings
    Route::controller(ApplyCouponController::class)->group(function () {
        Route::post('coupon-apply', 'apply')->name("coupon_apply");
    });

    // System Cache Controller
    Route::controller(SystemCacheController::class)->group(function () {
        Route::post('system-cache/clear', 'clear')->name('system-cache.clear');
    });
});
