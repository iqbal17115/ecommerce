@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Brand List</span>
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal"
                    data-target="#brandModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
                <input class="float-right mr-2 py-1" name="search_string" id="search_string" placeholder="Search..." />
            </div>
            <div class="col-md-12 brand_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Website</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($brands as $brand)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$brand->name}}</td>
                            <td><img src="{{ asset('storage/'.$brand->image) }}" class="rounded"
                                    style="width: 55px; height: 40px;" /></td>
                            <td>{{$brand->website}}</td>
                            <td>{{$brand->is_active == 1? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form"
                                    data-toggle="modal" data-target="#brandModal" data-id="{{$brand->id}}"
                                    data-name="{{$brand->name}}" data-image="{{$brand->image}}"
                                    data-short_name="{{$brand->short_name}}" data-is_active="{{$brand->is_active}}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_brand"
                                    data-id="{{$brand->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $brands->links() !!}
            </div>
        </div>
    </div>
<form method="POST" action="javascript:test('brand_form')" id="brand_form">
    @csrf
    <input type="" name="" value="" required>
    <button type="">Save</button>
</form>
<script>
    function test(brand_form) {
        alert(brand_form);
    }
</script>
</div>

@include('backend.product.modal.brand')

@endsection
@section('script')

@include('backend.product.js.brand-js')
{!! Toastr::message() !!}

@endsection