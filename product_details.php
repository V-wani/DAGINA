<?php
require "admin/db_connect.php";
$conn->set_charset("utf8mb4");

// 1. Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: collections.php");
    exit;
}

$id = (int)$_GET['id'];

// 2. Fetch Product Details
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ? AND status = 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

// 3. Handle Product Not Found
if (!$product) {
    header("Location: collections.php");
    exit;
}

// 4. Prepare Variables
$name  = htmlspecialchars($product['name']);
$price = (int)$product['price'];
$desc  = nl2br(htmlspecialchars($product['description'])); // nl2br preserves line breaks
$image = htmlspecialchars($product['image']);
$cat   = htmlspecialchars($product['category']);
$offer = isset($product['offer']) ? htmlspecialchars($product['offer']) : ''; // Assuming you might add an offer column later

// WhatsApp Message
$waMessage = "नमस्कार, मला '{$name}' (₹{$price}) बद्दल चौकशी करायची आहे. हे उपलब्ध आहे का?";
$waLink = "https://wa.me/7796080794?text=" . urlencode($waMessage);

// 5. Fetch Related Products (Random 4 excluding current)
$stmt_rel = $conn->prepare("SELECT * FROM products WHERE id != ? AND status = 1 ORDER BY RAND() LIMIT 4");
$stmt_rel->bind_param("i", $id);
$stmt_rel->execute();
$related_products = $stmt_rel->get_result();

?>
<!DOCTYPE html>
<html lang="mr">

<head>
    <meta charset="UTF-8">
    <title><?= $name; ?> | DAGINA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400;500;600;700;800&family=Hind:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        kumkum: '#C4161C',
                        gold: '#D4AF37',
                        dark: '#2D2D2D',
                        cream: '#FFF9F4'
                    },
                    fontFamily: {
                        heading: ['Baloo 2', 'cursive'],
                        body: ['Hind', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #C4161C 0%, #9E0B10 100%);
        }
        /* Hide scrollbar for gallery if needed */
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>

<body class="bg-cream font-body text-dark antialiased">

    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gold/20">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="collections.php" class="flex items-center gap-2 group text-gray-600 hover:text-kumkum transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:-translate-x-1 transition-transform">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                <span class="font-bold text-sm md:text-base">Back to Collection</span>
            </a>
            
            <a href="index.php" class="font-heading font-extrabold text-2xl text-kumkum tracking-wide">
                DAGINA
            </a>

            <div class="w-8"></div> 
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-8 md:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            
            <div class="relative rounded-3xl overflow-hidden bg-white shadow-xl shadow-kumkum/5 border border-gold/10 group">
                <div class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur text-kumkum text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider border border-kumkum/10">
                    <?= $cat; ?>
                </div>

                <div class="aspect-[4/5] w-full overflow-hidden">
                    <img src="admin/assets/products/<?= $image; ?>" 
                         alt="<?= $name; ?>" 
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-in-out">
                </div>
            </div>

            <div class="flex flex-col gap-6 lg:sticky lg:top-24">
                <div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-dark mb-2 leading-tight">
                        <?= $name; ?>
                    </h1>
                    
                    <div class="flex items-end gap-3 mb-4">
                        <span class="text-3xl font-bold text-kumkum">₹<?= number_format($price); ?></span>
                        <span class="text-sm text-gray-500 mb-1">सर्व कर समाविष्ट (Inclusive of all taxes)</span>
                    </div>
                </div>

                <hr class="border-gold/20">

                <div class="prose prose-stone text-gray-600 leading-relaxed">
                    <h3 class="font-bold text-dark text-lg mb-2">माहिती (Description)</h3>
                    <p><?= $desc; ?></p>
                </div>

                <div class="grid grid-cols-2 gap-4 py-4">
                    <div class="flex items-center gap-3 bg-white p-3 rounded-xl border border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-gold/10 flex items-center justify-center text-gold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div class="text-xs font-bold text-gray-600">अस्सल <br>क्वालिटी</div>
                    </div>
                    <div class="flex items-center gap-3 bg-white p-3 rounded-xl border border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-kumkum/10 flex items-center justify-center text-kumkum">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div class="text-xs font-bold text-gray-600">वेळेवर <br>डिलिव्हरी</div>
                    </div>
                </div>

                <div class="mt-2">
                    <a href="<?= $waLink; ?>" target="_blank" 
                       class="btn-gradient w-full text-white py-4 rounded-xl font-bold text-lg shadow-lg shadow-kumkum/30 hover:shadow-xl hover:shadow-kumkum/50 hover:-translate-y-1 transition-all flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592z"/>
                        </svg>
                        WhatsApp वर ऑर्डर करा
                    </a>
                    <p class="text-center text-xs text-gray-400 mt-3">Payment after confirmation on WhatsApp</p>
                </div>
            </div>
        </div>
    </main>

    <section class="bg-white border-t border-gold/10 py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-heading font-bold text-dark mb-8">तुम्हाला हे देखील आवडेल (Related)</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <?php while($row = $related_products->fetch_assoc()): ?>
                <div class="group cursor-pointer">
                    <a href="product_details.php?id=<?= $row['id']; ?>">
                        <div class="relative aspect-[3/4] rounded-2xl overflow-hidden mb-4 bg-gray-100">
                            <img src="admin/assets/products/<?= htmlspecialchars($row['image']); ?>" 
                                 alt="<?= htmlspecialchars($row['name']); ?>" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        </div>
                        <h3 class="font-bold text-dark group-hover:text-kumkum truncate"><?= htmlspecialchars($row['name']); ?></h3>
                        <p class="text-kumkum font-bold text-sm">₹<?= number_format($row['price']); ?></p>
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-cream py-8 text-center border-t-4 border-kumkum">
        <p class="font-heading opacity-80">&copy; <?= date('Y'); ?> DAGINA. पारंपरिक सौंदर्य.</p>
    </footer>

</body>
</html>