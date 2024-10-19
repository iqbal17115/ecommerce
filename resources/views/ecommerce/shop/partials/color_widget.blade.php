<div class="widget widget-color">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true"
            aria-controls="widget-body-4">Color</a>
    </h3>

    <div class="collapse show" id="widget-body-4">
        <div class="widget-body pb-0">
            <ul>
                @foreach ($productColors as $color)
                    <li>
                        <input type="checkbox" class="select_color" name="color"
                            value="{{ $color->value }}" onchange="applyFilters()">
                        <a>{{ $color->value }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- End .widget-body -->
    </div>
    <!-- End .collapse -->
</div>
