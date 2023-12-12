@extends('layouts.ecommerce')
@section('content')
    <style>
        .hh-grayBox {
            background-color: #F8F8F8;
            margin-bottom: 20px;
            padding: 35px;
            margin-top: 20px;
        }

        .pt45 {
            padding-top: 45px;
        }

        .order-tracking {
            text-align: center;
            width: 25%;
            position: relative;
            display: block;
        }

        .order-tracking .is-complete {
            display: block;
            position: relative;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            border: 0px solid #AFAFAF;
            background-color: #f7be16;
            margin: 0 auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
            z-index: 2;
        }

        .order-tracking .is-complete:after {
            display: block;
            position: absolute;
            content: '';
            height: 14px;
            width: 7px;
            top: -2px;
            bottom: 0;
            left: 5px;
            margin: auto 0;
            border: 0px solid #AFAFAF;
            border-width: 0px 2px 2px 0;
            transform: rotate(45deg);
            opacity: 0;
        }

        .order-tracking.completed .is-complete {
            border-color: #27aa80;
            border-width: 0px;
            background-color: #27aa80;
        }

        .order-tracking.completed .is-complete:after {
            border-color: #fff;
            border-width: 0px 3px 3px 0;
            width: 7px;
            left: 11px;
            opacity: 1;
        }

        .order-tracking p {
            color: #A4A4A4;
            font-size: 16px;
            margin-top: 8px;
            margin-bottom: 0;
            line-height: 20px;
        }

        .order-tracking p span {
            font-size: 14px;
        }

        .order-tracking.completed p {
            color: #000;
        }

        .order-tracking::before {
            content: '';
            display: block;
            height: 3px;
            width: calc(100% - 40px);
            background-color: #f7be16;
            top: 13px;
            position: absolute;
            left: calc(-50% + 20px);
            z-index: 0;
        }

        .order-tracking:first-child:before {
            display: none;
        }

        .order-tracking.completed:before {
            background-color: #27aa80;
        }
    </style>
    <main class="main main-test">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-10 hh-grayBox pt45 pb20">
                    <div class="row justify-content-between mb-3">

                        @foreach ($orderStatuses as $orderStatus)
                            @php
                                $matchingItem = null;
                            @endphp
                            @foreach ($trackingData as $item)
                                @if ($item['status'] === $orderStatus)
                                    @php
                                        $matchingItem = $item;
                                        break;
                                    @endphp
                                @endif
                            @endforeach
                            @php
                                $completed = !empty($matchingItem);
                                $desiredCreatedAt = $completed ? $matchingItem['created_at'] : null;
                            @endphp

                            <div class="order-tracking {{ $completed ? 'completed' : '' }}">
                                <span class="is-complete"></span>
                                <p>{{ ucfirst($orderStatus) }}<br><span>{{ $desiredCreatedAt ? date('d M Y', strtotime($desiredCreatedAt)) : '' }}</span>
                                </p>
                            </div>
                        @endforeach

                    </div>

                        @php
                            $statusMessages = [
                                'pending' => 'Thank you for shopping at Aladdinne.ae ! Your order Is being verified. ',
                                'processing' => 'Your order is now being processed and prepared for shipment.',
                                'shipped' => 'Your Package has been packed and its being handed over to logistic partner',
                                'out_for_delivery' => 'Your order is out for delivery and will be at your doorstep soon. Please ensure someone is available to receive it.',
                                'delivered' => 'Your order has been successfully delivered., Thank you for Shopping at Aladdinne.ae!',
                            ];
                        @endphp
                        @foreach ($trackingData as $index => $item)
                            @if ($item['status'] == 'pending' || $item['status'] == 'processing' || $item['status'] == 'shipped' || $item['status'] == 'out_for_delivery' || $item['status'] == 'delivered')
                                <div class="d-flex p-3" style="font-size: 16px;">
                                    <span
                                    class="badge badge-primary badge-pill mr-5">{{ date('d M Y h:i', strtotime($item['created_at'])) }}</span>
                                     {{$statusMessages[$item['status']]}}
                                </div>
                            @endif
                        @endforeach
                </div>
            </div>
        </div>
    </main>
    <!-- End .main -->

    <!-- footer-area -->
    @include('ecommerce.footer')
    <!-- footer-area-end -->
@endsection
@push('scripts')
    <script src="{{ asset('js/panel/users/cart/cart.js') }}"></script>
    <script src="{{ asset('js/panel/users/common.js') }}"></script>
    <script>
        window.onload = function() {
            // Code to be executed after rendering the full layout
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
        };
    </script>
@endpush

