<div class="widget widget-size">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true"
            aria-controls="widget-body-4">Size</a>
    </h3>

    <div class="collapse show" id="widget-body-4">
        <div class="widget-body pb-0">
            <ul>
                @foreach ($productSizes as $size)
                    <li>
                        <input type="checkbox" class="select_size" name="size"
                            value="{{ $size->value }}" onchange="applyFilters()">
                        <a>{{ $size->value }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- End .widget-body -->
    </div>
    <!-- End .collapse -->
</div>
