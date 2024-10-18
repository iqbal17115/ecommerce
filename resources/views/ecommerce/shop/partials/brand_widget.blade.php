<div class="widget widget-brand">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-body-7" role="button" aria-expanded="true"
            aria-controls="widget-body-7">Brand</a>
    </h3>

    <div class="collapse show" id="widget-body-7">
        <div class="widget-body pb-0">
            <ul class="cat-list">
                @foreach ($brands as $brand)
                    <li>
                        <input type="checkbox" class="select_brand" name="brand"
                            value="{{ $brand->name }}" onchange="applyFilters()">
                        <a>{{ $brand->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- End .widget-body -->
    </div>
    <!-- End .collapse -->
</div>
