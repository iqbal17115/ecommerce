document.addEventListener("DOMContentLoaded", function () {
    let currentPage = 1;
    let limit = parseInt(document.getElementById("perPageSelect").value);

    const transactionList = document.getElementById("transaction-list");
    const paginationContainer = document.getElementById("pagination");
    const totalItemsDisplay = document.getElementById("totalItems");

    function loadTransactions(page = 1, start_date = "", end_date = "") {
        currentPage = page;
        limit = parseInt(document.getElementById("perPageSelect").value);

        // Build query string
        const params = new URLSearchParams();
        params.append("page", page);
        params.append("limit", limit);

        if (start_date) {
            params.append("start_date", start_date);
        }
        if (end_date) {
            params.append("end_date", end_date);
        }

        const url = `/my-trasaction?${params.toString()}`;

        getDetails(
            url,
            (response) => {
                const data = response.results;
                renderTransactions(data.data);
                renderPagination(data);
                totalItemsDisplay.innerText = `Showing ${data.from} to ${data.to} of ${data.total} entries`;
            },
            (error) => {
                transactionList.innerHTML = `<p style="color: #dc3545; text-align: center; margin: 1rem 0;">Failed to load transactions.</p>`;
                console.error("Transaction load error:", error);
            }
        );
    }


    function renderTransactions(transactions) {
        // unchanged...
        transactionList.innerHTML = "";

        if (!transactions || transactions.length === 0) {
            transactionList.innerHTML = "<p style='text-align:center; margin:1rem 0; color:#6c757d;'>No transactions found.</p>";
            return;
        }

        const table = document.createElement("table");
        table.setAttribute("class", "table table-bordered table-striped table-hover");
        table.style.marginBottom = "0";
        table.style.textAlign = "center";

        const thead = `
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th style="vertical-align: middle;">Date</th>
                    <th style="vertical-align: middle;">Order Code</th>
                    <th style="vertical-align: middle;">Payment Method</th>
                    <th style="vertical-align: middle;">Amount</th>
                </tr>
            </thead>
        `;

        let tbody = "<tbody>";
        let totalAmount = 0;

        transactions.forEach(tx => {
            const amount = parseFloat(tx.amount);
            totalAmount += amount;

            tbody += `
                <tr>
                    <td>${tx.date}</td>
                    <td>${tx.order_code}</td>
                    <td>${tx.payment_method}</td>
                    <td>৳ ${amount.toFixed(2)}</td>
                </tr>
            `;
        });
        tbody += "</tbody>";

        const tfoot = `
            <tfoot style="background-color: #f1f1f1; font-weight: bold;">
                <tr>
                    <td colspan="3" style="text-align: right;">Total:</td>
                    <td>৳ ${totalAmount.toFixed(2)}</td>
                </tr>
            </tfoot>
        `;

        table.innerHTML = thead + tbody + tfoot;
        transactionList.appendChild(table);
    }

    function renderPagination(data) {
        paginationContainer.innerHTML = "";

        data.links.forEach(link => {
            const li = document.createElement("li");
            li.classList.add("page-item");
            if (link.active) li.classList.add("active");
            if (link.url === null) li.classList.add("disabled");

            const a = document.createElement("a");
            a.classList.add("page-link");
            a.innerHTML = link.label.replace("Previous", "&laquo;").replace("Next", "&raquo;");
            a.style.borderRadius = "0.375rem";
            a.style.padding = "0.35rem 0.75rem";
            a.style.fontSize = "0.875rem";
            a.style.color = link.active ? "#fff" : "#0d6efd";
            a.style.backgroundColor = link.active ? "#0d6efd" : "#fff";
            a.style.border = "1px solid #dee2e6";
            a.style.transition = "all 0.3s";

            if (link.url !== null) {
                a.href = "#";
                a.addEventListener("click", function (e) {
                    e.preventDefault();
                    const page = getPageFromUrl(link.url);
                    if (page) {
                        const filters = getCurrentFilters();
                        loadTransactions(page, filters);
                    }
                });
            }

            li.appendChild(a);
            paginationContainer.appendChild(li);
        });
    }

    function getPageFromUrl(url) {
        try {
            const urlObj = new URL(url, window.location.origin);
            return urlObj.searchParams.get("page");
        } catch {
            return null;
        }
    }

    function getCurrentFilters() {
        return {
            start_date: document.getElementById("startDate").value,
            end_date: document.getElementById("endDate").value,
        };
    }

    // Per page selector
    document.getElementById("perPageSelect").addEventListener("change", () => {
        const { start_date, end_date } = getCurrentFilters();
        loadTransactions(1, start_date, end_date);
    });

    // Apply Filters button
    document.getElementById("applyFilters").addEventListener("click", () => {
        const { start_date, end_date } = getCurrentFilters();
        loadTransactions(1, start_date, end_date);
    });

    // Initial load
    loadTransactions();
});
