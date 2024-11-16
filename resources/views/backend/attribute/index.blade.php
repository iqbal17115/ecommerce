@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Attribute List</span>
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal"
                    data-target="#attributeModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
                <input class="float-right mr-2 py-1" name="search_string" id="search_string" placeholder="Search..." />
            </div>
            <div class="col-md-12 attribute_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($attributes as $attribute)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$attribute->name}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form"
                                    data-toggle="modal" data-target="#attributeModal" data-id="{{$attribute->id}}"
                                    data-name="{{$attribute->name}}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_attribute"
                                    data-id="{{$attribute->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $attributes->links() !!}
            </div>
        </div>
    </div>
</div>

@include('backend.attribute.modal.attribute')

@endsection
@section('script')

@include('backend.attribute.js.attribute-js')
{!! Toastr::message() !!}

@endsection
