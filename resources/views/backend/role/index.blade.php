@include('layouts.admin_partials.datatable_resource')

@extends('layouts.backend_app')
@section('individual__link')
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="tab-content rounded-bottom">Role</div>
                        <div class="d-flex">
                            @include("components.data-table-search")
                            <button class="btn btn-sm btn-primary add_new" type="button" data-coreui-toggle="modal"
                                style="margin-left: 4px;">Add
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('components.data-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <!-- Start Modal -->
<div class="modal fade" id="roleModalXl" tabindex="-1" aria-labelledby="roleModalXlLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="custom-border-class p-3 d-flex justify-content-between">
                <h5 class="modal-title h4" id="roleModalXlLabel">Assign Role</h5>
                <center>
                    Select All: <input type="checkbox" class="custom-control-input" name="manage_check_boxes"
                        id="manage_check_boxes">
                </center>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="assign_role_form">
                <div class="modal-body">
                    <div class="row" id="assign_role">
                        <!-- Assign role here -->
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection
@push('scripts')
<script src="{{asset('js/panel/roles.js')}}"></script>
<script>
loadDataTable();
</script>
@endpush
