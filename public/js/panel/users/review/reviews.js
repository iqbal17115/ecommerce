const ReviewHandler = (() => {
    function init() {
        setupStarRating();
        bindFormSubmit();
        loadReviews();
    }

    function setupStarRating() {
        document.querySelectorAll('.rating-stars a').forEach(star => {
            star.addEventListener('click', function (e) {
                e.preventDefault();
                const rating = this.className.split('-')[1];
                document.getElementById('rating').value = rating;

                document.querySelectorAll('.rating-stars a').forEach(s => s.classList.remove('selected'));
                for (let i = 1; i <= rating; i++) {
                    document.querySelector(`.star-${i}`)?.classList.add('selected');
                }
            });
        });
    }

    function bindFormSubmit() {
        const form = document.getElementById('review_form');
        form?.addEventListener('submit', function (e) {
            e.preventDefault();

            const productId = document.getElementById('product_id')?.value;
            const rating = document.getElementById('rating')?.value;
            const comment = document.getElementById('comment')?.value;

            if (!rating || !comment) {
                alert('Please fill all required fields');
                return;
            }

            saveAction(
                'store',
                '/reviews/store',
                {
                    product_id: productId,
                    rating: rating,
                    comment: comment,
                },
                '',
                (data) => {
                    toastr.success(data.message);

                    // Delay the reset and clearing of selected stars
                    setTimeout(() => {
                        form.reset();
                        document.getElementById('rating').value = '';
                    }, 50);

                    document.querySelectorAll('.rating-stars a').forEach(s => {
                        s.classList.remove('selected');
                        s.classList.remove('active');
                    });

                    loadReviews();
                }
            );
        });
    }

    function loadReviews() {
        const productId = document.getElementById('product_id')?.value;

        getDetails(`/reviews/${productId}`, (data) => {
            const container = document.getElementById('review_list');
            container.innerHTML = "";

            const total = data.results.length;
            document.querySelectorAll('.total_review').forEach(el => el.textContent = total);

            if (total === 0) {
                container.innerHTML = `<p>No reviews yet.</p>`;
                return;
            }

            data.results.forEach(review => {
                container.innerHTML += renderReview(review);
            });
        });
    }

    function renderReview(review) {
        const stars = Array.from({ length: 5 }, (_, i) =>
            `<span class="star ${i < review.rating ? 'filled' : ''}">★</span>`
        ).join('');

        return `
            <div class="review-item border-bottom mb-3 pb-2">
                <div class="rating-stars mb-1">${stars}</div>
                <p class="comment mb-1">${review.comment}</p>
                <small class="text-muted">${review.created_at}</small>
            </div>
        `;
    }

    return {
        init,
    };
})();

document.addEventListener('DOMContentLoaded', () => {
    ReviewHandler.init();
});
