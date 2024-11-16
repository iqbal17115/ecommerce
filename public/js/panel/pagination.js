function generatePagination(total, perPage, currentPage, onPageChange) {
    const totalPages = Math.ceil(total / perPage);
    const maxVisiblePages = 3;
    let paginationHtml = '';

    if (totalPages <= 1) {
        return '';
    }

    currentPage = Math.min(currentPage, totalPages);
    currentPage = Math.max(currentPage, 1);

    const paginationItems = [];

    // Previous Page link
    if (currentPage > 1) {
        paginationItems.push(
            `<li class="page-item"><a class="page-link pagination-link" href="javascript:void(0);" data-page="${currentPage - 1}">Previous</a></li>`
        );
    }

    const startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
    const endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

    // Generate the page number links
    for (let i = startPage; i <= endPage; i++) {
        const isActive = i === currentPage ? 'active' : '';
            if (i === 1 || i === totalPages || Math.abs(currentPage - i) < maxVisiblePages - 1) {
                const itemHtml = i === currentPage
                ? `
                <li class="page-item">
                    <input id="pageInput" class="page-link page-input pagination_input_field active" type="number" value="${currentPage}" min="1" max="${totalPages}" style="width: 50px;">
                </li>
                <li class="page-item">
                    <a class="page-link go-button" href="javascript:void(0);">Go</a>
                </li>
                `
                : `
                <li class="page-item">
                    <a class="page-link pagination-link" href="javascript:void(0);" data-page="${i}">${i}</a>
                </li>
                `;

            paginationItems.push(itemHtml);
            } else if (i === currentPage - maxVisiblePages + 2 || i === currentPage + maxVisiblePages - 2) {
                paginationItems.push('<li class="page-item disabled"><span class="page-link">...</span></li>');
            }
    }

    // Next Page link
    if (currentPage < totalPages) {
        paginationItems.push(
            `<li class="page-item"><a class="page-link pagination-link" href="javascript:void(0);" data-page="${currentPage + 1}">Next</a></li>`
        );
    }

    // Last Page link
    if (currentPage < totalPages - maxVisiblePages + 1) {
        paginationItems.push(
            `<li class="page-item disabled"><span class="page-link">...</span></li>
            <li class="page-item">
                <a class="page-link pagination-link" href="javascript:void(0);" data-page="${totalPages}">${totalPages}</a>
            </li>`
        );
    }

    // Join all pagination items into a single string
    paginationHtml = `<ul class="pagination">${paginationItems.join('')}</ul>`;
    return paginationHtml;
}
