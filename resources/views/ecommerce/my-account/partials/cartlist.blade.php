<div class="tab-pane fade" id="my-account-cartlist">
    <h2 class="tab-title" style="background-color: #fff;">Cartlist</h2>
    <br>
    <div id="my-account-cartitem">
        <p>Loading cart data...</p>
    </div>

    <!-- Share Modal -->
    <div id="shareModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
        background:rgba(0,0,0,0.5); z-index:1000; justify-content:center; align-items:center;">
        <div style="background:#fff; padding:20px 30px; border-radius:10px; position:relative; max-width:400px; text-align:center;">
            <span id="closeShareModal" style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:20px;">&times;</span>
            <h4 style="margin-bottom:15px;">Share this product</h4>
            <div id="shareLinks" style="display:flex; justify-content:center; gap:20px;">
                <!-- Dynamically generated share icons -->
            </div>
        </div>
    </div>
</div>
