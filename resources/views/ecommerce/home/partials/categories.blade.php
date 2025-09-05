<div class="categories-slider owl-carousel owl-theme show-nav-hover nav-outer"
                    data-owl-options="{
                            'loop': false,
                            'autoplay': true,
                            'autoplayTimeout': 3000,
                            'responsive': {
                                '0': {
                                    'items': 3
                                },
                                '480': {
                                    'items': 5
                                },
                                '576': {
                                    'items': 6
                                },
                                '768': {
                                    'items': 7
                                },
                                '992': {
                                    'items': 8
                                },
                                '1200': {
                                    'items': 12
                                }
                            }
                        }">
                    @if(count($top_show_categories) > 0)
                    @foreach ($top_show_categories as $top_show_category)
                    <div class="product-category appear-animate" data-animation-name="fadeInUpShorter">
                        <a
                            href="{{ route('catalog.show', ['category_name' => rawurlencode($top_show_category->name)]) }}">
                            <figure>
                                <img class="lazy-load"
                                    data-src="{{ asset('storage/' . $top_show_category->image) }}" alt="category"
                                    width="280" height="240"
                                    style="width: 100px; height: 100px; border-radius: 50%;" />
                            </figure>
                            <div class="category-content p-0">
                                <span
                                    style="margin: 8px 12px 0;font-size: 12px;color: #212121;line-height: 18px;height: 36px;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;">
                                    {{ __($top_show_category->name, [], app()->getLocale()) }}
                                </span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    @endif
                </div>