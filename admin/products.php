<?php 
require 'auth.php'; 
require 'db_connect.php'; 

// Fetch products from DB
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | DAGINA Jewellery</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/admin.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body class="bg-cream font-[Baloo_2] text-deep-black">

<?php include 'sidebar.php'; ?>

<main class="lg:ml-64 p-8 min-h-screen">
    
    <div class="flex flex-col sm:flex-row justify-between sm:items-center mb-10 gap-4">
        <div>
            <h1 class="text-4xl font-black text-deep-black">Products</h1>
            <p class="text-gray-500 font-medium mt-1">Manage your catalogue</p>
        </div>
        
        <a href="product_form.php" class="bg-gradient-to-r from-red-800 to-kumkum text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-red-900/20 hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Product
        </a>
    </div>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-8 font-bold text-sm flex items-center gap-2 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-8 font-bold text-sm flex items-center gap-2 shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                
                <div class="glass-card p-4 rounded-2xl group relative hover:shadow-2xl hover:shadow-red-900/5 transition-all duration-300 border border-white/50">
                    
                    <div class="h-56 rounded-xl overflow-hidden mb-4 bg-gray-100 relative shadow-inner">
                        <img src="assets/products/<?= htmlspecialchars($row['image']); ?>" alt="Product" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">
                        
                        <div class="absolute inset-0 bg-deep-black/60 flex flex-col items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-all duration-300 backdrop-blur-[2px]">
                            
                            <a href="product_form.php?id=<?= $row['id']; ?>" class="bg-white text-deep-black px-6 py-2 rounded-lg font-bold text-sm hover:bg-gold hover:text-white transition-colors w-32 text-center shadow-lg">
                                Edit
                            </a>
                            
                            <a href="product_actions.php?delete=<?= $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.')" class="bg-red-600/90 text-white px-6 py-2 rounded-lg font-bold text-sm hover:bg-red-700 transition-colors w-32 text-center shadow-lg backdrop-blur-md">
                                Remove
                            </a>
                        </div>
                    </div>

                    <div class="px-1">
                        <h3 class="font-bold text-lg leading-tight mb-1 text-deep-black truncate"><?= htmlspecialchars($row['name']); ?></h3>
                        <p class="text-xs text-gray-500 mb-4 line-clamp-2 h-8 leading-relaxed"><?= htmlspecialchars($row['description']); ?></p>
                        
                        <div class="flex justify-between items-center pt-3 border-t border-gray-200/60">
                            <span class="text-kumkum font-black text-xl">₹ <?= number_format($row['price']); ?></span>
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider bg-gray-100 px-2 py-1 rounded">ID: #<?= $row['id']; ?></span>
                        </div>
                    </div>

                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-span-full flex flex-col items-center justify-center py-20 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-300">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-400">No products found</h3>
                <p class="text-gray-400 text-sm mt-1 mb-6">Your catalogue is currently empty.</p>
                <a href="product_form.php" class="text-kumkum font-bold hover:underline">Add your first product &rarr;</a>
            </div>
        <?php endif; ?>

    </div>

</main>

</body>
</html>