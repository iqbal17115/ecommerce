<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Aladdinne</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Aladdinne">
    <meta name="author" content="SW-THEMES">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    @if ($company_info && $company_info->icon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $company_info->icon) }}">
    @endif


   @include('layouts.parts.css-links')

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
<!-- Code to load after rendering content -->
@yield('after-content')
    </div>

    <!-- Start Mobile Responseive Footer -->
    @include('ecommerce.mobile-responsive-footer')
    <!-- Start Mobile Responseive Footer -->



    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

    @include('layouts.parts.js-links')
    @stack('scripts')

</body>

</html>
