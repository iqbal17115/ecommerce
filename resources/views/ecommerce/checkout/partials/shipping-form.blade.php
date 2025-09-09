<div class="checkout-box shadow-sm p-4 rounded bg-white">
    <form id="checkoutForm">
        <div class="form-group">
            <label for="name">Name / নাম <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Type Name / নাম লিখুন">
        </div>

        <div class="form-group">
            <label for="mobile">Number / ফোন নম্বর <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Type Number / ফোন নম্বর লিখুন">
        </div>

        <div class="form-group">
            <label for="district">District / জেলা <span class="text-danger">*</span></label>
            <select class="form-control" id="district" name="district">
                <option value="">Select District</option>
                <!-- Options will be loaded dynamically or manually -->
            </select>
        </div>

        <div class="form-group">
            <label for="address">Full Address / সম্পূর্ণ ঠিকানা <span class="text-danger">*</span></label>
            <textarea class="form-control" id="addressInput" name="address" rows="3" placeholder="এলাকা, থানা, জেলা"></textarea>
        </div>
    </form>
</div>
