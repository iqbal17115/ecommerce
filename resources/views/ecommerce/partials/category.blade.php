<li>
    @if ($category->subcategories->isNotEmpty())
        <a href="#widget-category-{{ $category->id }}" class="collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="widget-category-{{ $category->id }}">
            {{ $category->name }}<span class="toggle"></span>
        </a>
        <div class="collapse" id="widget-category-{{ $category->id }}">
            <ul class="cat-sublist">
                @foreach ($category->allSubcategories as $subCategory)
                    @include('ecommerce.partials.category', ['category' => $subCategory])
                @endforeach
            </ul>
        </div>
    @else
    <a href="{{ route('catalog.show', ['category_name' => urlencode($category->name)]) }}">
        {{ $category->name }}
    </a>
    @endif
</li>
