
    @foreach($products as $product)
    <div class="col-xl-3 col-lg-4 col-md-3 col-sm-4 col-6">
        <div class="product-default inner-quickview inner-icon">
            <figure>
                <a href="demo36-product.html">
                    <img src="{{ asset('storage/product_photo/'.$product->ProductMainImage->image) }}" width="239"
                        height="239" style="width: 239px; height: 239px;" alt="product">
                </a>
                <div class="btn-icon-group">
                    <a href="#" class="btn-icon btn-add-cart product-type-simple"><i class="icon-shopping-cart"></i></a>
                </div>
                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View">Quick
                    View</a>
            </figure>
            <div class="product-details">
                <div class="category-wrap">
                    <div class="category-list">
                        <a href="demo36-shop.html" class="product-category">category</a>
                    </div>
                    <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i class="icon-heart"></i></a>
                </div>
                <h3 class="product-title">
                    <a href="demo36-product.html">{{$product->name}}</a>
                </h3>
                <div class="ratings-container">
                    <div class="product-ratings">
                        <span class="ratings" style="width:100%"></span>
                        <!-- End .ratings -->
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <!-- End .product-ratings -->
                </div>
                <!-- End .product-container -->
                <div class="price-box">
                    <span class="old-price">$29.00</span>
                    <span class="product-price">$19.00</span>
                </div>
                <!-- End .price-box -->
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