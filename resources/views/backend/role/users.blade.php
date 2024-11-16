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
                        <div class="tab-content rounded-bottom">User</div>
                        <div class="d-flex">
                            @include("components.data-table-search")
                            <button class="btn btn-sm btn-primary add_user" type="button" data-coreui-toggle="modal"
                                    data-coreui-target="#targetedModal" style="margin-left: 4px;">Add
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
  <!-- Start Post Modal -->
  <div class="modal fade" id="targetedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Info</h5>
                <button class="btn-close" type="button" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="targeted_form">
                <input name="row_id" id="row_id" value="" hidden/>
                <div class="modal-body row">
                    <div class="col-md-6 mb-3">
                        <label class="col-form-label" for="name">Name<span class="red-asterisk"></span></label>
                        <input class="form-control" name="name" id="name"
                               placeholder="Name" required/>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="col-form-label" for="email">Email<span class="red-asterisk"></span></label>
                        <input class="form-control" name="email" id="email"
                               placeholder="Email" required/>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label" for="mobile">Mobile<span class="red-asterisk"></span></label>
                        <input class="form-control" name="mobile" id="mobile"
                               placeholder="Mobile" required/>
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label" for="role_id">Role Name<span
                                class="red-asterisk"></span></label>
                        <select class="form-control" name="role_id[]" id="role_id" multiple>
                            @foreach($model as $role)
                                <option value="{{$role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" id="user_password">
                        <label class="col-form-label" for="password">Password<span
                                class="red-asterisk"></span></label>
                        <input class="form-control" name="password" id="password"
                               placeholder="Password" required/>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-coreui-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" id="createPostButton">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('js/panel/users.js')}}"></script>
<script>
    loadDataTable();
</script>
@endpush
