document.addEventListener('DOMContentLoaded', function () {
    function getUserRewardPoint() {
        getDetails(
            "user-reward-point",
            (data) => {
                displayUserRewardPoint(data.results);
            },
            (error) => {
                console.error("Error fetching order list:", error);
                // Handle the error (e.g., show an error message)
            }
        );
    }

     function getUserRewardPointSummary() {
        getDetails(
            "user-reward-point-summary",
            (data) => {
                displayUserRewardPointSummary(data.results.data);
            },
            (error) => {
                console.error("Error fetching reward point history:", error);
            }
        );
    }

    function displayUserRewardPoint(userRewardPoint) {
        const total = userRewardPoint.total_points ?? 0;
        const used = userRewardPoint.used_points ?? 0;
        const earned = total + used;

        // Update UI
        document.getElementById("reward-total-points").innerText = `${total.toLocaleString()} Points`;
        document.getElementById("reward-summary").innerText = `Lifetime Earned: ${earned.toLocaleString()} | Used: ${used.toLocaleString()}`;
    }

    function displayUserRewardPointSummary(transactions) {
        const tbody = document.getElementById("reward-transaction-body");
        tbody.innerHTML = ""; // Clear old data

        transactions.forEach((txn) => {
            const row = document.createElement("tr");

            // Type badge
            let badgeClass = "bg-success";
            if (txn.type === "earned") badgeClass = "bg-success";
            else if (txn.type === "used") badgeClass = "bg-danger";
            else if (txn.type === "gift_card") badgeClass = "bg-primary";

            row.innerHTML = `
                <td><span class="badge ${badgeClass}">${txn.type}</span></td>
                <td>${txn.points}</td>
                <td>${txn.description ?? '-'}</td>
            `;

            tbody.appendChild(row);
        });
    }
    getUserRewardPoint();
    getUserRewardPointSummary();
});