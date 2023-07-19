@extends('layouts.backend_app')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Shipping</h4>

                <div class="page-title-right">
                    <a href="{{ route('shipping_charge.index') }}"><i class="fas fa-list"></i> List</a>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('shipping_charge.update', $shippingCharge->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shippingMethod">Shipping Method</label>
                                    <select class="form-control" id="shippingMethod" name="shipping_method_id" required>
                                        @foreach ($shippingMethods as $shippingMethod)
                                            <option value="{{ $shippingMethod->id }}" {{ $shippingMethod->id == $shippingCharge->shipping_method_id ? 'selected' : '' }}>
                                                {{ $shippingMethod->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shippingClass">Shipping Class</label>
                                    <select class="form-control" id="shippingClass" name="shipping_class_id" required>
                                        @foreach ($shippingClasses as $shippingClass)
                                            <option value="{{ $shippingClass->id }}" {{ $shippingClass->id == $shippingCharge->shipping_class_id ? 'selected' : '' }}>
                                                {{ $shippingClass->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="length">Length</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="from_length" name="from_length" value="{{ $shippingCharge->from_length }}" placeholder="From" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="to_length" name="to_length" value="{{ $shippingCharge->to_length }}" placeholder="To" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="width">Width</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="from_width" name="from_width" value="{{ $shippingCharge->from_width }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="to_width" name="to_width" value="{{ $shippingCharge->to_width }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="height">Height</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="from_height" name="from_height" value="{{ $shippingCharge->from_height }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="to_height" name="to_height" value="{{ $shippingCharge->to_height }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weight">Weight</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="from_weight" name="from_weight" value="{{ $shippingCharge->from_weight }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="to_weight" name="to_weight" value="{{ $shippingCharge->to_weight }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="charge">Charge</label>
                                    <input type="text" class="form-control" id="charge" name="charge" value="{{ $shippingCharge->charge }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minQuantity">Min Quantity</label>
                                    <input type="text" class="form-control" id="minQuantity" name="min_quantity" value="{{ $shippingCharge->min_quantity }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maxQuantity">Max Quantity</label>
                                    <input type="text" class="form-control" id="maxQuantity" name="max_quantity" value="{{ $shippingCharge->max_quantity }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <input type="text" class="form-control" id="area" name="area" value="{{ $shippingCharge->area }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minAmount">Min Amount</label>
                                    <input type="text" class="form-control" id="minAmount" name="min_amount" value="{{ $shippingCharge->min_amount }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maxAmount">Max Amount</label>
                                    <input type="text" class="form-control" id="maxAmount" name="max_amount" value="{{ $shippingCharge->max_amount }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="freeShipping">Free Shipping</label>
                                    <select class="form-control" id="freeShipping" name="free_shipping" required>
                                        <option value="yes" {{ $shippingCharge->free_shipping === 'yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="no" {{ $shippingCharge->free_shipping === 'no' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minAmountFreeShipping">Minimum Amount for Free Shipping</label>
                                    <input type="text" class="form-control" id="minAmountFreeShipping" name="minimum_amount_for_free_shipping" value="{{ $shippingCharge->minimum_amount_for_free_shipping }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maxAmountFreeShipping">Maximum Amount for Free Shipping</label>
                                    <input type="text" class="form-control" id="maxAmountFreeShipping" name="maximum_amount_for_free_shipping" value="{{ $shippingCharge->maximum_amount_for_free_shipping }}">
                                </div>
                            </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

