// --- PRODUCT IMAGES LOGIC ---
// Define globally
function setupImageUpload(wrapper) {
    const input = wrapper.querySelector('.image-input');
    const uploadBox = wrapper.querySelector('.upload-box');
    const type = wrapper.dataset.type;
    const index = parseInt(wrapper.dataset.index);

    if (!input) return;

    if (type === "gallery" && !input.name) input.name = "gallery_images[]";

    input.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            uploadBox.innerHTML = `
                <img src="${e.target.result}" class="preview-image" alt="Product Preview">
                <div class="upload-icons">
                    <i class="fas fa-trash-alt delete-image-icon"></i>
                    <i class="fas fa-edit edit-image-icon"></i>
                </div>
            `;
            uploadBox.classList.remove('dashed-border');
            uploadBox.classList.add('has-image');

            // delete handler
            uploadBox.querySelector('.delete-image-icon').addEventListener('click', () => {
                uploadBox.innerHTML = `<p class="text-muted">Upload Image</p>`;
                uploadBox.classList.add('dashed-border');
                uploadBox.classList.remove('has-image');
                input.value = "";
                if (type === "gallery" && index === getLastGalleryIndex()) {
                    addNextGalleryUploadBox(index + 1);
                }
            });

            wrapper.appendChild(input);

            if (type === "gallery" && index === getLastGalleryIndex()) {
                addNextGalleryUploadBox(index + 1);
            }
        };
        reader.readAsDataURL(file);
    });
}

function addNextGalleryUploadBox(newIndex) {
    const container = document.getElementById('mainGalleryUploadArea');
    const newWrapper = document.createElement('div');
    newWrapper.className = 'upload-box-wrapper';
    newWrapper.dataset.type = 'gallery';
    newWrapper.dataset.index = newIndex;

    newWrapper.innerHTML = `
        <div class="upload-box gallery-image-box dashed-border">
            <i class="fas fa-plus"></i>
            <input type="file" name="gallery_images[]" class="image-input" accept="image/*">
        </div>
    `;
    container.appendChild(newWrapper);
    setupImageUpload(newWrapper);
}

function getLastGalleryIndex() {
    const galleryWrappers = document.querySelectorAll('#mainGalleryUploadArea .upload-box-wrapper[data-type="gallery"]');
    return galleryWrappers.length > 0 ? parseInt(galleryWrappers[galleryWrappers.length - 1].dataset.index) : 0;
}

