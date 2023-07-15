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
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Shipping Charge</h4>

                                <div class="page-title-right">
                                    <a href="{{ route('shipping_charge.create') }}" class="btn btn-primary mb-3">Add New</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
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
                                    <!-- Add other table headers for other columns -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($shippingCharges as $shippingCharge)
                                    <tr>
                                        <td>{{ $shippingCharge->shippingMethod->name }}</td>
                                        <td>{{ $shippingCharge->shippingClass->name }}</td>
                                        <td>{{ $shippingCharge->length }}</td>
                                        <td>{{ $shippingCharge->width }}</td>
                                        <td>{{ $shippingCharge->height }}</td>
                                        <td>{{ $shippingCharge->weight }}</td>
                                        <td>{{ $shippingCharge->charge }}</td>
                                        <td>{{ $shippingCharge->min_quantity }}</td>
                                        <td>{{ $shippingCharge->max_quantity }}</td>
                                        <!-- Add other table data for other columns -->
                                        <td>
                                            <a href="{{ route('shipping_charge.edit', $shippingCharge->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('shipping_charge.destroy', $shippingCharge->id) }}" method="POST" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this shipping charge?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11">No shipping charges found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

