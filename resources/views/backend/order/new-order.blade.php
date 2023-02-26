@extends('layouts.backend_app')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="search-box mr-2 mb-2 d-inline-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <i class="bx bx-search-alt search-icon"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="text-sm-right">
                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2"><i
                            class="mdi mdi-plus mr-1"></i> Add New Order</button>
                </div>
            </div><!-- end col-->
        </div>

        <div class="table-responsive">
            <table class="table table-centered table-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 20px;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                            </div>
                        </th>
                        <th>Order ID</th>
                        <th>Billing Name</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Payment Status</th>
                        <th>Payment Method</th>
                        <th>View Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($new_orders as $new_order)
                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck2">
                                <label class="custom-control-label" for="customCheck2">&nbsp;</label>
                            </div>
                        </td>
                        <td><a href="javascript: void(0);" class="text-body font-weight-bold">{{$new_order->code}}</a>
                        </td>
                        <td>{{$new_order->Contact->first_name}}</td>
                        <td>
                            {{date('d-M-Y', strtotime($new_order->order_date))}}
                        </td>
                        <td>
                            ${{$new_order->payable_amount}}
                        </td>
                        <td>
                            <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                        </td>
                        <td>
                            <i class="fab fa-cc-mastercard mr-1"></i> Mastercard
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" data-order_id="{{$new_order->id}}"
                                class="btn btn-primary btn-sm btn-rounded new-order" data-toggle="modal"
                                data-target=".exampleModal">
                                View Details
                            </button>
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="mr-3 text-primary" data-toggle="tooltip"
                                data-placement="top" title="" data-original-title="Edit"><i
                                    class="mdi mdi-pencil font-size-18"></i></a>
                            <a href="javascript:void(0);" class="text-danger" data-toggle="tooltip" data-placement="top"
                                title="" data-original-title="Delete"><i class="mdi mdi-close font-size-18"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <ul class="pagination pagination-rounded justify-content-end mb-2">
            <li class="page-item disabled">
                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                    <i class="mdi mdi-chevron-left"></i>
                </a>
            </li>
            <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
            <li class="page-item">
                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                    <i class="mdi mdi-chevron-right"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- Modal -->
<div class="modal fade exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body order-modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@include('backend.order.order-js')
@endsection