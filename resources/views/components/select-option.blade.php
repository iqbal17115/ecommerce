<div id="parent_{{ $dataTable ?? '' }}">
    <select
        data-table="{{ $dataTable ?? '' }}"
        tabindex="{{ $tabIndex ?? '' }}"
        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 selectpicker {{ $class ?? '' }}"
        name="{{ $name ?? '' }}"
        id="{{ $id ?? '' }}">
    </select>
</div>