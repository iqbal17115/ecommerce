
    @foreach($products as $product)
    <div class="col-xl-3 col-lg-4 col-md-3 col-sm-4 col-6">
        <div class="product-default inner-quickview inner-icon">
            <figure>
                <a href="{{ route('products.show', ['name' => urlencode($product->name)]) }}">
                    <img @if($product->ProductMainImage) src="{{ asset('storage/product_photo/'.$product->ProductMainImage->image) }}" @endif width="239"
                        height="239" style="width: 239px; height: 239px;" alt="product">
                </a>
                @auth
                <div class="btn-icon-group">
                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                </div>
                @endauth
            </figure>
            <div class="product-details">
                <h3 class="product-title">
                    <a href="{{ route('products.show', ['name' => urlencode($product->name)]) }}">{{$product->name}}</a>
                </h3>
                <!-- End .product-container -->
                <div class="price-box">
                @php
                                echo $product->your_price? '<span
                                    class="old-price">'.$currency->icon.''.number_format((float)$product->your_price, 2).'</span>' : '';
                                echo $product->sale_price? '<span
                                    class="product-price">'.$currency->icon.''.number_format((float)$product->sale_price, 2).'</span>' :
                                '';
                                @endphp
                </div>
                <!-- End .price-box -->
                @guest
                                        <a href="{{ route('customer-sign-in') }}" class="btn btn-dark btn-add-cart btn-shop text-light" style="width: 100%; background-color: #ae016a;padding: 0 1.4rem;font-size: 1.2rem;font-weight: 600;text-align: center;">
                                            LOGIN TO ORDER
                                        </a>
                                        @endguest
            </div>
            <!-- End .product-details -->
        </div>
    </div>

    @endforeach
    <div class="col-12">
        <nav class="toolbox toolbox-pagination border-0">
            <ul class="pagination toolbox-item">
                <li class="page-item">
                    {!! $products->links() !!}
                </li>
            </ul>
        </nav>
    </div>
<!-- End .row -->
