document.addEventListener('DOMContentLoaded', () => {
    const search = document.getElementById('bookingSearch');
    const status = document.getElementById('bookingStatus');
    const rows = Array.from(document.querySelectorAll('#bookingRows tr[data-status]'));
    const noResults = document.getElementById('noSearchResults');

    const filterRows = () => {
        const query = (search?.value || '').trim().toLowerCase();
        const selectedStatus = status?.value || 'all';
        let visibleCount = 0;

        rows.forEach((row) => {
            const matchesSearch = (row.dataset.search || '').includes(query);
            const matchesStatus = selectedStatus === 'all' || row.dataset.status === selectedStatus;
            const visible = matchesSearch && matchesStatus;
            row.hidden = !visible;
            if (visible) visibleCount += 1;
        });

        if (noResults) noResults.hidden = visibleCount !== 0 || rows.length === 0;
    };

    search?.addEventListener('input', filterRows);
    status?.addEventListener('change', filterRows);
});
