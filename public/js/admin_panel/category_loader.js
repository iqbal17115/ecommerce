$(document).ready(function () {

    // ---------------- GLOBAL STATE ----------------
    let categoryCache = null;
    let categoryStack = [];
    let currentCategories = [];
    let selectedCategoryId = window.PRODUCT_DATA?.category_id || null;
    let selectedCategoryName = window.PRODUCT_DATA?.category?.name || null;

    const dropdown1 = {
        menu: $(".category-list-dropdown"),
        button: $("#categoryDropdownButton"),
        container: $(".category-dropdown-menu")
    };

    const $step2Wrapper = $("#categoryDropdownWrapperStep2");

    // ------------------------------------------------
    // Prevent dropdown from closing on inside click
    // ------------------------------------------------
    $(document).on("click", ".category-dropdown-menu", function (e) {
        e.stopPropagation();
    });

    // ------------------------------------------------
    // STEP 1 Toggle Dropdown
    // ------------------------------------------------
    dropdown1.button.on("click", function (e) {
        e.stopPropagation();
        dropdown1.container.toggle();

        if (!categoryCache) {
            loadCategories(dropdown1);
        } else {
            categoryStack = [];
            renderCategories(categoryCache, false, dropdown1);
        }
    });

    // ------------------------------------------------
    // Highlight the selected category
    // ------------------------------------------------
    function highlightSelected(scope) {
        if (!selectedCategoryId) return;

        scope.menu.find(".category-item").each(function () {
            if (String($(this).data("id")) === String(selectedCategoryId)) {
                $(this).addClass("selected-category");
            }
        });
    }

    // ------------------------------------------------
    // Render categories in dropdown
    // ------------------------------------------------
    function renderCategories(categories, isChild, scope) {
        let html = "";

        if (isChild) {
            html += '<div class="category-back">&larr; Back</div>';
        }

        html += categories
            .map(
                (cat) => `
                    <div class="category-item-wrapper">
                        <div class="category-item" data-id="${cat.id}" data-has-children="${cat.has_children}">
                            <span>${cat.name}</span>
                            ${cat.has_children ? '<i class="fas fa-chevron-right"></i>' : ""}
                        </div>
                    </div>
                `
            )
            .join("");

        currentCategories = categories;
        scope.menu.html(html);

        highlightSelected(scope);

        // Category click
        scope.menu.find(".category-item").off("click").on("click", function (e) {
            e.stopPropagation();

            const id = $(this).data("id");
            const name = $(this).find("span").text();
            const hasChildren = $(this).data("has-children");

            if (hasChildren) {
                loadCategories(scope, id);
            } else {
                selectCategory(id, name);
                scope.container.hide();
                syncStep2Dropdown();
            }
        });

        // Back
        scope.menu.find(".category-back").off("click").on("click", function () {
            if (categoryStack.length) {
                const prev = categoryStack.pop();
                renderCategories(prev.categories, prev.parent, scope);
            } else {
                renderCategories(categoryCache, false, scope);
            }
        });
    }

    // ------------------------------------------------
    // Select Category
    // ------------------------------------------------
    function selectCategory(id, name) {
        selectedCategoryId = id;
        selectedCategoryName = name;

        $("#selectedCategoryId").val(id);
        $("#selectedCategoryDisplay").text(name);

        // Move to step 2
        $(".basic-info-category-step").hide();
        $(".product-details-step").show();
    }

    // ------------------------------------------------
    // Load Categories
    // ------------------------------------------------
    function loadCategories(scope, parentId = null) {
        scope.menu.html(`
            <div class="text-center py-3">
                <div class="spinner-border text-secondary"></div>
            </div>
        `);

        getDetails(
            `/categories?parent_id=${parentId || ""}`,
            function (response) {
                const categories = response.results || [];

                if (!parentId) {
                    categoryCache = categories;
                    categoryStack = [];
                } else {
                    categoryStack.push({
                        categories: currentCategories,
                        parent: true,
                    });
                }

                renderCategories(categories, !!parentId, scope);
            },
            function () {
                scope.menu.html(`<div class="text-danger py-2 text-center">Failed to load</div>`);
            }
        );
    }

    // ------------------------------------------------
    // Click outside: hide dropdown
    // ------------------------------------------------
    $(document).on("click", function (e) {
        if (!$(e.target).closest(".category-dropdown-wrapper").length) {
            $(".category-dropdown-menu").hide();
            categoryStack = [];
        }
    });

    // ------------------------------------------------
    // Search filter
    // ------------------------------------------------
    $(document).on("input", ".category-search-input-dropdown", function () {
        const keyword = $(this).val().toLowerCase();
        $(this)
            .closest(".category-dropdown-menu")
            .find(".category-item-wrapper")
            .each(function () {
                const text = $(this).text().toLowerCase();
                $(this).toggle(text.includes(keyword));
            });
    });

    // ------------------------------------------------
    // STEP-2 DROPDOWN
    // ------------------------------------------------
    function syncStep2Dropdown() {
        const html = `
        <div class="category-dropdown-wrapper">
            <div class="category-dropdown">
                <button type="button" 
                    class="btn btn-outline-secondary dropdown-toggle form-control categoryBtnStep2">
                    <span class="categoryDisplayStep2">${selectedCategoryName ?? "Please select category"}</span>
                    <i class="fas fa-chevron-down"></i>
                </button>

                <div class="category-dropdown-menu categoryMenuStep2">
                    <div class="px-3 py-2">
                        <input type="text" class="form-control category-search-input-dropdown" placeholder="Search category">
                    </div>
                    <div class="category-list-dropdown categoryListStep2"></div>
                </div>
            </div>
            <input type="hidden" name="category_id" id="selectedCategoryIdStep2" value="${selectedCategoryId ?? ""}">
        </div>
        `;

        $step2Wrapper.html(html);

        const scope2 = {
            menu: $step2Wrapper.find(".categoryListStep2"),
            button: $step2Wrapper.find(".categoryBtnStep2"),
            container: $step2Wrapper.find(".categoryMenuStep2"),
        };

        scope2.button.on("click", function (e) {
            e.stopPropagation();
            scope2.container.toggle();

            if (!categoryCache) loadCategories(scope2);
            else renderCategories(categoryCache, false, scope2);
        });

        if (categoryCache) {
            renderCategories(categoryCache, false, scope2);
        }
    }

    // ------------------------------------------------
    // Auto-fill Step-2 for Edit Mode
    // ------------------------------------------------
    if (selectedCategoryId) {
        $(".basic-info-category-step").hide();
        $(".product-details-step").show();
        syncStep2Dropdown();
    }

    // ------------------ EDIT MODE SETUP ------------------
    if (window.PRODUCT_DATA && window.PRODUCT_DATA.id) {
        // 1️⃣ Set selected category from product
        selectedCategoryId = window.PRODUCT_DATA.category_id;
        selectedCategoryName = window.PRODUCT_DATA.category.name ?? "";

        // 2️⃣ Update step–1 hidden fields & UI text
        $("#selectedCategoryId").val(selectedCategoryId);
        $("#selectedCategoryDisplay").text(selectedCategoryName);

        $("#product_name").val(window.PRODUCT_DATA.name);
        $("#product_name_step2").val(window.PRODUCT_DATA.name);

        // 3️⃣ Load category list
        loadCategories(dropdown1);

        // 4️⃣ Highlight after categories load
        setTimeout(() => {
            highlightSelected(dropdown1);
        }, 300);

        // 5️⃣ Build step–2 dropdown
        setTimeout(() => {
            syncStep2Dropdown();

            if (window.scopeStep2Ref) {
                window.scopeStep2Ref.display.text(selectedCategoryName);
                window.scopeStep2Ref.input.val(selectedCategoryId);

                highlightSelected(window.scopeStep2Ref);
            }
        }, 400);

        // 6️⃣ Auto-open Step–2 (Your requirement)
        document.querySelector('.basic-info-category-step').style.display = 'none';
        document.querySelector('.product-details-step').style.display = 'block';

        console.log("Category set to:", selectedCategoryName, selectedCategoryId);
    }
});
