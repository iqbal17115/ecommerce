<div class="form-card">
    <h2>Product Specification</h2>
{{-- START: Product Specification Section (with correct Fill Rate span) --}}
<div class="form-section">
    <h2>Fill Rate: <span class="text-primary" id="specFillRate">0%</span></small> <span class="fill-rate-bar"></span></span></h2>
    <p class="form-text text-muted">Filling in attributes will increase product searchability, driving sales conversion. Spot a missing attribute or attribute value? <a href="#">Click me</a></p>

    <div class="row">
        <div class="col-md-6 form-group">
            <label for="brand">* Brand</label>
            <select name="brand" id="brand" class="form-control">
                <option value="">Select</option>
                {{-- Options --}}
            </select>
        </div>
        <div class="col-md-6 form-group">
            <label for="model">Model</label>
            <input type="text" name="model" id="model" class="form-control" placeholder="Input here">
        </div>
        <div class="col-md-6 form-group">
            <label for="display_resolution">Display Resolution</label>
            <input type="text" name="display_resolution" id="display_resolution" class="form-control" placeholder="Input here">
        </div>
        <div class="col-md-6 form-group">
            <label for="electronics_features">Electronics Features</label>
            <input type="text" name="electronics_features" id="electronics_features" class="form-control" placeholder="Input here">
        </div>
        <div class="col-md-6 form-group">
            <label for="energy_rating">Energy Rating</label>
            <input type="text" name="energy_rating" id="energy_rating" class="form-control" placeholder="Input here">
        </div>
        <div class="col-md-6 form-group">
            <label for="refresh_rate">Refresh Rate</label>
            <select name="refresh_rate" id="refresh_rate" class="form-control">
                <option value="">Select</option>
                {{-- Options --}}
            </select>
        </div>
    </div>

    {{-- Collapsible More Fields Section --}}
    <div id="moreSpecifications" style="display: none;">
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="required_serial">Required Serial</label>
                <input type="text" name="required_serial" id="required_serial" class="form-control" placeholder="Input here">
            </div>
            <div class="col-md-6 form-group">
                <label for="speakers_config">Speakers Config</label>
                <input type="text" name="speakers_config" id="speakers_config" class="form-control" placeholder="Input here">
            </div>
            <div class="col-md-6 form-group">
                <label for="internal_memory">Internal Memory</label>
                <input type="text" name="internal_memory" id="internal_memory" class="form-control" placeholder="Input here">
            </div>
        </div>
    </div>

    <a href="#" class="spec-toggle-link text-primary" data-toggle-target="#moreSpecifications">
        <span class="show-text">Show More <i class="fas fa-chevron-down"></i></span>
        <span class="hide-text" style="display: none;">Show Less <i class="fas fa-chevron-up"></i></span>
    </a>
</div>
{{-- END: Product Specification Section --}}
</div>