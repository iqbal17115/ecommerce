<!-- Address Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addressForm">
            @csrf
            <input type="hidden" id="addressId" name="address_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add / Update Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <select id="country" name="country_id" class="form-select mb-2" required></select>
                    <select id="division" name="division_id" class="form-select mb-2" required></select>
                    <select id="district" name="district_id" class="form-select mb-2" required></select>
                    <select id="area" name="area_id" class="form-select mb-2" required></select>

                    <input type="text" id="street_address" name="street_address" class="form-control mb-2" placeholder="Street Address" required>
                    <input type="text" id="building_name" name="building_name" class="form-control mb-2" placeholder="Building Name">
                    <input type="text" id="nearest_landmark" name="nearest_landmark" class="form-control mb-2" placeholder="Nearest Landmark">
                    <input type="text" id="mobile" name="mobile" class="form-control mb-2" placeholder="Mobile" required>
                    <input type="text" id="optional_mobile" name="optional_mobile" class="form-control mb-2" placeholder="Optional Mobile">

                    <select id="type" name="type" class="form-select mb-2">
                        <option value="home">Home</option>
                        <option value="office">Office</option>
                    </select>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_default" id="is_default">
                        <label class="form-check-label" for="is_default">Make default</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Address</button>
                </div>
            </div>
        </form>
    </div>
</div>
