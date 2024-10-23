@extends('layouts.ecommerce')
@section('content')
    <link rel="stylesheet" href="{{ asset('vendor/aladdinne/assets/css/shop.css') }}">
    <div id="temp_user_id" data-user_id="{{ $user_id }}"></div>
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-1">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="demo36.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                </ol>
            </div>
        </nav>

        <div class="container pt-2">
            <div class="row">
                <div class="col-lg-9 main-content">
                    @include('ecommerce.shop.partials.sticky_header')

                    <div class="row row-joined divide-line products-group" id="search_product_list"></div>
                    <!-- End .row -->
                </div>
                <!-- End .col-lg-9 -->

                <div class="sidebar-overlay"></div>
                <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                    <div class="sidebar-wrapper">
                        @include('ecommerce.shop.partials.category_widget')
                        <!-- End .widget -->

                        @include('ecommerce.shop.partials.price_widget')
                        <!-- End .widget -->

                        {{-- Size Filter --}}
                        <x-product-filter :items="$productSizes" filterType="size" filterId="4" viewLimit="5"
                            valueField="value" />

                        {{-- Color Filter --}}
                        <x-product-filter :items="$productColors" filterType="color" filterId="5" viewLimit="5"
                            valueField="value" />

                        {{-- Brand Filter --}}
                        <x-product-filter :items="$brands" filterType="brand" filterId="7" viewLimit="5"
                            valueField="name" />


                        <!-- Start Ads -->
                        @if (isset($all_active_advertisements['Category']['2']['ads']))
                            <div class="mt-1">
                                <center>
                                    <img src="{{ asset('storage/' . $all_active_advertisements['Category']['2']['ads']) }}">
                                </center>
                            </div>
                        @endif
                        <!-- End Ads -->
                    </div>
                    <!-- End .sidebar-wrapper -->
                </aside>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->

        <div class="mb-xl-4 mb-0"></div>
        <!-- margin -->
    </main>
    <!-- End .main -->
    <!-- footer-area -->
    @include('ecommerce.footer')
    <!-- footer-area-end -->
    @php
        $baseRoute = route('products.details', ['name' => '', 'seller_sku' => '']);
    @endphp
