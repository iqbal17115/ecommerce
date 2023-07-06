@extends('layouts.backend_app')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Customers</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Customers</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <input type="text" name="search_key" id="search_key" class="form-control"
                                        placeholder="Search...">
                                    <i class="bx bx-search-alt search-icon"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-right">
                                <button type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 mr-2">Download</button>
                            </div>
                        </div><!-- end col-->
                    </div>

                    <div class="table-responsive" id="main-content">
                        <table class="table table-centered table-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>
                                            {{ $i++ }}
                                        </td>
                                        <td>Juan Mays</td>
                                        <td>
                                            {{ $customer->name }}
                                        </td>

                                        <td>
                                            {{ $customer->email }}
                                        </td>
                                        <td>
                                            {{ $customer->mobile }}
                                        </td>
                                        <td>
                                            @if ($customer->status == 'active')
                                                <span
                                                    class="badge badge-pill badge-success font-size-12">{{ ucwords($customer->status) }}</span>
                                            @elseif($customer->status == 'inactive')
                                                <span
                                                    class="badge badge-pill badge-danger font-size-12">{{ ucwords($customer->status) }}</span>
                                            @else
                                                <span
                                                    class="badge badge-pill badge-warning font-size-12">{{ ucwords($customer->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#search_key').on('keyup', function() {
                var searchKey = $(this).val();
                var formData = {
                    search_key: searchKey
                };

                $.ajax({
                    url: '{{ route('all.customers.search') }}',
                    type: 'GET',
                    data: formData,
                    success: function(data) {
                        $('#main-content').html(data);
                    },
                    error: function(xhr) {
                        // Handle error
                    }
                });
            });
        });

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
    </script>
@endpush
