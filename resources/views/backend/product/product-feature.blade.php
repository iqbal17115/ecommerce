@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Feature List</span>
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal"
                    data-target="#productFeatureModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
                <input class="float-right mr-2 py-1" name="search_string" id="search_string" placeholder="Search..."/>
            </div>
            <div class="col-md-12 product_feature_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($product_features as $product_feature)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$product_feature->name}}</td>
                            <td>{{$product_feature->position}}</td>
                            <td>{{$product_feature->is_active == 1? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form"
                                    data-toggle="modal" data-target="#productFeatureModal" data-id="{{$product_feature->id}}"
                                    data-name="{{$product_feature->name}}" data-short_name="{{$product_feature->position}}"
                                    data-is_active="{{$product_feature->is_active}}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_product_feature"
                                    data-id="{{$product_feature->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
               {!! $product_features->links() !!}
            </div>
        </div>
    </div>

</div>

@include('backend.product.modal.product-feature')

@endsection
@section('script')

@include('backend.product.js.product-feature-js')
{!! Toastr::message() !!}

@endsection