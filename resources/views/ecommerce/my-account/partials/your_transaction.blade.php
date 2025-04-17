<div class="tab-pane fade" id="your_transactions">
    <h2 style="font-size: 1.5rem; font-weight: 600; color: #343a40; margin-bottom: 1.5rem;">Your Transactions</h2>

    <!-- Table container -->
    <div id="transaction-list" style="border: 1px solid #dee2e6; border-radius: 0.375rem; padding: 1rem; background-color: #fff; box-shadow: 0 .125rem .25rem rgba(0,0,0,.075); overflow-x: auto;"></div>

    <!-- Pagination + Info + Per Page -->
    <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; margin-top: 1.5rem; padding: 0.75rem 1rem; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.5rem;">

        <!-- Per Page Select -->
        <div style="display: flex; align-items: center; font-size: 0.95rem; color: #212529;">
            <label for="perPageSelect" style="margin-right: 0.5rem; font-weight: 600;">Show</label>

            <select id="perPageSelect"
                style="
                padding: 0.4rem 0.75rem;
                font-size: 0.95rem;
                border: 1px solid #ced4da;
                border-radius: 0.375rem;
                background-color: #fff;
                color: #212529;
                outline: none;
                margin-right: 0.5rem;
                appearance: auto;
                cursor: pointer;
            ">
                <option value="25" selected>25</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select>

            <span style="font-weight: 600; font-size: 0.95rem;">entries</span>
        </div>

        <!-- Info -->
        <div id="totalItems" style="font-size: 0.95rem; color: #212529; font-weight: 00; margin-top: 0.5rem;"></div>
    </div>

    <!-- Pagination -->
    <nav style="margin-top: 0.75rem;">
        <ul class="pagination justify-content-center" id="pagination" style="margin-bottom: 0; gap: 5px;"></ul>
    </nav>
</div>