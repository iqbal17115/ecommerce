
<!-- Add New Shipping Address Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 brand_color">
                <h5 class="modal-title font-weight-bold" id="addressModalLabel">Add New Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <!-- Address Form Fields -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="country_name">Country</label>
                            <select class="form-control" id="country_name" name="country_name" onchange="loadDivisions(this.value)">
                                <option value="">Select Country</option>
                                <option value="9c617d63-544b-49f8-991f-63e9158b4b8d">Bangladesh</option>
                                <option value="9a7a722d-34f2-4bf7-924b-27ef2e67e933">United Arab Emirates</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" style="width: 100% !important;" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="optional_mobile">Optional Mobile</label>
                            <input type="text" class="form-control" id="optional_mobile" name="optional_mobile">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="division_name">Division</label>
                            <select class="form-control" id="division_name" name="division_name" onchange="loadDistricts(this.value)">
                                <option value="">Select Division</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="district_name">District</label>
                            <select class="form-control" id="district_name" name="district_name" onchange="loadUpazilas(this.value)">
                                <option value="">Select District</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="upazila_name">Upazila</label>
                            <select class="form-control" id="upazila_name" name="upazila_name">
                                <option value="">Select Upazila</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="instruction">Special Instructions</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Optional" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="street_address">Street Address</label>
                            <input type="text" class="form-control" id="street_address" name="street_address">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="building_name">Building Name</label>
                            <input type="text" class="form-control" id="building_name" name="building_name">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nearest_landmark">Nearest Landmark</label>
                            <input type="text" class="form-control" id="nearest_landmark" name="nearest_landmark">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="type">Address Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit and Cancel Buttons -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" class="btn btn-sm btn-outline-secondary mr-2" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Add New Shipping Address Modal -->
