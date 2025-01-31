<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->code }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .invoice-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
            width: 210mm; /* A4 width */
            min-height: 297mm; /* A4 height */
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
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .invoice-details div {
            width: 48%;
        }
        .address-section {
            margin: 20px 0;
            font-size: 14px;
        }
        .address-section p {
            margin: 5px 0;
        }
        .address-section .address-line {
            display: inline-block;
            margin-right: 10px;
            width: 48%;
        }
        /* Table Styles */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
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
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            margin-top: 20px;
        }
        .footer-text {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            margin-top: 30px;
        }
        .invoice-summary {
            margin-top: 20px;
            font-size: 14px;
        }
        .invoice-summary div {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        /* Print-specific styles */
        @media print {
            body {
                font-family: 'Arial', sans-serif;
            }
            .invoice-container {
                padding: 30px;
                margin: auto;
            }
            .invoice-header {
                border-bottom: 2px solid #007bff;
            }
            .table {
                border-collapse: collapse;
                margin-top: 10px;
            }
            .table th, .table td {
                border: 1px solid #000;
                padding: 10px;
                text-align: center;
            }
            .table th {
                background: #007bff;
                color: #fff;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div>
                <h4 style="color: #007bff; margin: 0;">Aladdinne</h4>
                <p style="margin: 5px 0; color: #6c757d;">123 Street, Dhaka, Bangladesh</p>
                <p style="margin: 5px 0; color: #6c757d;">Email: info@aladdinne.com | Phone: +880123456789</p>
            </div>
            <img src="{{ asset('logo.jpg') }}" alt="Company Logo" class="company-logo">
        </div>
        <h2 class="invoice-title">Invoice</h2>
        
        <div class="invoice-details">
            <div>
                <p><strong>Order ID:</strong> #{{ $order->code }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
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
               <strong>Mobile:</strong> {{ $order->orderAddress->mobile ?? 'N/A' }}</p>
            <p><strong>Street:</strong> {{ $order->orderAddress->street_address ?? 'N/A' }}, 
               <strong>Building:</strong> {{ $order->orderAddress->building_name ?? 'N/A' }}</p>
            <p><strong>Landmark:</strong> {{ $order->orderAddress->nearest_landmark ?? 'N/A' }}, 
               <strong>Type:</strong> {{ $order->orderAddress->type ?? 'N/A' }}</p>
            <p><strong></strong> {{ $order->orderAddress->country_name ?? 'N/A' }}, 
               <strong></strong> {{ $order->orderAddress->division_name ?? 'N/A' }}, 
               <strong></strong> {{ $order->orderAddress->district_name ?? 'N/A' }}, 
               <strong></strong> {{ $order->orderAddress->upazila_name ?? 'N/A' }}</p>
        </div>
        
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
                    <td colspan="2" style="text-align: right;"><strong>Discount:</strong></td>
                    <td colspan="2">{{ number_format($order->discount, 2) }} ৳</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;"><strong>Shipping Charge:</strong></td>
                    <td colspan="2">{{ number_format($order->shipping_charge, 2) }} ৳</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right;"><strong> Payable:</strong></td>
                    <td colspan="2"><strong>{{ number_format($order->payable_amount, 2) }} ৳</strong></td>
                </tr>
            </tfoot>
        </table>  
        
        <p class="footer-text">Thank you for your purchase! If you have any questions, contact us at support@aladdinne.com</p>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
