<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Menu</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        .menu-item.hidden {
            display: none !important;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="bg-gray-50 pt-8 pb-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-10 tracking-wider">
                MENU
            </h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 justify-items-center">
                
                <a href="#" class="flex flex-col items-center group focus:outline-none" onclick="filterByCategory('merch')">
                    <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-40 md:h-40 bg-yellow-100 rounded-xl overflow-hidden shadow-lg transform group-hover:scale-105 transition duration-300">
                        <img src="assets/merchandiceArtboard-22-460x460.jpg" alt="Merchandise" class="w-full h-full object-cover">
                    </div>
                    <p class="mt-3 text-base sm:text-lg font-semibold text-blue-900 group-hover:text-yellow-600 group-focus:text-yellow-600 transition duration-150">
                        Merch
                    </p>
                </a>

                <a href="#" class="flex flex-col items-center group focus:outline-none" onclick="filterByCategory('coffee')">
                    <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-40 md:h-40 bg-blue-900 rounded-xl overflow-hidden shadow-lg transform group-hover:scale-105 transition duration-300">
                        <img src="assets/long-black-460x460.jpg" alt="Coffee" class="w-full h-full object-cover">
                    </div>
                    <p class="mt-3 text-base sm:text-lg font-semibold text-blue-900 group-hover:text-yellow-600 group-focus:text-yellow-600 transition duration-150">
                        Coffee
                    </p>
                </a>

                <a href="#" class="flex flex-col items-center group focus:outline-none" onclick="filterByCategory('non coffee')">
                    <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-40 md:h-40 bg-yellow-500 rounded-xl overflow-hidden shadow-lg transform group-hover:scale-105 transition duration-300">
                        <img src="assets/mango-smotie-460x460.jpg" alt="Non Coffee" class="w-full h-full object-cover">
                    </div>
                    <p class="mt-3 text-base sm:text-lg font-semibold text-blue-900 group-hover:text-yellow-600 group-focus:text-yellow-600 transition duration-150">
                        Non Coffee
                    </p>
                </a>

                <a href="#" class="flex flex-col items-center group focus:outline-none" onclick="filterByCategory('food')">
                    <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-40 md:h-40 bg-orange-200 rounded-xl overflow-hidden shadow-lg transform group-hover:scale-105 transition duration-300">
                        <img src="assets/chicken-karage-rice-460x460.jpg" alt="Food" class="w-full h-full object-cover">
                    </div>
                    <p class="mt-3 text-base sm:text-lg font-semibold text-blue-900 group-hover:text-yellow-600 group-focus:text-yellow-600 transition duration-150">
                        Food
                    </p>
                </a>
            </div>
            </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 pb-16">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-10">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-indigo-900 flex items-center mb-6 md:mb-0">
                <span class="w-1.5 h-8 bg-amber-400 mr-3 rounded-full"></span>
                <span id="menuTitle">All Menu</span>

                <a href="#" onclick="filterByCategory('all')" id="allMenuIcon" class="ml-3 p-1.5 rounded-full bg-amber-100 hover:bg-amber-200 transition duration-150 focus:outline-none focus:ring-2 focus:ring-amber-500 hidden" title="Tampilkan Semua Menu">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                    </svg>
                </a>
            </h2>
            
            <div class="relative w-full md:w-80">
                <input type="text" placeholder="Search..." id="menuSearch" onkeyup="filterMenu()"
                        class="w-full py-2.5 pr-4 pl-10 border border-gray-300 rounded-full focus:ring-amber-500 focus:border-amber-500 hover:border-[#E1AB00] transition duration-150 shadow-sm text-sm">

                <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <div id="menuGrid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-x-4 gap-y-10 sm:gap-x-6 sm:gap-y-12">
            </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>

<script>
    let menuData = [];

    const menuGrid = document.getElementById('menuGrid');
    const menuTitle = document.getElementById('menuTitle');
    const allMenuIcon = document.getElementById('allMenuIcon'); 

    async function loadMenuData() {
        try {
            const response = await fetch('menuData.json');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            menuData = await response.json();
            renderMenu(menuData);
        } catch (error) {
            console.error('Failed to load menu data:', error);
            menuGrid.innerHTML = '<p class="text-red-500 col-span-full">Gagal memuat data menu...</p>';
        }
    }

    function createMenuItem(item) {
        const div = document.createElement('div');
        div.className = 'menu-item text-center group';
        div.setAttribute('data-name', item.namaProduk);
        const categoryAttr = item.kategori.toLowerCase().replace(/\s/g, '-');
        div.setAttribute('data-category', categoryAttr);

        div.innerHTML = `
            <div class="menu-image-container w-full h-auto p-4 aspect-square transform group-hover:scale-[1.02] transition duration-300">
                <img src="${item.image}" alt="${item.alt}" class="w-full h-full object-cover rounded-md">
            </div>
            <p class="mt-3 text-sm sm:text-base font-semibold text-indigo-900 uppercase group-hover:text-yellow-600 group-focus:text-yellow-600 transition duration-150">${item.namaProduk}</p>
        `;
        return div;
    }

    function renderMenu(data) {
        menuGrid.innerHTML = '';
        data.forEach(item => {
            menuGrid.appendChild(createMenuItem(item));
        });
    }

    let activeCategory = 'all';

    function filterByCategory(category) {
        event.preventDefault();

        activeCategory = category.toLowerCase().replace(/\s/g, '-');

        let titleText;
        if (activeCategory === 'all') {
            titleText = 'All Menu';
            allMenuIcon.classList.add('hidden');
        } else {
            titleText = category.charAt(0).toUpperCase() + category.slice(1).replace('-', ' ');
            allMenuIcon.classList.remove('hidden');
        }
        menuTitle.textContent = titleText;

        applyFilters();
    }


    function filterMenu() {
        applyFilters(); 
    }

    function applyFilters() {
        const input = document.getElementById('menuSearch');
        const filter = input.value.toLowerCase();
        const menuItems = document.querySelectorAll('.menu-item');

        menuItems.forEach(item => {
            const name = item.getAttribute('data-name').toLowerCase();
            const itemCategory = item.getAttribute('data-category');

            const matchCategory = activeCategory === 'all' || itemCategory === activeCategory;
            const matchSearch = name.includes(filter);

            if (matchCategory && matchSearch) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    }


    document.addEventListener('DOMContentLoaded', () => {
        loadMenuData();
    });
</script>