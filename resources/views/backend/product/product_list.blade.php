@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Product List</span>
                <a href="{{ route('product-product') }}"
                    class="btn btn-success text-light btn-sm py-2 float-right clean_form" style="width: 100px;"><i
                        class="fas fa-plus-circle"></i> New</a>
                <input class="float-right mr-2 py-1" name="search_string" id="search_string" placeholder="Search..." />
            </div>
            <div class="col-md-12 product_content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Stock qty</th>
                            <th scope="col">Your Price</th>
                            <th scope="col">Sale Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($products as $product)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td style="word-wrap: break-word; white-space: pre-line;">{{$product->name}}</td>
                            <td>
                                <a class="badge badge-secondary product_stock_qty_{{$product->id}}" data-product_id="{{$product->id}}" data-stock_qty="{{$product->stock_qty}}" data-toggle="modal"
                                data-target="#productStockQtyModal" id="product_stock_qty">{{$product->stock_qty}}</a>
                            </td>
                            <td>{{$product->your_price}}</td>
                            <td>{{$product->sale_price}}</td>
                            <td>
                                @if($product->Category)
                                {{$product->Category->name}}
                                @endif
                            </td>
                            <td>
                                @if($product->Brand)
                                {{$product->Brand->name}}
                                @endif
                            </td>
                            <td style="width: 100px;">
                                <button type="button" class="btn btn-danger text-light btn-sm delete_product"
                                    data-id="{{$product->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                                <a href="{{ route('product-product', ['id'=>$product->id]) }}"
                                    class="btn btn-info text-light btn-sm">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $products->links() !!}
            </div>
        </div>
    </div>

</div>

<!-- sample modal content -->
<div id="productStockQtyModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myCountryLabel" aria-hidden="true">
    <form action="" method="post" id="stock_qty_targeted_form">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myCountryLabel">Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="row_id" id="row_id" value="" hidden/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="stock_qty">Increase Stock qty</label>
                                <input type="text" name="stock_qty" id="stock_qty" class="form-control"
                                    placeholder="Increase Stock qty" required>
                            </div>
                        </div>

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

@include('backend.product.modal.brand')

@endsection
@section('script')

@include('backend.product.js.product_list-js')
<script src="{{asset('js/admin_panel/product/product_list.js')}}"></script>
@endsection
