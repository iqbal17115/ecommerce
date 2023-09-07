<div class="tab-pane fade" id="wishlist">
    <h6 class="tab-title">Wishlist</h6>
    <table class="table table-wishlist mb-0 shadow">
        <thead>
            <tr>
                <th class="thumbnail-col"></th>
                <th class="product-col">Product</th>
                <th class="price-col">Price</th>
                <th class="status-col">Stock Status</th>
                <th class="action-col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user?->wishlist as $list)
                <tr class="product-row">
                    <td>
                        <figure class="product-image-container">
                            <a href="product.html" class="product-image">
                                <img @if ($list?->product?->ProductMainImage) src="{{ asset('storage/product_photo/' . $list?->product?->ProductMainImage->image) }}" @endif
                                    alt="product">
                            </a>

                            <a href="#" class="btn-remove icon-cancel" title="Remove Product"></a>
                        </figure>
                    </td>
                    <td>
                        <h5 class="product-title">
                            <a href="product.html">{{ $list?->product->name }}</a>
                        </h5>
                    </td>
                    <td class="price-box">
                        @if (
                            $list?->product->sale_price &&
                                $list?->product->sale_start_date &&
                                $list?->product->sale_end_date &&
                                $list?->product->sale_start_date <= now() &&
                                $list?->product->sale_end_date >= now())
                            {{ $currency->icon }}{{ number_format($list?->product->sale_price, 2) }}
                        @else
                            {{ $currency->icon }}{{ number_format($list?->product->your_price, 2) }}
                        @endif
                    </td>
                    <td>
                        <span class="stock-status">In stock</span>
                    </td>
                    <td class="action">
                        <button href="javascript:void(0);" title="Add To Cart" data-id="{{ $list?->product->id }}"
                            data-name="{{ $list?->product->name }}" data-your_price="{{ $list?->product->your_price }}"
                            data-sale_price="{{ $list?->product->sale_price }}"
                            @if ($list?->product->ProductMainImage) data-image="{{ $list?->product->ProductMainImage->image }}" @endif
                            class="btn btn-dark btn-add-cart product-type-simple btn-shop">
                            ADD TO CART
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr class="mt-0 mb-3 pb-2" />

</div>
