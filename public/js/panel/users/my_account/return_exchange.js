document.addEventListener('DOMContentLoaded', function () {
    function getUserOrderList() {
        getDetails(
            "my-account/order-list", // Your API endpoint
            (data) => {
                displayOrderList(data.results.data);

            },
            (error) => {
                console.error("Error fetching order list:", error);
                // Handle the error (e.g., show an error message)
            }
        );
    }

    function displayOrderList(orderList) {
        const tableBody = document.querySelector("#return_exchange table tbody");
        tableBody.innerHTML = ""; // Clear existing table rows

        orderList.forEach(order => {
            const orderRow = document.createElement("tr");
            orderRow.innerHTML = `
                <td style="padding: 12px; font-weight: bold;">#${order.order_number}</td>
                <td style="padding: 12px;">${order.ordered_at}</td>
                <td style="padding: 12px;">${order.delivered_at || 'N/A'}</td>
                <td style="padding: 12px; color: #28a745; font-weight: bold;">৳ ${order.total_amount}</td>
            `;
            tableBody.appendChild(orderRow);

            // Order details row
            const detailsRow = document.createElement("tr");
            detailsRow.innerHTML = `
                <td colspan="4" style="padding: 0;">
                    <div style="padding: 12px;">
                        ${order.order_items.map(item => `
                            <div style="display: flex; align-items: center; gap: 16px; padding: 12px 0; border-bottom: 1px solid #ddd;">
                                <img src="${item.product.image}" alt="Image" width="80" style="border-radius: 8px;">
                                <div>
                                    <p style="margin: 0; font-weight: bold; font-size: 16px;">${item.product.name}</p>
                                    <p style="margin: 4px 0;">Quantity: <strong>${item.quantity}</strong></p>
                                    <p style="margin: 4px 0; color: #28a745;">Subtotal: ৳ ${item.subtotal}</p>
                                    <p style="margin: 4px 0; color: #6c757d;">Return & Exchange: Eligible through ${item.return_eligible_date || 'N/A'}</p>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </td>
            `;
            tableBody.appendChild(detailsRow);

            // Action buttons row
            const actionsRow = document.createElement("tr");
            actionsRow.innerHTML = `
                <td colspan="4" style="text-align: center; padding-bottom: 26px;">
                    <button id="openReturnModal" data-order-id="${order.id}" style="background-color: #007bff; color: #fff; border: none; border-radius: 8px; padding: 4px 8px; margin: 4px; cursor: pointer;">Exchange & Return</button>
                    <button style="background-color: #6c757d; color: #fff; border: none; border-radius: 8px; padding: 4px 8px; margin: 4px; cursor: pointer;">Track Package</button>
                    <button style="background-color: #28a745; color: #fff; border: none; border-radius: 8px; padding: 4px 8px; margin: 4px; cursor: pointer;">View Invoice</button>
                    <button style="background-color: #17a2b8; color: #fff; border: none; border-radius: 8px; padding: 4px 8px; margin: 4px; cursor: pointer;">Write a Product Review</button>
                </td>
            `;
            tableBody.appendChild(actionsRow);
        });
    }

    getUserOrderList();

    const returnModal = new bootstrap.Modal(document.getElementById('returnExchangeModal'));

    let selectedProducts = {};
    let productsToReturn = {};

    function populateProductCheckboxes(orderId) {
        
        getDetails(`my-account/order-details/${orderId}`, (data) => {

            selectedProducts = {};
            const orderItems = data.results.order_items;

            orderItems.forEach(item => {
                selectedProducts[item.id] = {
                    id: item.product.id,
                    name: item.product.name,
                    image: item.product.image,
                    price: item.unit_price,
                    quantity: item.quantity,
                };
            });

            const allProductsContainer = document.getElementById('allProductsContainer');
            allProductsContainer.innerHTML = '';

            Object.keys(selectedProducts).forEach(productId => {
                const product = selectedProducts[productId];
                const label = createProductLabel(productId, product);
                allProductsContainer.appendChild(label);
            });

            if (allProductsContainer.lastChild) {
                allProductsContainer.lastChild.style.borderBottom = 'none';
                allProductsContainer.lastChild.style.paddingBottom = '0';
            }
        }, (error) => {
            console.error("Error fetching order details:", error);
        });
    }

    function createProductLabel(productId, product) {
        const label = document.createElement('label');
        label.className = 'product-label'; // Added for potential CSS styling
        label.style.display = 'flex';
        label.style.alignItems = 'center';
        label.style.marginBottom = '12px';
        label.style.borderBottom = '1px solid #f0f0f0';
        label.style.paddingBottom = '10px';

        const checkboxContainer = document.createElement('div');
        checkboxContainer.className = 'checkbox-container';
        checkboxContainer.style.display = 'flex';
        checkboxContainer.style.alignItems = 'center';
        checkboxContainer.style.marginRight = '10px';

        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.value = productId;
        checkbox.dataset.productId = productId;
        checkbox.className = 'return-product-checkbox';
        checkbox.style.marginRight = '5px';
        checkbox.style.width = '18px';
        checkbox.style.height = '18px';
        checkbox.style.cursor = 'pointer';

        checkbox.addEventListener('change', function () {
            if (this.checked) {
                productsToReturn[productId] = selectedProducts[productId];
            } else {
                delete productsToReturn[productId];
            }
        });

        const image = document.createElement('img');
        image.src = product.image;
        image.className = 'product-image';
        image.style.width = '25px';
        image.style.height = '25px';
        image.style.marginRight = '10px';
        image.style.objectFit = 'cover';

        const quantityInput = document.createElement('input');
        quantityInput.type = 'number';
        quantityInput.value = 1;
        quantityInput.min = 1;
        quantityInput.className = `product-quantity product-quantity-${productId}`; 
        quantityInput.style.marginLeft = 'auto';
        quantityInput.style.width = '60px';
        quantityInput.style.padding = '6px 10px';
        quantityInput.style.border = '1px solid #ccc';
        quantityInput.style.borderRadius = '4px';
        quantityInput.style.fontSize = '0.9rem';

        quantityInput.addEventListener('focus', function () {
            this.style.outline = 'none';
            this.style.borderColor = '#007bff';
            this.style.boxShadow = '0 0 0 0.2rem rgba(0, 123, 255, 0.25)';
        });

        quantityInput.addEventListener('blur', function () {
            this.style.outline = '';
            this.style.borderColor = '#ccc';
            this.style.boxShadow = '';
        });

        const productNameText = document.createTextNode(product.name + ' - ৳' + product.price);

        checkboxContainer.appendChild(checkbox);
        label.appendChild(checkboxContainer);
        label.appendChild(image);
        label.appendChild(productNameText);
        label.appendChild(quantityInput);

        return label;
    }

    // Attach event listener to the table (or a parent container)
    document.querySelector("#return_exchange table").addEventListener('click', function (event) {
        if (event.target && event.target.id === 'openReturnModal') {
            const orderId = event.target.dataset.orderId; // Get order ID from data attribute
            populateProductCheckboxes(orderId);
            returnModal.show();
        }
    });

    // Update subtotal when quantity changes
    window.updateSubtotal = function (productId) {
        const product = selectedProducts[productId];
        const quantity = document.getElementById(`quantity-${productId}`).value;
        const subtotal = product.price * quantity;
        selectedProducts[productId].quantity = quantity;
        document.getElementById(`subtotal-${productId}`).textContent = subtotal;
    }

    // Handle product removal
    window.removeProduct = function (productId) {
        delete selectedProducts[productId];
        const row = document.getElementById(`product-${productId}`);
        if (row) row.remove();
        // Enable the product option again in the select dropdown
        const productSelect = document.getElementById('productSelect');
        const option = productSelect.querySelector(`option[value='${productId}']`);
        if (option) option.disabled = false;
    };

    // Step 1: Continue to Step 2
    document.getElementById('step1Continue').addEventListener('click', function () {
        const returnReason = document.getElementById('returnReasonSelect').value;
        const comment = document.getElementById('comment').value;
        if (Object.keys(productsToReturn).length === 0 || !returnReason || !comment) {
            alert('Please select a product, return reason, and provide a comment.');
            return;
        }

        selectedProducts = productsToReturn; // Update selectedProducts to only those being returned
        // Hide Step 1 and Show Step 2
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
        // Set the return reason on Step 2
        document.getElementById('selectedReturnReason').textContent = returnReason;
        // Show product images on Step 2
        const returnedProductsImages = document.getElementById('returnedProductsImages');
        returnedProductsImages.innerHTML = '';
        returnedProductsImages.style.display = 'flex';
        returnedProductsImages.style.flexWrap = 'wrap';
        returnedProductsImages.style.gap = '10px';
        for (const productId in selectedProducts) {
            const product = selectedProducts[productId];
            const imgElement = document.createElement('img');
            imgElement.src = product.image;
            imgElement.width = 50;
            imgElement.style.objectFit = 'cover';
            returnedProductsImages.appendChild(imgElement);
        }
    });

    // Step 2: Continue to Step 3
    document.getElementById('step2Continue').addEventListener('click', function () {
        // Check if selectedProducts exists and is an array or object
        if (!selectedProducts || Object.keys(selectedProducts).length === 0) {
            console.error("No products selected.");
            return;
        }

        const refundMethod = [];
        if (document.getElementById('refundToAladdin').checked) refundMethod.push('Aladdin Account Balance');
        if (document.getElementById('refundToCard').checked) refundMethod.push('Card ending 3323');
        if (document.getElementById('refundToBank').checked) refundMethod.push('Bank');
        if (document.getElementById('refundToBkash').checked) refundMethod.push('bKash');
        if (document.getElementById('refundToNagad').checked) refundMethod.push('Nagad');
        if (document.getElementById('refundToRocket').checked) refundMethod.push('Rocket');
        if (document.getElementById('refundToUpay').checked) refundMethod.push('Upay');
        if (document.getElementById('refundToCash').checked) refundMethod.push('Cash');

        // Calculate refund amount based on selected products
        const refundAmount = Object.entries(selectedProducts).reduce((sum, [productId, product]) => {
            const quantityInput = document.querySelector(`.product-quantity-${productId}`);
            const quantity = quantityInput ? parseInt(quantityInput.value, 10) : 0; 
            const price = product.price || 0;
            return sum + (quantity * price);
        }, 0).toFixed(2);

        // Function to create a list item for summary
        function createSummaryItem(label, value) {
            const listItem = document.createElement('li');
            listItem.textContent = `${label} ${value}`;
            return listItem;
        }

        // Clear previous summary items before appending new ones
        const returnSummary = document.getElementById('returnSummary');
        returnSummary.innerHTML = ''; // Clear any previous summary items

        // Get selected return reason
        const returnReason = document.getElementById('selectedReturnReason').textContent || 'N/A';
        returnSummary.appendChild(createSummaryItem('Final Return Reason:', returnReason));

        // Get selected refund methods
        const refundMethodText = refundMethod.length > 0 ? refundMethod.join(', ') : 'None selected';
        returnSummary.appendChild(createSummaryItem('Final Refund Method:', refundMethodText));

        // Get refund amount
        returnSummary.appendChild(createSummaryItem('Final Refund Amount:', `৳${refundAmount}`));

        // Hide Step 2 and Show Step 3
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'block';
    });


    // Step 3: Finish the process
    document.getElementById('submitReturn').addEventListener('click', function () {
        alert('Your return request has been completed!');
        returnModal.hide();
    });
});