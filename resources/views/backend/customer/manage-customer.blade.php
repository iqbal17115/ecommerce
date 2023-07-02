@extends('layouts.backend_app')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Customers</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Customers</a></li>
                        <li class="breadcrumb-item active">Manage Customers</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content p-3">
                        <div class="tab-pane active" id="all-order" role="tabpanel">
                            <form>
                                <div class="row">

                                    <div class="col-xl col-md-1">
                                        <div class="form-group mb-0">
                                            <label>Country</label>
                                            <select class="form-control select2-search-disable form-control-sm">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl col-md-1">
                                        <div class="form-group mb-0">
                                            <label>Province</label>
                                            <select name="division_id" id="division_id"
                                                class="form-control select2-search-disable form-control-sm">
                                                <option value=""></option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl col-md-1">
                                        <div class="form-group">
                                            <label for="district_id">District</label>
                                            <select name="district_id" id="district_id" class="form-control form-control-sm"
                                                required>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl col-md-1">
                                        <div class="form-group">
                                            <label for="upazila_id">Upazila</label>
                                            <select name="upazila_id" id="upazila_id" class="form-control form-control-sm"
                                                required>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl col-md-1">
                                        <div class="form-group">
                                            <label for="union_id">Union</label>
                                            <select name="union_id" id="union_id" class="form-control form-control-sm"
                                                required>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl col-md-1">
                                        <div class="form-group mb-0">
                                            <label>Gender</label>
                                            <select class="form-control select2-search-disable form-control-sm">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-xl col-md-1 mt-3">
                                        <div class="custom-control custom-checkbox  custom-checkbox-success mt-3">
                                            <input type="checkbox" class="custom-control-input check-status" id="active">
                                            <label class="custom-control-label" for="active">Active</label>
                                        </div>
                                    </div>

                                    <div class="col-xl col-md-1 mt-3">
                                        <div class="custom-control custom-checkbox  custom-checkbox-warning mt-3">
                                            <input type="checkbox" class="custom-control-input check-status" id="inactive">
                                            <label class="custom-control-label" for="inactive">Inactive</label>
                                        </div>
                                    </div>
                                    <div class="col-xl col-md-1 mt-3">
                                        <div class="custom-control custom-checkbox custom-checkbox-info mt-3">
                                            <input type="checkbox" class="custom-control-input check-status" id="incomplete">
                                            <label class="custom-control-label" for="incomplete">Incomplete</label>
                                        </div>
                                    </div>
                                    <div class="col-xl col-md-1">
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-primary btn-sm mt-3">Download</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive mt-3" id="main-content">
                                <table class="table table-hover datatable dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile</th>
                                            <th scope="col">Orders</th>
                                            <th scope="col">Last Order</th>
                                            <th scope="col">City</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->mobile }}</td>
                                                <td>{{ $customer->Contact?->Order->count() ?? 0 }}</td>
                                                <td>{{ $customer->Contact?->Order->count() > 0 ? $customer->Contact?->Order->max('created_at')->diffForHumans() : 'No orders' }}
                                                </td>
                                                <td>
                                                    {{ $customer->address }}
                                                </td>
                                                <td>
                                                    <span class="badge badge-success font-size-10">Completed</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle card-drop"
                                                            data-toggle="dropdown" aria-expanded="false">
                                                            <i class="mdi mdi-dots-horizontal font-size-18"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="{{ route('customers.profile', ['user' => $customer]) }}" class="dropdown-item">Details</a></li>
                                                            <li><a href="#" class="dropdown-item">Edit</a></li>
                                                            <li><a href="#" class="dropdown-item">Active</a></li>
                                                            <li><a href="#" class="dropdown-item">Inactive</a></li>
                                                            <li><a href="#" class="dropdown-item">Make Vendor</a>
                                                            </li>
                                                            <li><a href="#" class="dropdown-item">Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@push('script')
    <script type="text/javascript">
        // search customer
        function customerSearch() {
            // Get references to the checkboxes
            var activeCheckbox = $('#active');
            var inactiveCheckbox = $('#inactive');
            var incompleteCheckbox = $('#incomplete');
            var division_id = document.getElementById('division_id').value;
            var district_id = document.getElementById('district_id').value;
            var upazila_id = document.getElementById('upazila_id').value;
            var union_id = document.getElementById('union_id').value;
            var active = activeCheckbox.is(':checked') ? 'active' : null;
            var inactive = inactiveCheckbox.is(':checked') ? 'inactive' : null;
            var incomplete = incompleteCheckbox.is(':checked') ? 'incomplete' : null;
            // var status = document.getElementById('status').value;
            var formData = {
                division_id: division_id,
                district_id: district_id,
                upazila_id: upazila_id,
                union_id: union_id,
                active: active,
                inactive: inactive,
                incomplete: incomplete
            };

            // Send AJAX request to search endpoint
            $.ajax({
                url: '{{ route('customers.search') }}',
                type: 'GET',
                data: formData,
                success: function(data) {
                    $('#main-content').html(data);
                },
                error: function(xhr) {
                    // Handle error
                }
            });
        }
        $(document).ready(function() {
            $('.check-status').on('click', function() {
                customerSearch();
            });
            // Get Union By Upazila
            $("body").on("change", "#union_id", function(e) {
                customerSearch();
            });
            // Get Union By Upazila
            $("body").on("change", "#upazila_id", function(e) {
                upazila_id = $(this).val();
                // Ajax
                $.ajax({
                    url: "get-union",
                    method: 'get',
                    data: {
                        upazila_id: upazila_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        customerSearch();
                        var union_value = $("[name='shipping_union_id']").val();
                        union = '';
                        union += '<option value="" selected="selected"></option>';
                        Object.entries(data['union']).forEach(([key, value]) => {
                            union_selected = '';
                            if (union_value == value['id']) {
                                union_selected = 'selected';
                            }
                            union += '<option ' + union_selected + ' value=' + value[
                                'id'] + '>' + value['name'] + '</option>';
                        });
                        $("#union_id").html(union);
                    },
                    error: function(err) {
                        var error = err.responseJSON;
                        console.log(error);
                    }
                });
            });
            // Get Upazila By District
            $("body").on("change", "#district_id", function(e) {
                district_id = $(this).val();
                // Ajax
                $.ajax({
                    url: "get-upazila",
                    method: 'get',
                    data: {
                        district_id: district_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        customerSearch();
                        var upazila_value = $("[name='shipping_upazilla_id']").val();
                        upazila = '';
                        upazila += '<option value="" selected="selected"></option>';
                        Object.entries(data['upazila']).forEach(([key, value]) => {
                            upazila_selected = '';
                            if (upazila_value == value['id']) {
                                upazila_selected = 'selected';
                            }
                            upazila += '<option ' + upazila_selected + ' value=' +
                                value['id'] + '>' + value['name'] + '</option>';
                        });
                        $("#upazila_id").html(upazila);
                    },
                    error: function(err) {
                        var error = err.responseJSON;
                        console.log(error);
                    }
                });
            });

            // Get District By Division
            $("body").on("change", "#division_id", function(e) {
                division_id = $(this).val();
                // Ajax
                $.ajax({
                    url: "get-district",
                    method: 'get',
                    data: {
                        division_id: division_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        customerSearch();
                        var dis_value = $("[name='shipping_district_id']").val();
                        district = '';
                        district += '<option value="" selected="selected"></option>';
                        Object.entries(data['district']).forEach(([key, value]) => {
                            dis_selected = '';
                            if (dis_value == value['id']) {
                                dis_selected = 'selected';
                            }
                            district += '<option ' + dis_selected + ' value=' + value[
                                'id'] + '>' + value['name'] + '</option>';
                        });
                        $("#district_id").html(district);
                    },
                    error: function(err) {
                        var error = err.responseJSON;
                        console.log(error);
                    }
                });
            });


        });
    </script>
@endpush
