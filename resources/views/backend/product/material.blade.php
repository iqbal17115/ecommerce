@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Material List</span>
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal"
                    data-target="#materialModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
                <input class="float-right mr-2 py-1" name="search_string" id="search_string" placeholder="Search..."/>
            </div>
            <div class="col-md-12 material_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($materials as $material)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$material->name}}</td>
                            <td>{{$material->is_active == 1? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form"
                                    data-toggle="modal" data-target="#materialModal" data-id="{{$material->id}}"
                                    data-name="{{$material->name}}"
                                    data-is_active="{{$material->is_active}}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_material"
                                    data-id="{{$material->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
               {!! $materials->links() !!}
            </div>
        </div>
    </div>

</div>

@include('backend.product.modal.material')

@endsection
@section('script')

@include('backend.product.js.material-js')
{!! Toastr::message() !!}

@endsection