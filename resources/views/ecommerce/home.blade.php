@extends('layouts.ecommerce')
@section('content')
<style>
    @media (min-width:1220px) {
        .container {
            max-width: 1500px;
        }
    }

    .post-slider>.owl-stage-outer,
    .products-slider>.owl-stage-outer {
        padding: 0px 0px;
    }

    .feature-card {
        width: 100%;
        background-color: #ccc;
    }

    @media screen and (min-width: 480px) {
        .feature-card {
            width: 100%;
        }
    }

    @media screen and (min-width: 768px) {
        .feature-card {
            width: 50%;
        }
    }

    @media screen and (min-width: 992px) {
        .feature-card {
            width: 25%;
        }
    }

    /* five start css code */
    .five-star-rating {
        color: #F4631B;
        /* Set the color of the stars */
        font-size: 12px;
        margin-left: 11px;
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

    /* two line name show css code */
</style>

@include('ecommerce.cart-js')
<!-- footer-area -->
@include('ecommerce.footer')
<!-- footer-area-end -->
@include('ecommerce.sidebar-js')
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

// using Javascript we doing split the producuct name into two lines
// Get the product name element
var productName = document.getElementById('product-name');
// Split the product name into two lines
var words = productName.textContent.split(' ');
var halfLength = Math.ceil(words.length / 2);
var firstLine = words.slice(0, halfLength).join(' ');
var secondLine = words.slice(halfLength).join(' ');
// Set the product name with two lines
productName.innerHTML = firstLine + '<br>' + secondLine;
// end of using Javascript we doing split the producuct name into two lines

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
                observer.unobserve(image); // Stop observing the image once it has been loaded
            }
        });
    }, options);

    // Loop through all the image elements and observe them with the IntersectionObserver
    for (var i = 0; i < images.length; i++) {
        var image = images[i];
        observer.observe(image);
    }
});
</script>
@endsection