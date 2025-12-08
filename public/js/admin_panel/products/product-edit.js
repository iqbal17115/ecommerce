/**
 * Common function to populate form fields from specs
 * @param {Array} specs - Array of { attribute_name, value }
 */
function populateSpecs(specs) {
    if (!specs || !specs.length) return;

    // Helper to get value by attribute_name
    const getValue = (attr) => {
        const spec = specs.find(s => s.attribute_name === attr);
        return spec ? spec.value : '';
    };

    // Set input fields
    const fields = {
        package_weight: 'package_weight',
        package_length: 'length',
        package_width: 'width',
        package_height: 'height',
        dangerous_goods: 'dangerous_goods',
        weight_unit: 'weight_unit'
        // Add more attributes if needed
    };

    for (const [attr, selectorName] of Object.entries(fields)) {
        const value = getValue(attr);
        if (!value) continue;

        // Handle radio buttons
        const radio = document.querySelector(`input[name="${selectorName}"][type="radio"][value="${value}"]`);
        if (radio) {
            radio.checked = true;
            continue;
        }

        // Handle select elements
        const select = document.querySelector(`select[name="${selectorName}"]`);
        if (select) {
            select.value = value;
            continue;
        }

        // Handle normal inputs
        const input = document.querySelector(`input[name="${selectorName}"]`);
        if (input) input.value = value;
    }
}

function setFormFields(data, fieldMap) {
    Object.keys(fieldMap).forEach(key => {
        const element = document.getElementById(fieldMap[key]);
        if (element) {
            element.value = data[key] ?? '';
        }
    });
}


