{{-- START: Shipping & Warranty Section (Updated to match image design) --}}
<div class="form-card">
    <h2>Shipping & Warranty</h2>
    <div class="form-section">
        <div class="form-group mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <p class="form-text text-muted mb-0">Switch on if you need different dimension & weight for different product variants</p>
                <label class="switch-toggle mb-0">
                    <input type="checkbox" name="variant_shipping_toggle" id="variantShippingToggle">
                    <span class="slider round"></span>
                </label>
            </div>
        </div>

        <div class="row">
            {{-- Package Weight --}}
            <div class="col-md-6 form-group">
                <label for="package_weight">* Package Weight</label>
                <small class="form-text text-primary mt-0"><a href="#">How to measure my package weight? View Example</a></small>

                <div class="input-group">
                    <input type="number" name="package_weight" id="package_weight" class="form-control" placeholder="0.001–300" min="0.001" max="300" step="0.001">
                    <div class="input-group-append">
                        {{-- Updated to be a proper select that looks like a button on the side --}}
                        <select name="weight_unit" class="form-control" style="width: auto; border-top-left-radius: 0; border-bottom-left-radius: 0;">
                            <option value="kg">kg</option>
                            <option value="g">g</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Package Dimensions --}}
            <div class="col-md-6 form-group">
                <label for="package_length">* Package Length(cm) * Width(cm) * Height(cm)</label>
                <small class="form-text text-primary mt-0"><a href="#">How to measure my package dimensions? View Example</a></small>

                <div class="d-flex package-dimensions-inputs">
                    <input type="number" name="length" class="form-control mr-2" placeholder="0.01–300" min="0.01" max="300" step="0.01">
                    <input type="number" name="width" class="form-control mr-2" placeholder="0.01–300" min="0.01" max="300" step="0.01">
                    <input type="number" name="height" class="form-control" placeholder="0.01–300" min="0.01" max="300" step="0.01">
                </div>
            </div>
        </div>

        {{-- Dangerous Goods --}}
        <div class="form-group mt-3">
            <label>Dangerous Goods</label>
            <div class="d-flex align-items-center">
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="dgNone" name="dangerous_goods" class="custom-control-input" value="none" checked>
                    <label class="custom-control-label" for="dgNone">None</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="dgContains" name="dangerous_goods" class="custom-control-input" value="contains">
                    <label class="custom-control-label" for="dgContains">Contains battery / flammables / liquid</label>
                </div>
            </div>
        </div>

        <hr class="mt-4 mb-4">

        {{-- Warranty Fields --}}
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="warranty_type">Warranty Type</label>
                <select name="warranty_type" id="warranty_type" class="form-control">
                    <option value="">Select</option>
                    {{-- Options --}}
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label for="warranty">Warranty</label>
                <select name="warranty" id="warranty" class="form-control">
                    <option value="">Select</option>
                    {{-- Options --}}
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="warranty_policy">Warranty Policy</label>
            <input type="text" name="warranty_policy" id="warranty_policy" class="form-control">
        </div>

        {{-- Show Less/More Link (This replicates your image structure) --}}
        <a href="#" class="spec-toggle-link text-primary mt-3 d-block" data-toggle-target="#warrantyFieldsToggle">
            <span class="hide-text">Show Less <i class="fas fa-chevron-up"></i></span>
            <span class="show-text" style="display: none;">Show More <i class="fas fa-chevron-down"></i></span>
        </a>
    </div>
</div>
{{-- END: Shipping & Warranty Section --}}