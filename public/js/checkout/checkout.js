/**
 * Validate phone number
 * @param {string} phone
 * @returns {boolean}
 */
function isValidPhone(phone) {
    // Example: Bangladesh phone numbers
    // Format: 01XXXXXXXXX (11 digits, starts with 01)
    const phonePattern = /^(?:\+?88)?01[3-9]\d{8}$/;
    return phonePattern.test(phone.trim());
}

document.addEventListener('DOMContentLoaded', function () {
    const qtyInput = document.querySelector('.quantity-control input');
    const btnIncrease = document.querySelector('.btn-increase');
    const btnDecrease = document.querySelector('.btn-decrease');
    const subtotalEl = document.querySelector('.order-summary span:nth-child(2)');
    const totalEl = document.querySelector('.order-summary .font-weight-bold span:nth-child(2)');

    const unitPrice = 279; // You may fetch this dynamically
    const shippingFee = 100;

    // Update total price
    function updatePrice() {
        const qty = parseInt(qtyInput.value);
        const subtotal = qty * unitPrice;
        const total = subtotal + shippingFee;

        subtotalEl.innerText = `Taka ${subtotal}`;
        totalEl.innerText = `Taka ${total}`;
    }

    // Increment Quantity
    btnIncrease.addEventListener('click', function () {
        let qty = parseInt(qtyInput.value);
        qtyInput.value = qty + 1;
        updatePrice();
    });

    // Decrement Quantity
    btnDecrease.addEventListener('click', function () {
        let qty = parseInt(qtyInput.value);
        if (qty > 1) {
            qtyInput.value = qty - 1;
            updatePrice();
        }
    });

    // Submit Button
    document.getElementById('placeOrderBtn').addEventListener('click', function () {
        const form = document.getElementById('checkoutForm');
        const formData = new FormData(form);

        // Basic validation example
        const requiredFields = ['name', 'phone', 'district', 'thana', 'address'];
        for (let field of requiredFields) {
            if (!formData.get(field)) {
                alert(`Please fill the required field: ${field}`);
                return;
            }
        }

        // Here you would submit the form using AJAX or normal POST
        alert("Order placed! (This is a placeholder action)");
    });
});
