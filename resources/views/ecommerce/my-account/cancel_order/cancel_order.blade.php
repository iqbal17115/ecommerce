@extends('layouts.ecommerce')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="{{ URL::asset('css/common.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <main class="main">
        <div class="container">
            <div class="row">
                {{-- Start Content --}}
                <div class="col-12">

                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <div class="row">
                                    <div class="col-md-9 text-success">
                                        Cancellation Product<br><br>
                                        <input type="checkbox" id="manage_check_boxes" class="ml-4"> &nbsp;<span
                                            class="text-dark" style="opacity: 0.7;">Select All</span>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-4 text-center text-danger">Quantity</div>
                                            <div class="col-md-4 text-center text-danger">cancelled</div>
                                            <div class="col-md-4 text-center text-danger">Remaining</div>
                                        </div>
                                    </div>
                                </div>
                            </h5>
                            <form action="{{ route('cancellation_product') }}" id="order_product_cancellation">
                                @csrf
                                <!-- Assuming you have an array of products called 'products' -->
                                @foreach ($order->OrderDetail as $orderDetail)
                                    <div class="row shadow-sm py-2">
                                        <div class="col-md-1 d-flex justify-content-between">
                                            <div class="custom-control custom-checkbox custom-control-lg mr-2">
                                                <input type="checkbox" name="order_detail_id[]"
                                                    value="{{ $orderDetail->id }}">
                                            </div>
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
                                                <p class="mb-2">{{ $orderDetail->quantity * $orderDetail->unit_price }}
                                                    Taka</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" value="{{ $orderDetail->quantity }}"
                                                        name="previous_quantity[]"
                                                        id="previous_quantity{{ $orderDetail->Product->id }}"
                                                        class="form-control form-control-sm" readonly />
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" data-product_id="{{ $orderDetail->Product->id }}"
                                                        name="product_return_qty_{{ $orderDetail->Product->id }}"
                                                        id="product_return_qty_{{ $orderDetail->Product->id }}"
                                                        class="form-control form-control-sm product-return-qty"
                                                        placeholder="Quantity" />
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="text" name="new_quantity[]"
                                                        id="new_quantity{{ $orderDetail->Product->id }}"
                                                        class="form-control form-control-sm" readonly />
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <select name="change_reason"
                                                        id="product_return reason_{{ $orderDetail->Product->id }}"
                                                        class="form-control form-control-sm">
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
                                            <button type="submit" class="btn btn-primary btn-sm mr-2">Save</button>
                                            <button type="button" class="btn btn-secondary btn-sm">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- End Content --}}
            </div>
            <!-- end row -->
        </div>
    </main><!-- End .main -->
@endsection
@push('scripts')
    <!-- Include jQuery library if not already included -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/panel/action.js') }}"></script>
    <script src="{{ asset('js/panel/common.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('js/panel/web/my_account/cancel_order.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.product-return-qty').keyup(function() {
                var productId = $(this).data('product_id');
                var orderedQty = parseFloat($('#previous_quantity' + productId).val());
                var returnQty = parseFloat($(this).val());

                if (isNaN(returnQty)) {
                    returnQty = 0;
                    returnQty = null;
                    remainingQty = null;
                } else {
                    var remainingQty = orderedQty - returnQty;
                }



                $('#product_order_cancel_qty_' + productId).val(returnQty);
                $('#new_quantity' + productId).val(remainingQty);
            });
        });
    </script>
@endpush
