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
                    data-target="#shippingChargeModal" id="add_new"><i class="fas fa-plus-circle"></i> New</a>

            </div>
            <div class="col-md-12">
                @include('components.data-table')
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="shippingChargeModal" tabindex="-1" aria-labelledby="shippingChargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="targeted_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shippingChargeModalLabel">Add / Edit Shipping Charge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="row_id" name="id" />

                    <div class="mb-3">
                        <label for="division" class="form-label">Division</label>
                        <select id="division" name="division" class="form-select">
                            <option value="">Select Division</option>
                            {{-- Populate dynamically --}}
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="district" class="form-label">District</label>
                        <select id="district" name="district" class="form-select">
                            <option value="">Select District</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="thana" class="form-label">Upazila</label>
                        <select id="thana" name="thana" class="form-select">
                            <option value="">Select Upazila</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="min_qty" class="form-label">Min Order Qty</label>
                        <input type="number" min="0" id="min_qty" name="min_qty" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label for="max_qty" class="form-label">Max Order Qty</label>
                        <input type="number" min="0" id="max_qty" name="max_qty" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label for="min_order_amount" class="form-label">Min Order Amount</label>
                        <input type="number" step="0.01" min="0" id="min_order_amount" name="min_order_amount" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label for="max_order_amount" class="form-label">Max Order Amount</label>
                        <input type="number" step="0.01" min="0" id="max_order_amount" name="max_order_amount" class="form-control" />
                    </div>

                    <div class="mb-3">
                        <label for="charge_amount" class="form-label">Charge Amount</label>
                        <input type="number" step="0.01" min="0" id="charge_amount" name="charge_amount" class="form-control" required />
                    </div>

                    <!-- Other fields here -->

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">Active</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="save-btn" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    @endsection
    @push('scripts')
    <script src="{{ asset('js/admin_panel/shipping_charges.js') }}"></script>
    <script src="{{ asset('js/address.js') }}"></script>
    <script>
        loadDataTable();
    </script>
    @endpush