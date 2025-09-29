function initLazyLoad() {
    const images = document.getElementsByClassName('lazy-load');

    const options = {
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver(function (entries, observer) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                const image = entry.target;
                const imageUrl = image.getAttribute('data-src');
                image.src = imageUrl;
                image.classList.remove('lazy-load');
                observer.unobserve(image);
            }
        });
    }, options);

    for (let i = 0; i < images.length; i++) {
        observer.observe(images[i]);
    }
}

// Automatically initialize after DOM is ready
document.addEventListener("DOMContentLoaded", initLazyLoad);
