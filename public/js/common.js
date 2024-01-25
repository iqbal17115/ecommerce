let limit = 3;
let page = 1;

function showMyOrderNotificationlistData(data) {
    let orderNotificationList = '';

    $("#total_pending_order").text(data.length);

    data.forEach((item) => {
        orderNotificationList += `
            <a href="" class="text-reset notification-item">
                <div class="media">
                    <img src="${item.profile_photo}" class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                    <div class="media-body">
                        <h6 class="mt-0 mb-1">${item.name} - ${item.code}</h6>
                        <div class="font-size-12 text-muted">
                            <p class="mb-1">${item.mobile}</p>
                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> ${item.order_date}</p>
                        </div>
                    </div>
                </div>
            </a>
        `;
    });

    $('#orderNotificationId').html(orderNotificationList);
}

function getOrderNotificationlist() {
    getDetails(
        `/order-notification?limit=${limit}&page=${page}`,
        (data) => {
            showMyOrderNotificationlistData(data.results.data);
        },
        (error) => {
            // Handle error
        }
    );
}

function loadMore() {
    // Increment page and call getOrderNotificationlist to fetch more data
    page++;
    getOrderNotificationlist();
}

$(document).ready(function () {
    getOrderNotificationlist();

    // Event listener for the "View More" button
    $('#viewMoreBtn').on('click', function () {
        loadMore();
    });
});
