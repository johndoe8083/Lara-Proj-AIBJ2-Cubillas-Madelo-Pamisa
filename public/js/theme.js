(() => {
    const root = document.documentElement;
    const button = document.getElementById('themeToggle');
    const label = document.getElementById('themeLabel');
    const metaTheme = document.getElementById('themeColorMeta');
    if (!button) return;

    let savedTheme = null;
    try { savedTheme = localStorage.getItem('barberhub-theme'); } catch (error) {}
    const colorScheme = window.matchMedia?.('(prefers-color-scheme: light)');
    const prefersLight = colorScheme?.matches;
    let hasUserPreference = savedTheme === 'light' || savedTheme === 'dark';
    let currentTheme = savedTheme === 'light' || savedTheme === 'dark'
        ? savedTheme
        : (prefersLight ? 'light' : 'dark');

    function applyTheme(theme, persist = true) {
        currentTheme = theme;
        root.setAttribute('data-theme', theme);
        const isLight = theme === 'light';
        button.setAttribute('aria-pressed', String(isLight));
        button.setAttribute('aria-label', isLight ? 'Switch to dark appearance' : 'Switch to light appearance');
        if (label) label.textContent = isLight ? 'Light' : 'Dark';
        if (metaTheme) metaTheme.setAttribute('content', isLight ? '#f5f2eb' : '#10100f');
        if (persist) {
            try { localStorage.setItem('barberhub-theme', theme); } catch (error) {}
        }
    }

        applyTheme(currentTheme, false);
        button.addEventListener('click', () => {
        hasUserPreference = true;
        applyTheme(currentTheme === 'dark' ? 'light' : 'dark');
    });

        colorScheme?.addEventListener('change', (event) => {
        if (!hasUserPreference) {
            applyTheme(event.matches ? 'light' : 'dark', false);
        }
    });
})();
