<div class="tab-pane fade" id="return_exchange">
    <h2 class="tab-title">Return & Exchange</h2>

    <!-- Order List Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Ordered On</th>
                <th>Delivered On</th>
                <th>Order Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#OC692633382</td>
                <td>29 Aug 2023 12:10 PM</td>
                <td>01 Sep 2023 11:29 AM</td>
                <td>Taka 13844</td>
                <td>
                    <button class="btn btn-primary" id="openReturnModal">Exchange & Return</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal to open the return exchange form -->
<div class="modal" tabindex="-1" id="returnExchangeModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa; padding: 15px 20px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <h5 class="modal-title" style="font-size: 24px; font-weight: 600;">Return Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-family: Arial, sans-serif; font-size: 14px;">
                <!-- Step 1 -->
                <div id="step1" class="step" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px; margin-bottom: 20px;">
                    <div class="row">
                        <!-- Left Side: Product Selection Info -->
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="productSelect" class="form-label" style="font-weight: bold; font-size: 16px; color: #333;">Choose a product:</label>
                                <select id="productSelect" class="form-select" style="padding: 10px; font-size: 14px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                                    <option value="" selected disabled>Select a product</option>
                                    <option value="1" data-name="Product 1" data-image="product1.jpg" data-price="100" data-seller="Seller 1">Product 1</option>
                                    <option value="2" data-name="Product 2" data-image="product2.jpg" data-price="150" data-seller="Seller 2">Product 2</option>
                                    <option value="3" data-name="Product 3" data-image="product3.jpg" data-price="200" data-seller="Seller 3">Product 3</option>
                                </select>
                            </div>
                            <table id="selectedProductsTable" style="width: 100%; margin-top: 20px; border-collapse: collapse;">
                                <thead style="background-color: #f0f0f0;">
                                    <tr>
                                        <th style="padding: 8px; text-align: left;">Image</th>
                                        <th style="padding: 8px; text-align: left;">Product</th>
                                        <th style="padding: 8px; text-align: left;">Price</th>
                                        <th style="padding: 8px; text-align: left;">Quantity</th>
                                        <th style="padding: 8px; text-align: left;">Subtotal</th>
                                        <th style="padding: 8px; text-align: left;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="productTableBody">
                                    <!-- Products will be added dynamically here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Right Side: Return Reason & Comment -->
                        <div class="col-md-4">
                            <div class="mb-3" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px; background-color: #fff;">
                                <label for="returnReason" class="form-label" style="font-weight: bold; font-size: 16px; color: #333;">Return Reason:</label>
                                <select id="returnReasonSelect" class="form-select" style="padding: 10px; font-size: 14px; border-radius: 5px; border: 1px solid #ddd; width: 100%;">
                                    <option value="" selected disabled>Select reason</option>
                                    <option value="defective">Defective Product</option>
                                    <option value="wrong_item">Wrong Item Delivered</option>
                                    <option value="no_longer_needed">No Longer Needed</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px; background-color: #fff;">
                                <label for="comment" class="form-label" style="font-weight: bold; font-size: 16px; color: #333;">Additional Comment:</label>
                                <textarea id="comment" class="form-control" rows="4" placeholder="Please provide any additional comments" style="padding: 10px; font-size: 14px; border-radius: 5px; border: 1px solid #ddd; width: 100%;"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Continue Button -->
                    <button id="step1Continue" class="btn btn-primary" style="padding: 10px 20px; font-size: 16px; border-radius: 5px;">Continue</button>
                </div>

                <!-- Step 2 -->
                <div id="step2" class="step" style="display: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px; margin-bottom: 20px;">
                    <div class="row">
                        <!-- Left Side: Return Reason & Refund Method -->
                        <div class="col-md-8">
                            <p><strong style="font-weight: bold; font-size: 16px;">Return Reason:</strong>
                                <span id="selectedReturnReason" style="font-size: 16px;"></span>
                            </p>
                            <div class="mb-3" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px; background-color: #fff;">
                                <label class="form-label" style="font-weight: bold; font-size: 16px; color: #333;">Refund Method:</label>
                                <div style="font-size: 14px; margin-top: 10px;">

                                    <!-- Custom Radio Button 1 -->
                                    <div style="margin-bottom: 15px;">
                                        <input type="radio" id="refundToAladdin" name="refundMethod" value="aladdin"
                                            style="width: 18px; height: 18px; margin-right: 10px; accent-color: #007bff;" />
                                        <label for="refundToAladdin" style="font-size: 14px; font-weight: 500; cursor: pointer; padding-left: 5px;">
                                            Refund to Aladdin Account Balance
                                        </label>
                                    </div>

                                    <!-- Custom Radio Button 2 -->
                                    <div style="margin-bottom: 15px;">
                                        <input type="radio" id="refundToCard" name="refundMethod" value="card"
                                            style="width: 18px; height: 18px; margin-right: 10px; accent-color: #007bff;" />
                                        <label for="refundToCard" style="font-size: 14px; font-weight: 500; cursor: pointer; padding-left: 5px;">
                                            Refund to your Card ending 3323
                                        </label>
                                    </div>

                                    <!-- Custom Radio Button 3 -->
                                    <div>
                                        <input type="radio" id="refundToBank" name="refundMethod" value="bank"
                                            style="width: 18px; height: 18px; margin-right: 10px; accent-color: #007bff;" />
                                        <label for="refundToBank" style="font-size: 14px; font-weight: 500; cursor: pointer; padding-left: 5px;">
                                            Refund to your Bank
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Product Images -->
                        <div class="col-md-4">
                            <p><strong style="font-weight: bold; font-size: 16px;">Returned Product Images:</strong></p>
                            <div id="returnedProductsImages" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px; background-color: #fff;">
                                <!-- Product images will be displayed here -->
                            </div>
                        </div>
                    </div>

                    <!-- Continue Button -->
                    <button id="step2Continue" class="btn btn-primary" style="padding: 10px 20px; font-size: 16px; border-radius: 5px;">Continue</button>
                </div>

                <!-- Step 3 -->
                <div id="step3" class="step" style="display: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px; margin-bottom: 20px;">
                    <!-- Left Side: Return Summary -->
                    <div class="row">
                        <div class="col-md-8">
                            <p style="font-weight: bold; font-size: 16px;">Return Summary</p>
                            <ul id="returnSummary" style="font-size: 14px;">
                                <!-- Summary will be dynamically populated here -->
                            </ul>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button id="submitReturn" class="btn btn-success" style="padding: 10px 20px; font-size: 16px; border-radius: 5px;">Submit Return</button>
                </div>
            </div>
        </div>
    </div>
</div>
