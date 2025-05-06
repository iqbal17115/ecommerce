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

   {{-- Messenger (fallback web dialog) --}}
   <!-- HTML for the Share on Messenger Button -->
   <a href="javascript:void(0);" onclick="shareOnMessenger('{{ $url }}', '{{ $title }}')" class="social-icon fab fa-facebook-messenger">
      Share on Messenger
   </a>


   {{-- Copy Link --}}
   <a class="social-icon fas fa-copy"
      href="#"
      onclick="copyToClipboard('{{ $url }}'); return false;"
      title="Copy Link">
   </a>

   {{-- Universal Share (Mobile Devices) --}}
   <a class="social-icon fas fa-share-alt"
      href="#"
      onclick="shareNow('{{ $title }}', '{{ $url }}'); return false;"
      title="Share...">
   </a>
</div>