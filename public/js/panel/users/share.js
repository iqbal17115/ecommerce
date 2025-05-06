// Function to copy the URL to clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text)
        .then(() => alert('Link copied to clipboard!'))
        .catch(err => {
            alert('Failed to copy link');
            console.error('Clipboard error:', err);
        });
}

// Function to trigger native share dialog (mobile)
function shareNow(title, url) {
    if (navigator.share) {
        navigator.share({
            title: title,
            text: title,
            url: url,
        })
        .catch(err => console.error('Share failed:', err));
    } else {
        alert("Sharing not supported on this browser. Use the copy button.");
    }
}

function shareOnMessenger(url, title) {
    var encodedUrl = encodeURIComponent(url);
    var encodedTitle = encodeURIComponent(title);
    
    // Facebook Messenger deep link URL
    var messengerLink = "fb-messenger://share?text=" + encodedTitle + "%20" + encodedUrl;
    
    // Try opening Messenger app on Android devices
    window.location.href = messengerLink;

    // Fallback: Open Facebook Messenger web version if Messenger app is not installed (optional)
    setTimeout(function() {
        if (!window.location.href.includes('fb-messenger://')) {
            window.location.href = "https://m.me/?link=" + encodedUrl;  // Fallback to Messenger web version
        }
    }, 1000);
}

