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

// Messenger Fallback (Web only)
function shareViaMessengerAppOnly(url) {
    const encodedUrl = encodeURIComponent(url);

    // Try to open Messenger app directly
    const messengerLink = `fb-messenger://share?link=${encodedUrl}`;

    // Open it
    window.location.href = messengerLink;

    // Optional fallback alert after 2 seconds
    setTimeout(() => {
        alert("If Messenger didn't open, please make sure the Messenger app is installed.");
    }, 2000);
}



