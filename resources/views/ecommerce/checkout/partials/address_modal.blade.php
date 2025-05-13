<!-- Address Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form id="addressForm" class="w-100">
            @csrf
            <input type="hidden" id="addressId" name="address_id">
            <div class="modal-content custom-address-modal">

                <!-- Modal Header -->
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-semibold">📍 Add / Update Address</h5>
                    <button type="button" class="custom-close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Location Selects -->
                        <div class="col-md-3">
                            <select id="country" name="country_id" class="form-select" required></select>
                        </div>
                        <div class="col-md-3">
                            <select id="division" name="division_id" class="form-select" required></select>
                        </div>
                        <div class="col-md-3">
                            <select id="district" name="district_id" class="form-select" required></select>
                        </div>
                        <div class="col-md-3">
                            <select id="area" name="upazila_id" class="form-select" required></select>
                        </div>

                        <!-- Address Fields -->
                        <div class="col-12">
                            <label for="street_address" class="form-label">Street Address</label>
                            <input type="text" id="street_address" name="street_address" class="form-control" placeholder="e.g. 123 Main Street" required>
                        </div>
                        <div class="col-md-6">
                            <label for="building_name" class="form-label">Building Name</label>
                            <input type="text" id="building_name" name="building_name" class="form-control" placeholder="Optional">
                        </div>
                        <div class="col-md-6">
                            <label for="nearest_landmark" class="form-label">Nearest Landmark</label>
                            <input type="text" id="nearest_landmark" name="nearest_landmark" class="form-control" placeholder="Optional">
                        </div>

                        <!-- Contact Info -->
                        <div class="col-md-6">
                            <label for="mobile" class="form-label">Mobile</label>
                            <input type="text" id="mobile" name="mobile" class="form-control" placeholder="e.g. 017XXXXXXXX" required>
                        </div>
                        <div class="col-md-6">
                            <label for="optional_mobile" class="form-label">Optional Mobile</label>
                            <input type="text" id="optional_mobile" name="optional_mobile" class="form-control" placeholder="e.g. 018XXXXXXXX">
                        </div>

                        <!-- Address Type & Default -->
                        <div class="col-md-6">
                            <select id="type" name="type" class="form-select">
                                <option value="home">Home</option>
                                <option value="office">Office</option>
                            </select>
                        </div>
                        <div class="col-md-6 d-flex align-items-center mt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_default" id="is_default">&nbsp;
                                <label class="form-check-label ml-2" for="is_default">Make this my default address</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer border-0 pt-3">
                    <button type="submit" class="btn btn-primary w-100 py-2">💾 Save Address</button>
                </div>
            </div>
        </form>
    </div>
</div>