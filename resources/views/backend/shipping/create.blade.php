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
                    <form action="{{ route('shipping_charge.store') }}" method="POST">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from_length">Length</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="from_length" name="from_length" placeholder="From Length" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="to_length" name="to_length" placeholder="To Length" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="width">Width</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="from_width" name="from_width" placeholder="From Width" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="to_width" name="to_width" placeholder="To Width" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="height">Height</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="from_height" name="from_height" placeholder="From Height" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="to_height" name="to_height" placeholder="To Height" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weight">Weight</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="from_weight" name="from_weight" placeholder="From Weight" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="to_weight" name="to_weight" placeholder="To Weight" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="charge">Charge</label>
                                    <input type="text" class="form-control" id="charge" name="charge" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minQuantity">Min Quantity</label>
                                    <input type="text" class="form-control" id="minQuantity" name="min_quantity">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maxQuantity">Max Quantity</label>
                                    <input type="text" class="form-control" id="maxQuantity" name="max_quantity">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minAmount">Min Amount</label>
                                    <input type="text" class="form-control" id="minAmount" name="min_amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maxAmount">Max Amount</label>
                                    <input type="text" class="form-control" id="maxAmount" name="max_amount">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="freeShipping">Free Shipping</label>
                                    <select class="form-control" id="freeShipping" name="free_shipping" required>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="minAmountFreeShipping">Minimum Amount for Free Shipping</label>
                                    <input type="text" class="form-control" id="minAmountFreeShipping" name="minimum_amount_for_free_shipping">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="maxAmountFreeShipping">Maximum Amount for Free Shipping</label>
                                    <input type="text" class="form-control" id="maxAmountFreeShipping" name="maximum_amount_for_free_shipping">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

@endsection

