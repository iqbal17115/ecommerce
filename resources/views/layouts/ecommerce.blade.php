<!doctype html>

<head>

<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Porto - Bootstrap eCommerce Template</title>

    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Bootstrap eCommerce Template">
    <meta name="author" content="SW-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('aladdinne/assets/images/icons/favicon.png') }}"">


    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700,800,400italic,800italic', 'Poppins:300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = 'assets/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/css/demo36.min.css">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('aladdinne/') }}/assets/vendor/fontawesome-free/css/all.min.css">
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


    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>

<!-- Plugins JS File -->
<script src="{{ URL::asset('aladdinne/') }}/assets/js/jquery.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/optional/isotope.pkgd.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/plugins.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/jquery.appear.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/jquery.plugin.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/jquery.countdown.min.js"></script>

<!-- Main JS File -->
<script src="{{ URL::asset('aladdinne/') }}/assets/js/main.min.js"></script>

    <script>
        $.ajaxSetup({
            crossDomain: true,
            xhrFields: {
                withCredentials: true
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

</body>

</html>
