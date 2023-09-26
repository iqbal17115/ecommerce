@props(['id', 'name', 'value'])

<textarea id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }}>{{ $value }}</textarea>
