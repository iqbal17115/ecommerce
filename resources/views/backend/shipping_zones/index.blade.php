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
                    data-target="#shippingChargeZone" id="add_new"><i class="fas fa-plus-circle"></i> New</a>

            </div>
            <div class="col-md-12">
                @include('components.data-table')
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="shippingChargeZone" tabindex="-1" aria-labelledby="shippingChargeZoneLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="targeted_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shippingChargeZoneLabel">Add / Edit Shipping Zone</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="row_id" name="id" />

                    <div class="mb-3">
                        <label for="zone_name" class="form-label">Zone Name</label>
                        <input type="text" class="form-control" id="zone_name" name="zone_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="zone_type" class="form-label">Type</label>
                        <select class="form-control" id="zone_type" name="zone_type" required>
                            <option value="inside_outside">Inside / Outside</option>
                            <option value="location">Location Wise</option>
                            <option value="mixed">Mixed</option>
                        </select>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="save-btn" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
    @endsection
    @push('scripts')
    <script src="{{ asset('js/admin_panel/shipping_zones.js') }}?v={{ time() }}"></script>
    <script>
        loadDataTable();
    </script>
    @endpush