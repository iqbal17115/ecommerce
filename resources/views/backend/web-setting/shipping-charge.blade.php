@extends('layouts.backend_app')

@section('individual__link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 p-2 rounded" style="background-color: #e4ebea;">
                <span class="h4">Shipping Charge</span>
                <a class="btn btn-success text-light btn-sm py-2 float-right clean_form" data-toggle="modal" data-target="#blockModal" style="width: 100px;"><i class="fas fa-plus-circle"></i> New</a>
            </div>
            <div class="col-md-12 block_content">
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">SL.</th>
                            <th scope="col">Type</th>
                            <th scope="col">Start</th>
                            <th scope="col">End</th>
                            <th scope="col">Inside Amount</th>
                            <th scope="col">Outside Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach($shipping_charges as $shipping_charge)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{$shipping_charge->type}}</td>
                            <td>{{$shipping_charge->start}}</td>
                            <td>{{$shipping_charge->end}}</td>
                            <td>{{$shipping_charge->inside_amount}}</td>
                            <td>{{$shipping_charge->outside_amount}}</td>
                            <td>{{$shipping_charge->is_active == 1? 'Active' : 'Inactive'}}</td>
                            <td>
                                <button type="button" class="btn btn-info text-light btn-sm update_form" data-toggle="modal" data-target="#blockModal" data-id="{{$shipping_charge->id}}" data-type="{{$shipping_charge->type}}" data-start="{{$shipping_charge->start}}" data-end="{{$shipping_charge->end}}" data-inside_amount="{{$shipping_charge->inside_amount}}" data-outside_amount="{{$shipping_charge->outside_amount}}" data-is_active="{{$shipping_charge->is_active}}">
                                    <i class="mdi mdi-pencil font-size-16"></i>
                                </button>
                                <button type="button" class="btn btn-danger text-light btn-sm delete_block" data-id="{{$shipping_charge->id}}">
                                    <i class="mdi mdi-trash-can font-size-16"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                {!! $shipping_charges->links() !!}
            </div>
        </div>
    </div>

</div>

@include('backend.web-setting.modal.shipping-charge')

@endsection
@section('script')

@include('backend.web-setting.js.shipping-charge-js')
{!! Toastr::message() !!}
@endsection