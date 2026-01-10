<?php
// 1. Secure session cookie settings
ini_set('session.cookie_httponly', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}
ini_set('session.cookie_samesite', 'Strict');

session_start();

// 2. CHECK LOGIN STATUS (With Safety Fix)
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    
    // SAFETY CHECK: Ensure we actually have an ID (prevents the "null" error)
    if (isset($_SESSION['admin_id'])) {
        header('Location: dashboard.php');
        exit;
    } else {
        // Session is corrupt (Old session without ID). Destroy it so user can login fresh.
        session_unset();
        session_destroy();
        session_start(); 
    }
}

// 3. Generate CSRF token for form security
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | DAGINA Jewellery</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="assets/admin.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Floating Animation */
        @keyframes floatUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-enter {
            animation: floatUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        }
        
        /* Background Glow Blob */
        .blur-blob {
            position: absolute;
            width: 300px;
            height: 300px;
            background: #b82040; /* Fallback */
            background: var(--kumkum, #b82040);
            filter: blur(80px);
            opacity: 0.15;
            z-index: -1;
            border-radius: 50%;
        }
    </style>
</head>
<body class="bg-cream text-deep-black antialiased min-h-screen flex flex-col items-center justify-center font-[Baloo_2] relative overflow-hidden">

    <div class="blur-blob top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>

    <div class="glass-card p-10 rounded-3xl w-full max-w-md animate-enter relative z-10 border border-white/50 shadow-xl">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-red-700 to-red-900 text-white font-black text-lg mb-4 shadow-lg shadow-red-900/20">
                DJ
            </div>
            <h2 class="text-3xl font-black text-kumkum">Admin Portal</h2>
            <p class="text-gray-500 text-sm mt-1">Please enter your credentials to access</p>
        </div>

        <?php
        if (isset($_SESSION['error'])) {
            echo '
            <div class="mb-5 p-3 rounded-xl bg-red-50 border border-red-100 flex items-center gap-3 text-red-700 text-sm font-semibold">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                '.htmlspecialchars($_SESSION['error']).'
            </div>';
            unset($_SESSION['error']);
        }
        ?>

        <form method="POST" action="login_process.php" class="flex flex-col gap-4">
            
            <div class="relative group">
                <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400 group-focus-within:text-kumkum transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                <input 
                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none transition-all font-medium text-deep-black placeholder-gray-400" 
                    type="text" 
                    name="username" 
                    placeholder="Username" 
                    required
                >
            </div>

            <div class="relative group">
                <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400 group-focus-within:text-kumkum transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                <input 
                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-200 bg-white/50 focus:bg-white focus:border-gold focus:ring-2 focus:ring-gold/20 outline-none transition-all font-medium text-deep-black placeholder-gray-400" 
                    type="password" 
                    name="password" 
                    placeholder="Password" 
                    required
                >
            </div>

            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
            
            <button class="w-full mt-2 bg-gradient-to-r from-red-800 to-kumkum text-white py-3.5 rounded-xl font-bold shadow-lg shadow-red-900/20 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200">
                Secure Login
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="../index.php" class="text-xs font-bold text-gray-400 hover:text-kumkum transition-colors">
                ← Back to Main Store
            </a>
        </div>
    </div>

    <footer class="absolute bottom-4 text-center text-xs text-gray-400 font-medium">
        &copy; <?= date('Y'); ?> DAGINA Jewellery. Authorized Personnel Only.
    </footer>

</body>
</html>