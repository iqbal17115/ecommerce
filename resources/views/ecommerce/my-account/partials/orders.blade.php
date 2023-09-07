<div class="tab-pane fade" id="orders">
    <h6 class="tab-title">Your Orders</h6>
    <div class="table-responsive">
        <table class="table table-wishlist shadow">
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

                @foreach ($user->Contact?->Order as $order)
                    <tr>
                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{ $order->code }}</a>
                        </td>
                        <td>
                            {{ date('d-M-Y H:i', strtotime($order->order_date)) }}
                        </td>
                        <td>
                            {{ ucwords($order->status) }}
                        </td>
                        <td>
                            {{ $order->total_amount }}
                        </td>
                        <td>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
