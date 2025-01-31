<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->code }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f8f9fa;
        }
        .invoice-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: auto;
        }
        .invoice-header {
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .company-logo {
            max-height: 70px;
        }
        .invoice-title {
            font-size: 26px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        .text-end { text-align: right; }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        .table th {
            background: #007bff;
            color: #fff;
            font-weight: bold;
        }
        .total-section {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            text-align: right;
            padding-top: 10px;
        }
        .footer-text {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="invoice-container">
            <div class="invoice-header">
                <div>
                    <h4 class="text-primary">Aladdinne</h4>
                    <p class="text-muted">123 Street, Dhaka, Bangladesh</p>
                    <p class="text-muted">Email: info@aladdinne.com | Phone: +880123456789</p>
                </div>
                <img src="{{ asset('logo.jpg') }}" alt="Company Logo" class="company-logo">
            </div>
            <h2 class="invoice-title">Invoice</h2>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Order ID:</strong> #{{ $order->code }}</p>
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <p><strong>Customer Name:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->mobile ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mt-3">
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
                            <td>{{ number_format($detail->unit_price, 2) }} BDT</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ number_format($detail->unit_price * $detail->quantity, 2) }} BDT</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Payment Method:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
                    <p><strong>Transaction ID:</strong> {{ $order->transaction_id ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 text-end total-section">
                    <p>Total: {{ number_format($order->payable_amount, 2) }} BDT</p>
                </div>
            </div>
            <p class="footer-text">Thank you for your purchase! If you have any questions, contact us at support@aladdinne.com</p>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>