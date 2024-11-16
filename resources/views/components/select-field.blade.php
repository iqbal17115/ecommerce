<select id="{{ $id }}" name="{{ $name }}"
        class="form-select w-full border border-gray-300 rounded-lg px-3 py-2 @error($name) is-invalid @enderror">
    <option value="">Select</option>
    @foreach($options as $option)
        <option value="{{ $option }}" @if($selected && $selected == $option) selected @endif>{{ $option }}</option>
    @endforeach
</select>