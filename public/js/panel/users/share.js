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

function shareToFacebookApp(url) {
    const encodedUrl = encodeURIComponent(url);
    const fbWebUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`;
    const fbAppUrl = `fb://facewebmodal/f?href=${fbWebUrl}`;

    const isMobile = /android|iphone|ipad|ipod/i.test(navigator.userAgent);

    if (isMobile) {
        const timeout = setTimeout(() => {
            window.open(fbWebUrl, '_blank', 'width=600,height=400,menubar=no,toolbar=no,status=no,scrollbars=yes');
        }, 1500);

        const iframe = document.createElement('iframe');
        iframe.style.display = 'none';
        iframe.src = fbAppUrl;
        document.body.appendChild(iframe);

        setTimeout(() => {
            document.body.removeChild(iframe);
            clearTimeout(timeout);
        }, 2000);
    } else {
        // ✅ Directly open the share window — must be inside the click handler
        window.open(fbWebUrl, '_blank', 'width=600,height=400,menubar=no,toolbar=no,status=no,scrollbars=yes');
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



