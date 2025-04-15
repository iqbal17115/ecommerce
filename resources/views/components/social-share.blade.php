@props(['url', 'title'])

@php
    $encodedUrl = urlencode($url);
    $encodedTitle = urlencode($title);
@endphp

<div class="social-icons">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $encodedUrl }}"
       target="_blank" rel="noopener" class="social-icon fab fa-facebook" title="Facebook"></a>
    <a href="https://twitter.com/intent/tweet?url={{ $encodedUrl }}&text={{ $encodedTitle }}"
       target="_blank" rel="noopener" class="social-icon fab fa-twitter" title="Twitter"></a>
    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $encodedUrl }}"
       target="_blank" rel="noopener" class="social-icon fab fa-linkedin-in" title="LinkedIn"></a>
    <a href="mailto:?subject={{ $encodedTitle }}&body={{ $encodedUrl }}"
       target="_blank" rel="noopener" class="social-icon fas fa-envelope" title="Email"></a>
</div>
