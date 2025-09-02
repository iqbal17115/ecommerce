document.addEventListener("DOMContentLoaded", function () {
    const sendBtn = document.getElementById("sendToCourierBtn");

    sendBtn.addEventListener("click", function () {
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
                alert("✅ Order sent to courier successfully!");
                console.log("Response:", data);
            },
            (error) => {
                alert("❌ Failed to send order to courier!");
                console.error("Error:", error);
            }
        );
    });
    document.getElementById("dispatchDate").addEventListener("change", function() {
    console.log(this.value); // will show the new value
});
});
