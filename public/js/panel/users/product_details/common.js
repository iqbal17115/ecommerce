function setReviews(data) {
    let reviewsHTML = ''; // Initialize an empty string to store the HTML

    data.forEach(review => {
        // Concatenate the HTML for each review
        reviewsHTML += `
            <div class="comments mb-2">
                <figure class="img-thumbnail">
                    <img src="${review.profile_photo}" alt="author" width="80" height="80" style="width: 70x;height: 70x;">
                </figure>

                <div class="comment-block">
                    <div class="comment-header">
                        <div class="comment-arrow"></div>

                        <div class="ratings-container float-sm-right">
                            <div class="product-ratings">
                                <span class="ratings" style="width: ${review.rating * 20}%"></span>
                                <span class="tooltiptext tooltip-top"></span>
                            </div>
                        </div>

                        <span class="comment-by">
                            <strong>${review.user_name}</strong> - ${review.created_at}
                        </span>
                    </div>

                    <div class="comment-content">
                        <p>${review.comment}</p>
                    </div>
                </div>
            </div>
        `;
    });

    $("#comment_list").html(reviewsHTML)
    $(".total_review").html(data.length)
}

function getReview() {
    const user_id = $("#temp_user_id").data('user_id');
    const product_id= $("#product_id").val();
    getDetails(
        "/api/reviews/lists?user_id=" + user_id + "&product_id=" + product_id,
        (data) => {
            setReviews(data.results);
        },
        (error) => {

        }
    );
}

// Function to handle form submission
function submitForm(formData, selectedId = "") {
    saveAction(
        "store",
        "/api/reviews",
        formData,
        selectedId,
        (data) => {
            toastrSuccessMessage(data.message);
            console.log(formData['rating']);
            getReview();
            $("#comment").val('');
            $(".star-" + formData['rating']).removeClass("active");
        },
        (error) => {

        }
    );
}

$(document).ready(function () {
    $("#review_form").submit(function (event) {
        event.preventDefault();

        const formData = {
            user_id: $("#temp_user_id").data('user_id'),
            comment: $("#comment").val(),
            rating: $("#rating").val(),
            product_id: $("#product_id").val()
        };
        submitForm(formData, '');
    });

    getReview();
});
