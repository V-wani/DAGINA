<?php 
require 'auth.php'; 
require 'db_connect.php';

$conn->set_charset("utf8mb4");

$isEdit = false;
$name = ''; 
$price = ''; 
$desc = ''; 
$image = ''; 
$category = '';
$id = '';

if (isset($_GET['id'])) {
    $isEdit = true;
    $id = (int)$_GET['id'];

    $stmt = $conn->prepare("SELECT name, price, description, category, image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();

    $name = $product['name'];
    $price = $product['price'];
    $desc = $product['description'];
    $category = $product['category'];
    $image = $product['image'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isEdit ? 'Edit' : 'Add'; ?> Product | Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/admin.css">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        /* Ensures the background covers everything even if the form is long */
        body { min-height: 100vh; display: flex; flex-direction: column; }
    </style>
</head>

<body class="bg-cream font-[Baloo_2] lg:items-center lg:justify-center p-4 sm:p-6">

<div class="glass-card w-full max-w-lg mx-auto p-6 sm:p-8 rounded-2xl sm:rounded-3xl relative mt-4 mb-4 shadow-xl border border-white/50">
    
    <a href="products.php"
       class="absolute top-4 right-4 sm:top-6 sm:right-6 text-gray-400 hover:text-kumkum text-xs sm:text-sm font-bold bg-gray-50 sm:bg-transparent px-2 py-1 rounded-lg">
        ✕ Close
    </a>

    <h2 class="text-2xl sm:text-3xl font-black text-kumkum mb-1">
        <?= $isEdit ? 'Edit' : 'Add New'; ?> Product
    </h2>

    <p class="text-gray-500 mb-6 text-xs sm:text-sm">
        Fill in the details below to update your catalogue.
    </p>

    <form action="product_actions.php"
          method="POST"
          enctype="multipart/form-data"
          class="flex flex-col gap-4">

        <input type="hidden" name="action" value="<?= $isEdit ? 'edit' : 'add'; ?>">
        <?php if($isEdit): ?>
            <input type="hidden" name="id" value="<?= $id; ?>">
        <?php endif; ?>

        <div class="space-y-1">
            <label class="block text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">
                Product Name
            </label>
            <input type="text" name="name" required
                   value="<?= htmlspecialchars($name); ?>"
                   placeholder="e.g. Gold Plated Necklace"
                   class="w-full p-3 rounded-xl border border-gray-100 bg-white/50 focus:bg-white focus:border-gold outline-none transition-all">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="space-y-1">
                <label class="block text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">
                    Price (₹)
                </label>
                <input type="number" name="price" step="0.01" required
                       value="<?= htmlspecialchars($price); ?>"
                       class="w-full p-3 rounded-xl border border-gray-100 bg-white/50 focus:bg-white focus:border-gold outline-none transition-all">
            </div>

            <div class="space-y-1">
                <label class="block text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">
                    Category
                </label>
                <select name="category" required
                        class="w-full p-3 rounded-xl border border-gray-100 bg-white/50 focus:bg-white focus:border-gold outline-none font-semibold appearance-none">
                    <option value="">-- Select --</option>
                    <option value="दागिने" <?= $category === 'दागिने' ? 'selected' : ''; ?>>दागिने</option>
                    <option value="रांगोळी" <?= $category === 'रांगोळी' ? 'selected' : ''; ?>>रांगोळी</option>
                    <option value="पूजा साहित्य" <?= $category === 'पूजा साहित्य' ? 'selected' : ''; ?>>पूजा साहित्य</option>
                    <option value="नवीन" <?= $category === 'नवीन' ? 'selected' : ''; ?>>नवीन</option>
                </select>
            </div>
        </div>

        <div class="space-y-1">
            <label class="block text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">
                Description
            </label>
            <textarea name="description" rows="3"
                      class="w-full p-3 rounded-xl border border-gray-100 bg-white/50 focus:bg-white focus:border-gold outline-none transition-all"><?= htmlspecialchars($desc); ?></textarea>
        </div>

        <div class="space-y-1">
            <label class="block text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-wider">
                Product Image
            </label>

            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 p-3 border border-dashed border-gray-200 rounded-xl bg-white/30">
                <?php if($isEdit && $image): ?>
                    <div class="relative group">
                        <img src="assets/products/<?= htmlspecialchars($image); ?>"
                             class="w-16 h-16 rounded-lg object-cover border shadow-sm">
                        <input type="hidden" name="current_image" value="<?= htmlspecialchars($image); ?>">
                    </div>
                <?php endif; ?>

                <input type="file" name="image" accept="image/*"
                       class="block w-full text-xs text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-lg file:border-0
                              file:text-xs file:font-bold
                              file:bg-red-50 file:text-kumkum
                              hover:file:bg-red-100 transition-all cursor-pointer">
            </div>
        </div>

        <button type="submit"
                class="mt-4 bg-gradient-to-r from-red-800 to-kumkum
                       text-white py-4 rounded-xl font-bold
                       shadow-lg active:scale-95 transition-all text-sm uppercase tracking-widest">
            <?= $isEdit ? 'Update Product' : 'Save Product'; ?>
        </button>

    </form>
</div>

</body>
</html>