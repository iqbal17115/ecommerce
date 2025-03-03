document.addEventListener('DOMContentLoaded', function () {
    const returnModal = new bootstrap.Modal(document.getElementById('returnExchangeModal'));

    document.getElementById('openReturnModal').addEventListener('click', function () {
        returnModal.show();
    });

    let selectedProducts = {};

    // Step 1: Product Selection
    document.getElementById('productSelect').addEventListener('change', function () {
        const productSelect = this;
        const selectedProductId = productSelect.value;
        const selectedProductText = productSelect.options[productSelect.selectedIndex].text;
        const productImage = productSelect.options[productSelect.selectedIndex].getAttribute('data-image');
        const productPrice = parseFloat(productSelect.options[productSelect.selectedIndex].getAttribute('data-price'));
        const productSeller = productSelect.options[productSelect.selectedIndex].getAttribute('data-seller');

        if (!selectedProductId) return;

        if (selectedProducts[selectedProductId]) {
            alert('This product is already selected.');
            return;
        }

        // Add the selected product to the products object
        selectedProducts[selectedProductId] = {
            name: selectedProductText,
            image: productImage,
            price: productPrice,
            seller: productSeller,
            quantity: 1
        };

        // Add the product to the table
        addProductToTable(selectedProductId);
    });

    // Add Product to the Table
    function addProductToTable(productId) {
        const product = selectedProducts[productId];
        const tableBody = document.getElementById('productTableBody');

        // Create a row for the selected product
        const row = document.createElement('tr');
        row.setAttribute('id', `product-${productId}`);
        row.innerHTML = `
            <td><img src="${product.image}" alt="${product.name}" width="100"></td>
            <td>${product.name}</td>
            <td>$${product.price.toFixed(2)}</td>
            <td><input type="number" id="quantity-${productId}" class="form-control" value="1" min="1" onchange="updateSubtotal(${productId})"></td>
            <td>$<span id="subtotal-${productId}">${product.price.toFixed(2)}</span></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="removeProduct('${productId}')">Remove</button></td>
        `;
        tableBody.appendChild(row);
        updateSubtotal(productId);
    }

    // Update subtotal when quantity changes
    window.updateSubtotal = function (productId) {
        const product = selectedProducts[productId];
        const quantity = document.getElementById(`quantity-${productId}`).value;
        const subtotal = product.price * quantity;
        selectedProducts[productId].quantity = quantity;
        document.getElementById(`subtotal-${productId}`).textContent = subtotal.toFixed(2);
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

        if (Object.keys(selectedProducts).length === 0 || !returnReason || !comment) {
            alert('Please select a product, return reason, and provide a comment.');
            return;
        }

        // Hide Step 1 and Show Step 2
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';

        // Set the return reason on Step 2
        document.getElementById('selectedReturnReason').textContent = returnReason;

        // Show product images on Step 2
        const returnedProductsImages = document.getElementById('returnedProductsImages');
        returnedProductsImages.innerHTML = ''; // Clear previous images
        returnedProductsImages.style.display = 'flex'; // Use Flexbox for layout
        returnedProductsImages.style.flexWrap = 'wrap'; // Allow wrapping of images if needed
        returnedProductsImages.style.gap = '10px'; // Add space between images

        for (const productId in selectedProducts) {
            const product = selectedProducts[productId];
            const imgElement = document.createElement('img');
            imgElement.src = product.image;
            imgElement.width = 50; // Set image width to 50px
            imgElement.style.objectFit = 'cover'; // Ensure images don't stretch
            returnedProductsImages.appendChild(imgElement);
        }

    });

    // Step 2: Continue to Step 3
    document.getElementById('step2Continue').addEventListener('click', function () {
        const refundMethod = [];
        if (document.getElementById('refundToAladdin').checked) refundMethod.push('Aladdin Account Balance');
        if (document.getElementById('refundToCard').checked) refundMethod.push('Card ending 3323');
        if (document.getElementById('refundToBank').checked) refundMethod.push('Bank');

        const refundAmount = Object.values(selectedProducts).reduce((sum, product) => {
            const quantity = product.quantity;
            const price = product.price;
            return sum + (quantity * price);
        }, 0).toFixed(2);

        // Show the final step summary
        // document.getElementById('finalReturnReason').textContent = document.getElementById('selectedReturnReason').textContent || 'N/A';
        // document.getElementById('finalRefundMethod').textContent = refundMethod.join(', ');
        // document.getElementById('finalRefundAmount').textContent = refundAmount;

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