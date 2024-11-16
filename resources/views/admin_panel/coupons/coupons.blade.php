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
                        data-target="#couponModal" id="add_new"><i class="fas fa-plus-circle"></i> New</a>

                </div>
                <div class="col-md-12">
                        @include('components.data-table')
                </div>
            </div>
        </div>

    </div>
    <!-- sample modal content -->
    <div id="couponModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myCountryLabel" aria-hidden="true">
        <form action="" method="post" id="targeted_form">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myCountryLabel">Coupon Codes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input name="row_id" id="row_id" value="" hidden/>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" name="code" id="code" class="form-control"
                                        placeholder="Enter coupon code" required>
                                </div>
                            </div>
                            {{-- End --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="max_uses">Max Uses</label>
                                    <input type="text" name="max_uses" id="max_uses" class="form-control"
                                        placeholder="Enter max uses" required>
                                </div>
                            </div>
                            {{-- End --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="valid_from">Valid From</label>
                                    <input type="date" name="valid_from" id="valid_from" class="form-control" required>
                                </div>
                            </div>
                            {{-- End --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="valid_to">Valid To</label>
                                    <input type="date" name="valid_to" id="valid_to" class="form-control" required>
                                </div>
                            </div>
                            {{-- End --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" name="type" id="type">
                                        <option value="">-- Select --</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed_amount">Fixed Amount</option>
                                    </select>
                                </div>
                            </div>
                            {{-- End --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="value">Value</label>
                                    <input type="text" name="value" id="value" class="form-control" placeholder="Enter value" required>
                                </div>
                            </div>
                            {{-- End --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minimum_order_amount">Minimum Order Amount</label>
                                    <input type="text" name="minimum_order_amount" id="minimum_order_amount" class="form-control" placeholder="Enter minimum order amount">
                                </div>
                            </div>
                            {{-- End --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="usage_limit_per_user">Usage Limit Per User</label>
                                    <input type="text" name="usage_limit_per_user" id="usage_limit_per_user" class="form-control" placeholder="Enter usage limit per user" required>
                                </div>
                            </div>
                            {{-- End --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" id="close_button" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="show_button">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div><!-- /.modal -->
@endsection
@push('scripts')
<script src="{{asset('js/admin_panel/coupons/coupons.js')}}"></script>
<script>
    loadDataTable();
</script>
@endpush
