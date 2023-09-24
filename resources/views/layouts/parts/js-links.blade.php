<script>
WebFontConfig = {
    google: {
        families: ['Open+Sans:300,400,600,700,800,400italic,800italic', 'Poppins:300,400,500,600,700,800',
            'Oswald:300,400,500,600,700,800'
        ]
    }
};
</script>
<!-- Plugins JS File -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/bootstrap.bundle.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/optional/isotope.pkgd.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/plugins.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/jquery.appear.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/jquery.plugin.min.js"></script>
<script src="{{ URL::asset('aladdinne/') }}/assets/js/jquery.countdown.min.js"></script>

<!-- Main JS File -->
<script src="{{ URL::asset('aladdinne/') }}/assets/js/main.min.js"></script>
<!-- Common JS File -->
<script src="{{ URL::asset('aladdinne/') }}/assets/custom/js/common.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('js/panel/action.js')}}"></script>
<script src="{{asset('js/panel/common.js')}}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").css("width", "320px");
        $("#wrapper").toggleClass("menuDisplayed");
    });
});

function googleTranslateElementInit() {
    new google.translate.TranslateElement({
        pageLanguage: 'en',
        includedLanguages: 'en,bn,ar', // Specify the language codes you want to include
    }, 'google_translate_element');
}
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
@include('ecommerce.sidebar-js')
@include('ecommerce.cart-js')
