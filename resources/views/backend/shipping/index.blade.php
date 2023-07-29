@extends('layouts.backend_app')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Shipping</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Shipping Charge</li>
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
                    <div class="mb-3">
                        <form id="searchForm" action="{{ route('shipping_charge.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-2">
                                    <h4 class="mb-0 font-size-18">Shipping Charge</h4>
                                </div>
                                <div class="col-md-3">
                                    <select name="per_page" class="form-control">
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                        <option value="70">70</option>
                                        <option value="80">80</option>
                                        <option value="90">90</option>
                                        <option value="100">100</option>
                                        <option value="150">150</option>
                                        <option value="200">200</option>
                                        <option value="250">250</option>
                                        <option value="300">300</option>
                                        <option value="400">400</option>
                                        <option value="500">500</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="shipping_charge_class" class="form-control">
                                        <option value="">Select Class</option>
                                        @foreach ($shippingChargeClasses as $className => $classData)
                                            @foreach ($classData as $criteria)
                                                <option value="{{ $criteria['name'] }}">{{ $criteria['name'] }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="shipping_method" class="form-control">
                                        <option value="">Select Method</option>
                                        @foreach ($shippingMethods as $shippingMethod)
                                            <option value="{{ $shippingMethod->id }}">{{ $shippingMethod->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ route('shipping_charge.create') }}"
                                        class="btn btn-primary mb-3 float-right">Add New</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive" id="shippingChargesTable">
                        @include('backend.shipping.shipping_charge.shipping_charge_table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@push('script')
    <script>
        // Function to perform AJAX search
        function performSearch() {
            var formData = $('#searchForm').serialize();
            var url = $('#searchForm').attr('action');
            $.ajax({
                url: url,
                type: 'GET',
                data: formData,
                success: function(response) {
                    console.log(response);
                    // Exclude thead from the response and update the table body
                    $('#shippingChargesTable').html($(response));
                },
                error: function(xhr, status, error) {
                    // Handle the error if needed
                    console.error(error);
                }
            });
        }

        // Bind the change event to the form fields
        $('#searchForm').on('keyup change', 'input, select', function() {
            performSearch();
        });
    </script>
@endpush
