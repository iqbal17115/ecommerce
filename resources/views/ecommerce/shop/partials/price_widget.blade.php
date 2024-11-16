<div class="widget widget-price">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true"
            aria-controls="widget-body-3">Price</a>
    </h3>

    <div class="collapse show" id="widget-body-3">
        <div class="widget-body pb-0">
            <form id="productFilterByPrice" onsubmit="event.preventDefault(); sendPriceFilters();">
                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="number" class="form-control form-control-sm rounded"
                                id="min_price" name="min_price" placeholder="Min" min="0"
                                style="-moz-appearance: textfield; height: 30px; font-size: 14px;"
                                required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="number" class="form-control form-control-sm rounded"
                                id="max_price" name="max_price" placeholder="Max" min="0"
                                style="-moz-appearance: textfield; height: 30px; font-size: 14px;"
                                required>
                        </div>
                    </div>
                    <div class="col-md-4 align-items-end">
                        <center>
                            <button type="submit" class="btn btn-primary btn-sm"
                                style="height: 30px; border-radius: 3px; background-color: #007bff; border-color: #007bff; color: #fff; padding: 0em 0em;">Filter</button>
                        </center>
                    </div>
                </div>
            </form>
        </div>
        <!-- End .widget-body -->
    </div>
    <!-- End .collapse -->
</div>
