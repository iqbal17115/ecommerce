<div id="courier-status-panel" style="border-left: 4px solid #0d6efd; background-color: #f8f9fa; padding: 12px; border-radius: 0.5rem; display: flex; align-items: center; gap: 30px; flex-wrap: wrap;">
    <div>
        @php
        function getCourierBadgeColor($status) {
            return match($status) {
                'delivered' => '#28a745',           // green
                'partial_delivered' => '#ffc107',   // yellow
                'in_review' => '#0dcaf0',           // blue
                'cancelled' => '#dc3545',           // red
                'hold', 'pending' => '#6c757d',     // gray
                default => '#6c757d',
            };
        }
        @endphp

        <strong style="margin-right: 4px;">Status:</strong>
        <span id="courier-status" style="padding: 4px 8px; border-radius: 0.25rem; background-color: {{ getCourierBadgeColor($order->courierShipment?->status) }}; color: #fff;">
                {{ $order->courierShipment?->status ? ucwords(str_replace('_', ' ', $order->courierShipment->status)) : 'N/A' }}
        </span>
    </div>

    <div>
        <strong style="margin-right: 4px;">Last Synced:</strong>
        <span id="last-synced">
            {{ $order->courierShipment?->last_synced_at ?? 'N/A' }}
        </span>
    </div>

    <div>
        <strong style="margin-right: 4px;">Delivered At:</strong>
        <span id="delivered-at">
            {{ $order->courierShipment?->delivered_at?->format('d M Y, H:i') ?? 'N/A' }}
        </span>
    </div>
</div>
