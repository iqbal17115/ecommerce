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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Cash On Delivery</h4>
                        <form id="cashOnDeliveryForm">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="type">Select Option:</label>
                                        <select class="form-control" name="type" id="type">
                                            <option value="{{ \App\Models\Backend\Shipping\ShippingMethod::TYPE_PERCENT }}">
                                                Percent</option>
                                            <option value="{{ \App\Models\Backend\Shipping\ShippingMethod::TYPE_AMOUNT }}">
                                                Amount</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="value">Value:</label>
                                        <input type="text" class="form-control" name="value" id="value"
                                            value="{{ old('value', $cashOnDeliveryMethod->value) }}">
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="updateCashOnDeliveryBtn" class="btn btn-primary btn-sm float-right">Update</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Free Shipping</h4>
                        <form id="freeShippingForm">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="value">Minimum Amount for Free Shipping:</label>
                                <input type="text" class="form-control" name="value" id="value"
                                    value="{{ old('value', $freeShippingMethod->value) }}">
                            </div>
                            <button type="button" id="updateFreeShippingBtn" class="btn btn-primary btn-sm float-right">Update</button>
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
                var url = "{{ route('shipping_methods.update', $cashOnDeliveryMethod->id) }}";

                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: formData,
                    success: function(response) {
                        // Handle success response, e.g., show a success message
                        alert("Cash On Delivery updated successfully!");
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
                var url = "{{ route('shipping_methods.update', $freeShippingMethod->id) }}";

                $.ajax({
                    type: "PATCH",
                    url: url,
                    data: formData,
                    success: function(response) {
                        // Handle success response, e.g., show a success message
                        alert("Free Shipping updated successfully!");
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
