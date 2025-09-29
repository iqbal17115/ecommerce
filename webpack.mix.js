const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);

if (mix.inProduction()) {
    mix.version();
}

// ---------------------------
// ✅ Page-specific JS Bundles
// ---------------------------

// Home Page Bundle
mix.js([
    './resources/js/panel/users/common.js',
    './resources/js/panel/users/cart/add_to_cart.js',
    './resources/js/panel/users/cart/cart_manager.js',
    './resources/js/panel/users/cart/cart_drawer.js',
    './resources/js/panel/users/cart/cart_list.js'
], 'public/js/home.bundle.js');

// Checkout Page Bundle
mix.js([
    './resources/js/panel/users/common.js',
    './resources/js/panel/users/cart/cart_manager.js',
    './resources/js/panel/users/cart/cart_drawer.js',
    './resources/js/panel/users/cart/cart_active_item_list.js',
    './resources/js/address.js',
    './resources/js/panel/users/checkout/place_order.js',
    './resources/js/panel/users/apply_coupon.js'
], 'public/js/checkout.bundle.js');

// Cart Page Bundle
mix.js([
    './resources/js/panel/users/cart/add_to_cart.js',
    './resources/js/panel/users/cart/cart_manager.js',
    './resources/js/panel/users/cart/cart_drawer.js',
    './resources/js/panel/users/cart/cart_list.js'
], 'public/js/cart.bundle.js');


// ---------------------------
// Versioning for cache-busting in production
// ---------------------------
if (mix.inProduction()) {
    mix.version();
}