<!doctype html>

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
    @if($company_info && $company_info->icon)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/'.$company_info->icon) }}">
    @endif

    <script>
    WebFontConfig = {
        google: {
            families: ['Open+Sans:300,400,600,700,800,400italic,800italic', 'Poppins:300,400,500,600,700,800',
                'Oswald:300,400,500,600,700,800'
            ]
        }
    };
    // (function(d) {
    //     var wf = d.createElement('script'),
    //         s = d.scripts[0];
    //     wf.src = 'assets/js/webfont.js';
    //     wf.async = true;
    //     s.parentNode.insertBefore(wf, s);
    // })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/css/demo36.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('aladdinne/') }}/assets/vendor/fontawesome-free/css/all.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/css/style.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('aladdinne/') }}/assets/vendor/fontawesome-free/css/all.min.css">
    <style>
    .owl-dots {
        display: none;
    }

    .slider_image {
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;

    }

    /* For Large View */
    @media screen and (min-width: 1920px) {
        .slider_image {
            height: 320px;
        }
    }


    /* For Desktop View */
    @media screen and (min-width: 1024px) {
        .slider_image {
            height: 290px;
        }
    }

    /* For Tablet View */
    @media screen and (min-device-width: 768px) and (max-device-width: 1024px) {
        .slider_image {
            height: 240px;
        }
    }

    @media screen and (max-device-width: 767px) {
        .slider_image {
            height: 180px;
        }
    }

    /* Sidebar */
    #sidebar-wrapper {
        z-index: 10;
        position: absolute;
        width: 0;
        min-height: 100% !important;
        height: 100vh;
        overflow-y: hidden;
        background: #fff;
        /* opacity: 0.9; */
        transition: all .5s;
        display: flex;
        overflow: scroll;
        /* align-items:center; */
    }

    /* Main Content */
    #page-content-wrapper {
        width: 100%;
        position: absolute;
        padding: 15px;
        transition: all .5s;
    }

    #menu-toggle {
        transition: all .3s;
        /* font-size:2em; */
    }

    /* Change the width of the sidebar to display it*/
    #wrapper.menuDisplayed #sidebar-wrapper {
        width: 310px;
    }

    #wrapper.menuDisplayed #page-content-wrapper {
        padding-left: 250px;
    }

    /* Sidebar styling */
    .sidebar-nav {
        padding: 0;
        list-style: none;
        transition: all .5s;
        width: 100%;
        /* text-align: center; */
    }

    .sidebar-nav li {
        line-height: 20px;
        width: 100%;
        transition: all .3s;
        padding: 10px;
    }

    .sidebar-nav li a {
        display: block;
        text-decoration: none;
        color: #000000;
    }

    .sidebar-nav li:hover {
        /* background: #846bab; */
    }

    .arrow {
        border: solid #707070;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 4px;
        margin-top: 3px;
        align-items: flex-end;
    }

    .right {
        transform: rotate(-45deg);
        -webkit-transform: rotate(-45deg);
    }

    @media (min-width: 992px) {
        .mobile-sidebar-menu {
            display: none;
        }
    }

    body {
        font-family: 'Roboto', sans-serif;
    }
  
    </style>
    <!-- <script src="jquery-3.6.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->

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

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->

    <script>
    $(document).ready(function() {
        $(".menu-toggle").click(function(e) {
            e.preventDefault();
            $("#sidebar-wrapper").css("width", "320px");
            $("#wrapper").toggleClass("menuDisplayed");
        });
    });
    </script>
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