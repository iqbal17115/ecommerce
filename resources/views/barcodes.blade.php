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
    </style>
</head>
<body>
    @foreach ($barcodesData as $barcodeData)
        <div class="barcode-card">
            <img class="barcode-image" src="data:image/png;base64,{{ base64_encode($barcodeData['image']) }}" alt="Barcode">
            <div class="barcode-content">{{ $barcodeData['content'] }}</div>
        </div>
    @endforeach

    <script>
            window.print();
    </script>
</body>
</html>
