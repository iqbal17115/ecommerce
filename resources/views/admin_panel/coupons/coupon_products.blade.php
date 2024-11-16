@include('layouts.admin_partials.datatable_resource')

@extends('layouts.backend_app')
@section('individual__link')
@endsection
@section('content')
<style>
        #productList {
            display: none;
            position: absolute;
            list-style-type: none;
            padding: 0;
            margin: 0;
            border: 1px solid #ccc;
            background-color: #fff;
            max-height: 200px;
            overflow-y: auto;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #productList li {
            padding: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #productList li:hover {
            background-color: #f4f4f4;
        }

        #selectedProducts {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #selectedProducts li {
            background-color: #f8f8f8;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #selectedProducts button.remove-product {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        #selectedProducts button.delete_row {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 6px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
</style>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="text-white rounded mb-2 bg-primary mb-1">{{ $model->code }}</h2>
                  </div>
                <form id="targeted_form">
                    <div class="col-md-12">
                        <input type="text" id="searchInput" class="form-control mb-2" placeholder="Search for products">
                        <ul id="productList"></ul>
                        <ul id="selectedProducts"></ul>
                    </div>

                    <!-- Hidden input to store selected product IDs -->
                    <input type="hidden" name="selectedProductIds" id="selectedProductIdsInput">
                    <input type="hidden" name="coupon_id" id="coupon_id" value="{{ $model->id }}">

                    <button type="submit" id="submitForm" class="float-right">Submit</button>
                </form>
            </div>
        </div>

    </div>
    <!-- sample modal content -->
@endsection
@push('scripts')
<script src="{{asset('js/admin_panel/coupons/coupon_products.js')}}"></script>
<script>
    loadData();
</script>
@endpush
