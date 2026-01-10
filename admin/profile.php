<?php 
require 'auth.php'; 
require 'db_connect.php'; 

// --- SAFETY CHECK START ---
// 1. If admin_id is missing from session (old session), force logout
if (!isset($_SESSION['admin_id'])) {
    header("Location: logout.php");
    exit();
}

// 2. Fetch current admin details securely
$stmt = $conn->prepare("SELECT * FROM admins WHERE id = ?");
$stmt->bind_param("i", $_SESSION['admin_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// 3. If user deleted from DB but still has session, force logout
if (!$user) {
    header("Location: logout.php");
    exit();
}
// --- SAFETY CHECK END ---

// Generate Premium Avatar
$avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($user['full_name']) . "&background=b82040&color=fff&size=200&font-size=0.4";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | DAGINA Admin</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="assets/admin.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Profile Cover Pattern */
        .profile-cover {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            background-image: radial-gradient(#b82040 1px, transparent 1px);
            background-size: 20px 20px;
        }
    </style>
</head>
<body class="bg-cream font-[Baloo_2] text-deep-black">

<?php include 'sidebar.php'; ?>

<main class="lg:ml-64 p-8 min-h-screen">

    <div class="flex justify-between items-end mb-10">
        <div>
            <div class="flex items-center gap-2 text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">
                <a href="dashboard.php" class="hover:text-kumkum transition">Home</a>
                <span>/</span>
                <span class="text-kumkum">Profile</span>
            </div>
            <h1 class="text-4xl font-black text-deep-black">My Profile</h1>
            <p class="text-gray-500 font-medium mt-1">Manage your account settings & security</p>
        </div>
    </div>

    <?php if(isset($_SESSION['success']) || isset($_SESSION['error'])): ?>
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition 
             class="fixed top-6 right-6 z-50 flex items-center gap-3 px-6 py-4 rounded-xl shadow-2xl backdrop-blur-md border border-white/20 <?= isset($_SESSION['success']) ? 'bg-green-100/90 text-green-800' : 'bg-red-100/90 text-red-800'; ?>">
            
            <?php if(isset($_SESSION['success'])): ?>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-bold"><?= $_SESSION['success']; unset($_SESSION['success']); ?></span>
            <?php else: ?>
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-bold"><?= $_SESSION['error']; unset($_SESSION['error']); ?></span>
            <?php endif; ?>
            
            <button @click="show = false" class="ml-4 opacity-50 hover:opacity-100">&times;</button>
        </div>
    <?php endif; ?>


    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <div class="lg:col-span-4">
            <div class="glass-card rounded-[30px] overflow-hidden sticky top-8 group">
                
                <div class="profile-cover h-32 relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                </div>

                <div class="px-8 pb-8 relative">
                    <div class="relative -mt-16 mb-4 flex justify-center">
                        <div class="relative">
                            <div class="absolute inset-0 bg-kumkum rounded-full blur opacity-20 group-hover:opacity-40 transition-opacity duration-500"></div>
                            <img src="<?= $avatarUrl; ?>" alt="Profile" class="w-32 h-32 rounded-full border-[5px] border-white/80 shadow-2xl relative z-10 bg-white object-cover">
                            
                            <div class="absolute bottom-2 right-2 w-6 h-6 bg-green-500 border-4 border-white rounded-full z-20" title="Active Status"></div>
                        </div>
                    </div>

                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-black text-deep-black"><?= htmlspecialchars($user['full_name']); ?></h2>
                        <div class="inline-flex items-center gap-1 bg-red-50 text-kumkum px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mt-2 border border-red-100">
                            <?= htmlspecialchars($user['role']); ?>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-white/40 rounded-2xl border border-white/50">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">@</div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase">Username</p>
                                    <p class="font-bold text-deep-black">@<?= htmlspecialchars($user['username']); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between p-4 bg-white/40 rounded-2xl border border-white/50">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">#</div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase">Joined</p>
                                    <p class="font-bold text-deep-black"><?= date("M Y", strtotime($user['created_at'])); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="lg:col-span-8 space-y-8">
            
            <div class="glass-card p-8 rounded-[30px] border-t-4 border-kumkum">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-deep-black">Edit Details</h3>
                    <span class="text-xs font-bold bg-gray-100 text-gray-500 px-3 py-1 rounded-full">General</span>
                </div>

                <form action="profile_action.php" method="POST">
                    <input type="hidden" name="action" value="update_info">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="group">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Full Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-kumkum transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']); ?>" class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-200 focus:border-kumkum focus:ring-4 focus:ring-kumkum/10 outline-none transition-all bg-white/60 font-medium">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-2 ml-1">Username (Locked)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                </div>
                                <input type="text" value="<?= htmlspecialchars($user['username']); ?>" disabled class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-100 bg-gray-100/50 text-gray-400 font-bold cursor-not-allowed select-none">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-deep-black text-white px-8 py-3 rounded-xl font-bold hover:bg-kumkum transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <div class="glass-card p-8 rounded-[30px] border-t-4 border-gray-800">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-black text-deep-black">Security</h3>
                    <span class="text-xs font-bold bg-gray-100 text-gray-500 px-3 py-1 rounded-full">Password</span>
                </div>

                <form action="profile_action.php" method="POST" x-data="{ showPass: false }">
                    <input type="hidden" name="action" value="change_password">

                    <div class="space-y-5 mb-8">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Current Password</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-kumkum" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                </div>
                                <input :type="showPass ? 'text' : 'password'" name="current_password" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-200 focus:border-kumkum focus:ring-4 focus:ring-kumkum/10 outline-none transition-all bg-white/60">
                            </div>
                        </div>

                        <div class="border-t border-gray-100 my-4"></div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">New Password</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-kumkum" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                                    </div>
                                    <input :type="showPass ? 'text' : 'password'" name="new_password" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-200 focus:border-kumkum focus:ring-4 focus:ring-kumkum/10 outline-none transition-all bg-white/60">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2 ml-1">Confirm New Password</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-kumkum" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </div>
                                    <input :type="showPass ? 'text' : 'password'" name="confirm_password" required class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-gray-200 focus:border-kumkum focus:ring-4 focus:ring-kumkum/10 outline-none transition-all bg-white/60">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="showPass" @click="showPass = !showPass" class="w-4 h-4 text-kumkum border-gray-300 rounded focus:ring-kumkum">
                            <label for="showPass" class="text-xs font-bold text-gray-500 select-none cursor-pointer">Show Passwords</label>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-gradient-to-r from-red-800 to-kumkum text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-red-900/20 hover:shadow-xl hover:-translate-y-0.5 transition-all">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</main>

</body>
</html>