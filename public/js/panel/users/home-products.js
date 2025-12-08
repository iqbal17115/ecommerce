document.addEventListener("DOMContentLoaded", function () {
    let currentFeaturePage = 1;
    const featuresPerPage = 4; // how many features per ajax call
    const productsPerFeature = 8;

    loadFeatures();

    document.getElementById("load-more-features").addEventListener("click", function () {
        loadFeatures();
    });

    function loadFeatures() {
        const url = `/home-features?page=${currentFeaturePage}&limit=${featuresPerPage}&product_limit=${productsPerFeature}`;

        toggleLoader(true);

        fetch(url)
            .then(res => res.json())
            .then(data => {
                const wrapper = document.getElementById("features-wrapper");

                data.results.data.forEach(feature => {
                    wrapper.innerHTML += renderFeature(feature);
                });

                currentFeaturePage++;

                // Hide button if no more pages
                if (!data.results.next_page_url) {
                    document.getElementById("load-more-features").style.display = "none";
                }
            })
            .finally(() => toggleLoader(false));
    }

    function renderFeature(feature) {
        let productsHtml = '';
        feature.products.forEach(p => {
            productsHtml += `
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="product-card shadow-sm bg-white rounded p-2 h-100">
                    <div class="product-img-wrapper position-relative">
                        <img data-src="${p.image}" class="product-img img-fluid">
                    </div>
                    <div class="pt-2">
                        <div class="product-name text-truncate-2">${p.name}</div>
                        <div class="mt-1">
                            <span class="price fw-bold text-danger">৳${p.special_price ?? p.price}</span>
                        </div>
                    </div>
                </div>
            </div>`;
        });

        return `
        <div class="feature-section mb-4">
            <h4>${feature.name}</h4>
            <div class="row g-2">
                ${productsHtml}
            </div>
        </div>`;
    }

    function toggleLoader(show) {
        document.getElementById("global-loader").style.display = show ? "block" : "none";
    }
});
