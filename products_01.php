<?php
require "admin/db_connect.php";

/* Fetch newest products first */
$query = "SELECT * FROM products WHERE status = 1 ORDER BY id DESC";
$result = $conn->query($query);

if (!$result) {
    die("Database error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8">
    <title>DAGINA – Products</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        kumkum: '#C4161C',
                        cream: '#FFF6EE'
                    }
                }
            }
        }
    </script>

    <style>
        .card-soft {
            background: #FFF6EE;
            border-radius: 28px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }
        .card-img {
            border-top-left-radius: 28px;
            border-top-right-radius: 28px;
        }
        .badge-popular {
            background: #C4161C;
            color: white;
            font-size: 12px;
            font-weight: 700;
            padding: 6px 14px;
            border-radius: 999px;
        }
        .whatsapp-btn {
            background: #C4161C;
            box-shadow: 0 12px 25px rgba(196,22,28,0.4);
        }
    </style>
</head>

<body class="bg-[#FFF9F4]">

<!-- HEADER -->
<header class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center">
    <h1 class="text-3xl font-extrabold text-kumkum">DAGINA</h1>
    <a href="index.html" class="text-gray-600 hover:text-kumkum font-semibold">Home</a>
</header>

<!-- TITLE -->
<section class="max-w-7xl mx-auto px-6 mb-10">
    <h2 class="text-4xl font-bold text-gray-900">आमचे दागिने</h2>
    <p class="text-gray-600 mt-1">शुद्धता • परंपरा • विश्वास</p>
</section>

<!-- PRODUCTS GRID -->
<section class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 pb-16">

<?php if ($result->num_rows > 0): ?>
<?php while ($row = $result->fetch_assoc()): 

    $name  = htmlspecialchars($row['name']);
    $price = (int)$row['price'];
    $image = $row['image'];

    // Safe description (no warnings)
    $desc = !empty($row['description'])
        ? htmlspecialchars($row['description'])
        : "पारंपरिक तिळगूळ माळ - हाताने बनवलेली";

    // Discount logic (Amazon style)
    $old_price = (int)($price * 1.35);
    $discount  = round((($old_price - $price) / $old_price) * 100);

    $waText = urlencode("नमस्कार, मला {$name} (₹{$price}) ऑर्डर करायची आहे.");
?>

<!-- PRODUCT CARD -->
<div class="max-w-[360px] card-soft overflow-hidden">

    <!-- IMAGE -->
    <!-- IMAGE -->
    <div class="relative">
        <img src="admin/assets/products/<?php echo htmlspecialchars($image); ?>"
            alt="<?php echo $name; ?>"
            class="w-full h-[260px] object-cover card-img">

        <div class="absolute top-4 right-4 badge-popular">
            सर्वाधिक लोकप्रिय
        </div>
    </div>


    <!-- CONTENT -->
    <div class="p-6">
        <h3 class="text-2xl font-extrabold text-gray-900 mb-1">
            <?php echo $name; ?>
        </h3>

        <p class="text-gray-600 text-sm mb-4">
            <?php echo $desc; ?>
        </p>

        <!-- PRICE -->
        <div class="flex items-center gap-3 mb-5">
            <span class="text-3xl font-black text-kumkum">
                ₹<?php echo number_format($price); ?>
            </span>

            <span class="text-sm text-gray-400 line-through">
                ₹<?php echo number_format($old_price); ?>
            </span>

            <span class="ml-auto bg-orange-100 text-orange-600 text-xs font-bold px-3 py-1 rounded-full">
                <?php echo $discount; ?>% सूट
            </span>
        </div>

        <!-- WHATSAPP BUTTON -->
        <a href="https://wa.me/91XXXXXXXXXX?text=<?php echo $waText; ?>"
           target="_blank"
           class="whatsapp-btn w-full flex items-center justify-center gap-2 text-white py-4 rounded-2xl font-bold text-base hover:opacity-90 transition">

            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                 viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207Z" />
            </svg>

            WhatsApp वर ऑर्डर करा
        </a>
    </div>
</div>

<?php endwhile; ?>
<?php else: ?>
<p class="text-gray-500">No products available.</p>
<?php endif; ?>

</section>

<!-- FOOTER -->
<footer class="text-center py-8 text-gray-400">
    © <?php echo date('Y'); ?> DAGINA. All rights reserved.
</footer>

</body>
</html>
