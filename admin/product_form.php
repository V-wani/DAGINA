<?php 
require 'auth.php'; 
require 'db_connect.php';

$isEdit = false;
$name = ''; $price = ''; $desc = ''; $image = ''; $id = '';

// Check if we are editing
if (isset($_GET['id'])) {
    $isEdit = true;
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    $name = $product['name'];
    $price = $product['price'];
    $desc = $product['description'];
    $image = $product['image'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $isEdit ? 'Edit' : 'Add'; ?> Product | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;800&display=swap" rel="stylesheet">
</head>
<body class="bg-cream font-[Baloo_2] flex items-center justify-center min-h-screen p-6">

<div class="glass-card w-full max-w-lg p-8 rounded-3xl relative">
    
    <a href="products.php" class="absolute top-6 right-6 text-gray-400 hover:text-kumkum text-sm font-bold">✕ Close</a>

    <h2 class="text-3xl font-black text-kumkum mb-2"><?= $isEdit ? 'Edit' : 'Add New'; ?> Product</h2>
    <p class="text-gray-500 mb-6 text-sm">Fill in the details below to update your catalogue.</p>

    <form action="product_actions.php" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
        
        <input type="hidden" name="action" value="<?= $isEdit ? 'edit' : 'add'; ?>">
        <?php if($isEdit): ?> <input type="hidden" name="id" value="<?= $id; ?>"> <?php endif; ?>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Product Name</label>
            <input type="text" name="name" value="<?= $name; ?>" required class="w-full p-3 rounded-xl border border-gray-200 focus:border-gold outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Price (₹)</label>
            <input type="number" name="price" value="<?= $price; ?>" required step="0.01" class="w-full p-3 rounded-xl border border-gray-200 focus:border-gold outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full p-3 rounded-xl border border-gray-200 focus:border-gold outline-none"><?= $desc; ?></textarea>
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Product Image</label>
            <div class="flex items-center gap-4">
                <?php if($isEdit && $image): ?>
                    <img src="assets/products/<?= $image; ?>" class="w-16 h-16 rounded-lg object-cover border">
                    <input type="hidden" name="current_image" value="<?= $image; ?>">
                <?php endif; ?>
                <input type="file" name="image" accept="image/*" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-red-50 file:text-kumkum hover:file:bg-red-100">
            </div>
        </div>

        <button type="submit" class="mt-4 bg-gradient-to-r from-red-800 to-kumkum text-white py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all">
            <?= $isEdit ? 'Update Product' : 'Save Product'; ?>
        </button>

    </form>
</div>

</body>
</html>