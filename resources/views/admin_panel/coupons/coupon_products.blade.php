@include('layouts.admin_partials.datatable_resource')

@extends('layouts.backend_app')
@section('individual__link')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 mb-2">
                    @include("components.data-table-search")
                </div>
                <div class="col-md-10 mb-2">
                    <a class="btn btn-success text-light btn-sm float-right add-new" data-toggle="modal"
                        data-target="#couponProductModal" id="add_new"><i class="fas fa-plus-circle"></i> New</a>

                </div>
                <div class="col-md-12">
                        @include('components.data-table')
                </div>
            </div>
        </div>

    </div>
    <!-- sample modal content -->
    <div id="couponProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myCountryLabel" aria-hidden="true">
        <form action="" method="post" id="targeted_form">
            @csrf
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myCountryLabel">Coupon Products</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input name="row_id" id="row_id" value="" hidden/>
                        <div class="row">
                            <div class="col-md-12">
                                <x-custom-input-label for="coupon_id" label="Coupon" :required="true"/>
                                @include('components.select-option', ['dataTable' => 'coupons', 'name' => 'coupon_id', 'id' => 'coupon_id'])
                            </div>
                            {{-- End --}}

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_id">Products</label>
                                    <select class="form-control" name="product_id[]" id="product_id" multiple>
                                        <option value="">-- Select --</option>
                                        @foreach($model as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- End --}}

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" id="close_button" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="show_button">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('js/admin_panel/coupons/coupon_products.js')}}"></script>
<script>
    $(document).ready(function() {
    $("#product_id").select2({
        dropdownParent: $("#couponProductModal"),
        placeholder: 'Select An Option'
    });
});
    loadDataTable();
</script>
@endpush
