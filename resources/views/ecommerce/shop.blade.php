@extends('layouts.ecommerce')
@section('content')
    <style>
        @media (min-width:1220px) {
            .container {
                max-width: 1500px;
                ;
            }
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

        .product-name {
            display: inline-block;
            word-wrap: break-word;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            justify-content: center;
        }

        .page-item {
            margin: 0 2px;
        }

        .page-link {
            display: block;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: #333;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .page-link:hover {
            background-color: #f5f5f5;
        }

        .page-item.active .page-link {
            background-color: #007bff;
            color: #fff;
            border: 1px solid #007bff;
        }

        .page-item.disabled .page-link {
            pointer-events: none;
            cursor: not-allowed;
            background-color: #eee;
            color: #777;
            border: 1px solid #ddd;
        }

        .pagination_input_field {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .pagination_input_field::-webkit-inner-spin-button,
        .pagination_input_field::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: none;
            margin: 0;
        }

        .sold_out {
            top: 2em;
            left: -4em;
            color: #fff;
            display: block;
            position: absolute;
            text-align: center;
            text-decoration: none;
            letter-spacing: .06em;
            background-color: #A00;
            padding: 0.5em 5em 0.4em 5em;
            text-shadow: 0 0 0.75em #444;
            box-shadow: 0 0 0.5em rgba(0, 0, 0, 0.5);
            font: bold 16px/1.2em Arial, Sans-Serif;
            -webkit-text-shadow: 0 0 0.75em #444;
            -webkit-box-shadow: 0 0 0.5em rgba(0, 0, 0, 0.5);
            -webkit-transform: rotate(-45deg) scale(0.75, 1);
            z-index: 10;
        }

        .sold_out:before {
            content: '';
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            position: absolute;
            margin: -0.3em -5em;
            transform: scale(0.7);
            -webkit-transform: scale(0.7);
            border: 2px rgba(255, 255, 255, 0.7) dashed;
        }
    </style>
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
                    <nav class="toolbox sticky-header" data-sticky-options="{'mobile': true}">
                        <div class="toolbox-left">
                            <a href="#" class="sidebar-toggle"><svg data-name="Layer 3" id="Layer_3"
                                    viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="15" x2="26" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="6" x2="9" y1="9" y2="9" class="cls-1"></line>
                                    <line x1="23" x2="26" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="6" x2="17" y1="16" y2="16" class="cls-1"></line>
                                    <line x1="17" x2="26" y1="23" y2="23" class="cls-1"></line>
                                    <line x1="6" x2="11" y1="23" y2="23" class="cls-1"></line>
                                    <path d="M14.5,8.92A2.6,2.6,0,0,1,12,11.5,2.6,2.6,0,0,1,9.5,8.92a2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                    <path d="M22.5,15.92a2.5,2.5,0,1,1-5,0,2.5,2.5,0,0,1,5,0Z" class="cls-2"></path>
                                    <path d="M21,16a1,1,0,1,1-2,0,1,1,0,0,1,2,0Z" class="cls-3"></path>
                                    <path d="M16.5,22.92A2.6,2.6,0,0,1,14,25.5a2.6,2.6,0,0,1-2.5-2.58,2.5,2.5,0,0,1,5,0Z"
                                        class="cls-2"></path>
                                </svg>
                                <span>Filter</span>
                            </a>
                            <div class="toolbox-item toolbox-sort">
                                <label>Sort By:</label>

                                <div class="select-custom">
                                    <select name="orderby" class="form-control order_of_product" id="order_of_product">
                                        <option value="" selected="selected">Default sorting</option>
                                        <option value="asc">Sort by price: low to high</option>
                                        <option value="desc">Sort by price: high to low</option>
                                    </select>
                                </div>
                                <!-- End .select-custom -->


                            </div>
                            <!-- End .toolbox-item -->
                        </div>
                        <!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-show">
                                <label>Show:</label>

                                <div class="select-custom">
                                    <select name="count_paginate" id="count_paginate" class="form-control count_paginate">
                                        <option value="12">12</option>
                                        <option value="24">24</option>
                                        <option value="36">36</option>
                                    </select>
                                </div>
                                <!-- End .select-custom -->
                            </div>
                            <!-- End .toolbox-item -->

                            <div class="toolbox-item layout-modes">
                                <a href="category.html" class="layout-btn btn-grid active" title="Grid">
                                    <i class="icon-mode-grid"></i>
                                </a>
                                <a href="category-list.html" class="layout-btn btn-list" title="List">
                                    <i class="icon-mode-list"></i>
                                </a>
                            </div>
                            <!-- End .layout-modes -->
                        </div>
                        <!-- End .toolbox-right -->
                    </nav>

                    <div class="row row-joined divide-line products-group" id="search_product_list"></div>
                    <!-- End .row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div id="pagination_container" class="mt-3"></div>
                        </div>
                    </div>
                </div>
                <!-- End .col-lg-9 -->

                <div class="sidebar-overlay"></div>
                <aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
                    <div class="sidebar-wrapper">
                        <div class="widget">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true"
                                    aria-controls="widget-body-2">Categories</a>
                            </h3>

                            <div class="collapse show" id="widget-body-2">
                                <div class="widget-body">
                                    <ul class="cat-list">
                                        @foreach ($categories as $category)
                                            @include('ecommerce.partials.category', [
                                                'category' => $category,
                                            ])
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->

                        <div class="widget widget-price">
                            <h3 class=" widget-title">
                                <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true"
                                    aria-controls="widget-body-3">Price</a>
                            </h3>

                            <div class="collapse show" id="widget-body-3">
                                <div class="widget-body pb-0">
                                    <form id="productFilterByPrice">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-sm rounded"
                                                        id="min_price" name="min-price" placeholder="Min" min="0"
                                                        style="-moz-appearance: textfield; height: 30px; font-size: 14px;"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input type="number" class="form-control form-control-sm rounded"
                                                        id="max_price" name="max-price" placeholder="Max" min="0"
                                                        style="-moz-appearance: textfield;height: 30px; font-size: 14px;"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 align-items-end">
                                                <center>
                                                    <button type="submit" class="btn btn-primary btn-sm"
                                                        style="height: 30px; border-radius: 3px; background-color: #007bff; border-color: #007bff; color: #fff; padding: 0em 0em;">Filter</button>
                                                </center>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->

                        <div class="widget widget-color">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true"
                                    aria-controls="widget-body-4">Color</a>
                            </h3>

                            <div class="collapse show" id="widget-body-4">
                                <div class="widget-body pb-0">
                                    <ul class="config-swatch-list">
                                        <li class="active">
                                            <a href="#" style="background-color: #000;"></a>
                                        </li>
                                        <li>
                                            <a href="#" style="background-color: #0188cc;"></a>
                                        </li>
                                        <li>
                                            <a href="#" style="background-color: #81d742;"></a>
                                        </li>
                                        <li>
                                            <a href="#" style="background-color: #6085a5;"></a>
                                        </li>
                                        <li>
                                            <a href="#" style="background-color: #ab6e6e;"></a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->

                        <div class="widget widget-brand">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-body-7" role="button" aria-expanded="true"
                                    aria-controls="widget-body-7">Brand</a>
                            </h3>

                            <div class="collapse show" id="widget-body-7">
                                <div class="widget-body pb-0">
                                    <ul class="cat-list">
                                        @foreach ($brands as $brand)
                                            <li>
                                                <input type="checkbox" class="select_brand" name="brand[]"
                                                    value="{{ $brand->id }}">
                                                <a>{{ $brand->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End .widget-body -->
                            </div>
                            <!-- End .collapse -->
                        </div>
                        <!-- End .widget -->

                        <!-- Start Ads -->
                        @if (isset($all_active_advertisements['Category']['2']['ads']))
                            <div class="mt-1">
                                <center>
                                    <img
                                        src="{{ asset('storage/' . $all_active_advertisements['Category']['2']['ads']) }}">
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
        $baseRoute = route('products.show', ['name' => '']);
    @endphp
@endsection
@push('scripts')
    <script src="{{ asset('js/panel/users/cart/cart.js') }}"></script>
    <script src="{{ asset('js/panel/users/common.js') }}"></script>
    <script src="{{ asset('js/panel/pagination.js') }}"></script>

    <script>
        const paginationContainer = document.getElementById('pagination_container');

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
                        <a href="${baseRoute}/${encodeURIComponent(product.product_name)}">
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
                            <a href="${baseRoute}/${encodeURIComponent(product.product_name)}">${product.product_name}</a>
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

                // Append the product HTML to #search_product_list
                $('#search_product_list').html(productHTML);
            });
        }

        function fetchData(page) {
            const searchCriteria = @json($searchCriteria ?? null);
            const categoryName = @json($categoryName ?? null);
            var checkedBrandCheckboxes = $('.select_brand:checked');

            // Extract brand IDs
            var selectedBrandIds = checkedBrandCheckboxes.map(function() {
                return $(this).val();
            }).get();

            var sort_order = $("#order_of_product").val() || 'asc';

            const queryParams = new URLSearchParams({
                page: page,
                limit: $('#count_paginate').val(),
                sort_order: sort_order,
                sort_by: 'your_price',
                search: searchCriteria,
                categoryName: categoryName,
                min_price: $("#min_price").val(),
                max_price: $("#max_price").val(),
            });

            // Manually add filters[brand_ids]
            queryParams.append('filters[brand_ids]', selectedBrandIds);
            const url = `/product-search?${queryParams.toString()}`;

            getDetails(url,
                (data) => {
                    setProduct(data.results);
                    const paginationHtml = generatePagination(data.results.total, data.results.per_page, page);
                    paginationContainer.innerHTML = paginationHtml;
                }
            );
        }
        fetchData(1);

        function callProductFilter() {
            fetchData(1);
        }

        $("#productFilterByPrice").submit(function(e) {
            e.preventDefault();
            callProductFilter(1);
        });

        $('.select_brand, #order_of_product, #count_paginate').on('change', function() {
            callProductFilter();
        })

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('pagination-link')) {
                event.preventDefault();
                const page = event.target.dataset.page;
                fetchData(page);
            }
        });

        $(document).on('click', '.load-subcategories', function() {
            var categoryId = $(this).data('id');
            var sublist = $('#sublist-' + categoryId);

            // if (sublist.is(':empty')) {
            $.ajax({
                url: '/categories/' + categoryId + '/subcategories',
                method: 'GET',
                success: function(data) {
                    sublist.html(data);
                },
                error: function() {
                    alert('Failed to load subcategories.');
                }
            });
            // }
        });


        // $(document).on('click', '.go-button', () => {
        //     const newPage = $('.page-input').val();
        //     if (!isNaN(newPage) && newPage >= 1) {
        //         fetchData(newPage);
        //     }
        // });

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
            // lazyLoad();
            // Check for visible images on page load
            // document.addEventListener("DOMContentLoaded", lazyLoad);

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
