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
        body {
            top: 0px !important;
            position: static !important;
        }

        .goog-te-banner-frame {
            display: none !important
        }

        .goog-te-combo {
            background-color: #f4631b;
            color: white;
            padding: 8px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            outline: none;
            /* Add this line to remove the outline */
        }

        .goog-te-combo option {
            background-color: white;
            color: #333;
        }

        .goog-te-gadget {
            color: #040f1c00;
        }

        .goog-logo-link,
        .goog-logo-link:link,
        .goog-logo-link:visited,
        .goog-logo-link:hover,
        .goog-logo-link:active {
            font-size: 12px;
            font-weight: bold;
            color: #040f1c00;
            text-decoration: none;
            visibility: hidden;
        }

        #google_translate_element img,
        iframe,
        .skiptranslate a {
            display: none;
        }

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

        @media screen and (max-width: 480px) {
            .responsive-desktop-menu {
                display: none;
            }
        }

        @media screen and (min-width: 480px) {
            .responsive-mobile-menu {
                display: none;
            }
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        .sticky-header.fixed .header-icon {
            color: #222529;
        }

        .sticky-logo {
            display: none;
        }

        .header-middle.fixed .logo img:not(.sticky-logo) {
            display: none;
        }

        .header-middle.fixed .sticky-logo {
            display: block;
        }

        .header-middle.fixed .mobile-menu-toggler {
            color: #222529;
        }

        .header-bottom.fixed .logo {
            max-width: 100px;
        }

        .header-search-inline {
            margin-right: 1.5rem;
        }

        .header-search-inline .form-control {
            width: 448px;
            font-size: 1.4rem;
            padding-left: 3rem;
            padding-right: 1.5rem
        }

        .header-search-wrapper .btn {
            position: relative;
            padding: 0 0 3px 0;
            border: 0;
            border-left: 1px solid #e7e7e7;
            min-width: 65px;
            color: #222529;
            font-size: 2rem;
            background: #fff
        }

        .header-search-wrapper .btn:before {
            display: inline-block;
            margin-top: 5px;
            font-weight: 800
        }

        .header-search .form-control,
        .header-search .select-custom {
            background: #fff
        }

        .product-name {
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: normal !important;
        }
    </style>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
