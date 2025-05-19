<div class="checkout-address-container">
    <div class="d-flex flex-wrap justify-content-between align-items-start row">

        <!-- Actions as Cards -->
        <div class="address-action-cards d-flex flex-wrap col-md-4">
            <div class="row" style="width: 100%">
                <!-- Add Address -->
                <div class="action-card col-md-6" onclick="openAddAddressModal()">
                    <i class="fas fa-plus fa-lg mb-2"></i>
                    <span>Add Address</span>
                </div>
           
                <!-- Manage Addresses -->
                <div class="action-card col-md-6" onclick="openSidebar()">
                    <i class="fas fa-cog fa-lg mb-2"></i>
                    <span>Manage</span>
                </div>
            </div>
        </div>

        <!-- Default Address -->
        <div id="defaultAddressBox" class="default-address-card col-md-8">
            <!-- Filled by JS -->
        </div>

    </div>
</div>