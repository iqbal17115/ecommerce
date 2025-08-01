<div class="checkout-box shadow-sm p-4 rounded bg-white">
    <h5 class="mb-4 font-weight-bold">Shipping Details</h5>
    
    <form id="checkoutForm">
        <div class="form-group">
            <label for="name">Name / নাম <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Type Name / নাম লিখুন">
        </div>

        <div class="form-group">
            <label for="phone">Number / ফোন নম্বর <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Type Number / ফোন নম্বর লিখুন">
        </div>

        <div class="form-group">
            <label for="division">Division / বিভাগ <span class="text-danger">*</span></label>
            <select class="form-control" id="division" name="division">
                <option value="">Select Division</option>
                <!-- Options will be loaded dynamically or manually -->
            </select>
        </div>

        <div class="form-group">
            <label for="district">District / জেলা <span class="text-danger">*</span></label>
            <select class="form-control" id="district" name="district">
                <option value="">Select District</option>
                <!-- Options will be loaded dynamically or manually -->
            </select>
        </div>

        <div class="form-group">
            <label for="thana">Thana / থানা <span class="text-danger">*</span></label>
            <select class="form-control" id="thana" name="thana">
                <option value="">Select Thana</option>
            </select>
        </div>

        <div class="form-group">
            <label for="address">Full Address / সম্পূর্ণ ঠিকানা <span class="text-danger">*</span></label>
            <textarea class="form-control" id="address" name="address" rows="3" placeholder="এলাকা, থানা, জেলা"></textarea>
        </div>
    </form>
</div>
