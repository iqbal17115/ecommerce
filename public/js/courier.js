document.addEventListener("DOMContentLoaded", function () {
    const sendBtn = document.getElementById("sendToCourierBtn");
    const shippingForm = document.getElementById("shippingForm");

    // Form validation function
    function validateForm() {
        let courier = document.getElementById("courier").value.trim();
        let shippingMethod = document.getElementById("shippingMethod").value.trim();
        let dispatchDate = document.getElementById("dispatchDate").value.trim();

        let errors = [];

        if (!courier) {
            errors.push("Courier is required.");
        }
        if (!shippingMethod) {
            errors.push("Shipping method is required.");
        }
        if (!dispatchDate) {
            errors.push("Dispatch date is required.");
        }

        if (errors.length > 0) {
            toastrErrorMessage(errors.join("<br>"));
            return false;
        }

        return true;
    }

    sendBtn.addEventListener("click", function () {
        if (!validateForm()) {
            return;
        }

        let orderId = document.getElementById("orderId").value;
        let formData = {
            courier: document.getElementById("courier").value,
            shippingMethod: document.getElementById("shippingMethod").value,
            trackingId: document.getElementById("trackingId").value,
            dispatchDate: document.getElementById("dispatchDate").value,
            _token: document.querySelector("input[name=_token]").value,
        };

        saveAction(
            "store",
            `/couriers/${orderId}/send`,
            formData,
            orderId,
            (data) => {
                if (data.success) {
                    toastrSuccessMessage(data.message);

                    if (data.data) {
                        let shipmentHtml = `
                            <div class="row">
                                <div class="col-md-4">
                                    <h5>Carrier & Delivery</h5>
                                    <p>${data.data.courier_name ?? '-'}</p>
                                    <p>${data.data.shipping_method ?? '-'}</p>
                                </div>
                                <div class="col-md-4">
                                    <h5>Tracking ID</h5>
                                    <p>${data.data.tracking_code ?? '-'}</p>
                                    <p>${data.data.dispatched_at ?? '-'}</p>
                                </div>
                                <div class="col-md-4">
                                    <h5>Estimate Delivery Date</h5>
                                    <p>${data.data.estimate_date ?? '-'}</p>
                                </div>
                            </div>
                        `;
                        document.getElementById("shipment-section").innerHTML = shipmentHtml;
                    }
                } else {
                    toastrErrorMessage(data.message);
                }
            },
            (error) => {
                toastrErrorMessage(error.responseJSON.message);
            }
        );
    });

    // Debugging: show dispatch date changes in console
    document.getElementById("dispatchDate").addEventListener("change", function () {
        console.log(this.value);
    });

  
});
  /**
 * Update courier delivery status for a single order
 * @param {number|string} orderId
 */
    function updateOrderStatus(orderId) {
        const route = `/couriers/check-status/${orderId}`;
        const targetSelector = `#order-status-${orderId}`;

        getDetails(route, (data) => {
            updateStatusElement(targetSelector, data.status);
        }, (error) => {
            console.error(`Failed to fetch status for order ${orderId}:`, error);
            updateStatusElement(targetSelector, 'Error', 'badge-danger');
        });
    }

    /**
     * Update the status element text and optional badge class
     * @param {string} selector - CSS selector of the element
     * @param {string} status - Status text to display
     * @param {string|null} forcedClass - Optional: force CSS class
     */
    function updateStatusElement(selector, status, forcedClass = null) {
        const el = document.querySelector(selector);
        if (!el) return;

        el.textContent = status || 'Unknown';
        const badgeClass = forcedClass || getStatusBadgeClass(status);
        el.className = `badge ${badgeClass}`;
    }

    /**
     * Map courier delivery status to CSS badge classes
     * @param {string} status
     * @returns {string} CSS class
     */
    function getStatusBadgeClass(status) {
        switch (status) {
            case 'delivered': return 'badge-success';
            case 'partial_delivered': return 'badge-warning';
            case 'in_review': return 'badge-info';
            case 'cancelled': return 'badge-danger';
            case 'hold': return 'badge-secondary';
            case 'pending': return 'badge-secondary';
            default: return 'badge-secondary';
        }
    }

    /**
     * Bulk update all orders currently in the table
     * @param {Array} orderIds - Array of order IDs
     */
    function updateAllOrderStatuses(orderIds) {

        updateOrderStatus(orderIds);
    }

   let orderIds = document.getElementById("orderId").value;

    updateAllOrderStatuses(orderIds);