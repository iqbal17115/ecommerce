// Function to copy the URL to clipboard
function copyToClipboard(text) {
    navigator.clipboard.writeText(text)
        .then(() => toastrSuccessMessage("Link copied to clipboard!"))
        .catch(err => {
            toastrErrorMessage("Failed to copy link");
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

function shareToFacebook(url, title) {
    const encodedUrl = encodeURIComponent(url);
    const fbWebUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;

    if (navigator.share) {
        // Mobile: Use native share dialog if available
        navigator.share({
            title: title,
            text: title,
            url: url,
        }).catch(err => {
            console.error('Native share failed:', err);
            // fallback to Facebook web share
            window.open(fbWebUrl, '_blank', 'width=600,height=400');
        });
    } else {
        // PC: Open Facebook web share dialog
        window.open(fbWebUrl, '_blank', 'width=600,height=400');
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
        toastrErrorMessage("If Messenger didn't open, please make sure the Messenger app is installed.");
    }, 2000);
}



