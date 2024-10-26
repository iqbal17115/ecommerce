<div class="widget categories-widget">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-body-2" role="button" aria-expanded="true" aria-controls="widget-body-2">
            Categories
            <span class="widget-icon">&#9662;</span>
        </a>
    </h3>
    <div class="collapse show" id="widget-body-2">
        <div class="widget-body">
            <ul class="cat-list list-group">
                @foreach ($categories as $category)
                    @include('ecommerce.partials.category', ['category' => $category, 'flag' => 1])
                @endforeach
            </ul>
        </div>
    </div>
</div>
