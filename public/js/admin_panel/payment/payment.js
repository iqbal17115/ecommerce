document.addEventListener("DOMContentLoaded", function () {
    $(document).on("click", ".make-payment", function () {
        let orderId = $(this).data("order-id");
        fetchPaymentInfo(orderId);
    });

    function fetchPaymentInfo(orderId) {
        $.ajax({
            url: `/order-payments/${orderId}`,
            type: "GET",
            dataType: "json",
            success: function (response) {
                displayPaymentInfo(response.results);
            },
            error: function () {
                alert("Failed to fetch payment information.");
            }
        });
    }

    function displayPaymentInfo(data) {
        let currentDate = new Date().toISOString().split('T')[0]; // Get current date in YYYY-MM-DD format

        let paymentHtml = `
            <div class="card shadow-sm p-3 mb-3">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Payment Details</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h6 class="text-muted">Total Order</h6>
                            <p class="font-weight-bold">${data.total_order_price}</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">Discount</h6>
                            <p class="font-weight-bold">${data.total_discount_amount}</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">Shipping</h6>
                            <p class="font-weight-bold">${data.total_shipping_charge_amount}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <h6 class="text-muted">Total Amount</h6>
                            <p class="font-weight-bold text-success">${data.total_amount}</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">Paid</h6>
                            <p class="font-weight-bold text-primary">${data.amount_paid}</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="text-muted">Due</h6>
                            <p class="font-weight-bold text-danger">${data.due_amount}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <span class="badge badge-${data.payment_status === 'Paid' ? 'success' : 'warning'} px-3 py-2">
                            ${data.payment_status}
                        </span>
                    </div>
                </div>
            </div>
    
            <div class="card shadow-sm p-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Make a Payment</h5>
                </div>
                <div class="card-body">
                    <form id="paymentForm">
                        <input type="hidden" name="order_id" value="${data.order_id}">
    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_date">Payment Date</label>
                                    <input type="date" name="date" id="payment_date" class="form-control" value="${currentDate}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_type">Payment Type</label>
                                    <select name="payment_type" id="payment_type" class="form-control">
                                        <option value="cash">Cash</option>
                                        <option value="bkash">Bkash</option>
                                        <option value="nagad">Nagad</option>
                                        <option value="rocket">Rocket</option>
                                        <option value="upay">Upay</option>
                                        <option value="card">Card</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="cheque">Cheque</option>
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control" required>
                        </div>
    
                        <div class="form-group">
                            <label for="note">Note</label>
                            <textarea name="note" id="note" class="form-control"></textarea>
                        </div>
    
                        <div class="text-right">
                            <button type="submit" class="btn btn-success">Submit Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        `;

        $("#orderDetails").html(paymentHtml);
    }

    $(document).on("click", ".view-payment", function () {
        let orderId = $(this).data("order-id");
        fetchViewPaymentInfo(orderId);
    });

    function fetchViewPaymentInfo(orderId) {
        $.ajax({
            url: `/order-payments/${orderId}`,
            type: "GET",
            dataType: "json",
            success: function (response) {
                displayViewPaymentInfo(response.results);
            },
            error: function () {
                alert("Failed to fetch payment information.");
            }
        });
    }

    function displayViewPaymentInfo(paymentInfo) {
        let modalBody = $("#viewPaymentDetails");

        if (!paymentInfo) {
            modalBody.html("<p class='text-danger text-center'>No payment information available.</p>");
            return;
        }

        let paymentDetailsHtml = `
            <div class="container-fluid">
                <!-- Order Summary -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Order Summary</h5>
                                <p><strong>Total Price:</strong> ${paymentInfo.total_order_price}</p>
                                <p><strong>Discount:</strong> ${paymentInfo.total_discount_amount}</p>
                                <p><strong>Shipping:</strong> ${paymentInfo.total_shipping_charge_amount}</p>
                                <p class="fw-bold"><strong>Total Amount:</strong> ${paymentInfo.total_amount}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="card-title text-success">Payment Summary</h5>
                                <p><strong>Amount Paid:</strong> ${paymentInfo.amount_paid}</p>
                                <p><strong>Due Amount:</strong> <span class="text-danger fw-bold">${paymentInfo.due_amount}</span></p>
                                <p><strong>Payment Status:</strong> ${getStatusBadge(paymentInfo.payment_status)}</p>
                            </div>
                        </div>
                    </div>
                </div>
    
                <hr class="my-4">
    
                <!-- Payment History -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped border">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>SL.</th>
                                <th>Date</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${generatePaymentDetailsRows(paymentInfo.payment_details)}
                        </tbody>
                    </table>
                </div>
            </div>
        `;

        modalBody.html(paymentDetailsHtml);
        $("#viewPaymentModal").modal("show");
    }

    /**
     * Generate payment details table rows.
     */
    function generatePaymentDetailsRows(paymentDetails) {
        return paymentDetails.map((detail, index) => `
            <tr>
                <td>${index + 1}</td>  <!-- Serial Number -->
                <td>${detail.payment_date}</td>
                <td>${detail.payment_method}</td>
                <td>${detail.amount}</td>
                <td>${detail.note || '<span class="text-muted">No note</span>'}</td>
            </tr>
        `).join("");
    }

    /**
     * Get status badge based on payment status.
     */
    function getStatusBadge(status) {
        let statusClass = {
            "Paid": "badge-success",
            "Pending": "badge-warning",
            "Overdue": "badge-danger"
        }[status] || "badge-secondary";

        return `<span class="badge ${statusClass}">${status}</span>`;
    }


    $(document).on("submit", "#paymentForm", function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: "/order-payments",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                alert("Payment successfully processed.");
                $("#makePaymentModal").modal("hide");

                // Update payment status using a separate function
                updatePaymentStatus(response.results.order_id, response.results.payment_status);
            },
            error: function () {
                alert("Failed to process payment.");
            }
        });
    });

    /**
     * Updates the payment status in the corresponding table cell.
     *
     * @param {string} orderId - The order ID to identify the correct row.
     * @param {string} paymentStatus - The updated payment status text.
     */
    function updatePaymentStatus(orderId, paymentStatus) {
        // Determine badge class based on payment status
        let paymentBadgeClass = getPaymentBadgeClass(paymentStatus);

        // Locate the payment status cell using a unique class based on orderId
        let paymentStatusTd = $(`.payment-status-${orderId}`);

        // Update the payment status badge
        paymentStatusTd
            .removeClass()
            .addClass(`badge badge-pill payment-status-${orderId} ${paymentBadgeClass} font-size-12`)
            .text(paymentStatus);
    }

    /**
     * Returns the corresponding badge class based on the payment status.
     *
     * @param {string} paymentStatus - The payment status text (e.g., "Paid", "Partially Paid", "Pending").
     * @returns {string} - The appropriate Bootstrap badge class.
     */
    function getPaymentBadgeClass(paymentStatus) {
        switch (paymentStatus.toLowerCase()) {
            case 'paid':
                return 'badge-success'; // Green for paid
            case 'partially paid':
                return 'badge-warning'; // Yellow for partially paid
            case 'pending':
                return 'badge-danger'; // Red for pending
            default:
                return 'badge-secondary'; // Default grey for unknown statuses
        }
    }
});
