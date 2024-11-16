<div class="widget widget-{{ $filterType }}">
    <h3 class="widget-title">
        <a data-toggle="collapse" href="#widget-body-{{ $filterId }}" role="button" aria-expanded="true"
            aria-controls="widget-body-{{ $filterId }}">{{ ucfirst($filterType) }}</a>
    </h3>

    <div class="collapse show" id="widget-body-{{ $filterId }}">
        <div class="widget-body pb-0">
            <ul>
                @foreach ($items as $key => $item)
                    <li class="{{ $key >= $viewLimit ? 'd-none more-items' : '' }}">
                        <input type="checkbox" class="select_{{ $filterType }}" name="{{ $filterType }}"
                            value="{{ $item->value }}" onchange="applyFilters()">
                        <a>{{ $item->value }}</a>
                    </li>
                @endforeach
            </ul>
            @if(count($items) > $viewLimit)
                <a href="javascript:void(0);" class="view-more" onclick="toggleViewMore(this)">View More</a>
                <a href="javascript:void(0);" class="view-less d-none" onclick="toggleViewLess(this)">View Less</a>
            @endif
        </div>
    </div>
</div>
