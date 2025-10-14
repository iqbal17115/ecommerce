<div class="widget widget-price">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true"
            aria-controls="widget-body-3">Price</a>
    </h3>

    <div class="collapse show" id="widget-body-3">
        <div class="widget-body">
            <div class="price-filter text-center" 
                style="padding:12px;border-radius:10px;background:#f9f9f9;border:1px solid #eee;">
                
                <div class="d-flex align-items-center justify-content-center mb-0">
                    <input type="number" id="min_price" class="form-control form-control-sm w-50" placeholder="Min" min="0"
                        style="border-radius:8px;font-size:14px;text-align:center;border:1px solid #ddd;">
                    <span class="divider" 
                        style="font-weight:500;color:#666;padding:0 6px;">-</span>
                    <input type="number" id="max_price" class="form-control form-control-sm w-50" placeholder="Max" min="0"
                        style="border-radius:8px;font-size:14px;text-align:center;border:1px solid #ddd;">
                </div>

                <button class="btn btn-sm w-100" id="apply_price_filter"
                    style="border-radius:8px;margin-top:2px;font-size:14px;font-weight:500;
                    background-color:#007bff;color:white;transition:all 0.2s ease-in-out;">
                    <i class="fas fa-filter"></i> Apply
                </button>
            </div>
        </div>
    </div>
</div>
