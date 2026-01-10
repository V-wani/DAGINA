<?php 
// 1. AUTHENTICATION CHECK
require 'auth.php'; 

// 2. PREPARE USER DATA
// Get the admin name from the session set during login_process.php
$adminName = $_SESSION['admin_name'] ?? 'Admin User';

// Generate Avatar URL based on the name (e.g., "Rahul Kumar" -> "RK" avatar)
$avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($adminName) . "&background=b82040&color=fff";
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | DAGINA Jewellery</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="assets/admin.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="bg-cream text-deep-black antialiased font-[Baloo_2]">

    <?php include 'sidebar.php'; ?>

    <main class="lg:ml-64 min-h-screen p-8 transition-all duration-300">

        <div class="flex flex-col md:flex-row justify-between md:items-center mb-10 gap-4">
            <div>
                <h1 class="text-4xl font-black text-deep-black">Dashboard</h1>
                <p class="text-deep-black/60 font-medium mt-1">Overview of your store performance</p>
            </div>

            <div class="flex items-center gap-6">
                
                <div class="relative w-full md:w-64 hidden md:block">
                    <svg class="absolute left-3 top-3 text-gray-400 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    <input type="search" placeholder="Search orders..." class="w-full pl-10 pr-4 py-2.5 rounded-2xl border-none text-sm font-semibold focus:outline-none shadow-sm">
                </div>

                <div class="text-right hidden md:block">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wider">Today</p>
                    <p class="font-bold text-kumkum"><?= date("d M Y"); ?></p>
                </div>
                
                <div class="relative">
                    <button onclick="toggleProfileMenu()" class="flex items-center gap-2 focus:outline-none group">
                        <div class="w-10 h-10 rounded-full bg-gray-300 border-2 border-white shadow-md overflow-hidden group-hover:ring-2 group-hover:ring-kumkum/30 transition-all">
                            <img src="<?= $avatarUrl; ?>" alt="Admin" class="w-full h-full object-cover">
                        </div>
                    </button>

                    <div id="profileMenu" class="hidden absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden transform origin-top-right transition-all">
                        <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                            <p class="text-xs text-gray-500">Signed in as</p>
                            <p class="text-sm font-bold text-deep-black truncate"><?= htmlspecialchars($adminName); ?></p>
                        </div>
                        <div class="py-1">
                            <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-kumkum transition-colors">My Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-kumkum transition-colors">Settings</a>
                        </div>
                        <div class="border-t border-gray-100 py-1">
                            <a href="logout.php" class="block px-4 py-2 text-sm text-red-600 font-bold hover:bg-red-50 transition-colors">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="stat-card">
                <div class="flex justify-between items-start">
                    <div class="stat-icon-wrapper bg-green-100 text-green-700">₹</div>
                    <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-md">+12%</span>
                </div>
                <div>
                    <h3>Total Revenue</h3>
                    <p>₹ 4.2L</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex justify-between items-start">
                    <div class="stat-icon-wrapper bg-blue-100 text-blue-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-gray-500 bg-gray-50 px-2 py-1 rounded-md">Stock</span>
                </div>
                <div>
                    <h3>Total Products</h3>
                    <p>24</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex justify-between items-start">
                    <div class="stat-icon-wrapper bg-orange-100 text-orange-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-orange-600 bg-orange-50 px-2 py-1 rounded-md">3 New</span>
                </div>
                <div>
                    <h3>Active Orders</h3>
                    <p>12</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="flex justify-between items-start">
                    <div class="stat-icon-wrapper bg-purple-100 text-purple-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <span class="text-xs font-bold text-purple-600 bg-purple-50 px-2 py-1 rounded-md">+2</span>
                </div>
                <div>
                    <h3>Customers</h3>
                    <p>158</p>
                </div>
            </div>
        </section>

        <section class="glass-card p-8 rounded-[24px]">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-deep-black">Recent Orders</h2>
                <a href="#" class="text-sm font-bold text-kumkum hover:underline">View All</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left">
                            <th class="py-2">Order ID</th>
                            <th>Product</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100/50">
                        <tr>
                            <td class="font-bold text-gray-500">#1021</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <img src="https://source.unsplash.com/random/100x100/?gold,necklace" class="product-thumb" alt="Product">
                                    <span class="font-bold text-deep-black">Gold Necklace</span>
                                </div>
                            </td>
                            <td>
                                <div class="font-medium">Aarti Patil</div>
                                <div class="text-xs text-gray-400">Pune, MH</div>
                            </td>
                            <td class="text-gray-500">Oct 24</td>
                            <td class="font-bold">₹ 45,000</td>
                            <td><span class="badge success">Completed</span></td>
                            <td>
                                <button class="text-gray-400 hover:text-kumkum transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="font-bold text-gray-500">#1020</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <img src="https://source.unsplash.com/random/100x100/?diamond,ring" class="product-thumb" alt="Product">
                                    <span class="font-bold text-deep-black">Diamond Ring</span>
                                </div>
                            </td>
                            <td>
                                <div class="font-medium">Rahul Deshmukh</div>
                                <div class="text-xs text-gray-400">Mumbai, MH</div>
                            </td>
                            <td class="text-gray-500">Oct 23</td>
                            <td class="font-bold">₹ 12,500</td>
                            <td><span class="badge pending">Pending</span></td>
                            <td>
                                <button class="text-gray-400 hover:text-kumkum transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td class="font-bold text-gray-500">#1019</td>
                            <td>
                                <div class="flex items-center gap-3">
                                    <img src="https://source.unsplash.com/random/100x100/?bangles,gold" class="product-thumb" alt="Product">
                                    <span class="font-bold text-deep-black">Bangles Set</span>
                                </div>
                            </td>
                            <td>
                                <div class="font-medium">Pooja Kale</div>
                                <div class="text-xs text-gray-400">Nashik, MH</div>
                            </td>
                            <td class="text-gray-500">Oct 21</td>
                            <td class="font-bold">₹ 28,000</td>
                            <td><span class="badge cancelled">Cancelled</span></td>
                            <td>
                                <button class="text-gray-400 hover:text-kumkum transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <script>
        function toggleProfileMenu() {
            const menu = document.getElementById('profileMenu');
            menu.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            const menu = document.getElementById('profileMenu');
            const button = document.querySelector('button[onclick="toggleProfileMenu()"]');
            
            // If click is NOT inside the button AND NOT inside the menu, close the menu
            if (!button.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>

</body>
</html>