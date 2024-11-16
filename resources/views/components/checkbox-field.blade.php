@props(['checked' => false, 'id', 'name', 'onclick' => null])

<input type="checkbox" {{ $checked ? 'checked' : '' }} id="{{ $id }}" name="{{ $name }}" {!! $attributes->merge(['class' => 'form-checkbox h-4 w-4 text-indigo-600 border-gray-300 rounded']) !!} onclick="{{ $onclick }}">
