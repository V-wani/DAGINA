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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@600;700;800&family=Hind:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        kumkum: '#C4161C',
                        cream: '#FFF6EE',
                        gold: '#D4AF37'
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
        .badge-popular {
            background: #C4161C;
            color: white;
            font-size: 11px;
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
<header class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">

    <!-- LEFT: PAGE TITLE -->
    <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight
               text-[#a4781f]
               drop-shadow-[0_3px_6px_rgba(196,22,28,0.35)]"
        style="font-family: 'Baloo 2', cursive;">
        दागिने कलेक्शन
    </h1>

    <!-- RIGHT: HOME BUTTON -->
    <a href="index.html"
       class="px-5 py-2 rounded-full
              border-2 border-[#D4AF37]
              text-[#8A6D1D]
              font-semibold text-sm md:text-base
              hover:bg-[#D4AF37]
              hover:text-white
              transition-all duration-300
              shadow-sm hover:shadow-lg">
        Home
    </a>

</header>


<!-- TITLE -->
<section class="max-w-7xl mx-auto px-6 mb-8">
    <p class="text-gray-600 mt-1"
       style="font-family: 'Hind', sans-serif;">
        आजची फॅशन - कालची परंपरा
    </p>
</section>

<!-- PRODUCTS GRID -->
<section class="max-w-7xl mx-auto px-6
    grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4
    gap-6 pb-16">

<?php if ($result->num_rows > 0): ?>
<?php while ($row = $result->fetch_assoc()): 

    $name  = htmlspecialchars($row['name']);
    $price = (int)$row['price'];
    $image = $row['image'];

    $desc = !empty($row['description'])
        ? htmlspecialchars($row['description'])
        : "पारंपरिक तिळगूळ माळ - हाताने बनवलेली";

    $old_price = (int)($price * 1.35);
    $discount  = round((($old_price - $price) / $old_price) * 100);

    $waText = urlencode("नमस्कार, मला {$name} (₹{$price}) ऑर्डर करायची आहे.");
?>

<!-- PRODUCT CARD -->
<div class="card-soft overflow-hidden flex flex-row lg:flex-col w-full">

    <!-- IMAGE -->
    <div class="relative w-[120px] sm:w-[140px] lg:w-full flex-shrink-0">
        <img src="admin/assets/products/<?php echo htmlspecialchars($image); ?>"
             alt="<?php echo $name; ?>"
             class="w-full h-full lg:h-[260px] object-cover
                    rounded-l-3xl lg:rounded-t-3xl lg:rounded-l-none">

        <div class="absolute top-3 right-3 badge-popular">
            सर्वाधिक लोकप्रिय
        </div>
    </div>

    <!-- CONTENT -->
    <div class="p-4 flex flex-col justify-between flex-1">

        <div>
            <h3 class="text-xl lg:text-2xl font-extrabold text-gray-900 mb-1">
                <?php echo $name; ?>
            </h3>

            <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                <?php echo $desc; ?>
            </p>

            <div class="flex items-center gap-2 mb-4">
                <span class="text-2xl lg:text-3xl font-black text-kumkum">
                    ₹<?php echo number_format($price); ?>
                </span>

                <span class="text-sm text-gray-400 line-through">
                    ₹<?php echo number_format($old_price); ?>
                </span>

                <span class="ml-auto bg-orange-100 text-orange-600 text-xs font-bold px-3 py-1 rounded-full">
                    <?php echo $discount; ?>% सूट
                </span>
            </div>
        </div>

        <!-- WHATSAPP BUTTON -->
        <a href="https://wa.me/91XXXXXXXXXX?text=<?php echo $waText; ?>"
           target="_blank"
           class="whatsapp-btn w-full flex items-center justify-center gap-2
                  text-white py-2.5 lg:py-4
                  rounded-xl lg:rounded-2xl
                  font-bold text-sm lg:text-base
                  hover:opacity-90 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 24 24"
                 width="20" height="20"
                 fill="currentColor"
                 class="flex-shrink-0">
                <path d="M20.52 3.48A11.82 11.82 0 0 0 12.05 0C5.5 0 .16 5.34.16 11.89c0 2.1.55 4.15 1.6 5.97L0 24l6.3-1.65a11.87 11.87 0 0 0 5.75 1.47h.01c6.55 0 11.89-5.34 11.89-11.89 0-3.17-1.24-6.15-3.48-8.45z"/>
            </svg>

            <span>WhatsApp वर ऑर्डर करा</span>
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
