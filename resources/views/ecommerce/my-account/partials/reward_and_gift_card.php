<div class="tab-pane fade" id="reward-gift-card">
    <div class="row">
        <!-- Reward Points Card -->
        <div class="col-md-6 card mb-4 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-star-fill fs-1 text-warning"></i>
                </div>
                <div>
                    <h5 class="card-title mb-1">Your Reward Points</h5>
                    <p class="mb-2">
                        <strong class="text-success fs-4" id="reward-total-points">0 Points</strong>
                    </p>
                    <small class="text-muted" id="reward-summary">Lifetime Earned: 0 | Used: 0</small><br>
                    <button
                        class="btn btn-primary btn-sm mt-2"
                        data-toggle="modal"
                        data-target="#usePointsModal">
                        Use Points
                    </button>
                </div>
            </div>
        </div>

        <!-- Gift Card Card -->
        <div class="col-md-6 card mb-4 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-credit-card fs-1 text-primary"></i>
                </div>
                <div>
                    <h5 class="card-title mb-1">Your Gift Cards</h5>
                    <p class="mb-2">
                        <strong class="fs-5">৳150.00</strong>
                    </p>
                    <small class="text-muted">Last Used: June 15, 2025</small><br>
                    <button
                        class="btn btn-primary btn-sm mt-2"
                        data-toggle="modal"
                        data-target="#useGiftCardModal">
                        Add Gift Card
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction History -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Transaction History</h5>
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Type</th>
                            <th>Point</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody id="reward-transaction-body">

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div
        class="modal fade"
        id="useGiftCardModal"
        tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Gift Card</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Gift Card Code</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Enter your gift card code" />
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            Add Gift Card
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="usePointsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Use Reward Points</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Points to Use</label>
                            <input
                                type="number"
                                class="form-control"
                                placeholder="Enter points amount"
                                min="1"
                                max="1500" />
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            Use Points
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>