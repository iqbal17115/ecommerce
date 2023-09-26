@props(['for', 'label', 'required' => false])

<label class="block text-gray-700 text-sm font-bold mb-2" for="{{ $for }}">
    {{ $label }} @if($required)<span class="text-red-500 text-lg">*</span>@endif
</label>