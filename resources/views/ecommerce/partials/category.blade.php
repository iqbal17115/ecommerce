<li class="category-item {{ isset($flag) ? 'list-group-item':''}}">
    @if ($category->subcategories->isNotEmpty())
        <a href="#widget-category-{{ $category->id }}" class="category-link load-subcategories" data-toggle="collapse"
           data-id="{{ $category->id }}" data-category="{{ $category->name }}" role="button" aria-expanded="false"
           aria-controls="widget-category-{{ $category->id }}">
            {{ $category->name }}
            <span class="toggle-icon">&#9662;</span>
        </a>
        <div class="collapse" id="widget-category-{{ $category->id }}">
            <ul class="cat-sublist" id="sublist-{{ $category->id }}">
                <!-- Subcategories will be loaded here via AJAX -->
            </ul>
        </div>
    @else
        <a href="javascript:void(0);" class="category-link category-filter" data-category="{{ $category->name }}">
            {{ $category->name }}
        </a>
    @endif
</li>
