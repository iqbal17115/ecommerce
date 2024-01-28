let limit = 5;
let page = 1;
let loading = false; // To prevent multiple simultaneous requests

function showMyOrderNotificationlistData(data) {
    let orderNotificationList = '';

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

    $('#orderNotificationId').append(orderNotificationList);
    loading = false; // Mark loading as completed
}

function getOrderNotificationlist() {
    if (!loading) {
        loading = true; // Mark loading as in progress
        getDetails(
            `/order-notification?limit=${limit}&page=${page}`,
            (data) => {
                console.log(data);
                $("#total_pending_order").text(data.results.total);
                showMyOrderNotificationlistData(data.results.data);
            },
            (error) => {
                // Handle error
            }
        );
        page++;
    }
}

$(document).ready(function () {
    getOrderNotificationlist();

    // Event listener for the "on-scroll load more" functionality
    $('#orderNotificationId').on('scroll', function () {
        if (this.scrollHeight - this.scrollTop === this.clientHeight) {
            // User has reached the bottom, trigger load more
            getOrderNotificationlist();
        }
    });
});
