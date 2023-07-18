<div class="tab-pane add_vital_info" id="addVitalInfo" role="tabpanel">
    <form method="post" id="add_vital_info">
        @csrf
        <div class="row">
            <input type="hidden" name="vital_info_id" id="vital_info_id"
                @if ($productInfo) value="{{ $productInfo->id }}" @else value="-1" @endif />
            <!-- Start -->
            <div class="col-md-10">
                <!-- Start Content -->
                <div class="row">

                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Feature</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <select name="product_feature_id" id="product_feature_id" class="form-select"
                            style="width: 100%;">
                            <option value=""></option>
                            @foreach ($product_features as $product_feature)
                                <option @if ($productInfo && $productInfo->product_feature_id == $product_feature->id) selected @endif
                                    value="{{ $product_feature->id }}">{{ $product_feature->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Model Name</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input name="model_name" id="model_name"
                            @if ($productInfo) value="{{ $productInfo->model_name }}" @endif
                            class="form-control" placeholder="Enter Model Name" />
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Model Number</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input name="model_number" id="model_number" type="text"
                            @if ($productInfo) value="{{ $productInfo->model_number }}" @endif
                            class="form-control" placeholder="Enter Model Number" aria-label="Username"
                            aria-describedby="model_number">
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Material Type</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <select name="material_type_id" id="material_type_id" class="form-select" style="width: 100%;">
                            <option value=""></option>
                            @foreach ($materials as $material)
                                <option @if ($productInfo && $productInfo->ProductDetail && $productInfo->ProductDetail->material_type_id == $material->id) selected @endif value="{{ $material->id }}">
                                    {{ $material->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Outer Material</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input name="outer_material" id="outer_material"
                            @if ($productInfo && $productInfo->ProductDetail) value="{{ $productInfo->outer_material }}" @endif
                            class="form-control" placeholder="Enter Outer Material" />
                    </div>
                    <!-- End -->

                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Shipping Class</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <select name="shipping_class_id" id="shipping_class_id" class="form-select" style="width: 100%;" required>
                            <option value="">Select</option>
                            @foreach ($shippingClasses as $shippingClass)
                                <option @if ($productInfo && $productInfo->shipping_class_id == $shippingClass->id) selected @endif value="{{ $shippingClass->id }}">
                                    {{ $shippingClass->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- End -->

                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Dimension</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="row">
                            <div class="col-md-4">
                                <input name="length" id="length"
                                    value="{{ $productInfo?->length }}"
                                    class="form-control" placeholder="Enter Length" required/>
                            </div>
                            {{-- end --}}

                            <div class="col-md-4">
                                <input name="width" id="width"
                                    value="{{ $productInfo?->width }}"
                                    class="form-control" placeholder="Enter Width" required/>
                            </div>
                            {{-- end --}}

                            <div class="col-md-4">
                                <input name="height" id="height"
                                    value="{{ $productInfo?->height }}"
                                    class="form-control" placeholder="Enter Height" required/>
                            </div>
                            {{-- end --}}
                        </div>

                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Weight</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <input name="weight" id="weight"
                            value="{{ $productInfo?->weight }}"
                            class="form-control" placeholder="Enter Weight" />
                    </div>
                    <!-- End -->

                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Condition</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <select class="form-select" name="condition_id" id="condition_id" style="width: 100%;" required>
                            <option value="">Select Option</option>
                            @foreach ($conditions as $condition)
                                <option value="{{ $condition->id }}" @if ($productInfo && $productInfo->ProductDetail && $productInfo->ProductDetail->condition_id == $condition->id) selected @endif>
                                    {{ $condition->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Condition Note</label>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <textarea class="form-control" name="condition_note" id="condition_note">
                        @if ($productInfo && $productInfo->ProductDetail)
{!! $productInfo->ProductDetail->condition_note !!}
@endif
                        </textarea>
                    </div>
                    <!-- End -->

                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Item Booking Date</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="product_booking_date"><i class="fa fa-calendar"
                                        aria-hidden="true"></i></span>
                            </div>
                            <input type="date" name="booking_date" id="booking_date"
                                @if ($productInfo) value="{{ $productInfo->booking_date }}" @endif
                                class="form-control" aria-label="Username" aria-describedby="product_booking_date"
                                required>
                        </div>
                    </div>
                    <!-- End -->
                    <div class="col-md-4 mt-md-3">
                        <label class="col-form-label float-md-right" style="font-size: 14px;">Country/Region of
                            Publication</label>
                        <span class="text-danger float-md-right">*</span>
                    </div>
                    <div class="col-md-8 mt-md-3">
                        <select name="region_publication_id" id="region_publication_id" class="form-select" required>
                            <option @if ($productInfo && $productInfo->region_publication_id == 1) selected @endif value="1">Bangladesh
                            </option>
                        </select>
                    </div>
                    <!-- End -->
                    <div class="col-md-12 mt-md-3">
                        <button class="float-right btn btn-success btn-sm ml-2">Save and
                            finish</button>
                        <button type="submit" class="float-right btn btn-warning btn-sm">Save as
                            draft</button>
                    </div>
                    <!-- End -->
                </div>
                <!-- End Content -->
            </div>
            <div class="col-md-2"></div>
            <!-- End -->
        </div>
    </form>
</div>
