@props(['url', 'title'])

@php
    $encodedUrl = urlencode($url);
    $encodedTitle = urlencode($title);
@endphp

<div class="social-icons d-flex gap-2">
    {{-- Facebook --}}
    <a class="social-icon fab fa-facebook" 
       href="https://www.facebook.com/sharer/sharer.php?u={{ $encodedUrl }}" 
       target="_blank" 
       title="Facebook">
    </a>

    {{-- Twitter --}}
    <a class="social-icon fab fa-twitter" 
       href="https://twitter.com/intent/tweet?url={{ $encodedUrl }}&text={{ $encodedTitle }}" 
       target="_blank" 
       title="Twitter">
    </a>

    {{-- LinkedIn --}}
    <a class="social-icon fab fa-linkedin-in" 
       href="https://www.linkedin.com/shareArticle?mini=true&url={{ $encodedUrl }}&title={{ $encodedTitle }}" 
       target="_blank" 
       title="LinkedIn">
    </a>

    {{-- WhatsApp --}}
    <a class="social-icon fab fa-whatsapp" 
       href="https://api.whatsapp.com/send?text={{ $encodedTitle }}%20{{ $encodedUrl }}" 
       target="_blank" 
       title="WhatsApp">
    </a>

    {{-- Telegram --}}
    <a class="social-icon fab fa-telegram-plane" 
       href="https://t.me/share/url?url={{ $encodedUrl }}&text={{ $encodedTitle }}" 
       target="_blank" 
       title="Telegram">
    </a>

    {{-- Facebook Messenger --}}
    <a class="social-icon fab fa-facebook-messenger" 
       href="https://www.facebook.com/dialog/send?link={{ $encodedUrl }}&app_id=9639422116148689&redirect_uri={{ $encodedUrl }}" 
       target="_blank" 
       title="Messenger">
    </a>

    {{-- Copy to Clipboard --}}
    <a class="social-icon fas fa-copy" 
       href="#" 
       onclick="copyToClipboard('{{ $url }}'); return false;" 
       title="Copy Link">
    </a>
</div>