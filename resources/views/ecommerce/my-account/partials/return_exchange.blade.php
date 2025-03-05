<style>
    /* Mobile Responsive */
    @media (max-width: 768px) {

        .table th,
        .table td {
            padding: 12px 8px;
            /* Reduce padding */
            font-size: 14px;
            /* Adjust font size */
        }

        .table th {
            white-space: nowrap;
            /* Prevent header wrap */
        }

        .table td {
            white-space: nowrap;
            /* Prevent content wrap */
        }

        /* Make table scrollable */
        .table-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            /* Smooth scrolling on iOS */
        }
    }

    #returnSummary {
        font-size: 14px;
        margin-top: 20px;
        padding: 0;
        list-style: none;
    }

    #returnSummary li {
        padding: 8px 12px;
        margin-bottom: 8px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
    }

    #returnSummary li:first-child {
        margin-top: 0;
    }

    #returnSummary li:last-child {
        margin-bottom: 0;
    }

    #returnSummary li:hover {
        background-color: #e9ecef;
        cursor: pointer;
    }
</style>
<div class="tab-pane fade" id="return_exchange">
    <h2 class="tab-title">Return & Exchange</h2>

    <!-- Order List Table -->
    <div style="max-width: 100%; overflow-x: auto; font-family: Arial, sans-serif;">
        <table style="width: 100%; border-collapse: collapse; font-size: 16px;">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th style="padding: 12px; text-align: left;">Order ID</th>
                    <th style="padding: 12px; text-align: left;">Date</th>
                    <th style="padding: 12px; text-align: left;">Order Total</th>
                </tr>
            </thead>
            <tbody style="background-color: #ffffff;">
                <!-- Order Information -->
                <tr>
                    <td style="padding: 12px; font-weight: bold;">#OC692633</td>
                    <td style="padding: 12px;">
                        Order On 29 Aug 2023 <br>
                        Delivered On01 Sep 2023
                    </td>
                    <td style="padding: 12px; color: #28a745; font-weight: bold;">৳ 13844</td>
                </tr>

                <!-- Order Details -->
                <tr>
                    <td colspan="4" style="padding: 0;">
                        <div style="padding: 12px;">
                            <!-- Product 1 -->
                            <div style="display: flex; align-items: center; gap: 16px; padding: 12px 0; border-bottom: 1px solid #ddd;">
                                <img src="/images/product1.jpg" alt="Product Image 1" width="80" style="border-radius: 8px;">
                                <div>
                                    <p style="margin: 0; font-weight: bold; font-size: 16px;">Product Name 1</p>
                                    <p style="margin: 4px 0;">Quantity: <strong>2</strong></p>
                                    <p style="margin: 4px 0; color: #28a745;">Subtotal: ৳ 5000</p>
                                    <p style="margin: 4px 0; color: #6c757d;">Return & Exchange: Eligible through 08 Sep 2023</p>
                                </div>
                            </div>

                            <!-- Product 2 -->
                            <div style="display: flex; align-items: center; gap: 16px; padding: 12px 0;">
                                <img src="/images/product2.jpg" alt="Product Image 2" width="80" style="border-radius: 8px;">
                                <div>
                                    <p style="margin: 0; font-weight: bold; font-size: 16px;">Product Name 2</p>
                                    <p style="margin: 4px 0;">Quantity: <strong>1</strong></p>
                                    <p style="margin: 4px 0; color: #28a745;">Subtotal: ৳ 3844</p>
                                    <p style="margin: 4px 0; color: #6c757d;">Return & Exchange: Eligible through 08 Sep 2023</p>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Action Buttons -->
                <tr>
                    <td colspan="4" style="text-align: center; padding-bottom: 26px;">
                        <button id="openReturnModal" style="background-color: #007bff; color: #fff; border: none; border-radius: 8px; padding: 4px 8px; margin: 4px; cursor: pointer;">Exchange & Return</button>
                        <button style="background-color: #6c757d; color: #fff; border: none; border-radius: 8px; padding: 4px 8px; margin: 4px; cursor: pointer;">Track Package</button>
                        <button style="background-color: #28a745; color: #fff; border: none; border-radius: 8px; padding: 4px 8px; margin: 4px; cursor: pointer;">View Invoice</button>
                        <button style="background-color: #17a2b8; color: #fff; border: none; border-radius: 8px; padding: 4px 8px; margin: 4px; cursor: pointer;">Write a Product Review</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Mobile Responsive -->
    <div style="@media (max-width: 768px) { overflow-x: auto; -webkit-overflow-scrolling: touch; }"></div>

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
                            <div class="table-responsive">
                                <table id="selectedProductsTable" class="table table-bordered" style="margin-top: 20px;">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productTableBody">
                                        <!-- Products will be added dynamically here -->
                                    </tbody>
                                </table>
                            </div>
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

                    <!-- Image Upload for Defective Product -->
                    <div id="imageUploadContainer" class="mb-3 p-3 shadow-sm bg-white rounded">
                        <label for="defectiveImage" class="form-label" style="font-weight: bold; font-size: 16px; color: #333;">Upload Defective Product Image:</label>
                        <input type="file" id="defectiveImage" class="form-control" accept="image/*">
                        <small class="text-muted">Supported formats: JPG, PNG, JPEG (Max: 5MB)</small>
                    </div>

                    <!-- Terms & Conditions Agreement -->
                    <div class="mb-3 p-3 shadow-sm bg-white rounded d-flex justify-content-center align-items-center">
                        <label class="form-check-label d-flex align-items-center" style="font-weight: bold; font-size: 16px; color: #333;">
                            <input type="radio" name="returnAgreement" id="returnAgreement" class="form-check-input me-3" required>
                            I agree to return all items in original condition, with price tags or stickers intact, user manual, warranty cards, and original accessories in manufacturer's packaging.
                        </label>
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
                            <p><strong style="font-weight: bold; font-size: 16px;">Item you are returning:</strong></p>
                            <div id="returnedProductsImages" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px; background-color: #fff;">
                                <!-- Product images will be displayed here -->
                            </div>
                            <div style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 5px; background-color: #ffffff; text-align: center;">
                                Return by 10 Jan 2025
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
                            <ul id="returnSummary" class="list-group" style="font-size: 14px;">
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