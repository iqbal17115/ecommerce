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
function shareOnMessenger(url) {
    const encodedUrl = encodeURIComponent(url);
    // Open Messenger (limited support on mobile)
    window.open("https://m.me/?link=" + encodedUrl, "_blank");
}


