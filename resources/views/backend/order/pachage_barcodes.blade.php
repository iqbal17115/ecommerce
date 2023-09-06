<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Example</title>
    <style>
        /* Custom row class */
        .custom-row::after {
            content: "";
            display: table;
            clear: both;
        }

        /* Custom column classes for a flexible grid layout */
        .custom-col-1 {
            width: 8.33%;
            /* 1/12 */
            float: left;
        }

        .custom-col-2 {
            width: 16.66%;
            /* 2/12 */
            float: left;
        }

        .custom-col-3 {
            width: 25%;
            /* 3/12 */
            float: left;
        }

        .custom-col-4 {
            width: 33.33%;
            /* 4/12 */
            float: left;
        }

        .custom-col-5 {
            width: 41.66%;
            /* 5/12 */
            float: left;
        }

        .custom-col-6 {
            width: 50%;
            /* 6/12 */
            float: left;
        }

        .custom-col-7 {
            width: 58.33%;
            /* 7/12 */
            float: left;
        }

        .custom-col-8 {
            width: 66.66%;
            /* 8/12 */
            float: left;
        }

        .custom-col-9 {
            width: 75%;
            /* 9/12 */
            float: left;
        }

        .custom-col-10 {
            width: 83.33%;
            /* 10/12 */
            float: left;
        }

        .custom-col-11 {
            width: 91.66%;
            /* 11/12 */
            float: left;
        }

        .custom-col-12 {
            width: 100%;
            /* 12/12 (full-width) */
            float: left;
        }

        @media print {
            table {
                border-collapse: collapse;
            }

            table,
            tr,
            td {
                border: 2px solid black;
                /* Set the table row and cell borders for print */
            }
        }
    </style>
    <!-- Include Bootstrap CSS here -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <!-- Your custom row and column layout -->
    <div class="custom-row">
        @foreach ($barcodesData as $barcodeData)
            <div class="custom-col-7">
                <div class="address-container">
                    <div class="address-section">
                        <strong>Return To:</strong><br>
                        <strong>{{ $company_info?->name }}</strong><br>
                        <strong>{{ $company_info?->address }}</strong><br>
                        <div class="address-section" style="margin-top: 10px;">
                            <strong>Ship To:</strong><br>
                            <strong>{{ $order->Contact->first_name }}</strong><br>
                            <strong>{{ $order?->Contact?->address }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-col-5">
                <table>
                    <tbody>
                        <tr>
                            <td></td>
                            <td>COD</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Pkg {{ $barcodeData['box_no'] }} of {{ count($order->orderProductBox) }}</td>
                        </tr>
                        <tr>
                            <td rowspan="2">{{ $order->orderProductBox->first()->weight }}{{$order->orderProductBox->first()->weight_unit}}</td>
                        </tr>
                        <tr>
                            <td rowspan="2">{{ $order->orderProductBox->first()->length }}{{$order->orderProductBox->first()->length_unit}} * {{ $order->orderProductBox->first()->height }}{{$order->orderProductBox->first()->height_unit}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="custom-col-12">
                <h3 class="text-center">
                    EAD: {{ $order->orderProductBox->first()->pickup_day }}
                </h3>
                <hr style="padding-top: 2px;">
                <div class="custom-row">
                    <div class="custom-col-6">
                        <center>
                            <img class="barcode-image"
                                src="data:image/png;base64,{{ base64_encode($barcodeData['image']) }}" alt="Barcode">
                        </center>
                        <div class="order_id" style="font-size: 14px;"><center>Tracking ID: {{ $barcodeData['content'] }}</center></div>
                    </div>
                    <div class="custom-col-6">
                        <center>
                            <img class="barcode-image"
                                src="data:image/png;base64,{{ base64_encode($barcodeOrderImage) }}" alt="Barcode">
                        </center>
                        <div class="order_id" style="font-size: 14px;">
                            <center>Order ID: {{ $order->code }}</center>
                        </div>
                    </div>
                </div>
                <hr style="padding-top: 2px;">
            </div>
            <br>
            <br>
            <br>
            <br>
        @endforeach


    </div>
    <!-- Include Bootstrap JavaScript and jQuery (if needed) here -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
    </script>

    <!-- JavaScript to trigger the print dialog -->
    <script>
        // Make sure the content is ready and Bootstrap styles are applied
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
