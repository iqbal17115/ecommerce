@extends('layouts.backend_app')

@section('content')

    <div class="row">
        {{-- Start Content --}}
        <div class="col-12">

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <div class="row">
                            <div class="col-md-9 text-success">Cancellation Product</div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-4 text-center text-danger">Quantity</div>
                                    <div class="col-md-4 text-center text-danger">cancelled</div>
                                    <div class="col-md-4 text-center text-danger">Remaining</div>
                                </div>
                            </div>
                        </div>
                    </h5>
                    
                    <!-- Assuming you have an array of products called 'products' -->
                    @foreach ($order->OrderDetail as $orderDetail)
                        <div class="row shadow-sm py-2">
                            <div class="col-md-1">
                                <img src="{{ asset('storage/product_photo/' . $orderDetail->Product?->ProductImage?->first()->image) }}"
                                    style="width:50px; height: 50px;" class="img-responsive">
                            </div>
                            <div class="col-md-2">
                                @php
                                    $product_codes = [];
                                @endphp
                                @for ($i = 1; $i <= $orderDetail->quantity; $i++)
                                    <p>{{ $order?->code }}{{ $orderDetail->id }}{{ $i }}</p>
                                    @php
                                        $product_codes[] = $order->code . $orderDetail->id . $i;
                                    @endphp
                                @endfor
                            </div>
                            <div class="col-md-5">
                                <h6 class="mb-3">{{ $orderDetail->Product->name }}</h6>
                                <p class="mb-2">SKU: {{ $orderDetail->Product->seller_sku }}</p>
                                <p class="mb-0">Price: (Inclusive Tax)</p>
                            </div>
                            <div class="col-md-1">
                                <div class="price-info">
                                    <p class="mb-2">{{ $orderDetail->quantity * $orderDetail->unit_price }} Taka</p>
                                    <p class="mb-0"><input type="text" data-product_id="{{$orderDetail->Product->id}}" name="product_return_qty_{{$orderDetail->Product->id}}" id="product_return_qty_{{$orderDetail->Product->id}}" class="form-control form-control-sm product-return-qty" placeholder="Quantity"/></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" value="{{ $orderDetail->quantity }}" name="product_order_qty_{{$orderDetail->Product->id}}" id="product_order_qty_{{$orderDetail->Product->id}}" class="form-control form-control-sm" readonly/>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="product_order_cancel_qty_{{$orderDetail->Product->id}}" id="product_order_cancel_qty_{{$orderDetail->Product->id}}" class="form-control form-control-sm" readonly/>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" name="product_order_remaining_qty_{{$orderDetail->Product->id}}" id="product_order_remaining_qty_{{$orderDetail->Product->id}}" class="form-control form-control-sm" readonly/>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <select name="product_return reason_{{$orderDetail->Product->id}}" id="product_return reason_{{$orderDetail->Product->id}}" class="form-control form-control-sm">
                                            <option value="">Select Product Cancel Reason</option>
                                            <?php
                                            foreach ($cancel_reasons as $value => $label) {
                                                echo '<option value="' . $value . '">' . $label . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-primary btn-sm mr-2">Save</button>
                                <button type="button" class="btn btn-secondary btn-sm">Cancel</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
     
        {{-- End Content --}}
    </div>
    <!-- end row -->
@endsection
@push('script')
    <!-- Include jQuery library if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('.product-return-qty').keyup(function() {
        var productId = $(this).data('product_id');
        var orderedQty = parseFloat($('#product_order_qty_' + productId).val());
        var cancelQty = parseFloat($('#product_order_cancel_qty_' + productId).val());
        var returnQty = parseFloat($(this).val());

        if (isNaN(returnQty)) {
            returnQty = 0;
            returnQty = null;
            remainingQty = null;
        } else {
            var remainingQty = orderedQty - returnQty;
        }

        

        $('#product_order_cancel_qty_' + productId).val(returnQty);
        $('#product_order_remaining_qty_' + productId).val(remainingQty);
    });
});
</script>

@endpush
