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
<script>
    $(document).ready(function() {
        $(".menu-toggle").click(function(e) {
            e.preventDefault();
            $("#sidebar-wrapper").css("width", "320px");
            $("#wrapper").toggleClass("menuDisplayed");
        });
    });
</script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,bn,ar', // Specify the language codes you want to include
        }, 'google_translate_element');
    }
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
<script>
    function lazyLoad() {
        const lazyImages = document.querySelectorAll('.lazy-load');
        lazyImages.forEach(img => {
            if (img.getBoundingClientRect().top <= window.innerHeight && img.getBoundingClientRect()
                .bottom >= 0 && getComputedStyle(img).display !== 'none') {
                img.src = img.dataset.src;
                img.classList.remove('lazyload');
            }
        });
    }



    // Check for visible images on page load
    document.addEventListener("DOMContentLoaded", lazyLoad);
    $(document).ready(function() {
        // Get an array of all the image elements you want to load
        var images = document.getElementsByClassName('lazy-load');

        // Set up an IntersectionObserver to detect when the images are in view
        var options = {
            rootMargin: '0px',
            threshold: 0.1
        };

        var observer = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                // If the image is in the viewport, load it by setting its `src` attribute to the appropriate URL
                if (entry.isIntersecting) {
                    var image = entry.target;
                    var imageUrl = image.getAttribute('data-src');
                    image.src = imageUrl;
                    image.classList.remove(
                        'lazy-load'
                    ); // Remove the class to prevent the image from being loaded again
                    observer.unobserve(
                    image); // Stop observing the image once it has been loaded
                }
            });
        }, options);

        // Loop through all the image elements and observe them with the IntersectionObserver
        for (var i = 0; i < images.length; i++) {
            var image = images[i];
            observer.observe(image);
        }
    });
    function get_main_content() {
            $.ajax({
                url: '{{ route('get-main-content') }}',
                type: 'GET',
                beforeSend: function() {
                    $('#ecom_main_content').html('');
                },
                success: function(data) {
                    // Handle the response data
                    $('#ecom_main_content').html(data);
                }
            });
        }
</script>
@include('ecommerce.sidebar-js')
@include('ecommerce.cart-js')
