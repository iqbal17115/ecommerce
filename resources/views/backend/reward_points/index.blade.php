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
                    data-target="#rewardPointModal" id="add_new"><i class="fas fa-plus-circle"></i> New</a>

            </div>
            <div class="col-md-12">
                @include('components.data-table')
            </div>
        </div>
    </div>

</div>
<!-- sample modal content -->
<div id="rewardPointModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myRewardPointLabel" aria-hidden="true">
    <form action="" method="post" id="targeted_form">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myRewardPointLabel">Reward Point</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="row_id" id="row_id" value="" />

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="event">Event</label>
                                <select name="event" id="event" class="form-control" required>
                                    <option value="" disabled selected>Select an event</option>
                                    <option value="1">Registration</option>
                                    <option value="2">Order</option>
                                    <option value="3">Review</option>
                                    <option value="4">Referral</option>
                                    <option value="5">Birthday</option>
                                </select>
                                <span class="text-danger err_event"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="points">Points</label>
                                <input type="number" name="points" id="points" class="form-control" placeholder="Enter Points" required>
                                <span class="text-danger err_points"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="multiplier">Multiplier (Optional)</label>
                                <input type="number" name="multiplier" id="multiplier" step="0.01" class="form-control" placeholder="e.g. 1.2">
                                <span class="text-danger err_multiplier"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" id="close_button" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="show_button">Save</button>
                </div>
            </div>
        </div>
    </form>
</div><!-- /.modal -->
@endsection
@push('scripts')
<script src="{{asset('js/admin_panel/reward_points.js')}}"></script>
<script>
    loadDataTable();
</script>
@endpush