<?php

use App\Http\Controllers\DatatableController;
use App\Http\Controllers\FrontEnt\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontEnt\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Backend\Product\UnitController;
use App\Http\Controllers\Backend\Product\VariantController;

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
        Route::get('product-unit', [UnitController::class, 'index'])->name('product-unit');
        Route::post('add-unit', [UnitController::class, 'addUnit'])->name('add.unit');
        Route::post('delete-unit', [UnitController::class, 'deleteUnit'])->name('delete.unit');
        Route::get('pagination/unit-pagination-data', [UnitController::class, 'pagination']);
        Route::get('search-unit', [UnitController::class, 'searchUnit'])->name('search.unit');
        // Unit Start

        // Unit Start
        Route::get('product-variant', [VariantController::class, 'index'])->name('product-variant');
        Route::post('add-variant', [VariantController::class, 'addVariant'])->name('add.variant');
        Route::post('delete-variant', [VariantController::class, 'deleteVariant'])->name('delete.variant');
        Route::get('pagination/variant-pagination-data', [VariantController::class, 'pagination']);
        Route::get('search-variant', [VariantController::class, 'searchVariant'])->name('search.variant');
        // Unit Start
    
    Route::group(['prefix' => 'member', 'middleware' => ['auth']], function () {

        // Start Report
        Route::group(['prefix' => 'report', 'as' => 'report.'], function () {

            Route::get('purchase-report-new', [ReportController::class, 'PurchaseReport'])->name('purchase-report-new');
            Route::get('purchase-report-data', [ReportController::class, 'PurchaseReportDate'])->name('purchase-report-data');

            Route::get('sale-report-new', [ReportController::class, 'SaleReport'])->name('sale-report-new');
            Route::get('sale-report-data', [ReportController::class, 'SaleReportData'])->name('sale-report-data');

            Route::get('purchase-details-report-new', [ReportController::class, 'PurchaseDetailReport'])->name('purchase-details-report-new');
            Route::get('purchase-details-report-data', [ReportController::class, 'PurchaseDetailReportData'])->name('purchase-details-report-data');

            Route::get('cash-bank-book-report-new', [ReportController::class, 'CashBankBookReport'])->name('cash-bank-book-report-new');
            Route::get('cash-bank-book-report-data', [ReportController::class, 'CashBankBookReportData'])->name('cash-bank-book-report-data');

            Route::get('sale-details-report-new', [ReportController::class, 'SaleDetailReport'])->name('sale-details-report-new');
            Route::get('sale-details-report-data', [ReportController::class, 'SaleDetailReportData'])->name('sale-details-report-data');

            Route::get('stock-report-new', [ReportController::class, 'StockReport'])->name('stock-report-new');
            Route::get('stock-report-data', [ReportController::class, 'StockReportData'])->name('stock-report-data');

            Route::get('customer-ledger-report-new', [ReportController::class, 'CustomerLedgerReport'])->name('customer-ledger-report-new');
            Route::get('customer-ledger-report-data', [ReportController::class, 'CustomerLedgerReportData'])->name('customer-ledger-report-data');

            Route::get('supplier-ledger-report-new', [ReportController::class, 'SupplierLedgerReport'])->name('supplier-ledger-report-new');
            Route::get('supplier-ledger-report-data', [ReportController::class, 'SupplierLedgerReportData'])->name('supplier-ledger-report-data');

            Route::get('customer-due-report-new', [ReportController::class, 'CustomerDueReport'])->name('customer-due-report-new');
            Route::get('customer-due-report-data', [ReportController::class, 'CustomerDueReportData'])->name('customer-due-report-data');

            Route::get('supplier-due-report-new', [ReportController::class, 'SupplierDueReport'])->name('supplier-due-report-new');
            Route::get('supplier-due-report-data', [ReportController::class, 'SupplierDueReportData'])->name('supplier-due-report-data');

            Route::get('profit-loss-report-new', [ReportController::class, 'ProfitLossReport'])->name('profit-loss-report-new');
            Route::get('profit-loss-report-data', [ReportController::class, 'ProfitLossReportData'])->name('profit-loss-report-data');

            Route::get('receivable-report-new', [ReportController::class, 'ReceivableReport'])->name('receivable-report-new');
            Route::get('receivable-report-data', [ReportController::class, 'ReceivableReportData'])->name('receivable-report-data');

            Route::get('payable-report-new', [ReportController::class, 'PayableReport'])->name('payable-report-new');
            Route::get('payable-report-data', [ReportController::class, 'PayableReportData'])->name('payable-report-data');
        });
        // End Report
        Route::group(['prefix' => 'data', 'as' => 'data.'], function () {
            Route::get('category_table', [DatatableController::class, 'CategoryTable'])->name('category_table');
            Route::get('sub_category_table', [DatatableController::class, 'SubCategoryTable'])->name('sub_category_table');
            Route::get('sub_sub_category_table', [DatatableController::class, 'SubSubCategoryTable'])->name('sub_sub_category_table');
            Route::get('product_table', [DatatableController::class, 'ProductTable'])->name('product_table');
            Route::get('branch_table', [DatatableController::class, 'BranchTable'])->name('branch_table');
            Route::get('currency_table', [DatatableController::class, 'CurrencyTable'])->name('currency_table');
            Route::get('delivery_method_table', [DatatableController::class, 'DeliveryMethodTable'])->name('delivery_method_table');
            Route::get('warehouse_table', [DatatableController::class, 'WarehouseTable'])->name('warehouse_table');
            Route::get('unit_table', [DatatableController::class, 'UnitTable'])->name('unit_table');
            Route::get('feature_product_table', [DatatableController::class, 'FeatureProductTable'])->name('feature_product_table');
            Route::get('slider_table', [DatatableController::class, 'SliderTable'])->name('slider_table');
            Route::get('brand_table', [DatatableController::class, 'BrandTable'])->name('brand_table');
            Route::get('invoiceSetting_table', [DatatableController::class, 'InvoiceSettingTable'])->name('invoiceSetting_table');
            Route::get('vat_table', [DatatableController::class, 'VatTable'])->name('vat_table');
            Route::get('shipping_charge', [DatatableController::class, 'ShippingChargeTable'])->name('shipping_charge');
            Route::get('coupon_table', [DatatableController::class, 'CouponTable'])->name('coupon_table');
            Route::get('paymentMethod_table', [DatatableController::class, 'paymentMethodTable'])->name('paymentMethod_table');
            Route::get('invoiceSave', [DatatableController::class, 'InvoiceTable'])->name('invoiceSave');
            Route::get('customer_table', [DatatableController::class, 'CustomerTable'])->name('customer_table');
            Route::get('supplier_table', [DatatableController::class, 'SupplierTable'])->name('supplier_table');
            Route::get('staff_table', [DatatableController::class, 'StaffTable'])->name('staff_table');
            Route::get('contact_category_table', [DatatableController::class, 'ContactCategoryTable'])->name('contact_category_table');
            Route::get('purchase_list', [DatatableController::class, 'PurchaseListTable'])->name('purchase_list');
            Route::get('sale_list', [DatatableController::class, 'SaleListTable'])->name('sale_list');
            Route::get('news_list', [DatatableController::class, 'NewsListTable'])->name('news_list');
            Route::get('language_list', [DatatableController::class, 'LanguageListTable'])->name('language_list');
            Route::get('manage_language_list', [DatatableController::class, 'LanguageListTable'])->name('manage_language_list');
            Route::get('vendor_table', [DatatableController::class, 'VendorListTable'])->name('vendor_table');
            Route::get('vendor_approved_table', [DatatableController::class, 'VendorApprovedListTable'])->name('vendor_approved_table');
            Route::get('vendor_cancel_table', [DatatableController::class, 'VendorCancelListTable'])->name('vendor_cancel_table');
            Route::get('all_user_table', [DatatableController::class, 'AllUserList'])->name('all_user_table');
            Route::get('offer_table', [DatatableController::class, 'OfferList'])->name('offer_table');
        });
    });
});