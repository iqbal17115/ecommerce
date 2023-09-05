<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generated Barcodes</title>
    <style>
        body {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            background-color: #f0f0f0;
            padding: 10px;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .barcode-card {
            /* width: 200px; */
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            margin: 10px;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .barcode-image {
            /* width: 100px; */
            /* height: 60px; */
            margin-bottom: 10px;
        }

        .barcode-content {
            font-size: 14px;
        }

        /* CSS Styles */
        .address-container {
            display: grid;
            grid-template-columns: 70% 30%;
            /* 70% for addresses, 30% for box_no */
            gap: 10px;
            /* Add some spacing between sections */
        }

        .address-section {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .box-no-section {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            background-color: #f9f9f9;
        }

        .address-section strong,
        .box-no-section strong {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .address-section br,
        .box-no-section br {
            display: none;
        }

        .address-section p,
        .box-no-section p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    @foreach ($barcodesData as $barcodeData)
        <div>
            <div class="barcode-card">
                <div class="address-container">
                    <div class="address-section">
                        <strong>Billed To:</strong><br>
                        {{ $order->Contact->first_name }}<br>
                        {{ $order?->Contact?->address }}<br>
                    </div>
                    <div class="box-no-section">
                        {{ $barcodeData['pickup_day'] }}<br>
                        <br>
                        {{ $barcodeData['pickup_time'] }}<br>
                    </div>
                    <div class="address-section">
                        <strong>Shipped To:</strong><br>
                        {{ $order?->Contact?->District?->name }}, {{ $order?->Contact?->Division?->name }}<br>
                        {{ $order?->Contact?->Union?->name }}, {{ $order?->Contact?->Union?->name }}<br>
                        {{ $order?->Contact?->shipping_address }}<br>
                    </div>
                    <div class="box-no-section">
                        <strong>{{ $order->code }}</strong><br>
                    </div>

                </div>
<br>
                <img class="barcode-image"
                    src="data:image/png;base64,{{ base64_encode($barcodeData['image']) }}" alt="Barcode">
                <div class="barcode-content">{{ $barcodeData['content'] }}</div>
            </div>
        </div>
    @endforeach

    <script>
        window.print();
    </script>
</body>

</html>
