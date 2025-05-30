@props(['url', 'title'])

@php
$encodedUrl = urlencode($url);
$encodedTitle = urlencode($title);
@endphp

<div class="social-icons d-flex gap-2">
   {{-- Facebook App/Web --}}
   <a href="https://www.facebook.com/dialog/share?app_id=9639422116148689&href={{ $encodedUrl }}&display=popup"
      target="_blank"
      class="social-icon fab fa-facebook"
      title="Share on Facebook">
   </a>

   {{-- WhatsApp --}}
   <a class="social-icon fab fa-whatsapp"
      href="https://api.whatsapp.com/send?text={{ $encodedTitle }}%20{{ $encodedUrl }}"
      target="_blank"
      title="Share on WhatsApp">
   </a>

   {{-- Telegram --}}
   <a class="social-icon fab fa-telegram-plane"
      href="https://t.me/share/url?url={{ $encodedUrl }}&text={{ $encodedTitle }}"
      target="_blank"
      title="Share on Telegram">
   </a>

   {{-- Messenger --}}
   <div class="social-icons d-flex gap-2">
      {{-- Messenger App Only --}}
      <a href="javascript:void(0);"
         onclick="shareViaMessengerAppOnly('{{ $url }}')"
         class="social-icon fab fa-facebook-messenger"
         title="Share on Messenger App Only">
      </a>
   </div>


   {{-- Copy Link --}}
   <a class="social-icon fas fa-copy"
      href="#"
      onclick="copyToClipboard('{{ $url }}'); return false;"
      title="Copy Link">
   </a>
</div>