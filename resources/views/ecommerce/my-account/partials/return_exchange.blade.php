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
                    <th style="padding: 12px; text-align: left;">Ordered On</th>
                    <th style="padding: 12px; text-align: left;">Delivered On</th>
                    <th style="padding: 12px; text-align: left;">Order Total</th>
                </tr>
            </thead>
            <tbody style="background-color: #ffffff;">
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
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body" style="font-family: Arial, sans-serif; font-size: 14px;">
                <!-- Step 1 -->
                <div id="step1" class="step" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 15px; margin-bottom: 20px;">
                    <div class="row">
                        <!-- Left Side: Product Selection Info -->
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label style="font-weight: 600; font-size: 1.1rem; color: #282828; display: block; margin-bottom: 0.5rem;">Select Products for Return:</label>
                                <div id="allProductsContainer" style="max-height: 300px; overflow-y: auto; border: 1px solid #e0e0e0; border-radius: 8px; padding: 15px; background-color: #f9f9f9;">
                                </div>
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
                            <input type="radio" name="returnAgreement" id="returnAgreement" class="form-check-input" required>
                            <span style="margin-left: 10px;">
                                I agree to return all items in original condition, with price tags or stickers intact, user manual, warranty cards, and original accessories in manufacturer's packaging.
                            </span>
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
                                            Refund to Aladdinne Account Balance
                                        </label>
                                    </div>

                                    <!-- Custom Radio Button 2 -->
                                    <div style="margin-bottom: 15px;">
                                        <input type="radio" id="refundToCard" name="refundMethod" value="card"
                                            style="width: 18px; height: 18px; margin-right: 10px; accent-color: #007bff;" />
                                        <label for="refundToCard" style="font-size: 14px; font-weight: 500; cursor: pointer; padding-left: 5px;">
                                            Refund to your Card
                                        </label>
                                    </div>

                                    <!-- Custom Radio Button 3 -->
                                    <div style="margin-bottom: 15px;">
                                        <input type="radio" id="refundToBank" name="refundMethod" value="bank"
                                            style="width: 18px; height: 18px; margin-right: 10px; accent-color: #007bff;" />
                                        <label for="refundToBank" style="font-size: 14px; font-weight: 500; cursor: pointer; padding-left: 5px;">
                                            Refund to your Bank
                                        </label>
                                    </div>

                                    <!-- Custom Radio Button 4 -->
                                    <div style="margin-bottom: 15px;">
                                        <input type="radio" id="refundToBkash" name="refundMethod" value="bKash"
                                            style="width: 18px; height: 18px; margin-right: 10px; accent-color: #007bff;" />
                                        <label for="refundToBkash" style="font-size: 14px; font-weight: 500; cursor: pointer; padding-left: 5px;">
                                            Refund to your Bkash
                                        </label>
                                    </div>

                                    <!-- Custom Radio Button 5 -->
                                    <div style="margin-bottom: 15px;">
                                        <input type="radio" id="refundToNagad" name="refundMethod" value="nagad"
                                            style="width: 18px; height: 18px; margin-right: 10px; accent-color: #007bff;" />
                                        <label for="refundToBkash" style="font-size: 14px; font-weight: 500; cursor: pointer; padding-left: 5px;">
                                            Refund to your Nagad
                                        </label>
                                    </div>

                                    <!-- Custom Radio Button 6 -->
                                    <div style="margin-bottom: 15px;">
                                        <input type="radio" id="refundToRocket" name="refundMethod" value="rocket"
                                            style="width: 18px; height: 18px; margin-right: 10px; accent-color: #007bff;" />
                                        <label for="refundToRocket" style="font-size: 14px; font-weight: 500; cursor: pointer; padding-left: 5px;">
                                            Refund to your Rocket
                                        </label>
                                    </div>

                                    <!-- Custom Radio Button 7 -->
                                    <div style="margin-bottom: 15px;">
                                        <input type="radio" id="refundToUpay" name="refundMethod" value="upay"
                                            style="width: 18px; height: 18px; margin-right: 10px; accent-color: #007bff;" />
                                        <label for="refundToUpay" style="font-size: 14px; font-weight: 500; cursor: pointer; padding-left: 5px;">
                                            Refund to your Upay
                                        </label>
                                    </div>

                                    <!-- Custom Radio Button 8 -->
                                    <div style="margin-bottom: 15px;">
                                        <input type="radio" id="refundToCash" name="refundMethod" value="cash"
                                            style="width: 18px; height: 18px; margin-right: 10px; accent-color: #007bff;" />
                                        <label for="refundToUpay" style="font-size: 14px; font-weight: 500; cursor: pointer; padding-left: 5px;">
                                            Refund to your Cash
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
                        <div class="col-md-12">
                             <!-- Submit Button -->
                             <button id="submitReturn" class="btn btn-success" style="padding: 5px 10px; font-size: 10px; border-radius: 5px; margin-top: 10px; float: right;">Submit Return</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>