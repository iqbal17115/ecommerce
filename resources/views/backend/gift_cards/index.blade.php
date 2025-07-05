@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background-color: #e4ebea;">
            <h4 class="mb-0">Gift Card Management</h4>
            <button
                class="btn btn-success btn-sm d-flex align-items-center"
                data-toggle="modal"
                data-target="#createGiftCardModal">
                <i class="fas fa-plus-circle me-1"></i> New
            </button>
        </div>

        <!-- Gift Cards Table -->
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Initial Amount</th>
                        <th>Balance</th>
                        <th>Status</th>
                        <th>Recipient Email</th>
                        <th>Expiration</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><code>GC-1234-5678</code></td>
                        <td>৳500</td>
                        <td>৳200</td>
                        <td><span class="badge bg-success">Active</span></td>
                        <td>customer@example.com</td>
                        <td>2026-07-05</td>
                        <td class="text-end">
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><code>GC-9876-5432</code></td>
                        <td>৳300</td>
                        <td>৳0</td>
                        <td><span class="badge bg-secondary">Used</span></td>
                        <td>another@example.com</td>
                        <td>2025-12-31</td>
                        <td class="text-end">
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </td>
                    </tr>
                    <!-- End Example -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Gift Card Modal -->
<div class="modal fade" id="createGiftCardModal" tabindex="-1" aria-labelledby="createGiftCardLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="createGiftCardLabel">Create Gift Card</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="number" class="form-control" placeholder="e.g., 500" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Recipient Email</label>
                        <input type="email" class="form-control" placeholder="customer@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sender Name</label>
                        <input type="text" class="form-control" placeholder="Your Store Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" rows="2" placeholder="Optional message to recipient"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Expiration Date</label>
                        <input type="date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Create Gift Card</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection