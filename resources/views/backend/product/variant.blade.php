@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Variant List</span>
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal"
                    data-target="#variantModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
                <input class="float-right mr-2 py-1" name="search_string" id="search_string" placeholder="Search..." />
            </div>
            <div class="col-md-12 variant_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Variant Type</th>
                            <th scope="col">Variant Name</th>
                            <th scope="col">Color Code</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($variants as $variant)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$variant->type}}</td>
                            <td>{{$variant->name}}</td>
                            <td>
                                @if($variant->color_code)
                                <input type="color" value="{{$variant->color_code}}" disabled />
                                @endif
                            </td>
                            <td>{{$variant->is_active == 1? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form"
                                    data-toggle="modal" data-target="#variantModal" data-id="{{$variant->id}}"
                                    data-type="{{$variant->type}}" data-name="{{$variant->name}}"
                                    data-color_code="{{$variant->color_code}}" data-is_active="{{$variant->is_active}}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_variant"
                                    data-id="{{$variant->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $variants->links() !!}
            </div>
        </div>
    </div>

</div>

@include('backend.product.modal.variant')

@endsection
@section('script')

@include('backend.product.js.variant-js')
{!! Toastr::message() !!}

@endsection