document.addEventListener('DOMContentLoaded', function () {
    // --- STEP 1: Product Name Character Count ---
    const productNameInput = document.getElementById('product_name');
    const productNameCount = document.getElementById('productNameCount');

    if (productNameInput && productNameCount) {
        productNameInput.addEventListener('input', function () {
            productNameCount.textContent = this.value.length;
        });
        productNameCount.textContent = productNameInput.value.length;
    }

    // --- STEP 1: Category Dropdown Logic (Requires jQuery/Bootstrap for .dropdown('hide')) ---
    const categoryDropdownButton = document.getElementById('categoryDropdownButton');
    const selectedCategoryDisplay = document.getElementById('selectedCategoryDisplay');
    const selectedCategoryIdInput = document.getElementById('selectedCategoryId');
    const categorySearchInput = document.querySelector('.category-search-input-dropdown');
    const categoryItems = document.querySelectorAll('.category-list-dropdown .category-item');
    const recentlyUsedTags = document.querySelectorAll('.category-recently-used-tags .badge');
    // New variables for the Edit State in Step 2
    const productSummaryDisplay = document.getElementById('productSummaryDisplay');
    const editBasicInfoButton = document.getElementById('editBasicInfoButton');
    const basicInfoEditSection = document.getElementById('basicInfoEditSection');
    const saveBasicInfoButton = document.getElementById('saveBasicInfoButton');
    const productNameInputStep2 = document.getElementById('product_name_step2');
    const productNameCountStep2 = document.getElementById('productNameCountStep2');
    const categoryDropdownWrapperStep2 = document.getElementById('categoryDropdownWrapperStep2');
    // --- New/Updated selectCategory function ---
    function selectCategory(categoryId, categoryPath) {
        // ... (Category selection logic: updates selectedCategoryDisplay/selectedCategoryIdInput) ...
        selectedCategoryDisplay.textContent = categoryPath;
        selectedCategoryIdInput.value = categoryId;
        if (typeof $ !== 'undefined') {
            $(categoryDropdownButton).dropdown('hide');
        }
        // ... (End of selection logic) ...

        const productName = productNameInput.value.trim();

        // Basic Validation Check
        if (productName.length < 10) {
            alert('Please enter a product name with at least 10 characters before proceeding.');
            return;
        }
        if (!categoryId || categoryPath.includes('select category')) {
            alert('A category must be selected.');
            return;
        }

        // 1. POPULATE HIDDEN FIELDS (Crucial for final form submission)
        hiddenProductName.value = productName;
        hiddenCategoryId.value = categoryId;
        hiddenCategoryPath.value = categoryPath;

        // 2. TRANSFER DATA TO STEP 2 EDIT FIELDS
        if (productNameInputStep2) productNameInputStep2.value = productName;
        if (productNameCountStep2) productNameCountStep2.textContent = productName.length;

        // 3. Clone and Initialize Category Dropdown in Step 2
        syncCategoryHtmlToStep2();

        // 4. Transition to Step 2
        const basicInfoCategorySection = document.querySelector('.basic-info-category-step');
        const productDetailsSection = document.querySelector('.product-details-step');
        const confirmButton = document.getElementById('confirmButton');

        if (basicInfoCategorySection && productDetailsSection) {
            basicInfoCategorySection.style.display = 'none';
            productDetailsSection.style.display = 'block';

            if (confirmButton) confirmButton.style.display = 'inline-block';

            calculateFillRate();
        }
    }

    // Function to clone and sync the complex category dropdown HTML
    // --- Synchronization Functions ---

    // Function to clone and sync the complex category dropdown HTML
    function syncCategoryHtmlToStep2() {
        if (!categoryDropdownWrapperStep2) return;

        // Get the innerHTML of the Step 1 category wrapper
        const originalCategoryWrapper = document.querySelector('.category-dropdown-wrapper');

        if (originalCategoryWrapper) {
            // Clone the HTML and insert it into the Step 2 section
            categoryDropdownWrapperStep2.innerHTML = originalCategoryWrapper.innerHTML;

            // Update the display of the cloned dropdown to show the currently selected value
            const clonedDisplay = categoryDropdownWrapperStep2.querySelector('#selectedCategoryDisplay');
            const originalDisplay = document.getElementById('selectedCategoryDisplay');

            if (clonedDisplay && originalDisplay) {
                clonedDisplay.textContent = originalDisplay.textContent;
            }

            // Set the hidden input value inside the cloned HTML (using the original name)
            const clonedHiddenInput = categoryDropdownWrapperStep2.querySelector('#selectedCategoryId');
            if (clonedHiddenInput) {
                clonedHiddenInput.value = originalCategoryWrapper.querySelector('#selectedCategoryId').value;

                // IMPORTANT: Change the ID to prevent conflicts with the original field!
                clonedHiddenInput.id = 'selectedCategoryIdStep2';
                clonedHiddenInput.name = 'category_id'; // Ensure name is correct for submission
            }

            // Rebind all category related listeners to the new elements in Step 2
            bindStep2CategoryListeners();
        }
    }

    // Function to handle a selection inside the Step 2 dropdown
    function selectCategoryInStep2(categoryId, categoryPath) {
        const clonedDropdownButton = categoryDropdownWrapperStep2.querySelector('#categoryDropdownButton');
        const clonedDisplay = categoryDropdownWrapperStep2.querySelector('#selectedCategoryDisplay');
        const clonedHiddenInput = categoryDropdownWrapperStep2.querySelector('#selectedCategoryIdStep2');

        // Update the visual display in Step 2
        if (clonedDisplay) clonedDisplay.textContent = categoryPath;
        if (clonedHiddenInput) clonedHiddenInput.value = categoryId;

        // Hide the dropdown
        if (typeof $ !== 'undefined' && clonedDropdownButton) {
            $(clonedDropdownButton).dropdown('hide');
        }

        // TWO-WAY BINDING: Sync this change back to the main hidden fields
        hiddenCategoryId.value = categoryId;
        hiddenCategoryPath.value = categoryPath;
    }

    // Function to bind category listeners in the Step 2 edit section
    function bindStep2CategoryListeners() {
        // Re-run the listeners on the Step 2 elements
        const categoryItemsStep2 = categoryDropdownWrapperStep2.querySelectorAll('.category-list-dropdown .category-item');
        const recentlyUsedTagsStep2 = categoryDropdownWrapperStep2.querySelectorAll('.category-recently-used-tags .badge');
        const categorySearchInputStep2 = categoryDropdownWrapperStep2.querySelector('.category-search-input-dropdown');

        // --- Rebind Category Item Click ---
        categoryItemsStep2.forEach(item => {
            item.addEventListener('click', function (event) {
                event.preventDefault();
                selectCategoryInStep2(this.dataset.categoryId, this.dataset.categoryPath);
                // Highlight active item if desired
                categoryItemsStep2.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // --- Rebind Recently Used Click ---
        recentlyUsedTagsStep2.forEach(tag => {
            tag.addEventListener('click', function () {
                selectCategoryInStep2(this.dataset.categoryId, this.textContent.trim());
                recentlyUsedTagsStep2.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // --- Rebind Search Input (unchanged from previous logic) ---
        if (categorySearchInputStep2) {
            categorySearchInputStep2.addEventListener('input', function () {
                const searchTerm = this.value.toLowerCase();
                categoryItemsStep2.forEach(item => {
                    const categoryPath = item.dataset.categoryPath.toLowerCase();
                    item.style.display = categoryPath.includes(searchTerm) ? 'block' : 'none';
                });
                recentlyUsedTagsStep2.forEach(tag => {
                    const tagText = tag.textContent.toLowerCase();
                    tag.style.display = tagText.includes(searchTerm) ? 'inline-flex' : 'none';
                });
            });
        }
    }

    // --- Final Data Binding Listeners (for the Product Name) ---

    // 1. Character Count for Step 2 Name
    if (productNameInputStep2 && productNameCountStep2) {
        productNameInputStep2.addEventListener('input', function () {
            productNameCountStep2.textContent = this.value.length;
            // TWO-WAY BINDING: Sync this change back to the main hidden field
            hiddenProductName.value = this.value;
        });
    }

    // Function to bind category listeners in the Step 2 edit section
    function bindStep2CategoryListeners() {
        // Re-run the listeners on the Step 2 elements
        const categoryItemsStep2 = categoryDropdownWrapperStep2.querySelectorAll('.category-list-dropdown .category-item');
        const recentlyUsedTagsStep2 = categoryDropdownWrapperStep2.querySelectorAll('.category-recently-used-tags .badge');
        const categorySearchInputStep2 = categoryDropdownWrapperStep2.querySelector('.category-search-input-dropdown');

        // --- Rebind Category Item Click ---
        categoryItemsStep2.forEach(item => {
            item.addEventListener('click', function (event) {
                event.preventDefault();
                // When clicked in Step 2, update the original Step 1 display
                selectCategoryInStep2(this.dataset.categoryId, this.dataset.categoryPath);
                categoryItemsStep2.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // --- Rebind Recently Used Click ---
        recentlyUsedTagsStep2.forEach(tag => {
            tag.addEventListener('click', function () {
                selectCategoryInStep2(this.dataset.categoryId, this.textContent.trim());
                recentlyUsedTagsStep2.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // --- Rebind Search Input ---
        if (categorySearchInputStep2) {
            categorySearchInputStep2.addEventListener('input', function () {
                const searchTerm = this.value.toLowerCase();
                categoryItemsStep2.forEach(item => {
                    const categoryPath = item.dataset.categoryPath.toLowerCase();
                    item.style.display = categoryPath.includes(searchTerm) ? 'block' : 'none';
                });
                recentlyUsedTagsStep2.forEach(tag => {
                    const tagText = tag.textContent.toLowerCase();
                    tag.style.display = tagText.includes(searchTerm) ? 'inline-flex' : 'none';
                });
            });
        }
    }

    // Custom select function for Step 2 that only updates the internal display
    function selectCategoryInStep2(categoryId, categoryPath) {
        const clonedDropdownButton = categoryDropdownWrapperStep2.querySelector('#categoryDropdownButton');
        const clonedDisplay = categoryDropdownWrapperStep2.querySelector('#selectedCategoryDisplay');
        const clonedHiddenInput = categoryDropdownWrapperStep2.querySelector('#selectedCategoryId');

        if (clonedDisplay) clonedDisplay.textContent = categoryPath;
        if (clonedHiddenInput) clonedHiddenInput.value = categoryId;

        if (typeof $ !== 'undefined' && clonedDropdownButton) {
            $(clonedDropdownButton).dropdown('hide');
        }
    }

    // --- Basic Info Toggling and Saving ---

    // 1. Toggling the Edit Section
    if (editBasicInfoButton) {
        editBasicInfoButton.addEventListener('click', function () {
            productSummaryDisplay.style.display = 'none';
            basicInfoEditSection.style.display = 'block';

            // Sync current data to the editable fields on open
            if (productNameInputStep2) productNameInputStep2.value = hiddenProductName.value;
            if (productNameCountStep2) productNameCountStep2.textContent = hiddenProductName.value.length;

            // If the category dropdown wasn't synced before (shouldn't happen, but safety)
            syncCategoryHtmlToStep2();
        });
    }

    // 2. Character Count for Step 2 Name
    if (productNameInputStep2 && productNameCountStep2) {
        productNameInputStep2.addEventListener('input', function () {
            productNameCountStep2.textContent = this.value.length;
        });
    }

    // 3. Saving the Changes
    if (saveBasicInfoButton) {
        saveBasicInfoButton.addEventListener('click', function () {
            const newProductName = productNameInputStep2.value.trim();
            const newCategoryId = categoryDropdownWrapperStep2.querySelector('#selectedCategoryId').value;
            const newCategoryPath = categoryDropdownWrapperStep2.querySelector('#selectedCategoryDisplay').textContent;

            // Simple validation
            if (newProductName.length < 10 || !newCategoryId) {
                alert('Please ensure the Product Name has at least 10 characters and a Category is selected.');
                return;
            }

            // Sync the changes back to the main hidden fields (for form submission)
            hiddenProductName.value = newProductName;
            hiddenCategoryId.value = newCategoryId;
            hiddenCategoryPath.value = newCategoryPath;

            // Update the read-only summary display
            if (summaryProductName) summaryProductName.textContent = newProductName;
            if (summaryCategoryPath) summaryCategoryPath.textContent = newCategoryPath;

            // Hide the edit section and show the summary
            basicInfoEditSection.style.display = 'none';
            productSummaryDisplay.style.display = 'flex'; // Use flex to restore alignment
        });
    }

    categoryItems.forEach(item => {
        item.addEventListener('click', function (event) {
            event.preventDefault();
            selectCategory(this.dataset.categoryId, this.dataset.categoryPath);
            categoryItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });

    recentlyUsedTags.forEach(tag => {
        tag.addEventListener('click', function () {
            selectCategory(this.dataset.categoryId, this.textContent.trim());
            recentlyUsedTags.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    if (categorySearchInput) {
        categorySearchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            categoryItems.forEach(item => {
                const categoryPath = item.dataset.categoryPath.toLowerCase();
                item.style.display = categoryPath.includes(searchTerm) ? 'block' : 'none';
            });
            recentlyUsedTags.forEach(tag => {
                const tagText = tag.textContent.toLowerCase();
                tag.style.display = tagText.includes(searchTerm) ? 'inline-flex' : 'none';
            });
        });
    }

    // --- Multi-step form navigation and Data Transfer ---
    const nextStepButton = document.getElementById('nextStepButton');
    const confirmButton = document.getElementById('confirmButton');
    const basicInfoCategorySection = document.querySelector('.basic-info-category-step');
    const productDetailsSection = document.querySelector('.product-details-step');
    const cancelButton = document.getElementById('cancelButton');

    // Summary elements in the second step
    const summaryProductName = document.getElementById('summaryProductName');
    const summaryCategoryPath = document.getElementById('summaryCategoryPath');
    const readOnlyProductName = document.getElementById('readOnlyProductName');
    const readOnlyCategoryPath = document.getElementById('readOnlyCategoryPath');

    // Hidden input fields for form submission
    const hiddenProductName = document.getElementById('hiddenProductName');
    const hiddenCategoryId = document.getElementById('hiddenCategoryId');
    const hiddenCategoryPath = document.getElementById('hiddenCategoryPath');


    if (nextStepButton && confirmButton && basicInfoCategorySection && productDetailsSection) {
        let currentStep = 1;

        nextStepButton.addEventListener('click', function () {
            if (currentStep === 1) {
                // Validation
                const productName = productNameInput.value.trim();
                const categoryPath = selectedCategoryDisplay.textContent.trim();
                const selectedCatId = selectedCategoryIdInput.value;

                if (productName.length < 10) {
                    alert('Please enter a product name with at least 10 characters.');
                    return;
                }
                if (!selectedCatId || categoryPath.includes('select category')) {
                    alert('Please select a category.');
                    return;
                }

                // 1. POPULATE HIDDEN FIELDS
                hiddenProductName.value = productName;
                hiddenCategoryId.value = selectedCatId;
                hiddenCategoryPath.value = categoryPath;

                // 2. UPDATE SUMMARY DISPLAY
                if (summaryProductName) summaryProductName.textContent = productName;
                if (summaryCategoryPath) summaryCategoryPath.textContent = categoryPath;
                if (readOnlyProductName) readOnlyProductName.textContent = productName;
                if (readOnlyCategoryPath) readOnlyCategoryPath.textContent = categoryPath;


                // 3. Transition to Step 2
                basicInfoCategorySection.style.display = 'none';
                productDetailsSection.style.display = 'block';
                nextStepButton.style.display = 'none';
                confirmButton.style.display = 'inline-block';
                currentStep = 2;

                // 4. Calculate initial fill rate for Step 2
                calculateFillRate();
            }
        });

        cancelButton.addEventListener('click', function () {
            if (confirm('Are you sure you want to cancel? All unsaved changes will be lost.')) {
                // Replace with your actual cancellation logic (e.g., redirect)
                // window.location.href = '/admin/products';
            }
        });
    }

    // --- STEP 2: Product Specification Show More/Less Toggle ---
    const specToggleLink = document.querySelector('.spec-toggle-link');

    if (specToggleLink) {
        specToggleLink.addEventListener('click', function (event) {
            event.preventDefault();

            const targetId = this.getAttribute('data-toggle-target');
            const targetElement = document.querySelector(targetId);

            const showText = this.querySelector('.show-text');
            const hideText = this.querySelector('.hide-text');

            if (targetElement.style.display === 'none' || targetElement.style.display === '') {
                // Show the fields
                targetElement.style.display = 'block';
                showText.style.display = 'none';
                hideText.style.display = 'inline';
            } else {
                // Hide the fields
                targetElement.style.display = 'none';
                showText.style.display = 'inline';
                hideText.style.display = 'none';
            }
        });
    }

    // --- NEW: Fill Rate Calculation Logic ---
    function calculateFillRate() {
        // We will target the entire Product Specification section, which is the 3rd .form-section inside the main content wrapper
        const specSection = document.querySelector('.main-form-content .form-section:nth-child(2)');
        if (!specSection) return;

        // Find all relevant input fields and select menus within the specification section
        const inputs = specSection.querySelectorAll('input[type="text"], input[type="number"], select');
        const fillRateElement = document.getElementById('specFillRate');

        let totalFields = 0;
        let filledFields = 0;

        inputs.forEach(input => {
            // Exclude fields that are part of the shipping units (handled elsewhere)
            if (input.name && !input.name.includes('_unit')) {
                totalFields++;
                const value = input.value.trim();

                // Check if the field has a meaningful value
                if (value !== '' && value !== 'Select' && value !== 'select') {
                    filledFields++;
                }
            }
        });

        if (totalFields > 0 && fillRateElement) {
            const percentage = Math.round((filledFields / totalFields) * 100);
            fillRateElement.textContent = `${percentage}%`;
        } else if (fillRateElement) {
            fillRateElement.textContent = '0%';
        }
    }

    // Attach the calculation function to input events in the spec section
    // Using the new .main-form-content class for accurate targeting
    const specInputs = document.querySelectorAll('.main-form-content .form-section:nth-child(2) input, .main-form-content .form-section:nth-child(2) select');
    specInputs.forEach(input => {
        input.addEventListener('input', calculateFillRate);
        input.addEventListener('change', calculateFillRate);
    });

    // --- VARIANT MANAGEMENT LOGIC ---

    // --- DUMMY DATA ---
    let ALL_INT_SIZES = [];
    let ALL_COLOR_OPTIONS = [];


    // --- Helper Functions ---

    // ----------------------------
    // 1️⃣ Get current variants from DOM
    // ----------------------------
    function getVariantState() {
        const variants = [];

        document.querySelectorAll('.variant-block').forEach(block => {
            const index = parseInt(block.getAttribute('data-variant-index'));
            const nameInput = document.getElementById(`variant_name_${index}`);
            const name = nameInput ? (nameInput.value || `Variant ${index}`) : `Variant ${index}`;

            const values = [];

            // fallback to hidden inputs
            block.querySelectorAll(`input[name^="variant_values[${index}]"]`).forEach(input => {
                if (input.value) values.push(input.value.trim());
            });

            // Variant 1 fixed rows
            block.querySelectorAll('.variant-input-row[data-is-fixed="true"]').forEach(row => {
                const val = row.getAttribute('data-value');
                if (val) values.push(val.trim());
            });

            // Variant 2+ pills
            block.querySelectorAll('.variant-pill').forEach(pill => {
                const val = pill.getAttribute('data-value');
                if (val) values.push(val.trim());
            });

            if (values.length > 0) {
                variants.push({
                    index,
                    name,
                    values,
                    isImageVariant: block.querySelector('.variant-image-checkbox')?.checked || false
                });
            }
        });

        return variants;
    }

    // ----------------------------
    // 2️⃣ Generate all combinations
    // ----------------------------
    function generateCombinations(variants) {
        if (variants.length === 0) return [];

        let combos = variants[0].values.map(v => [v]);

        for (let i = 1; i < variants.length; i++) {
            const nextValues = variants[i].values;
            const newCombos = [];
            combos.forEach(c => {
                nextValues.forEach(v => {
                    newCombos.push([...c, v]);
                });
            });
            combos = newCombos;
        }

        return combos;
    }

    // ----------------------------
    // 3️⃣ Render table with proper saved data mapping
    // ----------------------------
    function renderVariantTable() {
        const variants = getVariantState();
        const combos = generateCombinations(variants);

        const tableHeader = document.getElementById('variantTableHeader');
        const tableBody = document.getElementById('variantTableBody');
        const tablePlaceholder = document.getElementById('tablePlaceholder');
        const tableEl = document.querySelector('.variant-price-stock-table');

        // Map saved backend data by **sorted option values** to match new combos
        const savedData = {};
        (window.EDIT_PRODUCT?.combinations || []).forEach(c => {
            const sortedKey = c.option_values.map(v => v.trim().replace(/\W/g, '').toUpperCase()).join('_');
            savedData[sortedKey] = c;
        });

        if (combos.length === 0) {
            tableHeader.innerHTML = '';
            tableBody.innerHTML = '';
            tablePlaceholder.style.display = 'block';
            tableEl.style.display = 'none';
            return;
        }

        tablePlaceholder.style.display = 'none';
        tableEl.style.display = 'table';

        // Table header
        let headerHtml = variants.map(v => `<th>${v.name}</th>`).join('');
        headerHtml += `
        <th class="text-danger">* Price</th>
        <th>Special Price</th>
        <th class="text-danger">* Stock</th>
        <th>Seller SKU</th>
        <th>Free Items</th>
        <th>Availability</th>`;
        tableHeader.innerHTML = headerHtml;

        const productName = document.getElementById('product_name')?.value.trim().toUpperCase() || 'PROD';
        const baseIdentifier = productName.substring(0, 4).replace(/\W/g, '');

        let bodyHtml = '';

        combos.forEach(values => {
            // generate sorted key to match saved data
            const key = values.map(v => v.trim().replace(/\W/g, '').toUpperCase()).join('_');

            const saved = savedData[key] || {};

            const fallbackSku = `${baseIdentifier}-${key.replace(/_/g, '-')}`;

            bodyHtml += `<tr>`;

            // option values
            values.forEach(v => {
                bodyHtml += `<td>${v}</td>`;
            });

            bodyHtml += `
            <td><input type="number" name="combinations[${key}][price]" value="${saved.price ?? ''}" class="form-control form-control-sm" required></td>
            <td><input type="number" name="combinations[${key}][special_price]" value="${saved.special_price ?? ''}" class="form-control form-control-sm"></td>
            <td><input type="number" name="combinations[${key}][stock]" value="${saved.stock ?? ''}" class="form-control form-control-sm" required></td>
            <td><input type="text" name="combinations[${key}][seller_sku]" value="${saved.seller_sku ?? fallbackSku}" class="form-control form-control-sm" required></td>
            <td><input type="text" name="combinations[${key}][free_items]" value="${saved.free_items ?? ''}" class="form-control form-control-sm"></td>
            <td>
                <label class="switch">
                    <input type="checkbox" name="combinations[${key}][available]" ${saved.available ? 'checked' : ''}>
                    <span class="slider round"></span>
                </label>
            </td>`;

            // hidden option values
            values.forEach(v => {
                bodyHtml += `<input type="hidden" name="combinations[${key}][option_values][]" value="${v}">`;
            });

            bodyHtml += `</tr>`;
        });

        tableBody.innerHTML = bodyHtml;
    }

    // --- Variant 1 (Select-and-Add Logic) ---
    function getUsedVariant1Values() {
        const usedValues = [];
        document.querySelectorAll('#variantPills_1 .variant-input-row[data-is-fixed="true"]').forEach(row => {
            usedValues.push(row.getAttribute('data-value').toLowerCase());
        });
        return usedValues;
    }

    /**
 * Load all color options dynamically from backend
 */
    function loadColorOptions(callback) {
        // Only load once
        if (ALL_COLOR_OPTIONS.length > 0) {
            if (callback && typeof callback === 'function') callback();
            return;
        }

        getDetails('/attributes/color-values', function (response) {
            if (response.success) {
                ALL_COLOR_OPTIONS = response.data;
                if (callback && typeof callback === 'function') callback();
            } else {
                console.error('Failed to load color values.');
            }
        }, function (error) {
            console.error('Error fetching color values:', error);
        });
    }

    /**
     * Update color dropdown dynamically
     */
    function updateVariant1DynamicSelect(selectElement) {
        // Ensure color options are loaded before populating
        if (ALL_COLOR_OPTIONS.length === 0) {
            loadColorOptions(() => updateVariant1DynamicSelect(selectElement));
            return;
        }
        const usedValues = getUsedVariant1Values();
        const currentSelectedValue = selectElement.value;

        selectElement.innerHTML = ''; // Clear options

        // Add placeholder
        const placeholder = document.createElement('option');
        placeholder.value = '';
        placeholder.textContent = 'Please type or select';
        selectElement.appendChild(placeholder);

        // Add available options
        ALL_COLOR_OPTIONS.forEach(color => {
            if (!usedValues.includes(color.toLowerCase())) {
                const option = document.createElement('option');
                option.value = color;
                option.textContent = color;
                selectElement.appendChild(option);
            }
        });

        // Reset to placeholder
        selectElement.value = '';
    }


    function createNewFixedRow(oldDynamicRow, value) {
        // 1. Convert the existing dynamic row into a fixed row
        oldDynamicRow.setAttribute('data-is-fixed', 'true');
        oldDynamicRow.setAttribute('data-value', value);
        oldDynamicRow.style.borderStyle = 'solid';

        // Replace the select with an input that is set to read-only
        oldDynamicRow.innerHTML = `
        <input type="text" class="form-control variant-value-input" value="${value}" readonly style="pointer-events: none;">
        <div class="ml-2 variant-media-links" style="visibility: visible;">
            <a href="#">Upload</a> | <a href="#">Media Center</a>
        </div>
        <i class="fas fa-trash text-muted ml-3 remove-variant-value" style="cursor: pointer;"></i>
        <i class="fas fa-bars text-muted ml-2 drag-handle" style="cursor: grab;"></i>
    `;

        // 2. Create the new dynamic SELECT row element
        const newDynamicRow = document.createElement('div');
        newDynamicRow.className = 'variant-input-row d-flex align-items-center mb-2';
        newDynamicRow.setAttribute('data-is-fixed', 'false');

        newDynamicRow.innerHTML = `
        <select class="form-control variant-value-select-dynamic" style="max-width: 250px;"></select>
        <div class="ml-2 variant-media-links" style="visibility: hidden;">
            <a href="#">Upload</a> | <a href="#">Media Center</a>
        </div>
        <i class="fas fa-trash text-muted ml-3 remove-variant-value" style="cursor: pointer; display: none;"></i>
        <i class="fas fa-bars text-muted ml-2 drag-handle" style="cursor: grab; display: none;"></i>
    `;

        // 3. Append the new dynamic row
        const container = document.getElementById('variantPills_1');
        container.appendChild(newDynamicRow);

        // 4. Rebind listeners and update table
        bindDynamicListeners();
        renderVariantTable();
        // Ensure the new select element is populated and focused
        const newSelect = newDynamicRow.querySelector('.variant-value-select-dynamic');
        updateVariant1DynamicSelect(newSelect);
        newSelect.focus();
    }


    function handleVariant1SelectChange(selectElement) {
        const value = selectElement.value.trim();
        if (!value) return;

        // Find the row element this select belongs to
        const currentDynamicRow = selectElement.closest('.variant-input-row[data-is-fixed="false"]');
        if (currentDynamicRow) {
            createNewFixedRow(currentDynamicRow, value);
        }
    }

    function bindVariant1Listeners(row) {

        // Remove button listener (only for fixed rows)
        const removeBtn = row.querySelector('.remove-variant-value');
        if (removeBtn) {
            removeBtn.onclick = function () {
                this.closest('.variant-input-row').remove();
                renderVariantTable();
                // Update the last select dropdown to potentially re-add the deleted option
                const lastSelect = document.querySelector('#variantPills_1 .variant-input-row[data-is-fixed="false"] .variant-value-select-dynamic');
                if (lastSelect) updateVariant1DynamicSelect(lastSelect);
            };
        }

        // Bind change listener only to the dynamic select element
        const select = row.querySelector('.variant-value-select-dynamic');
        if (select && row.getAttribute('data-is-fixed') === 'false') {
            // Unbind existing to prevent duplication
            select.removeEventListener('change', handleVariant1SelectChange);
            // Bind new listener
            select.addEventListener('change', function () {
                handleVariant1SelectChange(this);
            });
        }
    }


    // --- Variant 2 (Modal Logic - No Changes) ---

    let currentSelectedModalSizes = [];

    function populateSizeModalGrid() {
        const sizeGrid = document.querySelector('#v-pills-int .size-grid');
        sizeGrid.innerHTML = '';
        ALL_INT_SIZES.forEach(size => {
            const isSelected = currentSelectedModalSizes.includes(size);
            const sizeOptionDiv = document.createElement('div');
            sizeOptionDiv.className = `size-option ${isSelected ? 'selected' : ''}`;
            sizeOptionDiv.setAttribute('data-size', size);
            sizeOptionDiv.innerHTML = `
            <input type="checkbox" ${isSelected ? 'checked' : ''}>
            ${size}
        `;
            sizeGrid.appendChild(sizeOptionDiv);

            sizeOptionDiv.addEventListener('click', function () {
                this.classList.toggle('selected');
                const checkbox = this.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;
                updateSelectedSizeCount();
            });
        });
    }

    function updateSelectedSizeCount() {
        const selectedCount = document.querySelectorAll('#v-pills-int .size-option.selected').length;
        document.getElementById('selectedSizeCount').textContent = selectedCount;
    }

    function createVariantPill(value) {
        const pill = document.createElement('div');
        pill.className = 'variant-pill';
        pill.setAttribute('data-value', value);
        pill.innerHTML = `${value} <i class="fas fa-times remove-pill"></i>`;
        return pill;
    }

    function addVariantPill(listElement, value) {
        if (!value || value.trim() === '') return;
        const cleanValue = value.trim();
        if (listElement.querySelector(`.variant-pill[data-value="${cleanValue}"]`)) return;

        listElement.appendChild(createVariantPill(cleanValue));

        bindDynamicListeners();
    }


    // Modal show event listener
    // When modal is about to show
    $('#sizeSelectionModal').on('show.bs.modal', function (e) {
        currentSelectedModalSizes = [];

        document.querySelectorAll('#variantPills_2 .variant-pill').forEach(pill => {
            currentSelectedModalSizes.push(pill.getAttribute('data-value'));
        });

        if (ALL_INT_SIZES.length === 0) {
            // Load size values via AJAX only once
            getDetails('/attributes/size-values', function (response) {
                if (response.success) {
                    ALL_INT_SIZES = response.data;
                    populateSizeModalGrid();
                    updateSelectedSizeCount();
                } else {
                    console.error('Failed to load sizes');
                }
            }, function (error) {
                console.error('Error fetching size values:', error);
            });
        } else {
            populateSizeModalGrid();
            updateSelectedSizeCount();
        }
    });

    // Confirm button in modal
    document.getElementById('confirmSizeSelection').addEventListener('click', function () {
        const variantPillsList = document.getElementById('variantPills_2');
        variantPillsList.innerHTML = '';

        document.querySelectorAll('#v-pills-int .size-option.selected').forEach(option => {
            addVariantPill(variantPillsList, option.getAttribute('data-size'));
        });

        renderVariantTable();
        $('#sizeSelectionModal').modal('hide');
    });


    // --- Global Listener Binding ---

    function bindDynamicListeners() {
        // 1. Pill Removal (for Variant 2)
        document.querySelectorAll('#variantPills_2 .remove-pill').forEach(btn => {
            btn.onclick = function () {
                this.closest('.variant-pill').remove();
                renderVariantTable();
            };
        });

        // 2. Variant 1 Row Listeners (rebinding every time a new row is added/converted)
        document.querySelectorAll('#variantPills_1 .variant-input-row').forEach(bindVariant1Listeners);

        // 3. Variant Name change listener
        document.querySelectorAll('.variant-name-input').forEach(input => {
            input.removeEventListener('input', renderVariantTable);
            input.addEventListener('input', renderVariantTable);
        });
    }


    // Function to setup the variant block (Toggle & Name Change)
    function setupVariantBlock(block) {
        const header = block.querySelector('.variant-header');
        const content = block.querySelector('.variant-content');

        // Toggle collapse listener
        if (header) header.addEventListener('click', function () {
            const isCollapsed = content.style.display === 'none';
            content.style.display = isCollapsed ? 'block' : 'none';
            header.querySelector('.variant-toggle-icon').classList.toggle('fa-chevron-up', isCollapsed);
            header.querySelector('.variant-toggle-icon').classList.toggle('fa-chevron-down', !isCollapsed);
        });
    }


    // --- INITIALIZATION ---
    document.querySelectorAll('.variant-block').forEach(setupVariantBlock);
    bindDynamicListeners();

    // Initial population of the first dynamic select
    const initialSelect = document.querySelector('#variantPills_1 .variant-value-select-dynamic');
    if (initialSelect) {
        updateVariant1DynamicSelect(initialSelect);
    }

    renderVariantTable();

    // --- Bulk Apply Logic ---
    document.querySelector('.apply-to-all-btn').addEventListener('click', function () {
        const price = document.querySelector('.bulk-input[data-field="price"]').value;
        const specialPrice = document.querySelector('.bulk-input[data-field="special_price"]').value;
        const stock = document.querySelector('.bulk-input[data-field="stock"]').value;
        const baseSku = document.querySelector('.bulk-input[data-field="sku"]').value.trim(); // Get the base SKU

        // 1. Bulk apply Price, Special Price, and Stock (unchanged)
        if (price) { document.querySelectorAll('input[name^="price_"]').forEach(input => input.value = price); }
        if (specialPrice) { document.querySelectorAll('input[name^="special_price_"]').forEach(input => input.value = specialPrice); }
        if (stock) { document.querySelectorAll('input[name^="stock_"]').forEach(input => input.value = stock); }

        // 2. Bulk apply and GENERATE UNIQUE SKU
        if (baseSku) {
            const variantRows = document.querySelectorAll('#variantTableBody tr');

            variantRows.forEach((row, index) => {
                // Determine the unique key for this row's input.
                // Since your input names are structured as 'sku_<uniqueKey>', we must find the key.
                // The easiest way is to target the specific SKU input in the row.
                const skuInput = row.querySelector('input[name^="sku_"]');

                if (skuInput) {
                    // Extract the unique key from the input's 'name' attribute
                    const fullInputName = skuInput.name; // e.g., 'sku_Red_S'
                    const uniqueIdentifier = fullInputName.substring(4); // e.g., '_Red_S' (Keep the underscore if needed)

                    // Generate the new unique SKU
                    const newSku = `${baseSku}-${uniqueIdentifier.replace(/_/g, '-')}`;

                    // Cleanup example: remove leading underscores if present, replace others with dashes
                    // Alternatively, for a simple unique number suffix:
                    // const newSku = `${baseSku}-${index + 1}`; 

                    skuInput.value = newSku;
                }
            });
        }
    });
    // --- End of Variant Management Logic ---

    // --- PRODUCT IMAGES LOGIC ---
    function setupImageUpload(wrapper) {
        const input = wrapper.querySelector('.image-input');
        const uploadBox = wrapper.querySelector('.upload-box');
        const type = wrapper.dataset.type;
        const index = parseInt(wrapper.dataset.index);

        if (!input) return;

        // Always ensure input has name="gallery_images[]"
        if (type === "gallery" && !input.name) {
            input.name = "gallery_images[]";
        }

        input.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {

                // ⭐ DO NOT overwrite input
                uploadBox.innerHTML = `
                <img src="${e.target.result}" class="preview-image" alt="Product Preview">
                <div class="upload-icons">
                    <i class="fas fa-trash-alt delete-image-icon"></i>
                    <i class="fas fa-edit edit-image-icon"></i>
                </div>
            `;

                uploadBox.classList.remove('dashed-border');
                uploadBox.classList.add('has-image');

                // Rebind delete handler
                uploadBox.querySelector('.delete-image-icon').addEventListener('click', () => {
                    // Reset preview
                    uploadBox.innerHTML = `<p class="text-muted">Upload Image</p>`;
                    uploadBox.classList.add('dashed-border');
                    uploadBox.classList.remove('has-image');

                    // Clear file input
                    input.value = "";

                    // Maintain gallery rules
                    if (type === "gallery" && index === getLastGalleryIndex()) {
                        addNextGalleryUploadBox(index + 1);
                    }
                });

                // ⭐ Append input back to wrapper (not inside uploadBox)
                wrapper.appendChild(input);

                // ⭐ Auto-add next gallery box
                if (type === "gallery" && index === getLastGalleryIndex()) {
                    addNextGalleryUploadBox(index + 1);
                }
            };

            reader.readAsDataURL(file);
        });
    }

    function handleDeleteImage(event) {
        // Prevent the file input from being clicked
        event.stopPropagation();
        event.preventDefault();

        const wrapper = this.closest('.upload-box-wrapper');
        const type = wrapper.dataset.type;
        const index = parseInt(wrapper.dataset.index);

        if (type === 'main') {
            // Reset main image box to original state
            const uploadBox = wrapper.querySelector('.upload-box');
            uploadBox.innerHTML = `
            <i class="fas fa-plus"></i>
            <p>Upload main image</p>
            <input type="file" name="main_image" class="image-input" accept="image/*">
        `;
            uploadBox.classList.add('dashed-border');
            uploadBox.classList.remove('has-image');
            // Re-setup listener on the new input
            setupImageUpload(wrapper);
        } else if (type === 'gallery') {
            // Remove the gallery box entirely
            wrapper.remove();

            // Renumber remaining gallery inputs if necessary (optional but good practice)
            document.querySelectorAll('#mainGalleryUploadArea .upload-box-wrapper[data-type="gallery"]').forEach((el, newIndex) => {
                el.dataset.index = newIndex + 1;
                el.querySelector('.image-input').name = `gallery_images[${newIndex}]`;
            });

            // Ensure the last gallery box is the empty placeholder
            if (!isLastGalleryBoxEmpty()) {
                addNextGalleryUploadBox(getLastGalleryIndex() + 1);
            }
        }
    }

    function getLastGalleryIndex() {
        const galleryWrappers = document.querySelectorAll('#mainGalleryUploadArea .upload-box-wrapper[data-type="gallery"]');
        return galleryWrappers.length > 0 ? parseInt(galleryWrappers[galleryWrappers.length - 1].dataset.index) : 0;
    }

    function isLastGalleryBoxEmpty() {
        const lastWrapper = document.querySelector(`#mainGalleryUploadArea .upload-box-wrapper[data-type="gallery"][data-index="${getLastGalleryIndex()}"]`);
        return lastWrapper && !lastWrapper.querySelector('.upload-box').classList.contains('has-image');
    }


    function addNextGalleryUploadBox(newIndex) {
        const container = document.getElementById('mainGalleryUploadArea');

        const newWrapper = document.createElement('div');
        newWrapper.className = 'upload-box-wrapper';
        newWrapper.dataset.type = 'gallery';
        newWrapper.dataset.index = newIndex;

        // Use an empty paragraph for the gallery placeholder text
        const placeholderText = newIndex === 1 ? '<p>Upload gallery image</p>' : '';

        newWrapper.innerHTML = `
        <div class="upload-box gallery-image-box dashed-border">
            <i class="fas fa-plus"></i>
            ${placeholderText}
            <input type="file" name="gallery_images[]" class="image-input" accept="image/*" style>
        </div>
    `;

        container.appendChild(newWrapper);

        // Setup listeners for the new box
        setupImageUpload(newWrapper);
    }


    // --- INITIALIZATION (run this part once on load) ---
    document.querySelectorAll('#mainGalleryUploadArea .upload-box-wrapper').forEach(setupImageUpload);

    // --- Seller SKU Bulk Input Character Count ---
    const skuBulkInput = document.querySelector('.bulk-input[data-field="sku"]');
    const skuBulkCount = document.getElementById('skuBulkCount');

    if (skuBulkInput && skuBulkCount) {
        skuBulkInput.addEventListener('input', function () {
            skuBulkCount.textContent = this.value.length;
        });
        // Set initial count if there's a default value
        skuBulkCount.textContent = skuBulkInput.value.length;
    }

    /**
 * =========================================================================
 * MOCK UTILITY FUNCTIONS (Needed for saveAction dependencies)
 * NOTE: These assume you are using jQuery for AJAX.
 * =========================================================================
 */

    /**
     * Mock utility for making a simple GET or DELETE request.
     */
    function requestParamsUrl(route, method = "GET") {
        return $.Deferred().resolve({ results: [], message: "Success (Mock)" }).promise();
    }

    /**
     * Simple mock confirmation dialog (since alert()/confirm() are forbidden)
     */
    function confirmAction(title, text, callback) {
        console.warn(`[MOCK CONFIRMATION] ${title}: ${text}`);
        if (callback) {
            // In a real app, this would show a modal. For the mock, we call the callback directly.
            callback();
        }
    }

    /**
     * Delete Action
     */
    function deleteAction(route, successCallback, errorCallback, title = "Delete", text = "Are you sure you want to delete this record?") {
        confirmAction(title, text, () => {
            requestParamsUrl(route, "DELETE")
                .done(function (data) {
                    if (successCallback && typeof successCallback === 'function') {
                        successCallback(data);
                    }
                })
                .fail(function (error) {
                    if (errorCallback && typeof errorCallback === 'function') {
                        errorCallback(error);
                    }
                });
        });
    }
});

/**
    * =========================================================================
    * PRODUCT SUBMISSION LOGIC
    * =========================================================================
    */
$(document).ready(function () {
    // 1. Target the main form. You must ensure your entire wizard is wrapped in a form tag.
    const $productForm = $('#productWizardForm');
    const $submitButton = $('#finalSubmitButton'); // Assuming a button with this ID

    // Helper function to clear previous validation errors
    function clearFormErrors() {
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        $submitButton.prop('disabled', false).html('Save Product');
    }

    // Helper function to handle Laravel validation errors
    function handleFormErrors(error) {
        clearFormErrors();

        const errors = error.responseJSON?.errors;
    }

    // --- Form Submission Listener ---
    $productForm.on('submit', function (e) {
        e.preventDefault();

        // Disable button and show loading state
        $submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm mr-2"></span> Saving...');

        clearFormErrors();

        const form = document.getElementById('productWizardForm');
        const formData = new FormData(form);

        const isEdit = form.getAttribute('method') === 'PUT' || form.querySelector('input[name="_method"]')?.value === 'PUT';

        const route = isEdit
            ? form.getAttribute('action')  // products/{id}
            : form.getAttribute('action'); // products

        saveAction(
            'store', // action
            route,   // route
            formData, // formData
            '',      // id (not needed for store)

            // Success Callback
            function (data) {
                alert(data.message || 'Product created successfully!', 'success');
                // Example: Redirect to the product listing page
                // window.location.href = '/products';
                $submitButton.html('Product Saved!');
            },

            // Error Callback
            function (error) {
                handleFormErrors(error);
            }
        );
    });

    // Start Upload Image
    const galleryContainer = document.getElementById('mainGalleryUploadArea');
    const editProduct = window.EDIT_PRODUCT || {};

    // 1️⃣ Render existing media (if any)
    if (editProduct.medias && editProduct.medias.length > 0) {
        galleryContainer.innerHTML = ''; // clear placeholder

        editProduct.medias.forEach((media, idx) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'upload-box-wrapper';
            wrapper.dataset.type = 'gallery';
            wrapper.dataset.index = idx + 1;

            wrapper.innerHTML = `
                <div class="upload-box gallery-image-box has-image">
                    <img src="${media.url}" class="preview-image" alt="Product Image">
                    <div class="upload-icons">
                        <i class="fas fa-trash-alt delete-image-icon"></i>
                    </div>
                    <input type="file" name="gallery_images[]" class="image-input" accept="image/*" style="display:none">
                </div>
            `;
            galleryContainer.appendChild(wrapper);

            setupImageUpload(wrapper); // bind listeners for replace/delete
        });

        // Ensure an empty box at the end for adding new images
        addNextGalleryUploadBox(editProduct.medias.length + 1);
    } else {
        // No existing images, just bind existing box
        galleryContainer.querySelectorAll('.upload-box-wrapper').forEach(setupImageUpload);
    }
    // End Upload Image
});
