<div class="tab-pane fade show" id="your_transactions">
    <h2 class="tab-title">Your Transaction</h2>

    <div class="row">
        @forelse ($orderPayments as $payment)
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white" style="background-color: #f4631b;">
                    <h5 class="mb-0">Order #{{ $payment->order->code }}</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3 d-flex justify-content-between">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Total Price:</strong> <span class="text-primary">৳{{ number_format($payment->total_order_price, 2) }}</span></p>
                            <p class="mb-1"><strong>Discount:</strong> <span class="text-success">৳{{ number_format($payment->total_discount_amount, 2) }}</span></p>
                            <p class="mb-1"><strong>Shipping:</strong> <span class="text-warning">৳{{ number_format($payment->total_shipping_charge_amount, 2) }}</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Paid:</strong> <span class="text-success">৳{{ number_format($payment->amount_paid, 2) }}</span></p>
                            <p class="mb-1"><strong>Due:</strong> <span class="text-danger">৳{{ number_format($payment->due_amount, 2) }}</span></p>
                            <p class="mb-1">
                                <strong>Status:</strong>
                                <span class="badge bg-{{ $payment->payment_status == 'paid' ? 'success' : 'danger' }}">
                                    {{ ucfirst($payment->payment_status) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Table Wrapper for Responsiveness -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Date</th>
                                    <th>Payment Type</th>
                                    <th>Method</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalAmount = 0; // Variable to calculate total amount for the order
                                @endphp
                                @foreach ($payment->orderPaymentDetails as $detail)
                                <tr>
                                    <td>{{ $detail->date }}</td>
                                    <td>{{ ucfirst($detail->payment_type) }}</td>
                                    <td>{{ ucfirst($detail->payment_method) }}</td>
                                    <td><span class="fw-bold text-primary">৳{{ number_format($detail->amount, 2) }}</span></td>
                                    <td>
                                        <span class="badge bg-{{ $detail->is_successful == 1 ? 'success' : 'danger' }}">
                                            {{ $detail->is_successful == 1 ? 'Successful' : 'Failed' }}
                                        </span>
                                    </td>
                                </tr>
                                @php
                                    $totalAmount += $detail->amount; // Add detail amount to total
                                @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                    <td class="fw-bold text-primary">৳{{ number_format($totalAmount, 2) }}</td>
                                    <td></td> <!-- Empty cell for consistency -->
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- End Table Wrapper -->
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <div class="alert alert-warning" role="alert">
                No transactions found.
            </div>
        </div>
        @endforelse
    </div>
</div>
