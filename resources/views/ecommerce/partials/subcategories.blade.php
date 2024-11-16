@foreach ($category->subcategories as $subCategory)
    @include('ecommerce.partials.category', ['category' => $subCategory])
@endforeach
