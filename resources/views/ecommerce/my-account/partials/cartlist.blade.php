<div class="tab-pane fade" id="my-account-cartlist">
    <h2 class="tab-title" style="background-color: #fff;">Cartlist</h2>
    <br>
    <div id="my-account-cartitem">
        <p>Loading cart data...</p>
    </div>

    <!-- Share Modal -->
    <div id="shareModal" style="
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1050;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
">
        <div style="
        background: #fff;
        padding: 25px 30px;
        border-radius: 12px;
        position: relative;
        width: 100%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    ">
            <!-- Close Button -->
            <span id="closeShareModal" style="
            position: absolute;
            top: 10px;
            right: 15px;
            cursor: pointer;
            font-size: 24px;
            font-weight: bold;
            color: #555;
        ">&times;</span>

            <h4 style="margin-bottom: 20px; font-size: 1.25em;">Share this product</h4>

            <!-- Share Links -->
            <div id="shareLinks" style="
            display: flex;
            justify-content: center;
            gap: 25px;
        ">
                <!-- Dynamically injected icons here -->
            </div>
        </div>
    </div>

</div>