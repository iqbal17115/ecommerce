<li>
    @if ($category->subcategories->isNotEmpty())
        <a href="#widget-category-{{ $category->id }}" class="collapsed load-subcategories" data-toggle="collapse" data-id="{{ $category->id }}" role="button" aria-expanded="false" aria-controls="widget-category-{{ $category->id }}">
            {{ $category->name }}<span class="toggle"></span>
        </a>
        <div class="collapse" id="widget-category-{{ $category->id }}">
            <ul class="cat-sublist" id="sublist-{{ $category->id }}">
                <!-- Subcategories will be loaded here via AJAX -->
            </ul>
        </div>
    @else
        <a href="{{ route('catalog.show', ['category_name' => urlencode($category->name)]) }}">
            {{ $category->name }}
        </a>
    @endif
</li>
