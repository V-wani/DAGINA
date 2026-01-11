<?php
require "admin/db_connect.php";

/* UTF-8 SUPPORT FOR MARATHI */
$conn->set_charset("utf8mb4");

/* GET PARAMETERS */
$search   = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

/* BASE QUERY */
$sql = "SELECT * FROM products WHERE status = 1";
$params = [];
$types  = "";

/* CATEGORY FILTER */
if (!empty($category)) {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}

/* SEARCH FILTER */
if (!empty($search)) {
    $sql .= " AND (name LIKE ? OR description LIKE ?)";
    $searchTerm = "%" . $search . "%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $types .= "ss";
}

$sql .= " ORDER BY id DESC";

/* PREPARED STATEMENT */
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="mr">
<head>
<meta charset="UTF-8">
<title>DAGINA – दागिने कलेक्शन</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;700;800&family=Hind:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>

<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                kumkum: '#C4161C',
                gold: '#D4AF37',
                dark: '#2D2D2D'
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
.card-soft {
    background:#fff;
    border-radius:24px;
    border:1px solid rgba(212,175,55,.15);
    box-shadow:0 10px 30px rgba(0,0,0,.04);
    transition:.3s;
}
.card-soft:hover {
    transform:translateY(-6px);
    box-shadow:0 20px 40px rgba(196,22,28,.15);
}
.whatsapp-btn {
    background:linear-gradient(135deg,#C4161C,#9E0B10);
}
.glow-hover:hover {
    box-shadow: 0 0 0 6px rgba(196, 22, 28, 0.12);
}
</style>
</head>

<body class="bg-[#FFF9F4] font-body text-dark">

<!-- HEADER -->
<header class="max-w-7xl mx-auto px-6 pt-8 pb-4 flex flex-col md:flex-row justify-between gap-4">
    <div>
        <h1 class="text-4xl font-extrabold text-kumkum font-heading drop-shadow">
            दागिने कलेक्शन
        </h1>
        <p class="text-gray-500">आजची फॅशन • कालची परंपरा</p>
    </div>

    <a href="index.php"
        class="group flex glow-hover items-center gap-2
                px-6 py-3
                rounded-full
                bg-white
                border border-gold/40
                text-gold font-bold
                shadow-md shadow-gold/20
                hover:bg-gradient-to-r hover:from-kumkum hover:to-red-700
                hover:text-white hover:border-kumkum
                hover:shadow-xl hover:shadow-kumkum/30
                transition-all duration-300">

        <!-- Home Icon -->
        <svg xmlns="http://www.w3.org/2000/svg"
            width="18" height="18"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="group-hover:scale-110 transition">
            <path d="M3 9l9-7 9 7"></path>
            <path d="M9 22V12h6v10"></path>
        </svg>

        <span>Home</span>
    </a>

</header>

<!-- SEARCH -->
<section class="max-w-4xl mx-auto px-6 my-6">
<form method="GET" class="relative">
    <input type="text" name="search" value="<?= htmlspecialchars($search); ?>"
           placeholder="काय शोधायचं आहे?"
           class="w-full px-6 py-4 rounded-full border focus:border-kumkum outline-none shadow">
</form>
</section>

<!-- CATEGORY BUTTONS -->
<section class="max-w-7xl mx-auto px-6 mb-10">
<div class="flex flex-wrap gap-3 justify-center">

<?php
$categories = [
    '' => 'सर्व',
    'दागिने' => 'दागिने',
    'रांगोळी' => 'रांगोळी',
    'पूजा साहित्य' => 'पूजा साहित्य',
    'नवीन' => 'नवीन'
];

foreach ($categories as $key => $label):
    $active = ($category === $key) || ($key === '' && empty($category));
?>
<a href="?category=<?= urlencode($key); ?>&search=<?= urlencode($search); ?>"
   class="px-5 py-2 rounded-full border font-bold text-sm transition
   <?= $active ? 'bg-kumkum text-white border-kumkum' : 'bg-white text-gray-600 border-gray-300 hover:bg-kumkum hover:text-white'; ?>">
   <?= $label; ?>
</a>
<?php endforeach; ?>

</div>
</section>

<!-- PRODUCTS -->
<section class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 pb-20">

<?php if($result->num_rows > 0): ?>
<?php while($row = $result->fetch_assoc()):
    $name  = htmlspecialchars($row['name']);
    $price = (int)$row['price'];
    $desc  = htmlspecialchars($row['description']);
    $image = htmlspecialchars($row['image']);
    $cat   = htmlspecialchars($row['category']);
    $waTxt = urlencode("नमस्कार, मला {$name} (₹{$price}) ऑर्डर करायची आहे.");
?>
<div class="card-soft overflow-hidden flex flex-col">

    <div class="h-[260px] overflow-hidden">
        <img src="admin/assets/products/<?= $image; ?>" class="w-full h-full object-cover hover:scale-110 transition">
    </div>

    <div class="p-5 flex flex-col justify-between flex-1">
        <div>
            <span class="inline-block mb-2 px-3 py-1 rounded-full text-xs font-bold bg-gold/10 text-gold">
                <?= $cat; ?>
            </span>

            <h3 class="text-xl font-bold text-dark mb-1"><?= $name; ?></h3>
            <p class="text-gray-500 text-sm mb-4 line-clamp-2"><?= $desc; ?></p>

            <span class="text-2xl font-black text-kumkum">₹<?= number_format($price); ?></span>
        </div>

        <a href="https://wa.me/7796080794?text=<?= $waTxt; ?>"
           target="_blank"
           class="whatsapp-btn mt-5 text-white py-3 rounded-xl font-bold text-center">
            WhatsApp वर ऑर्डर करा
        </a>
    </div>
</div>
<?php endwhile; ?>

<?php else: ?>
<div class="col-span-full text-center py-20 text-gray-500">
    <h3 class="text-2xl font-bold">कोणतेही प्रोडक्ट सापडले नाही</h3>
</div>
<?php endif; ?>

</section>

<footer class="text-center py-10 border-t bg-white">
<p class="text-gray-500">
© <?= date('Y'); ?> DAGINA. Handcrafted with ❤️ in India.
</p>
</footer>

</body>
</html>
