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

    // --- New/Updated selectCategory function ---
    function selectCategory(categoryId, categoryPath) {
        // 1. Update Category Display and Hidden Field
        selectedCategoryDisplay.textContent = categoryPath;
        selectedCategoryIdInput.value = categoryId;

        // Assuming jQuery/Bootstrap is available to hide the dropdown
        if (typeof $ !== 'undefined') {
            $(categoryDropdownButton).dropdown('hide');
        }

        // --- AUTOMATIC STEP TRANSITION LOGIC ---

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


        // 1. POPULATE HIDDEN FIELDS
        hiddenProductName.value = productName;
        hiddenCategoryId.value = categoryId;
        hiddenCategoryPath.value = categoryPath;

        // 2. UPDATE SUMMARY DISPLAY (in Step 2)
        const summaryProductName = document.getElementById('summaryProductName');
        const summaryCategoryPath = document.getElementById('summaryCategoryPath');
        const readOnlyProductName = document.getElementById('readOnlyProductName');
        const readOnlyCategoryPath = document.getElementById('readOnlyCategoryPath');

        if (summaryProductName) summaryProductName.textContent = productName;
        if (summaryCategoryPath) summaryCategoryPath.textContent = categoryPath;
        if (readOnlyProductName) readOnlyProductName.textContent = productName;
        if (readOnlyCategoryPath) readOnlyCategoryPath.textContent = categoryPath;


        // 3. Transition to Step 2
        const basicInfoCategorySection = document.querySelector('.basic-info-category-step');
        const productDetailsSection = document.querySelector('.product-details-step');
        const confirmButton = document.getElementById('confirmButton');

        if (basicInfoCategorySection && productDetailsSection) {
            basicInfoCategorySection.style.display = 'none';
            productDetailsSection.style.display = 'block';

            // Show the Confirm button (if you still need a final submit button)
            if (confirmButton) confirmButton.style.display = 'inline-block';

            // 4. Calculate initial fill rate for Step 2
            calculateFillRate();
        }
        // --- END OF AUTOMATIC STEP TRANSITION LOGIC ---
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
    const ALL_INT_SIZES = ["3XS", "XXS", "XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL", "5XL", "XS/S", "S/M", "M/L", "L/XL", "W22 L30", "W23 L30", "W24 L30", "W25 L30", "W27 L30", "W35 L30", "W36 L30", "W37 L30", "W38 L30", "W39 L30", "W40 L30", "W41 L30", "W42 L30", "W43 L30", "W44 L30", "W22 L32", "W23 L32", "W24 L32", "W25 L32", "W27 L32", "W35 L32", "W37 L32", "W39 L32", "W41 L32", "W42 L32"];
    const ALL_COLOR_OPTIONS = ["Red", "Green", "Blue", "Yellow", "Maroon", "Black", "White", "Gray"];


    // --- Helper Functions ---

    function getVariantState() {
        const variants = [];
        document.querySelectorAll('.variant-block').forEach(block => {
            const index = block.getAttribute('data-variant-index');
            const nameInput = document.getElementById(`variant_name_${index}`);
            const name = nameInput ? (nameInput.value || `Variant ${index}`) : `Variant ${index}`;

            const values = [];

            if (parseInt(index) === 1) {
                // Variant 1: Get values from the data-value attribute set on fixed rows
                block.querySelectorAll('.variant-pills-list-container .variant-input-row[data-is-fixed="true"]').forEach(row => {
                    const value = row.getAttribute('data-value');
                    if (value) values.push(value);
                });
            } else {
                // Variant 2: Get values from the generated pills
                block.querySelectorAll('.variant-pills-list .variant-pill').forEach(pill => {
                    values.push(pill.getAttribute('data-value'));
                });
            }

            if (values.length > 0) {
                variants.push({
                    index: parseInt(index),
                    name: name,
                    values: values,
                    isImageVariant: block.querySelector('.variant-image-checkbox')?.checked || false
                });
            }
        });
        return variants;
    }

    function generateCombinations(variants) {
        if (variants.length === 0) return [];

        let combinations = variants[0].values.map(v => [v]);

        for (let i = 1; i < variants.length; i++) {
            const nextValues = variants[i].values;
            const newCombinations = [];

            combinations.forEach(currentCombo => {
                nextValues.forEach(nextValue => {
                    newCombinations.push([...currentCombo, nextValue]);
                });
            });
            combinations = newCombinations;
        }
        return combinations;
    }

    function renderVariantTable() {
        const variants = getVariantState();
        const combinations = generateCombinations(variants);
        const tableHeader = document.getElementById('variantTableHeader');
        const tableBody = document.getElementById('variantTableBody');
        const tablePlaceholder = document.getElementById('tablePlaceholder');
        const tableEl = document.querySelector('.variant-price-stock-table');

        if (combinations.length === 0) {
            tableHeader.innerHTML = '';
            tableBody.innerHTML = '';
            tablePlaceholder.style.display = 'block';
            tableEl.style.display = 'none';
            return;
        }

        tablePlaceholder.style.display = 'none';
        tableEl.style.display = 'table';

        tableHeader.innerHTML = '';
        let headerHtml = '';

        variants.forEach(v => {
            headerHtml += `<th>${v.name}</th>`;
        });

        headerHtml += `
        <th class="text-danger">* Price</th>
        <th>Special Price</th>
        <th class="text-danger">* Stock</th>
        <th>Seller SKU</th>
        <th>Free Items</th>
        <th>Availability</th>
    `;
        tableHeader.innerHTML = headerHtml;

        tableBody.innerHTML = '';

        const rowSpan = variants.length > 1 ? combinations.length / variants[0].values.length : 1;

        let bodyHtml = '';
        combinations.forEach((combo, index) => {
            const uniqueKey = combo.map(v => v.replace(/\W/g, '')).join('_');

            bodyHtml += `<tr>`;

            if (index % rowSpan === 0) {
                bodyHtml += `<td ${rowSpan > 1 ? `rowspan="${rowSpan}"` : ''}>${combo[0]}</td>`;
            }

            combo.slice(1).forEach(value => {
                bodyHtml += `<td>${value}</td>`;
            });

            bodyHtml += `
            <td><input type="number" name="price_${uniqueKey}" class="form-control form-control-sm" placeholder="Price"></td>
            <td>
                <input type="number" name="special_price_${uniqueKey}" class="form-control form-control-sm" placeholder="Special Price">
            </td>
            <td><input type="number" name="stock_${uniqueKey}" class="form-control form-control-sm" placeholder="Stock"></td>
            <td><input type="text" name="sku_${uniqueKey}" class="form-control form-control-sm" placeholder="Seller SKU"></td>
            <td><input type="text" name="free_items_${uniqueKey}" class="form-control form-control-sm" placeholder=""></td>
            <td>
                <label class="switch">
                    <input type="checkbox" name="available_${uniqueKey}" checked>
                    <span class="slider round"></span>
                </label>
            </td>
        </tr>`;
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

    function updateVariant1DynamicSelect(selectElement) {
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
    $('#sizeSelectionModal').on('show.bs.modal', function (e) {
        currentSelectedModalSizes = [];
        document.querySelectorAll('#variantPills_2 .variant-pill').forEach(pill => {
            currentSelectedModalSizes.push(pill.getAttribute('data-value'));
        });
        populateSizeModalGrid();
        updateSelectedSizeCount();
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
        const sku = document.querySelector('.bulk-input[data-field="sku"]').value;

        if (price) { document.querySelectorAll('input[name^="price_"]').forEach(input => input.value = price); }
        if (specialPrice) { document.querySelectorAll('input[name^="special_price_"]').forEach(input => input.value = specialPrice); }
        if (stock) { document.querySelectorAll('input[name^="stock_"]').forEach(input => input.value = stock); }
        if (sku) { document.querySelectorAll('input[name^="sku_"]').forEach(input => input.value = sku); }

        alert('Bulk fields applied to all visible rows!');
    });
    // --- End of Variant Management Logic ---

    // --- PRODUCT IMAGES LOGIC ---

    function setupImageUpload(wrapper) {
        const input = wrapper.querySelector('.image-input');
        const uploadBox = wrapper.querySelector('.upload-box');
        const type = wrapper.dataset.type;
        const index = parseInt(wrapper.dataset.index);

        if (!input) return;

        input.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // 1. Display the preview image
                    uploadBox.innerHTML = `
                    <img src="${e.target.result}" class="preview-image" alt="Product Preview">
                    <div class="upload-icons">
                        <i class="fas fa-trash-alt delete-image-icon"></i>
                        <i class="fas fa-edit edit-image-icon"></i>
                    </div>
                    ${input.outerHTML} 
                `;
                    uploadBox.classList.remove('dashed-border');
                    uploadBox.classList.add('has-image');

                    // Rebind the delete listener after innerHTML update
                    uploadBox.querySelector('.delete-image-icon').addEventListener('click', handleDeleteImage);

                    // 2. Add the next gallery upload box if this one was just filled
                    if (type === 'gallery' && index === getLastGalleryIndex()) {
                        addNextGalleryUploadBox(index + 1);
                    }
                };
                reader.readAsDataURL(file);
            }
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
            <input type="file" name="gallery_images[]" class="image-input" accept="image/*">
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
        skuBulkInput.addEventListener('input', function() {
            skuBulkCount.textContent = this.value.length;
        });
        // Set initial count if there's a default value
        skuBulkCount.textContent = skuBulkInput.value.length;
    }
});