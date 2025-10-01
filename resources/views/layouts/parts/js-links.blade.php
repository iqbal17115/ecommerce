<script>
WebFontConfig = {
    google: {
        families: [
            'Open+Sans:300,400,600,700,800,400italic,800italic',
            'Poppins:300,400,500,600,700,800',
            'Oswald:300,400,500,600,700,800'
        ]
    }
};
</script>

<!-- jQuery (load only once, no duplicates) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap & plugins -->
<script src="{{ asset('aladdinne/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('aladdinne/assets/js/optional/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('aladdinne/assets/js/plugins.min.js') }}"></script>
<script src="{{ asset('aladdinne/assets/js/jquery.appear.min.js') }}"></script>
<script src="{{ asset('aladdinne/assets/js/jquery.plugin.min.js') }}"></script>
<script src="{{ asset('aladdinne/assets/js/jquery.countdown.min.js') }}"></script>

<!-- Main theme JS -->
<script src="{{ asset('aladdinne/assets/js/main.min.js') }}"></script>
<script src="{{ asset('aladdinne/assets/custom/js/common.js') }}"></script>

<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<!-- Third-party plugins (confirm, toastr, etc.) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Your panel scripts -->
<script src="{{ asset('js/panel/action.js') }}"></script>
<script src="{{ asset('js/panel/common.js') }}"></script>

@include('ecommerce.sidebar-js')
