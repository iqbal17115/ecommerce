<div class="tab-pane fade" id="address">
    <h6 class="tab-title">Your Address</h6>
    <!-- Address form fields go here -->
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center dashed-border-card" data-toggle="modal" data-target="#userAddressModal">
                <div class="card-body">
                    <i class="fas fa-plus-circle plus-icon"></i>
                    <p class="card-text add-address-text">Add Address</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">1</div>
        <div class="col-md-3">1</div>
        <div class="col-md-3">1</div>
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="userAddressModal" tabindex="-1" role="dialog" aria-labelledby="userAddressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userAddressModalLabel">Your Address</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addressForm">
                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select class="form-control form-control-sm" id="country_id" name="country_id">
                                <option> -- Select --</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile"
                                placeholder="Enter mobile number" required>
                        </div>
                        <div class="form-group">
                            <label for="optional_mobile">Optional Mobile</label>
                            <input type="text" class="form-control" id="optional_mobile" name="optional_mobile"
                                placeholder="Enter optional mobile number">
                        </div>

                        <div class="form-group">
                            <label for="division_id">City/Province</label>
                            <select class="form-control form-control-sm" id="division_id" name="division_id">
                                <option> -- Select --</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="district_id">District/Area</label>
                            <select class="form-control form-control-sm" id="district_id" name="district_id">
                                <option> -- Select --</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="street_address">Street Address</label>
                            <input type="text" class="form-control" id="street_address" name="street_address"
                                placeholder="Enter street address">
                        </div>

                        <div class="form-group">
                            <label for="building_name">Building Name</label>
                            <input type="text" class="form-control" id="building_name" name="building_name"
                                placeholder="Enter building name">
                        </div>

                        <div class="form-group">
                            <label for="nearest_landmark">Nearest Landmark</label>
                            <input type="text" class="form-control" id="nearest_landmark" name="nearest_landmark"
                                placeholder="Enter nearest landmark">
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="home" name="type"
                                            value="home" checked>
                                        <label class="form-check-label ml-2" for="home"> Home</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="office" name="type"
                                        value="office">
                                    <label class="form-check-label ml-2" for="office"> Office</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Address</button>
                </div>
            </div>
        </div>
    </div>
</div>
