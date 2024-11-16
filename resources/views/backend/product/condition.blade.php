@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Condition List</span>
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal" data-target="#conditionModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
            </div>
            <div class="col-md-12 condition_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($conditions as $condition)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$condition->title}}</td>
                            <td>{{$condition->is_active == 1? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form" data-toggle="modal" data-target="#conditionModal" data-id="{{$condition->id}}" data-title="{{$condition->title}}" data-description="{{$condition->description}}" data-is_active="{{$condition->is_active}}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_condition" data-id="{{$condition->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $conditions->links() !!}
            </div>
        </div>
    </div>

</div>

@include('backend.product.modal.condition')

@endsection
@section('script')

@include('backend.product.js.condition-js')
{!! Toastr::message() !!}

@endsection