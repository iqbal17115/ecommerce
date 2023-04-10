@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Currency List</span>
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal" data-target="#currencyModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
            </div>
            <div class="col-md-12 currency_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Position</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Default Status</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($currencies as $currency)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$currency->name}}</td>
                            <td>{{$currency->icon}}</td>
                            <td>{{$currency->position}}</td>
                            <td>{{$currency->conversion_rate}}</td>
                            <td>{{$currency->is_default==1 ? 'Yes' : 'No'}}</td>
                            <td>{{$currency->is_active == 1? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form" data-toggle="modal" data-target="#currencyModal" data-id="{{$currency->id}}" data-name="{{$currency->name}}" data-icon1="{{$currency->icon}}" data-position="{{$currency->position}}" data-conversion_rate="{{$currency->conversion_rate}}" data-is_default="{{$currency->is_default}}" data-is_active="{{$currency->is_active}}">
                                <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_currency" data-id="{{$currency->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $currencies->links() !!}
            </div>
        </div>
    </div>

</div>

@include('backend.currency.currency-modal')

@endsection
@section('script')

@include('backend.currency.currency-js')
{!! Toastr::message() !!}
@endsection