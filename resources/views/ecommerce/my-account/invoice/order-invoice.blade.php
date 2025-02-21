<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->code }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f1f3f4;
            margin: 0;
            padding: 0;
            overflow-x: auto;
        }

        .invoice-container {
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            width: 93%;
            max-width: 850px;
            margin: 50px auto;
            overflow-x: auto;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #f4631b;
            padding-bottom: 20px;
        }

        .company-logo {
            max-height: 80px;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #f4631b;
            text-align: center;
            margin-top: 0;
        }

        .invoice-subtitle {
            text-align: center;
            font-size: 18px;
            color: #6c757d;
            margin: 0;
        }

        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            font-size: 14px;
        }

        .invoice-details div {
            width: 48%;
        }

        .address-section p {
            margin: 5px 0;
            font-size: 14px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .table th,
        .table td {
            border: 2px solid #dee2e6;
            padding: 12px;
            text-align: center;
            font-size: 14px;
        }

        .table th {
            background-color: #f4631b;
            color: white;
            font-weight: bold;
        }

        .table tfoot td {
            font-weight: bold;
            background-color: #e9ecef;
        }

        .total-section {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #f4631b;
            margin-top: 20px;
        }

        .footer-text {
            font-size: 12px;
            color: #6c757d;
            text-align: center;
            margin-top: 30px;
        }

        .footer-text a {
            color: #f4631b;
            text-decoration: none;
        }

        @media print {
            body {
                font-family: 'Arial', sans-serif;
            }

            .invoice-container {
                padding: 40px;
            }

            .invoice-header {
                border-bottom: 3px solid #f4631b;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div>
                <h4 style="color: #f4631b; margin: 0;">Aladdinne</h4>
                <p style="margin: 5px 0; color: #6c757d;">123 Street, Dhaka, Bangladesh</p>
                <p style="margin: 5px 0; color: #6c757d;">Email: info@aladdinne.com | Phone: +880123456789</p>
            </div>
            <img src="{{ asset('logo.jpg') }}" alt="Company Logo" class="company-logo">
        </div>
        <div class="invoice-details">
            <div>
                <p><strong>Order ID:</strong> #{{ $order->code }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
            </div>
            <div style="text-align: right;">
                <p><strong>Customer Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $order->user->mobile ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
            </div>
        </div>

        <div class="address-section">
            <p><strong>Shipping Address:</strong></p>
            <p><strong>Name:</strong> {{ $order->orderAddress->name ?? 'N/A' }},
                <strong>Mobile:</strong> {{ $order->orderAddress->mobile ?? 'N/A' }}
            </p>
            <p><strong>Street:</strong> {{ $order->orderAddress->street_address ?? 'N/A' }},
                <strong>Building:</strong> {{ $order->orderAddress->building_name ?? 'N/A' }}
            </p>
        </div>

        <!-- Added Estimated Delivery Date or Delivered Date Section -->
        @if($order->status == 'completed')
        <p><strong>Delivered Date:</strong> {{ \Carbon\Carbon::parse($order->updated_at)->format('d M, Y') }}</p>
        @else
        <p><strong>Estimated Delivery Date:</strong> {{ \Carbon\Carbon::parse($order->estimate_delivery_date)->format('d M, Y') }}</p>
        @endif


        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->OrderDetail as $detail)
                <tr>
                    <td>{{ $detail->product->name ?? 'N/A' }}</td>
                    <td>{{ number_format($detail->unit_price, 2) }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->unit_price * $detail->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="text-align: right;">Discount:</td>
                    <td colspan="2">{{ number_format($order->discount, 2) }} ৳</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;">Shipping Charge:</td>
                    <td colspan="2">{{ number_format($order->shipping_charge, 2) }} ৳</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right; font-weight: bold;">Payable:</td>
                    <td colspan="2" style="font-weight: bold;">{{ number_format($order->payable_amount, 2) }} ৳</td>
                </tr>
            </tfoot>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>Payment Date</th>
                    <th>Method</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order?->orderPayment?->orderPaymentDetails as $payment)
                <tr>
                    <td>{{ $payment->created_at->format('d M, Y') }}</td>
                    <td>{{ $payment->payment_method ?? 'N/A' }}</td>
                    <td>{{ number_format($payment->amount, 2) }} ৳</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="footer-text">If you have any questions, contact us at <a href="mailto:support@aladdinne.com">support@aladdinne.com</a></p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>