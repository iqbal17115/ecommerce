@extends('layouts.backend_app')

@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Manage Shipping Method</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Manage Shipping Method</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Cash On Delivery</h4>
                        <form id="cashOnDeliveryForm">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <select class="form-control" name="status" id="cashOnDeliveryStatus">
                                    <option value="1" {{ $cashOnDeliveryMethod->is_active ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ !$cashOnDeliveryMethod->is_active ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>
                            <button type="button" id="updateCashOnDeliveryBtn"
                                class="btn btn-primary btn-sm float-right">Update</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Free Shipping</h4>
                        <form id="freeShippingForm">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <select class="form-control" name="status" id="freeShippingStatus">
                                    <option value="1" {{ $freeShippingMethod->is_active ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ !$freeShippingMethod->is_active ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>
                            <button type="button" id="updateFreeShippingBtn"
                                class="btn btn-primary btn-sm float-right">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            // Function to handle the Cash On Delivery form submission
            $("#updateCashOnDeliveryBtn").on("click", function() {
                var formData = $("#cashOnDeliveryForm").serialize();
                var url = "{{ route('shipping_methods.update_status', $cashOnDeliveryMethod->id) }}";

                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: formData,
                    success: function(response) {
                        // Handle success response, e.g., show a success message
                        alert("Cash On Delivery status updated successfully!");
                    },
                    error: function(xhr, status, error) {
                        // Handle error response, e.g., show an error message
                        alert("An error occurred. Please try again later.");
                    }
                });
            });

            // Function to handle the Free Shipping form submission
            $("#updateFreeShippingBtn").on("click", function() {
                var formData = $("#freeShippingForm").serialize();
                var url = "{{ route('shipping_methods.update_status', $freeShippingMethod->id) }}";

                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: formData,
                    success: function(response) {
                        // Handle success response, e.g., show a success message
                        alert("Free Shipping status updated successfully!");
                    },
                    error: function(xhr, status, error) {
                        // Handle error response, e.g., show an error message
                        alert("An error occurred. Please try again later.");
                    }
                });
            });
        });
    </script>
@endpush
