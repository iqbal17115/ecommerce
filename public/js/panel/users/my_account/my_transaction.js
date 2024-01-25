function showMyTransactionlistData(data) {
    let htmlWishlistContent = '';

    data.forEach((item) => {
        let paymentStatus = (item.status === 'completed') ? 'Order Payment' : 'Refunded';
        let paymentMethod = (item.status === 'completed') ? `${item.order.payment_method}` : '-';
        htmlWishlistContent += `
        <tr class="product-row wishlist_row_${item.id}">
            <td>
                <h5 class="product-title">
                    <a>${item.order.order_date}</a>
                </h5>
            </td>
            <td>
                <h5 class="product-title">
                    <a>${item.order.code}</a>
                </h5>
            </td>
            <td class="price-box">${paymentStatus}</td>
            <td class="price-box">${paymentMethod}</td>
            <td class="price-box">${item.order.total_amount}</td>
        </tr>`;
    });

    $('#my_transaction_data table tbody').html(htmlWishlistContent);
}



$(document).ready(function () {

    function getMyTransactionlist() {
        getDetails(
            "/my-trasaction",
            (data) => {
                console.log(data);
                console.log(data);
                console.log(data);
                console.log(data);
                showMyTransactionlistData(data.results.data);
            },
            (error) => {

            }
        );
    }

    getMyTransactionlist();
});
