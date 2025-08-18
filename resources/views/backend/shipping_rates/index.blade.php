@include('layouts.admin_partials.datatable_resource')

@extends('layouts.backend_app')
@section('individual__link')
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2 mb-2">
                @include("components.data-table-search")
            </div>
            <div class="col-md-10 mb-2">
                <a class="btn btn-success text-light btn-sm float-right add-new" data-toggle="modal"
                    data-target="#shippingRateModal" id="add_new"><i class="fas fa-plus-circle"></i> New</a>

            </div>
            <div class="col-md-12">
                @include('components.data-table')
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="shippingRateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="targeted_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add / Edit Shipping Rate</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" id="close_button"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="row_id" name="id" />
                    <input type="hidden" id="zone_id" name="shipping_zone_id" />
                    <input type="hidden" id="zone_type" />

                    <div class="col-md-4">
                        <label for="shipping_zone_filter" class="form-label">Shipping Zone</label>
                        <select id="shipping_zone_filter" class="form-select">
                            <option value="">Select Zone</option>
                        </select>
                    </div>

                    <!-- Inside/Outside variant -->
                    <div id="insideOutsideFields" class="d-none">
                        <div class="row">
                        <div class="col-md-6">
                            <label for="inside_rate" class="form-label">Inside Rate</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="inside_rate" name="inside_rate" placeholder="Enter inside rate">
                        </div>
                        <div class="col-md-6">
                            <label for="outside_rate" class="form-label">Outside Rate</label>
                            <input type="number" step="0.01" min="0" class="form-control" id="outside_rate" name="outside_rate" placeholder="Enter outside rate">
                        </div>
                        </div>
                    </div>

                    <!-- Tiered (shipping_rates) variant -->
                    <div id="tierFields" class="d-none">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label">Min Amount</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="min_amount" name="min_amount" placeholder="Enter minimum amount">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Max Amount</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="max_amount" name="max_amount" placeholder="Enter maximum amount">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Min Weight</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="min_weight" name="min_weight" placeholder="Enter minimum weight">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Max Weight</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="max_weight" name="max_weight" placeholder="Enter maximum weight">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Min Qty</label>
                                <input type="number" min="0" class="form-control" id="min_qty" name="min_qty" placeholder="Enter minimum quantity">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Max Qty</label>
                                <input type="number" min="0" class="form-control" id="max_qty" name="max_qty" placeholder="Enter maximum quantity">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Rate</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="rate" name="rate" placeholder="Enter rate">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" id="save-btn" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel_button">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/admin_panel/shipping_rates.js') }}"></script>
<script>
    loadDataTable();
</script>
@endpush