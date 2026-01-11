<?php
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="lg:hidden fixed top-0 left-0 w-full bg-white/80 backdrop-blur-md border-b border-gray-100 px-5 py-4 flex items-center justify-between z-50">
    <div class="flex items-center gap-2">
        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-red-700 to-red-900 flex items-center justify-center text-white font-bold text-[10px]">DJ</div>
        <h2 class="text-xl font-black text-kumkum tracking-tight">DAGINA</h2>
    </div>
    
    <button id="mobile-menu-btn" class="p-2 rounded-xl bg-gray-50 text-kumkum focus:ring-2 focus:ring-red-100">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
    </button>
</div>

<div id="sidebar-overlay" class="fixed inset-0 bg-black/20 backdrop-blur-sm z-30 hidden lg:hidden transition-opacity duration-300"></div>

<aside id="sidebar" class="w-64 h-screen fixed top-0 left-0 p-6 flex flex-col justify-between bg-white/90 lg:bg-white/50 backdrop-blur-md border-r border-white/40 z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    
    <div>
        <div class="flex items-center justify-between mb-10 px-2">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-red-700 to-red-900 flex items-center justify-center text-white font-bold text-xs shadow-lg shadow-red-900/20">DJ</div>
                <h2 class="text-2xl font-black text-kumkum tracking-tight">DAGINA</h2>
            </div>
            <button id="close-sidebar" class="lg:hidden text-gray-400 hover:text-red-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <nav class="flex flex-col gap-2 text-sm">
            <a href="dashboard.php" class="nav-link <?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                Dashboard
            </a>

            <a href="products.php" class="nav-link <?= ($current_page == 'products.php' || $current_page == 'product_form.php') ? 'active' : ''; ?>">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                Products
            </a>

            <a href="#" class="nav-link">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                Orders
                <span class="ml-auto bg-red-100 text-red-700 py-0.5 px-2 rounded-full text-xs font-bold">3</span>
            </a>

            <a href="profile.php" class="nav-link <?= ($current_page == 'profile.php') ? 'active' : ''; ?>">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                My Profile
            </a>
        </nav>
    </div>

    <a href="logout.php" class="nav-link text-red-600 hover:bg-red-50 font-bold mt-auto">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
        Logout
    </a>
</aside>

<script>
    const menuBtn = document.getElementById('mobile-menu-btn');
    const closeBtn = document.getElementById('close-sidebar');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    function toggleMenu() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }

    menuBtn.addEventListener('click', toggleMenu);
    closeBtn.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu);
</script>