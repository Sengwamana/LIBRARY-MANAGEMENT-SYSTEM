document.addEventListener("DOMContentLoaded", function () {
    console.log("JavaScript loaded for Library Management System.");

    // Add Dark Mode Toggle Button
    const toggleButton = document.createElement('button');
    toggleButton.textContent = 'Toggle Dark Mode';
    toggleButton.setAttribute('id', 'darkModeToggle');
    document.body.appendChild(toggleButton);

    // Styling for the toggle button (you can move this to your CSS if needed)
    toggleButton.style.position = 'fixed';
    toggleButton.style.top = '20px';
    toggleButton.style.right = '20px';
    toggleButton.style.padding = '10px 15px';
    toggleButton.style.backgroundColor = '#007bff';
    toggleButton.style.color = '#fff';
    toggleButton.style.border = 'none';
    toggleButton.style.borderRadius = '5px';
    toggleButton.style.cursor = 'pointer';
    toggleButton.style.boxShadow = '0 4px 12px rgba(0, 123, 255, 0.2)';
    toggleButton.style.transition = 'background-color 0.3s ease';

    // Toggle dark mode and store preference in localStorage
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');

        // Save dark mode preference in localStorage
        const isDarkMode = document.body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');
    }

    // Check localStorage for dark mode preference
    const storedPreference = localStorage.getItem('darkMode');
    if (storedPreference === 'enabled') {
        document.body.classList.add('dark-mode'); // Enable dark mode if it was saved previously
    }

    // Attach event listener to the button
    toggleButton.addEventListener('click', toggleDarkMode);
});
  // Dark Mode Toggle Script
    const toggleDarkModeBtn = document.querySelector('.toggle-dark-mode-btn');
    toggleDarkModeBtn.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
    });

    // Section Transition Script
    const sections = document.querySelectorAll('section');

    function handleSectionVisibility() {
        sections.forEach(section => {
            const rect = section.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                section.classList.add('visible');
            } else {
                section.classList.remove('visible');
            }
        });
    }

    window.addEventListener('scroll', handleSectionVisibility);
    window.addEventListener('load', handleSectionVisibility);