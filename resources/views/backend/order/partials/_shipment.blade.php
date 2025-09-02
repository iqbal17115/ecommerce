<div id="shipment-section">
    @if($shipment = $order->courierShipment)
        <div class="row">
            <div class="col-md-4">
                <h5>Carrier & Delivery</h5>
                <p>{{ ucfirst($shipment->courier_name) }}</p>
                <p>{{ $order->shipping_method ?? '-' }}</p>
            </div>
            <div class="col-md-4">
                <h5>Tracking ID</h5>
                <p>{{ $shipment->tracking_code ?? '-' }}</p>
                <p>{{ $shipment->dispatched_at }}</p>
            </div>
            <div class="col-md-4">
                <h5>Estimate Delivery Date</h5>
                <p>{{ $shipment->dispatched_at }}</p>
            </div>
        </div>
    @else
        <p>No shipment information available.</p>
    @endif
</div>
