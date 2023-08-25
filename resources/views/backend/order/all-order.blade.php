@extends('layouts.backend_app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row mb-1">
                <div class="col-md-2">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="search_input" placeholder="Search...">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="bx bx-search-alt"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row mb-4">
                        <div class="col-lg-12">
                            <div class="input-daterange input-group" data-provide="datepicker">
                                <input type="date" class="form-control form-control-sm" placeholder="Start Date"
                                    name="start" />
                                <input type="date" class="form-control form-control-sm" placeholder="End Date"
                                    name="end" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <select class="form-control form-control-sm" id="order_status">
                        <option value="">-- Order Status --</option>
                        @foreach ($statusValues as $statusValue)
                            <option value="{{ $statusValue }}">{{ $statusValue }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex align-items-center justify-content-end">
                        <select class="form-control form-control-sm" id="itemsPerPageSelect">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="d-flex justify-content-end mb-3">
                        <div>
                            <button class="btn btn-success btn-sm" id="pdfBtn">Generate PDF</button>
                            <button class="btn btn-info btn-sm" id="csvBtn">Export CSV</button>
                        </div>
                    </div>
                </div>
            </div>



            <div class="table-responsive">
                <table class="table table-centered nowrap" id="datatable-buttons">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Seller</th>
                            <th>Payment Status</th>
                            <th>Delivery Type</th>
                            <th>Fullfilment Status</th>
                            <th>View</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="order_container"></tbody>
                </table>
            </div>
            <div id="pagination_container" class="mt-3"></div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
@push('script')

@endpush
