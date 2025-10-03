@props([
    'src',
    'alt' => '',
    'class' => '',
    'width' => null,
    'height' => null,
    'style' => null
])

<img 
    class="{{ trim('lazy-load ' . ($class ?? '')) }}"
    data-src="{{ $src }}"
    src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" 
    alt="{{ $alt }}"
    @if($width) width="{{ $width }}" @endif
    @if($height) height="{{ $height }}" @endif
    @if($style) style="{{ $style }}" @endif
>
