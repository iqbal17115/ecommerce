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
  @yield('meta')

  
    @include('layouts.partials.gtm-head')
  <!-- Favicon -->
  @if ($company_info && $company_info->icon)
  <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $company_info->icon) }}">
  @endif
  @include('layouts.parts.css-links')
  <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
  @stack('css')

      {!! $companyInfo->header_code ?? '' !!}
      22222222
</head>

<body>
      @include('layouts.partials.gtm-body')
<!-- 
  <div id="loader-overlay">
    <div id="loader">
      <img class="lazy-load" data-src="{{ asset('images/spinner.png') }}">
    </div>
  </div> -->
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

  <a id="whatsapp-contact" href="https://wa.me/8801727265200?text=Hi%20there!" target="_blank" title="Contact on WhatsApp" role="button">
    <i class="fab fa-whatsapp"></i>
  </a>

  <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

  @include('layouts.parts.js-links')

  <!-- <script src="{{ asset('js/ajax_setup.js') }}"></script> -->

  @stack('scripts')

  {!! $companyInfo->footer_code ?? '' !!}
</body>

</html>