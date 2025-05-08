<!-- Preload critical CSS -->
<link rel="preload" href="{{ URL::asset('aladdinne/') }}/assets/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" href="{{ URL::asset('aladdinne/') }}/assets/css/demo36.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" href="{{ URL::asset('aladdinne/') }}/assets/vendor/fontawesome-free/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" href="{{ asset('web_css/global.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

<!-- Non-critical stylesheets: loaded async -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css" media="print" onload="this.media='all'">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" media="print" onload="this.media='all'">

<!-- Fallback for users with JavaScript disabled -->
<noscript>
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/css/demo36.min.css">
    <link rel="stylesheet" href="{{ URL::asset('aladdinne/') }}/assets/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('web_css/global.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</noscript>
