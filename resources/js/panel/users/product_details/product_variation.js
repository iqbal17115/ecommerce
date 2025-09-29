document.addEventListener('DOMContentLoaded', function () {
    const variationMap = window.variationMap || {};
    const selectedAttributes = {};
    const hiddenInput = document.getElementById('selected_variation_id');

    function updateActiveButton(attribute, value) {
        const buttons = document.querySelectorAll(`[data-attribute="${attribute}"] .variation-btn`);
        buttons.forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.value === value) {
                btn.classList.add('active');
            }
        });
    }

    function findMatchingVariation() {
        for (const [variationId, attributes] of Object.entries(variationMap)) {
            const isMatch = Object.entries(selectedAttributes).every(
                ([key, val]) => attributes[key] === val
            );
            if (isMatch) return variationId;
        }
        return null;
    }

    function filterOptions() {
        const allButtons = document.querySelectorAll('.variation-btn');

        allButtons.forEach(button => {
            const attr = button.dataset.attribute;
            const val = button.dataset.value;
            let isValid = false;

            for (const attributes of Object.values(variationMap)) {
                let match = true;
                for (const [selectedAttr, selectedVal] of Object.entries(selectedAttributes)) {
                    if (attr === selectedAttr) continue; // skip current attribute being checked
                    if (attributes[selectedAttr] !== selectedVal) {
                        match = false;
                        break;
                    }
                }

                if (match && attributes[attr] === val) {
                    isValid = true;
                    break;
                }
            }

            button.disabled = !isValid;
            button.classList.toggle('disabled', !isValid);
        });
    }

    function handleVariationClick(e) {
        const button = e.currentTarget;
        const attr = button.dataset.attribute;
        const val = button.dataset.value;

        selectedAttributes[attr] = val;
        updateActiveButton(attr, val);
        filterOptions();

        const matchedId = findMatchingVariation();
        if (hiddenInput) hiddenInput.value = matchedId || '';
    }

    function clearSelection() {
        Object.keys(selectedAttributes).forEach(attr => delete selectedAttributes[attr]);
        document.querySelectorAll('.variation-btn').forEach(btn => {
            btn.classList.remove('active');
            btn.disabled = false;
            btn.classList.remove('disabled');
        });
        if (hiddenInput) hiddenInput.value = '';
    }

    const buttons = document.querySelectorAll('.variation-btn');
    buttons.forEach(button => button.addEventListener('click', handleVariationClick));

    const clearButton = document.getElementById('clear-variations');
    if (clearButton) {
        clearButton.addEventListener('click', clearSelection);
    }
});
