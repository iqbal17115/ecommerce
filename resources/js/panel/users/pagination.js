function renderSmartPagination({ current_page, last_page }, onPageClick, containerId = 'pagination-container') {
    const container = document.getElementById(containerId);
    container.innerHTML = '';

    if (last_page <= 1) return;

    const ul = document.createElement('ul');
    ul.className = 'pagination justify-content-center';

    const createPageItem = (label, page = null, isActive = false, isDisabled = false) => {
        const li = document.createElement('li');
        li.className = `page-item ${isActive ? 'active' : ''} ${isDisabled ? 'disabled' : ''}`;

        const a = document.createElement('a');
        a.className = 'page-link';
        a.href = '#';
        a.innerHTML = label;

        if (!isDisabled && page !== null) {
            a.addEventListener('click', function (e) {
                e.preventDefault();
                onPageClick(page);
            });
        }

        li.appendChild(a);
        return li;
    };

    // Prev button
    ul.appendChild(createPageItem('«', current_page - 1, false, current_page === 1));

    const pagesToShow = [];

    // Always show first two pages
    pagesToShow.push(1);
    if (last_page > 1) pagesToShow.push(2);

    // Add dynamic pages around current page
    for (let i = current_page - 1; i <= current_page + 1; i++) {
        if (i > 2 && i < last_page - 1) {
            pagesToShow.push(i);
        }
    }

    // Always show last two pages
    if (last_page > 2) pagesToShow.push(last_page - 1);
    if (last_page > 1) pagesToShow.push(last_page);

    // Remove duplicates and sort
    const uniquePages = [...new Set(pagesToShow)].filter(p => p >= 1 && p <= last_page).sort((a, b) => a - b);

    // Render page buttons with ellipsis
    let lastPageRendered = 0;
    uniquePages.forEach(page => {
        if (page - lastPageRendered > 1) {
            const ellipsis = document.createElement('li');
            ellipsis.className = 'page-item disabled';
            ellipsis.innerHTML = `<span class="page-link ellipsis">…</span>`;
            ul.appendChild(ellipsis);
        }
        ul.appendChild(createPageItem(page, page, current_page === page));
        lastPageRendered = page;
    });

    // Next button
    ul.appendChild(createPageItem('»', current_page + 1, false, current_page === last_page));

    container.appendChild(ul);
}

// Expose globally
window.renderSmartPagination = renderSmartPagination;
