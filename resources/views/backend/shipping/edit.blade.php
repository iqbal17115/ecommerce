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
                                            <option value="{{ $shippingMethod->id }}"
                                                {{ $shippingMethod->id == $shippingCharge->shipping_method_id ? 'selected' : '' }}>
                                                {{ $shippingMethod->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_class">Shipping Class</label>
                                    <select class="form-control" id="shipping_class" name="shipping_class" required>
                                        <option value="">Select</option>
                                        @foreach ($shippingChargeClasses as $className => $classData)
                                            @foreach ($classData as $criteria)
                                                <option value="{{ $criteria['name'] }}"
                                                    {{ $criteria['name'] == $shippingCharge->shipping_class ? 'selected' : '' }}>
                                                    {{ $criteria['name'] }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minQuantity">Min Quantity</label>
                                    <input type="text" class="form-control" id="minQuantity" name="min_quantity"
                                        value="{{ $shippingCharge->min_quantity }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maxQuantity">Max Quantity</label>
                                    <input type="text" class="form-control" id="maxQuantity" name="max_quantity"
                                        value="{{ $shippingCharge->max_quantity }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minAmount">Min Amount</label>
                                    <input type="text" class="form-control" id="minAmount" name="min_amount"
                                        value="{{ $shippingCharge->min_amount }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maxAmount">Max Amount</label>
                                    <input type="text" class="form-control" id="maxAmount" name="max_amount"
                                        value="{{ $shippingCharge->max_amount }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="freeShipping">Free Shipping</label>
                                    <select class="form-control" id="freeShipping" name="free_shipping" required>
                                        <option value="yes"
                                            {{ $shippingCharge->free_shipping === 'yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="no"
                                            {{ $shippingCharge->free_shipping === 'no' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minAmountFreeShipping">Minimum Amount for Free Shipping</label>
                                    <input type="text" class="form-control" id="minAmountFreeShipping"
                                        name="minimum_amount_for_free_shipping"
                                        value="{{ $shippingCharge->minimum_amount_for_free_shipping }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="charge_1">Charge(Inside Dhaka)</label>
                                    <input type="text" class="form-control" id="charge_1" name="charge_1"
                                        value="{{ $shippingCharge->charge_1 }}" placeholder="Inside Amount" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="charge_2">Charge(Outside Dhaka)</label>
                                    <input type="text" class="form-control" id="charge_2" name="charge_2"
                                        value="{{ $shippingCharge->charge_2 }}" placeholder="Outside Amount" required>
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
