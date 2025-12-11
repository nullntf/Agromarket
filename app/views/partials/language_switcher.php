<!-- Language Switcher -->
<div id="language-switcher" class="relative">
    <button id="language-button"
            class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition-colors focus:outline-none"
            aria-expanded="false">
        <i class="fas fa-globe text-lg"></i>
        <span class="text-sm font-medium"><?php echo strtoupper(isset($_SESSION['language']) && $_SESSION['language'] === 'en' ? 'EN' : 'ES'); ?></span>
        <i id="language-chevron" class="fas fa-chevron-down text-xs ml-1 transition-transform duration-200"></i>
    </button>
    <div id="language-dropdown"
         class="hidden absolute right-0 mt-2 w-36 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
        <a href="?lang=es"
           class="language-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            <span class="w-5 h-4 mr-2 rounded-sm overflow-hidden">
                <img src="https://flagcdn.com/w20/es.png" alt="Español" class="w-full h-full object-cover">
            </span>
            Español
        </a>
        <a href="?lang=en"
           class="language-option flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
            <span class="w-5 h-4 mr-2 rounded-sm overflow-hidden">
                <img src="https://flagcdn.com/w20/gb.png" alt="English" class="w-full h-full object-cover">
            </span>
            English
        </a>
    </div>
</div>

<script>
    // Language switcher JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        const languageButton = document.getElementById('language-button');
        const languageDropdown = document.getElementById('language-dropdown');
        const languageChevron = document.getElementById('language-chevron');
        const languageOptions = document.querySelectorAll('.language-option');

        if (languageButton && languageDropdown) {
            // Toggle dropdown
            languageButton.addEventListener('click', function(e) {
                e.stopPropagation();
                const isHidden = languageDropdown.classList.contains('hidden');
                if (isHidden) {
                    languageDropdown.classList.remove('hidden');
                    languageChevron.style.transform = 'rotate(180deg)';
                } else {
                    languageDropdown.classList.add('hidden');
                    languageChevron.style.transform = 'rotate(0deg)';
                }
                languageButton.setAttribute('aria-expanded', isHidden);
            });

            // Close menu when clicking on an option
            languageOptions.forEach(option => {
                option.addEventListener('click', function() {
                    languageDropdown.classList.add('hidden');
                    languageChevron.style.transform = 'rotate(0deg)';
                    languageButton.setAttribute('aria-expanded', 'false');
                });
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!languageButton.contains(e.target) && !languageDropdown.contains(e.target)) {
                    languageDropdown.classList.add('hidden');
                    languageChevron.style.transform = 'rotate(0deg)';
                    languageButton.setAttribute('aria-expanded', 'false');
                }
            });

            // Prevent menu from closing when clicking inside
            languageDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    });
</script>