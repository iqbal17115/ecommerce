@include('layouts.admin_partials.datatable_resource')

@extends('layouts.backend_app')
@section('individual__link')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 mb-2">
                    @include('components.data-table-search')
                </div>
                <div class="col-md-10 mb-2">
                    <a class="btn btn-success text-light btn-sm float-right add-new" data-toggle="modal"
                        data-target="#countryModal" id="add_new"><i class="fas fa-plus-circle"></i> New</a>

                </div>
                <div class="col-md-12">
                    @include('components.data-table')
                </div>
            </div>
        </div>

    </div>
    <!-- sample modal content -->
    <div id="countryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myUpazilaLabel"
        aria-hidden="true">
        <form method="post" id="targeted_form">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myUpazilaLabel">Area</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input name="row_id" id="row_id" value="" hidden />
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <x-custom-input-label for="district_id" label="District" :required="true" />
                                @include('components.select-option', [
                                    'dataTable' => 'districts',
                                    'name' => 'district_id',
                                    'id' => 'district_id',
                                ])
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Area Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Enter Area Name" required>
                                    <span class="text-danger"></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" id="close_button"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light"
                            id="show_button">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->
@endsection
@push('scripts')
    <script src="{{ asset('js/admin_panel/shop_setting/upazila.js') }}"></script>
    <script>
        loadDataTable();
    </script>
@endpush
