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
                    data-target="#shippingZoneLocation" id="add_new"><i class="fas fa-plus-circle"></i> New</a>

            </div>
            <div class="col-md-12">
                @include('components.data-table')
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="shippingZoneLocation" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="shipping_zone_location">
            <input type="hidden" id="shipping_zone_id" name="shipping_zone_id">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Manage Shipping Zone Locations</h5>
                    <button type="button" class="btn-close" data-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Zone Select -->
                    <div class="mb-3">
                        <label for="shipping_zone" class="form-label">Select Shipping Zone</label>
                        <select id="shipping_zone" name="shipping_zone_id" class="form-select"></select>
                    </div>

                    <!-- Dynamic Rows -->
                    <div id="location_rows"></div>
                    <div class="mt-3">
                        <table class="table table-bordered" id="upazilaTable">
                            <thead>
                                <tr>
                                    <th>
                                        Upazila
                                    </th>
                                    <th>
                                        <center>
                                        <input type="checkbox" id="checkAllUpazilas">
                                        </center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Upazilas will be appended here --}}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Save Locations</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@push('scripts')
<script src="{{ asset('js/admin_panel/shipping_zone_locations.js') }}?v={{ time() }}"></script>
<script>
    loadDataTable();
</script>
@endpush