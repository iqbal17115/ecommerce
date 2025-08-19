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
                    <div class="col-md-12 mb-3">
                        <label for="shipping_zone_filter" class="form-label">Shipping Zone</label>
                        <select id="shipping_zone_filter" name="shipping_zone_id" class="form-select">
                            <option value="">Select Zone</option>
                        </select>
                    </div>

                    <div id="rate-container">
                        <!-- Dynamic rows will be added here -->
                    </div>
                    
                    <button type="button" class="btn btn-sm btn-success mt-2" id="add-rate-row">
                        <i class="fa fa-plus"></i> Add Rate
                    </button>

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