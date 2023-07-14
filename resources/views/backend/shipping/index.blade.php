@extends('layouts.backend_app')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Orders</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">SEO Page</h4>

                                <div class="page-title-right">
                                    <button class="btn btn-primary mb-3" data-toggle="modal"
                                        data-target="#createShippingChargeModal">Add New Charge</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" id="shippingChargesTable">
                            <thead>
                                <tr>
                                    <th>Shipping Method</th>
                                    <th>Shipping Class</th>
                                    <th>Length</th>
                                    <th>Width</th>
                                    <th>Height</th>
                                    <th>Weight</th>
                                    <th>Charge</th>
                                    <th>Min Quantity</th>
                                    <th>Max Quantity</th>
                                    <th>Area</th>
                                    <th>Min Amount</th>
                                    <th>Max Amount</th>
                                    <th>Free Shipping</th>
                                    <th>Min Amount for Free Shipping</th>
                                    <th>Max Amount for Free Shipping</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shippingCharges as $shippingCharge)
                                    <tr data-id="{{ $shippingCharge->id }}">
                                        <td>{{ $shippingCharge->shippingMethod->name }}</td>
                                        <td>{{ $shippingCharge->shippingClass->name }}</td>
                                        <td>{{ $shippingCharge->length }}</td>
                                        <td>{{ $shippingCharge->width }}</td>
                                        <td>{{ $shippingCharge->height }}</td>
                                        <td>{{ $shippingCharge->weight }}</td>
                                        <td>{{ $shippingCharge->charge }}</td>
                                        <td>{{ $shippingCharge->min_quantity }}</td>
                                        <td>{{ $shippingCharge->max_quantity }}</td>
                                        <td>{{ $shippingCharge->area }}</td>
                                        <td>{{ $shippingCharge->min_amount }}</td>
                                        <td>{{ $shippingCharge->max_amount }}</td>
                                        <td>{{ $shippingCharge->free_shipping ? 'Yes' : 'No' }}</td>
                                        <td>{{ $shippingCharge->minimum_amount_for_free_shipping }}</td>
                                        <td>{{ $shippingCharge->maximum_amount_for_free_shipping }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary edit-btn" data-toggle="modal"
                                                data-target="#editShippingChargeModal"
                                                data-id="{{ $shippingCharge->id }}">Edit</button>
                                            <button class="btn btn-sm btn-danger delete-btn"
                                                data-id="{{ $shippingCharge->id }}">Delete</button>
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
    <!-- end row -->

    <!-- Create Shipping Charge Modal -->
    <div class="modal fade" id="createShippingChargeModal" tabindex="-1" role="dialog"
        aria-labelledby="createShippingChargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createShippingChargeModalLabel">Add New Shipping Charge</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Add the form fields for creating a shipping charge -->
                    <form id="createShippingChargeForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shippingMethod">Shipping Method</label>
                                    <select class="form-control" id="shippingMethod" name="shipping_method_id" required>
                                        @foreach ($shippingMethods as $shippingMethod)
                                            <option value="{{ $shippingMethod->id }}">{{ $shippingMethod->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shippingClass">Shipping Class</label>
                                    <select class="form-control" id="shippingClass" name="shipping_class_id" required>
                                        @foreach ($shippingClasses as $shippingClass)
                                            <option value="{{ $shippingClass->id }}">{{ $shippingClass->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="length">Length</label>
                                    <input type="text" class="form-control" id="length" name="length" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="width">Width</label>
                                    <input type="text" class="form-control" id="width" name="width" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="height">Height</label>
                                    <input type="text" class="form-control" id="height" name="height" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="weight">Weight</label>
                                    <input type="text" class="form-control" id="weight" name="weight" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_quantity">Min Quantity</label>
                                    <input type="text" class="form-control" id="min_quantity" name="min_quantity">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="max_quantity">Max Quantity</label>
                                    <input type="text" class="form-control" id="max_quantity" name="max_quantity">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="charge">Charge</label>
                                    <input type="text" class="form-control" id="charge" name="charge">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <input type="text" class="form-control" id="area" name="area">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minAmount">Min Amount</label>
                                    <input type="text" class="form-control" id="min_amount" name="min_amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="max_amount">Max Amount</label>
                                    <input type="text" class="form-control" id="max_amount" name="max_amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="freeShipping">Free Shipping</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="freeShipping"
                                            name="free_shipping">
                                        <label class="custom-control-label" for="freeShipping">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minAmountFreeShipping">Min Amount for Free Shipping</label>
                                    <input type="text" class="form-control" id="minAmountFreeShipping"
                                        name="minimum_amount_for_free_shipping">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // jQuery AJAX for CRUD operations

        // Handle create shipping charge form submission
        $(document).on('submit', '#createShippingChargeForm', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('shipping_charge.store') }}',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.success);
                    $('#createShippingChargeModal').modal('hide');
                    appendShippingCharge(response.shippingCharge);
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';

                    for (var key in errors) {
                        errorMessage += errors[key][0] + '\n';
                    }

                    alert(errorMessage);
                }
            });
        });

        // Handle edit shipping charge button click
        $(document).on('click', '.edit-btn', function() {
            var shippingChargeId = $(this).data('id');

            $.ajax({
                url: '{{ route("shipping_charge.edit", ":id") }}'.replace(':id', shippingChargeId),
                type: 'GET',
                success: function(response) {
                    $('#editShippingChargeModal .modal-content').html(response);
                    $('#editShippingChargeModal').modal('show');
                },
                error: function(xhr) {
                    alert('Failed to fetch shipping charge data.');
                }
            });
        });

        // Handle update shipping charge form submission
        $(document).on('submit', '#editShippingChargeForm', function(e) {
            e.preventDefault();
            var shippingChargeId = $(this).data('id');

            $.ajax({
                url: '/shipping_charge/update/' + shippingChargeId,
                type: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.success);
                    $('#editShippingChargeModal').modal('hide');
                    updateShippingCharge(response.shippingCharge);
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';

                    for (var key in errors) {
                        errorMessage += errors[key][0] + '\n';
                    }

                    alert(errorMessage);
                }
            });
        });

        // Handle delete shipping charge button click
        $(document).on('click', '.delete-btn', function() {
            var shippingChargeId = $(this).data('id');

            if (confirm('Are you sure you want to delete this shipping charge?')) {
                $.ajax({
                    url: '/shipping_charge/delete/' + shippingChargeId,
                    type: 'DELETE',
                    success: function(response) {
                        alert(response.success);
                        removeShippingCharge(shippingChargeId);
                    },
                    error: function(xhr) {
                        alert('Failed to delete shipping charge.');
                    }
                });
            }
        });

        // Function to append a new shipping charge to the table
        function appendShippingCharge(shippingCharge) {
            var newRow = $('<tr>').attr('data-id', shippingCharge.id).append(
                $('<td>').text(shippingCharge.shippingMethod.name),
                $('<td>').text(shippingCharge.shippingClass.name),
                $('<td>').text(shippingCharge.length),
                $('<td>').text(shippingCharge.width),
                $('<td>').text(shippingCharge.height),
                $('<td>').text(shippingCharge.weight),
                $('<td>').text(shippingCharge.charge),
                $('<td>').text(shippingCharge.min_quantity),
                $('<td>').text(shippingCharge.max_quantity),
                $('<td>').text(shippingCharge.area),
                $('<td>').text(shippingCharge.min_amount),
                $('<td>').text(shippingCharge.max_amount),
                $('<td>').text(shippingCharge.free_shipping ? 'Yes' : 'No'),
                $('<td>').text(shippingCharge.minimum_amount_for_free_shipping),
                $('<td>').text(shippingCharge.maximum_amount_for_free_shipping),
                $('<td>').append(
                    $('<button>').addClass('btn btn-sm btn-primary edit-btn').attr({
                        'data-toggle': 'modal',
                        'data-target': '#editShippingChargeModal',
                        'data-id': shippingCharge.id
                    }).text('Edit'),
                    $('<button>').addClass('btn btn-sm btn-danger delete-btn').attr('data-id', shippingCharge.id).text(
                        'Delete')
                )
            );

            $('#shippingChargesTable tbody').append(newRow);
        }

        // Function to update an existing shipping charge in the table
        function updateShippingCharge(shippingCharge) {
            var row = $('#shippingChargesTable tbody tr[data-id="' + shippingCharge.id + '"]');
            row.find('td:eq(0)').text(shippingCharge.shippingMethod.name);
            row.find('td:eq(1)').text(shippingCharge.shippingClass.name);
            row.find('td:eq(2)').text(shippingCharge.length);
            row.find('td:eq(3)').text(shippingCharge.width);
            row.find('td:eq(4)').text(shippingCharge.height);
            row.find('td:eq(5)').text(shippingCharge.weight);
            row.find('td:eq(6)').text(shippingCharge.charge);
            row.find('td:eq(7)').text(shippingCharge.min_quantity);
            row.find('td:eq(8)').text(shippingCharge.max_quantity);
            row.find('td:eq(9)').text(shippingCharge.area);
            row.find('td:eq(10)').text(shippingCharge.min_amount);
            row.find('td:eq(11)').text(shippingCharge.max_amount);
            row.find('td:eq(12)').text(shippingCharge.free_shipping ? 'Yes' : 'No');
            row.find('td:eq(13)').text(shippingCharge.minimum_amount_for_free_shipping);
            row.find('td:eq(14)').text(shippingCharge.maximum_amount_for_free_shipping);
        }

        // Function to remove a deleted shipping charge from the table
        function removeShippingCharge(shippingChargeId) {
            $('#shippingChargesTable tbody tr[data-id="' + shippingChargeId + '"]').remove();
        }
    </script>
@endsection
