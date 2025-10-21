document.addEventListener('DOMContentLoaded', function() {
    // --- STEP 1: Product Name Character Count ---
    const productNameInput = document.getElementById('product_name');
    const productNameCount = document.getElementById('productNameCount');

    if (productNameInput && productNameCount) {
        productNameInput.addEventListener('input', function() {
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

    function selectCategory(categoryId, categoryPath) {
        selectedCategoryDisplay.textContent = categoryPath;
        selectedCategoryIdInput.value = categoryId;
        // Assuming jQuery/Bootstrap is available to hide the dropdown
        if (typeof $ !== 'undefined') {
            $(categoryDropdownButton).dropdown('hide');
        }
    }

    categoryItems.forEach(item => {
        item.addEventListener('click', function(event) {
            event.preventDefault();
            selectCategory(this.dataset.categoryId, this.dataset.categoryPath);
            categoryItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });

    recentlyUsedTags.forEach(tag => {
        tag.addEventListener('click', function() {
            selectCategory(this.dataset.categoryId, this.textContent.trim());
            recentlyUsedTags.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });

    if (categorySearchInput) {
        categorySearchInput.addEventListener('input', function() {
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

        nextStepButton.addEventListener('click', function() {
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

        cancelButton.addEventListener('click', function() {
            if (confirm('Are you sure you want to cancel? All unsaved changes will be lost.')) {
                // Replace with your actual cancellation logic (e.g., redirect)
                // window.location.href = '/admin/products';
            }
        });
    }

    // --- STEP 2: Product Specification Show More/Less Toggle ---
    const specToggleLink = document.querySelector('.spec-toggle-link');

    if (specToggleLink) {
        specToggleLink.addEventListener('click', function(event) {
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

});