document.addEventListener('DOMContentLoaded', function () {

    let ALL_INT_SIZES = [];
    let ALL_COLOR_OPTIONS = [];

    function getUsedVariant1Values() {
        const usedValues = [];
        document.querySelectorAll('#variantPills_1 .variant-input-row[data-is-fixed="true"]').forEach(row => {
            usedValues.push(row.getAttribute('data-value').toLowerCase());
        });


        return usedValues;
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

    function handleVariant1SelectChange(selectElement) {
        const value = selectElement.value.trim();
        if (!value) return;

        // Find the row element this select belongs to
        const currentDynamicRow = selectElement.closest('.variant-input-row[data-is-fixed="false"]');
        if (currentDynamicRow) {
            createNewFixedRow(currentDynamicRow, value);
        }
    }

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

        // ------- TABLE HEADER -------
        let headerHtml = '';
        variants.forEach(v => headerHtml += `<th>${v.name}</th>`);
        headerHtml += `
        <th class="text-danger">* Price</th>
        <th>Special Price</th>
        <th class="text-danger">* Stock</th>
        <th>Seller SKU</th>
        <th>Free Items</th>
        <th>Availability</th>
    `;
        tableHeader.innerHTML = headerHtml;

        // ------- TABLE BODY -------
        tableBody.innerHTML = '';

        // DYNAMIC ROWSPAN FOR EACH ATTRIBUTE COLUMN
        const rowSpans = [];
        let total = combinations.length;

        for (let i = 0; i < variants.length; i++) {
            rowSpans[i] = total / variants[i].values.length;
            total = rowSpans[i];
        }

        // SKU LOGIC
        const productName = document.getElementById('product_name')?.value.trim().toUpperCase() || 'PROD';
        const baseIdentifier = productName.substring(0, 4).replace(/\W/g, '');

        let bodyHtml = '';

        combinations.forEach((combo, index) => {
            bodyHtml += `<tr>`;

            // --- APPLY ROWSPAN COLUMN BY COLUMN ---
            variants.forEach((v, i) => {
                if (index % rowSpans[i] === 0) {
                    bodyHtml += `<td rowspan="${rowSpans[i]}">${combo[i]}</td>`;
                }
            });

            const rowIndex = index;
            const uniqueKey = combo.map(v => v.replace(/\W/g, '')).join('_');
            const defaultUniqueSku = `${baseIdentifier}-${uniqueKey.replace(/_/g, '-')}`.toUpperCase();

            // --- INPUT FIELDS ---
            bodyHtml += `
            <td><input type="number" name="combinations[${rowIndex}][price]" class="form-control form-control-sm" required></td>
            <td><input type="number" name="combinations[${rowIndex}][special_price]" class="form-control form-control-sm"></td>
            <td><input type="number" name="combinations[${rowIndex}][stock]" class="form-control form-control-sm" required></td>
            <td><input type="text" name="combinations[${rowIndex}][seller_sku]" value="${defaultUniqueSku}" class="form-control form-control-sm" required></td>
            <td><input type="text" name="combinations[${rowIndex}][free_items]" class="form-control form-control-sm"></td>
            <td>
                <label class="switch">
                    <input type="checkbox" name="combinations[${rowIndex}][available]" checked>
                    <span class="slider round"></span>
                </label>
            </td>
        `;

            // Hidden option values
            combo.forEach(value => {
                bodyHtml += `<input type="hidden" name="combinations[${rowIndex}][option_values][]" value="${value}">`;
            });

            bodyHtml += `</tr>`;
        });

        tableBody.innerHTML = bodyHtml;
    }


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

    function addVariantPill(listElement, value) {
        if (!value || value.trim() === '') return;
        const cleanValue = value.trim();
        if (listElement.querySelector(`.variant-pill[data-value="${cleanValue}"]`)) return;

        listElement.appendChild(createVariantPill(cleanValue));

        bindDynamicListeners();
    }

    function handleSizeVariant(variantIndex, variant) {
        const container = document.getElementById(`variantPills_${variantIndex}`);
        const nameInput = document.getElementById(`variant_name_${variantIndex}`);
        const sizeWrapper = document.querySelector('#v-pills-int .size-grid');

        nameInput.value = "Size";

        currentSelectedModalSizes = variant.options.map(o => o.value);

        populateSizeModalGrid();

        container.innerHTML = '';
        currentSelectedModalSizes.forEach(size => {
            addVariantPill(container, size);
        });

        updateSelectedSizeCount();

        // ⭐⭐⭐ FIX: এখনই table তৈরি করুন
        renderVariantTable();
    }



    function loadEditVariants() {
        if (!window.EDIT_PRODUCT) return;

        const product = window.EDIT_PRODUCT;
        product.variants.forEach((variant, index) => {
            const variantIndex = index + 1;
            const container = document.getElementById(`variantPills_${variantIndex}`);
            if (!container) return;

            const nameInput = document.getElementById(`variant_name_${variantIndex}`);
            if (nameInput) nameInput.value = variant.name;

            // -------------------------------
            // ✅ SPECIAL HANDLING FOR SIZE
            // -------------------------------
            if (variant.name.toLowerCase() === "size") {
                handleSizeVariant(variantIndex, variant);
                return; // IMPORTANT: skip default logic
            }

            // -------------------------------
            // NORMAL VARIANT HANDLING
            // -------------------------------
            variant.options.forEach(option => {
                const row = document.createElement('div');
                row.className = 'variant-input-row d-flex align-items-center mb-2';
                row.setAttribute('data-is-fixed', 'true');
                row.setAttribute('data-value', option.value);

                row.innerHTML = `
                <input type="text" class="form-control variant-value-input" value="${option.value}" readonly style="pointer-events: none;">
                <div class="ml-2 variant-media-links" style="visibility: visible;">
                    <a href="#">Upload</a> | <a href="#">Media Center</a>
                </div>
                <i class="fas fa-trash text-muted ml-3 remove-variant-value" style="cursor: pointer;"></i>
                <i class="fas fa-bars text-muted ml-2 drag-handle" style="cursor: grab;"></i>
            `;
                container.appendChild(row);
                bindVariant1Listeners(row);
            });

            // Add the dynamic (empty) row
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

            container.appendChild(newDynamicRow);
            bindVariant1Listeners(newDynamicRow);

            const select = newDynamicRow.querySelector('select');
            updateVariant1DynamicSelect(select);
        });

        renderEditCombinations();
    }

    function renderEditCombinations() {
        if (!window.EDIT_PRODUCT) return;

        const product = window.EDIT_PRODUCT;
        const tableBody = document.getElementById('variantTableBody');
        tableBody.innerHTML = '';

        product.combinations.forEach((combo) => {

            // combo.key MUST be provided from backend
            const key = combo.id;

            const row = document.createElement('tr');

            // Show option values as table columns
            combo.option_values.forEach(value => {
                row.innerHTML += `<td>${value}</td>`;
            });

            // Main fields
            row.innerHTML += `
            <td>
                <input type="number"
                       name="combinations[${key}][price]"
                       class="form-control form-control-sm"
                       value="${combo.price ?? ''}"
                       required>
            </td>

            <td>
                <input type="number"
                       name="combinations[${key}][special_price]"
                       class="form-control form-control-sm"
                       value="${combo.special_price ?? ''}">
            </td>

            <td>
                <input type="number"
                       name="combinations[${key}][stock]"
                       class="form-control form-control-sm"
                       value="${combo.stock ?? ''}"
                       required>
            </td>

            <td>
                <input type="text"
                       name="combinations[${key}][seller_sku]"
                       class="form-control form-control-sm"
                       value="${combo.seller_sku ?? ''}"
                       required>
            </td>

            <td>
                <input type="text"
                       name="combinations[${key}][free_items]"
                       class="form-control form-control-sm"
                       value="${combo.free_items ?? ''}">
            </td>

            <td>
                <label class="switch">
                    <input type="checkbox"
                           name="combinations[${key}][available]"
                           ${combo.available ? 'checked' : ''}>
                    <span class="slider round"></span>
                </label>
            </td>
        `;

            // Hidden option values
            combo.option_values.forEach(val => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = `combinations[${key}][option_values][]`;
                input.value = val;
                row.appendChild(input);
            });

            tableBody.appendChild(row);
        });
    }

    // Populate Shipping & Warranty fields
    populateSpecs(window.EDIT_PRODUCT.product_specs);

    if (window.EDIT_PRODUCT) {
        setFormFields(window.EDIT_PRODUCT, {
            description: 'description',
            short_description: 'short_description',
            highlights: 'highlights'
        });
    }

    loadEditVariants();
    renderVariantTable();
    renderEditCombinations();
});