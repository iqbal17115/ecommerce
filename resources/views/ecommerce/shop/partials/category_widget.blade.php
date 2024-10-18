<div class="widget">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true"
            aria-controls="widget-body-2">Categories</a>
    </h3>

    <div class="collapse show" id="widget-body-2">
        <div class="widget-body">
            <ul class="cat-list">
                @foreach ($categories as $category)
                    @include('ecommerce.partials.category', [
                        'category' => $category,
                    ])
                @endforeach
            </ul>
        </div>
        <!-- End .widget-body -->
    </div>
    <!-- End .collapse -->
</div>
