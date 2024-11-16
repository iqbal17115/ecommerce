@props(['id', 'name', 'value'])

<input type="date" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}"
       {{ $attributes->merge(['class' => 'form-control']) }}>
