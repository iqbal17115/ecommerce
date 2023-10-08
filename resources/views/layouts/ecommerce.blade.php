<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
            {!! strip_tags($company_info?->title) !!}
    </title>

    <meta name="description" content="{{ htmlspecialchars(strip_tags($company_info?->description)) }}">
    <meta name="keywords" content="{{ htmlspecialchars($company_info?->key_word) }}">



    <meta name="author" content="SW-THEMES">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type='application/ld+json'>
        {
          "@context": "http://www.schema.org",
          "@type": "ShoppingCenter",
          "name": "Aladdinne.com",
          "url": "https://www.aladdinne.com/",
          "logo": "https://www.aladdinne.com/storage/company_info/logos/Lpzoe54rj1p8i4K6mpwVRIxdPmS6CSfP59liCSyR.png",
          "image": "https://www.aladdinne.com/storage/company_info/logos/Lpzoe54rj1p8i4K6mpwVRIxdPmS6CSfP59liCSyR.png",
          "description": "Aladdinne is an e-commerce marketplace platform that connects multiple buyers and sellers to facilitate buyers and sellers both by the buying and selling of a wide range of products and services in our marketplace, such as big brands selling items ranging from electronics, Fashion, home Decor & appliances, gadgets, garden supplies, groceries, etc. Aladdinne provides service through the aladdinne.com website, mobile app, and other platforms.",
          "address": {
            "@type": "PostalAddress",
            "streetAddress": "Office No:523, 5th Floor, Alpona Plaza",
            "addressLocality": "Dhaka",
            "addressRegion": "Dhaka",
            "postalCode": "1205",
            "addressCountry": "Bangladesh"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": "23.7386671",
            "longitude": "90.381785"
          },
          "hasMap": "https://www.google.com/maps/search/https:%2F%2Fwww.google.com%2Fmaps%2Fplace%2FAladdinne.com%2F@23.7386622,90.3843599,15z%2Fdata%3D!4m6!3m5!1s0x3755b9ecc12ae8c5:0x29d5b7fd67107fe5!8m2!3d23.7386622!4d90.3843599!16s%252Fg%252F11tcg4q1dx/@23.7386671,90.381785,17z/data=!3m1!4b1",
          "openingHours": "Mo, Tu, We, Th, Fr, Sa, Su 08:00-17:00",
          "contactPoint": {
            "@type": "ContactPoint",
            "contactType": "support @aladdinne.com",
            "telephone": "+8801975340753"
          }
        }
    </script>

    <!-- Favicon -->
    @if ($company_info && $company_info->icon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $company_info->icon) }}">
    @endif
    @include('layouts.parts.css-links')
    @stack('css')
</head>

<body>

    <!-- Scroll-top-end-->
    <div class="page-wrapper">
        <!-- header-area -->
        @include('ecommerce.header')
        <!-- header-area-end -->

        <!-- main-area -->
        @yield('content')
        <!-- main-area-end -->

    </div>

    <!-- Start Mobile Responseive Footer -->
    @include('ecommerce.mobile-responsive-footer')
    <!-- Start Mobile Responseive Footer -->

    @include('ecommerce.mobile-menu-container')

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    @include('layouts.parts.js-links')
    @stack('scripts')
</body>

</html>
