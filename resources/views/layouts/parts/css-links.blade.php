    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/css/bootstrap.min.css">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/css/demo36.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ URL::asset('aladdinne/') }}/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('web_css/global.css') }}">
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

        .product-name {
            display: -webkit-box !important;
            -webkit-line-clamp: 2 !important;
            -webkit-box-orient: vertical !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: normal !important;
        }

        /* five start css code */
        .five-star-rating {
            color: #F4631B;
            /* Set the color of the stars */
            font-size: 12px;
            /* margin-left: 11px; */
            /* Adjust the size of the stars */
        }

        .five-star-rating i {
            display: inline-block;
        }

        /* If you are using FontAwesome for the star icons */
        .five-star-rating .fa-star:before {
            content: "\f005";
            /* Use the appropriate Unicode for the star icon */
        }

        /* end of five start css code */

        /* two line name show css code */

        .product-name {
            display: inline-block;
            word-wrap: break-word;
        }
    </style>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
