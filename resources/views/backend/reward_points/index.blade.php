@extends('layouts.backend_app')

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center p-3 rounded" style="background-color: #e4ebea;">
            <h4 class="mb-0">Reward Point Rules Management</h4>
            <button
                class="btn btn-success btn-sm d-flex align-items-center"
                data-toggle="modal"
                data-target="#createRewardRuleModal">
                <i class="fas fa-plus-circle me-1"></i> New
            </button>
        </div>

        <!-- Rules Table -->
        <div class="table-responsive mt-3">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Event</th>
                        <th>Points</th>
                        <th>Multiplier (Tier)</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Rows -->
                    <tr>
                        <td>1</td>
                        <td>Registration</td>
                        <td>100</td>
                        <td>1x</td>
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
                        <td>Order</td>
                        <td>1 per ৳1</td>
                        <td>1.2x</td>
                        <td class="text-end">
                            <button class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </td>
                    </tr>
                    <!-- Loop your real data here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Reward Rule Modal -->
<div class="modal fade" id="createRewardRuleModal" tabindex="-1" aria-labelledby="createRewardRuleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h5 class="modal-title" id="createRewardRuleLabel">Add New Reward Rule</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="eventName" class="form-label">Event Name</label>
                        <input type="text" id="eventName" class="form-control" placeholder="e.g., Registration">
                    </div>
                    <div class="mb-3">
                        <label for="points" class="form-label">Points</label>
                        <input type="text" id="points" class="form-control" placeholder="e.g., 100 or 1 per ৳1">
                    </div>
                    <div class="mb-3">
                        <label for="multiplier" class="form-label">Multiplier (Optional)</label>
                        <input type="text" id="multiplier" class="form-control" placeholder="e.g., 1.2x">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Rule</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection