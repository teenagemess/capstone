document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const htmlElement = document.documentElement;
    const darkModeKey = 'theme';

    // Atur tema berdasarkan preferensi di localStorage
    if (localStorage.getItem(darkModeKey) === 'dark') {
        htmlElement.classList.add('dark');
    } else {
        htmlElement.classList.remove('dark');
    }

    // Toggle tema saat tombol diklik
    themeToggleBtn.addEventListener('click', () => {
        if (htmlElement.classList.contains('dark')) {
            htmlElement.classList.remove('dark');
            localStorage.setItem(darkModeKey, 'light');
        } else {
            htmlElement.classList.add('dark');
            localStorage.setItem(darkModeKey, 'dark');
        }
    });
});
