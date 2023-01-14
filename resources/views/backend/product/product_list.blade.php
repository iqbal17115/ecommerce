@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Product List</span>
                <a href="{{ route('product-product') }}" class="btn btn-success text-light btn-sm py-2 float-right clean_form" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
                <input class="float-right mr-2 py-1" name="search_string" id="search_string" placeholder="Search..." />
            </div>
            <div class="col-md-12 product_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
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
                            <td>{{$product->name}}</td>
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
                            <td>
                                <a href="{{ route('product-product', Crypt::encrypt(['id'=>$product->id])) }}" class="btn btn-info text-light">
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

@include('backend.product.modal.brand')

@endsection
@section('script')

@include('backend.product.js.product_list-js')

@endsection