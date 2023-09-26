@props(['for', 'value', 'required' => false])

<label for="{{ $for }}" class="block font-medium text-sm text-gray-700">
    {{ $value }}
    @if($required)
        <span class="text-red-500">*</span>
    @endif
</label>