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
    
    // Messenger URL for mobile and desktop
    var messengerLink = "https://m.me/?link=" + encodedUrl + "&title=" + encodedTitle;

    // Open Messenger link
    window.location.href = messengerLink;

    // Fallback: Wait 1 second and check if the app was launched
    setTimeout(function() {
        if (!window.location.href.includes('m.me')) {
            window.location.href = "https://www.messenger.com/t/" + encodedUrl;  // Fallback to Messenger Web version if needed
        }
    }, 1000);
}


