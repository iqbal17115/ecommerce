<div class="tab-pane" id="progress-confirm-detail">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="text-center">
                <div class="mb-4">
                    <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                </div>
                <div>
                    <h5>Confirm Detail</h5>
                    {{-- <p class="text-muted">If several languages coalesce, the grammar of the resulting</p> --}}
                </div>

                <form method="POST" action="{{ route('product.save') }}">
                    @csrf
                    <input type="hidden" name="product_id" class="product_id"
                    @if($productInfo) value="{{$productInfo->id}}" @else value="-1"
                    @endif />
                    <div class="form-group">
                        <label for="product-status">Product Status</label>
                        <select class="form-control" id="product-status" name="status">
                            @foreach($product_statuses as $key => $value)
                                <option value="{{ $key }}" @if($productInfo && $productInfo->status == $key) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Other form fields here -->

                    <button type="submit" class="btn btn-primary mt-4">Save Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
