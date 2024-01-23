<div class="tab-pane @if (isset($wishlist_status)) show active @endif fade" id="wishlist">
    <h2 class="tab-title">Wishlist</h2>
    <table class="table table-wishlist mb-0 shadow common_bg">
        <thead>
            <tr>
                <th class="thumbnail-col"></th>
                <th class="product-col">Product</th>
                <th class="price-col">Price</th>
                <th class="status-col">Stock Status</th>
                <th class="action-col">Actions</th>
            </tr>
        </thead>
        <tbody id="wishlist_table_body"></tbody>
    </table>
    <hr class="mt-0 mb-3 pb-2" />
</div>
