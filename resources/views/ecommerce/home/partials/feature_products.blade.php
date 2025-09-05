 @foreach ($product_features as $product_feature)
 <div class="recent-products-section appear-animate" data-animation-name="fadeIn"
     data-animation-delay="100">
     <div class="d-flex align-items-center">
         <h4 class="section-title text-transform-none mb-0">{{ $product_feature['name'] }}</h4>
         <a class="view-all ml-auto"
             href="{{ route('catalog.show') }}?filters[feature_names]={{ urlencode($product_feature['name']) }}"
             style="white-space: nowrap;">
             View All <i class="fas fa-long-arrow-alt-right"></i>
         </a>
     </div>
     <div class="products-slider owl-carousel owl-theme carousel-with-bg nav-circle pb-0"
         data-owl-options="{
                            'margin': 1,
                            'navText': [ '<i class=icon-left-open-big>', '<i class=icon-right-open-big>' ],
                            'dots': false,
                            'nav': true,
                            'loop': false,
                            'responsive': {
                                '0': {
                                    'items': 2,
                                    'margin': 5
                                },
                                '576': {
                                    'items': 3,
                                    'margin': 10
                                },
                                '768': {
                                    'items': 4,
                                    'margin': 10
                                },
                                '992': {
                                    'items': 5,
                                    'margin': 10
                                },
                                '1200': {
                                    'items': 6,
                                    'margin': 10
                                }
                            }
                        }">
         @foreach ($product_feature['products'] as $product)
         <div class="product-default inner-quickview inner-icon" style="overflow:hidden;">
             <figure>
                 <a
                     href="{{ route('products.details', ['name' => rawurlencode($product['name']), 'seller_sku' => $product['seller_sku']]) }}">
                     <img class="lazy-load"
                         data-src="{{ $product['image_path'] }}"
                         style="width: 239px; height: 239px; filter: brightness(0.9)
                                contrast(1.2) saturate(1.1);"
                         width="239" height="239" alt="product">
                 </a>
                 <!-- Check if your_price is not null -->
                 @if ($product['is_on_sale'])
                 <div class="label-group">
                     <div class="product-label label-sale">-{{ $product['offer_percentage'] }}%</div>
                 </div>
                 @endif

                 <div class="btn-icon-group">
                     @if ($product['stock_qty'] > 0 )
                     <a href="javascript:void(0);" title="Add To Cart"
                         data-product_id="{{ $product['id'] }}"
                         data-has_variation="{{ $product['has_variation'] ? '1' : '0' }}"
                         data-details_url="{{ route('products.details', ['name' => rawurlencode($product['name']), 'seller_sku' => $product['seller_sku']]) }}"
                         data-image="{{ $product['image_path'] }}"
                         class="btn-icon add_cart_item product-type-simple"><i
                             class="icon-shopping-cart"></i></a>
                     @endif
                 </div>
             </figure>
             <div class="product-details">
                 <h3 class="product-title">
                     <a href="{{ route('products.details', ['name' => rawurlencode($product['name']), 'seller_sku' => $product['seller_sku']]) }}"
                         class="product-name" id="product-name">{{ $product['name'] }}</a>
                 </h3>
                 <div class="category-wrap">
                     <span class="five-star-rating ml-0 mb-1">
                         @if ($product['rating'] >= 1)
                         <i class="fas fa-star"></i>
                         @else
                         <i class="far fa-star"></i>
                         @endif

                         @if ($product['rating'] >= 2)
                         <i class="fas fa-star"></i>
                         @else
                         <i class="far fa-star"></i>
                         @endif

                         @if ($product['rating'] >= 3)
                         <i class="fas fa-star"></i>
                         @else
                         <i class="far fa-star"></i>
                         @endif

                         @if ($product['rating'] >= 4)
                         <i class="fas fa-star"></i>
                         @else
                         <i class="far fa-star"></i>
                         @endif

                         @if ($product['rating'] >= 5)
                         <i class="fas fa-star"></i>
                         @else
                         <i class="far fa-star"></i>
                         @endif
                         <span class="rating-number">-</span>
                         <span class="rating-number"
                             style="font-size: 11px;">{{ $product['rating'] }}</span>
                     </span>

                     {{-- Add to wishlist --}}
                     <a href="javascript:void(0);" class="btn-icon-wish"
                         data-product_id="{{ $product['id'] }}" title="Add To Wishlist"><i
                             class="icon-heart"></i></a>
                 </div>
                 <!-- End .product-container -->
                 <div class="price-box">
                     @if ($product['is_on_sale'])
                     <del class="old-price">{{ $product['currency'] }} {{ $product['your_price'] }}</del>
                     <span class="product-price brand_text_design">{{ $product['currency'] }} {{ $product['sale_price'] }}</span>
                     @else
                     <span class="product-price brand_text_design">{{ $product['currency'] }} {{ $product['your_price'] }}</span>
                     @endif
                 </div>
                 <!-- End .price-box -->
             </div>
             <!-- End .product-details -->
             @if ($product['stock_qty'] <= 0)
                 <a class="sold_out" style="color: #fff;">Sold out</a>
                 @endif
         </div>
         @endforeach
     </div>
     <!-- End .products-slider -->
 </div>
 @endforeach