document.addEventListener('DOMContentLoaded', () => {
    const button = document.getElementById('readMoreToggle');
    const content = document.getElementById('aboutMore');
    if (!button || !content) return;
    button.addEventListener('click', () => {
        const isExpanded = button.getAttribute('aria-expanded') === 'true';
        content.hidden = isExpanded;
        content.classList.toggle('is-expanded', !isExpanded);
        button.setAttribute('aria-expanded', String(!isExpanded));
        button.textContent = isExpanded ? 'READ MORE +' : 'READ LESS −';
    });
});