@endsection
@push('scripts')
    <script src="{{ asset('js/panel/users/cart/cart.js') }}"></script>
    <script src="{{ asset('js/panel/users/common.js') }}"></script>
    <script src="{{ asset('js/panel/pagination.js') }}"></script>

    <script>
        let observer; // Declare observer globally

        function initLazyLoadObserver() {
            const options = {
                rootMargin: '0px',
                threshold: 0.1
            };

            observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const imageUrl = img.getAttribute('data-src');
                        img.src = imageUrl;
                        img.classList.remove('lazy-load');
                        observer.unobserve(img);
                    }
                });
            }, options);

            // Observe all current lazy-load images
            document.querySelectorAll('.lazy-load').forEach(img => {
                observer.observe(img);
            });
        }

        window.onload = function() {
            initLazyLoadObserver();
        };


        function setProduct(data) {
            $('#search_product_list').html('');
            let productHTML = ""
            var baseRoute = "{!! $baseRoute !!}";

            // Iterate through each product in the data
            data.forEach(product => {
                // Construct the HTML for each product
                productHTML += `
            <div class="col-xl-3 col-lg-4 col-md-3 col-sm-4 col-6">
                <div class="product-default inner-quickview inner-icon" style="overflow:hidden;">
                    <figure>
                        <a href="${baseRoute}/${encodeURIComponent(product.product_name)}/${encodeURIComponent(product.seller_sku)}">
                            <img class="lazy-load" data-src="${product.image_url}" width="239" height="239" alt="product">
                        </a>
                        ${product.is_offer_active ? `
                                                                                                                                                                                    <div class="label-group">
                                                                                                                                                                                        <div class="product-label label-sale">-${product.offer_percentage}%</div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                ` : ''}
                        <div class="btn-icon-group">
                            <a href="javascript:void(0);" data-product_id="${product.id}" class="btn-icon add_cart_item product-type-simple">
                                <i class="icon-shopping-cart"></i>
                            </a>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-wrap">
                            <a href="javascript:void(0);" class="btn-icon-wish" data-product_id="${product.id}">
                                <i class="icon-heart"></i>
                            </a>
                        </div>
                        <h3 class="product-title">
                            <a href="${baseRoute}/${encodeURIComponent(product.product_name)}/${encodeURIComponent(product.seller_sku)}">${product.product_name}</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>
                        <div class="price-box">
                            ${product.is_offer_active ? `
                                                                                                                                                                                        <span class="old-price">${product.active_currency.icon}${product.your_price}</span>
                                                                                                                                                                                    ` : ''}
                            <span class="product-price">${product.active_currency.icon}${product.is_offer_active ? product.sale_price : product.your_price}</span>
                        </div>
                    </div>
                    ${product.stock_qty <= 0 ? `<a class="sold_out" style="color: #fff;">Sold out</a>` : ''}
                </div>
            </div>
        `;
            });

            // Append the product HTML to #search_product_list
            $('#search_product_list').html(productHTML);

            // Re-observe the newly added images
            document.querySelectorAll('.lazy-load').forEach(img => {
                if (typeof observer !== 'undefined' && observer !== null) {
                    observer.observe(img);
                }
            });
        }

        let selectedCategories = []; // Global array to hold selected categories

        function toggleCategory(category) {
            const index = selectedCategories.indexOf(category);

            if (index > -1) {
                // Category is already selected, remove it
                selectedCategories.splice(index, 1);
            } else {
                // Category is not selected, add it
                selectedCategories.push(category);
            }

            // Apply filters after toggling the category
            applyFilters();
        }

        function applyFilters() {
            // Base URL for the products page
            const baseUrl = `${window.location.pathname}`;

            // Sorting order
            var sort_order = $("#order_of_product").val() || 'asc';

            // Initialize an object to hold filter parameters
            const filters = {};

            // Extract the current URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // Preserve the 'search' parameter, if present
            let searchParam = urlParams.get('search');
            if (searchParam) {
                filters['search'] = encodeURIComponent(searchParam);
            }

            let feature_names = urlParams.get('feature_names');
            if (feature_names) {
                filters['feature_names'] = feature_names;
            }

            // Preserve the existing filters if present
            for (const [key, value] of urlParams.entries()) {
                if (key.startsWith('filters[')) {
                    filters[key] = value;
                }
            }

            // Get selected brands and add them as a comma-separated value
            let selectedBrands = [];
            document.querySelectorAll('input[name="brand"]:checked').forEach((input) => {
                selectedBrands.push(input.value);
            });

            if (selectedBrands.length > 0) {
                filters['filters[brand_names]'] = selectedBrands.join(','); // Comma-separated string
            } else {
                delete filters['filters[brand_names]']; // Remove if no colors selected
            }

            // Get selected categories
            let selectedCategories = [];
            document.querySelectorAll('.category-filter.active').forEach((activeCategory) => {
                selectedCategories.push(activeCategory.getAttribute('data-category'));
            });
            if (selectedCategories.length > 0) {
                filters['filters[category_names]'] = selectedCategories.join(','); // Comma-separated string
            }

            // Get selected colors and add them as a comma-separated value
            let selectedColors = [];
            document.querySelectorAll('input[name="color"]:checked').forEach((input) => {
                selectedColors.push(input.value);
            });

            if (selectedColors.length > 0) {
                filters['filters[color_names]'] = selectedColors.join(','); // Keep as a comma-separated string
            } else {
                delete filters['filters[color_names]']; // Remove if no colors selected
            }

            // Get selected sizes and add them as a comma-separated value
            let selectedSizes = [];
            document.querySelectorAll('input[name="size"]:checked').forEach((input) => {
                selectedSizes.push(input.value);
            });
            if (selectedSizes.length > 0) {
                filters['filters[size_names]'] = selectedSizes.join(','); // Comma-separated string
            } else {
                delete filters['filters[size_names]']; // Remove if no sizes selected
            }

            // Get min and max price and create a 'price' range in the format price=min-max
            let minPrice = document.getElementById('min_price').value;
            let maxPrice = document.getElementById('max_price').value;
            if (minPrice && maxPrice) {
                filters['filters[price]'] = `${minPrice}-${maxPrice}`; // Combine min and max price
            } else {
                delete filters['price']; // Remove if no price range selected
            }

            // Build the query string
            const queryString = new URLSearchParams(filters).toString();

            // Replace any specific encodings that may have occurred
            const cleanedQueryString = queryString.replace(/%2C/g, ','); // Replace %2C with comma

            // Update the browser's URL without reloading the page
            const newUrl = `${baseUrl}?${cleanedQueryString}&sort_order=${sort_order}`;
            window.history.pushState({}, '', newUrl);

            // Fetch data with the updated URL
            fetchData();
        }

        function sendPriceFilters() {
            // Get min and max price values
            const minPrice = document.getElementById('min_price').value;
            const maxPrice = document.getElementById('max_price').value;

            // Base URL for the products page
            const baseUrl = `${window.location.pathname}`;

            // Initialize an object to hold filter parameters
            const filters = {};

            // Preserve existing URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // Add price filters to the filters object
            if (minPrice && maxPrice) {
                filters['filters[price]'] = `${minPrice}-${maxPrice}`;
            }

            // Build the query string
            const queryString = new URLSearchParams(filters).toString();

            // Update the browser's URL without reloading the page
            const newUrl = `${baseUrl}?${queryString}`;
            window.history.pushState({}, '', newUrl);

            // Call the applyFilters function to refresh data with new filters
            applyFilters();
        }

        // Call applyFilters on document ready to initialize the filters based on URL parameters
        document.addEventListener('DOMContentLoaded', (event) => {
            applyFilters();
        });

        // Add click event listener to category links to mark them as active
        document.addEventListener('click', function(event) {
            if (event.target.matches('.category-filter')) {
                event.preventDefault(); // Prevent default action

                // Remove active class from all category links
                document.querySelectorAll('.category-filter').forEach((link) => {
                    link.classList.remove('active');
                });

                // Add active class to the clicked category
                event.target.classList.add('active');

                // Call applyFilters without passing category (it will retrieve from the active link)
                applyFilters();
            }
        });

        // Function to handle fetching data
        function fetchData(page = 1) {
            // Retrieve all current URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // Ensure the 'page' parameter is set (for pagination)
            urlParams.set('page', page);

            // Build the final URL with the current parameters
            const url = `/shop/products?${urlParams.toString()}`;

            // Fetch product data based on the updated URL
            getDetails(url, (data) => {
                setProduct(data.results); // Update the product list dynamically
                console.log(data.results);
            });
        }

        // Event listener for loading subcategories
        // Event listener for loading subcategories
        $(document).on('click', '.load-subcategories', function() {
            const categoryId = $(this).data('id');
            const sublist = $('#sublist-' + categoryId);
            const selectedCategory = $(this).data('category'); // Get the category name from data attribute

            // Load subcategories via AJAX
            $.ajax({
                url: '/categories/' + categoryId + '/subcategories',
                method: 'GET',
                success: function(data) {
                    // Populate the sublist with the received data
                    sublist.html(data);

                    // Remove active class from all category links
                    document.querySelectorAll('.load-subcategories').forEach((link) => {
                        $(link).removeClass('active'); // Use jQuery for consistency
                    });

                    // Add active class to the clicked category
                    $(this).addClass('active');

                    // Update URL with the selected category
                    updateURLAndApplyFilters(selectedCategory);
                }.bind(this), // Maintain context to use 'this' inside the success callback
                error: function() {
                    alert('Failed to load subcategories.');
                }
            });
        });

        function updateURLAndApplyFilters(selectedCategory) {
            // Parse existing URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // Update or delete the category name based on whether one is selected
            if (selectedCategory) {
                // Manually replace spaces with '+' without URL encoding
                const formattedCategory = selectedCategory.replace(/\s+/g, '+');
                urlParams.set('filters[category_names]', formattedCategory);
            } else {
                urlParams.delete('filters[category_names]'); // Remove category if none selected
            }

            // Preserve the 'search' parameter if it exists
            const searchParam = urlParams.get('search');
            if (searchParam) {
                urlParams.set('search', searchParam); // Keep search parameter intact
            }

            // Construct the new URL with custom parameters and update the browser's address bar
            const queryString = urlParams.toString().replace(/%2B/g, '+'); // Replace '%2B' with '+'
            const newUrl = `${window.location.pathname}?${queryString}`;
            window.history.pushState({}, '', newUrl);

            // Call applyFilters to apply the filtering logic
            applyFilters();
        }

        function toggleViewMore(element) {
            let container = element.closest('.widget-body');
            container.querySelectorAll('.more-items').forEach(item => {
                item.classList.remove('d-none');
            });
            container.querySelector('.view-less').classList.remove('d-none');
            element.classList.add('d-none');
        }

        function toggleViewLess(element) {
            let container = element.closest('.widget-body');
            container.querySelectorAll('.more-items').forEach(item => {
                item.classList.add('d-none');
            });
            container.querySelector('.view-more').classList.remove('d-none');
            element.classList.add('d-none');
        }
    </script>
@endpush
