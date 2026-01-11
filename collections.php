<?php
require "admin/db_connect.php";

/* 1. INITIALIZE SEARCH VARIABLE */
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

/* 2. PREPARE QUERY BASED ON SEARCH */
if (!empty($search)) {
    // Secure search using Prepared Statements
    $sql = "SELECT * FROM products WHERE status = 1 AND (name LIKE ? OR description LIKE ?) ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Default Query
    $query = "SELECT * FROM products WHERE status = 1 ORDER BY id DESC";
    $result = $conn->query($query);
}

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

    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@500;600;700;800&family=Hind:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        kumkum: '#C4161C',
                        cream: '#FFF6EE',
                        gold: '#D4AF37',
                        dark: '#2D2D2D'
                    },
                    fontFamily: {
                        heading: ['"Baloo 2"', 'cursive'],
                        body: ['"Hind"', 'sans-serif']
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Hind', sans-serif; }
        
        .card-soft {
            background: #ffffff;
            border: 1px solid rgba(212, 175, 55, 0.15); /* Subtle gold border */
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.04);
            transition: all 0.3s ease;
        }
        
        .card-soft:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(196, 22, 28, 0.1);
            border-color: rgba(196, 22, 28, 0.3);
        }

        .badge-popular {
            background: linear-gradient(135deg, #C4161C 0%, #ff4d4d 100%);
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 4px 12px;
            border-radius: 999px;
            box-shadow: 0 4px 10px rgba(196, 22, 28, 0.3);
        }

        /* --- UPDATED BUTTON STYLE TO MATCH THEME --- */
        .whatsapp-btn {
            /* Red Gradient matching Kumkum Theme */
            background: linear-gradient(135deg, #C4161C 0%, #9E0B10 100%);
            box-shadow: 0 8px 20px rgba(196, 22, 28, 0.3);
            transition: all 0.3s ease;
        }
        
        .whatsapp-btn:hover {
            box-shadow: 0 12px 25px rgba(196, 22, 28, 0.5);
            transform: translateY(-2px);
        }
        
        .whatsapp-btn:active {
            transform: translateY(0);
        }

        /* Search Input Styling */
        .search-wrapper {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .search-input {
            width: 100%;
            padding: 16px 24px;
            padding-left: 55px;
            border-radius: 50px;
            border: 2px solid transparent;
            background: white;
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.1);
            font-size: 1.1rem;
            color: #4a4a4a;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #C4161C; /* Focus color changed to Red */
            box-shadow: 0 10px 30px rgba(196, 22, 28, 0.15);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #C4161C; /* Icon color changed to Red */
        }
    </style>
</head>

<body class="bg-[#FFF9F4] text-dark">

<header class="max-w-7xl mx-auto px-6 pt-8 pb-4 flex flex-col md:flex-row items-center justify-between gap-4">
    
    <div class="text-center md:text-left">
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-kumkum font-heading drop-shadow-sm">
            दागिने कलेक्शन
        </h1>
        <p class="text-gray-500 text-sm md:text-base font-medium mt-1">
            आजची फॅशन - कालची परंपरा
        </p>
    </div>

    <a href="./index.php" 
       class="group flex items-center gap-2 px-6 py-2.5 rounded-full border border-gold/30 bg-white text-gold font-bold hover:bg-kumkum hover:text-white hover:border-kumkum transition-all duration-300 shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
        </svg>
        <span>Home</span>
    </a>
</header>

<section class="max-w-7xl mx-auto px-6 mb-12 mt-4">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="search-wrapper">
        <svg class="search-icon w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
        <input type="text" 
               name="search" 
               value="<?php echo htmlspecialchars($search); ?>" 
               class="search-input" 
               placeholder="काय शोधायचं आहे? (उदा. माळ, नेकलेस...)">
        
        <?php if(!empty($search)): ?>
            <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-kumkum">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>
        <?php endif; ?>
    </form>
</section>

<section class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 pb-20">

<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): 
        $name  = htmlspecialchars($row['name']);
        $price = (int)$row['price'];
        $image = $row['image'];
        $desc  = !empty($row['description']) ? htmlspecialchars($row['description']) : "उत्कृष्ट दर्जाचे दागिने";
        
        // Calculate fake discount
        $old_price = (int)($price * 1.35); 
        $discount  = round((($old_price - $price) / $old_price) * 100);
        
        $waText = urlencode("नमस्कार, मला {$name} (₹{$price}) ऑर्डर करायची आहे.");
    ?>

    <div class="card-soft overflow-hidden flex flex-row lg:flex-col w-full h-full relative group">
        
        <div class="relative w-[40%] lg:w-full lg:h-[280px] bg-gray-50 overflow-hidden">
            <img src="admin/assets/products/<?php echo htmlspecialchars($image); ?>" 
                 alt="<?php echo $name; ?>" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
            
            <div class="absolute inset-0 bg-gradient-to-r from-black/10 to-transparent lg:hidden"></div>
            
            <div class="absolute top-3 left-3 badge-popular z-10">
                NEW ARRIVAL
            </div>
        </div>

        <div class="p-5 flex flex-col justify-between flex-1 relative bg-white">
            <div>
                <h3 class="text-xl font-bold text-gray-800 font-heading leading-tight mb-1 group-hover:text-kumkum transition-colors">
                    <?php echo $name; ?>
                </h3>
                
                <p class="text-gray-500 text-xs font-medium mb-3 line-clamp-2">
                    <?php echo $desc; ?>
                </p>

                <div class="flex items-end gap-2 mb-5">
                    <span class="text-2xl font-extrabold text-kumkum">
                        ₹<?php echo number_format($price); ?>
                    </span>
                    <div class="flex flex-col mb-1">
                        <span class="text-[10px] text-gray-400 font-bold strike-through line-through">
                            ₹<?php echo number_format($old_price); ?>
                        </span>
                        <span class="text-[10px] text-green-600 font-bold">
                            <?php echo $discount; ?>% OFF
                        </span>
                    </div>
                </div>
            </div>

            <a href="https://wa.me/7796080794?text=<?php echo $waText; ?>" 
               target="_blank"
               class="whatsapp-btn w-full flex items-center justify-center gap-2 text-white py-3 rounded-xl font-bold text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.148-.148.346-.396.52-.594.173-.198.23-.335.346-.545.116-.208.058-.387-.029-.565-.087-.179-.781-1.882-1.07-2.578-.287-.693-.578-.6-.796-.611-.2-.012-.429-.014-.658-.014-.229 0-.6.085-.914.428-.314.343-1.201 1.173-1.201 2.863 0 1.69 1.231 3.323 1.402 3.551.172.229 2.423 3.7 5.871 5.19 2.286.988 3.148.819 4.301.768 1.258-.055 2.534-1.037 2.891-2.038.357-1.002.357-1.86.25-2.048z"/>
                </svg>
                Order on WhatsApp
            </a>
        </div>
    </div>

    <?php endwhile; ?>

<?php else: ?>
    <div class="col-span-full flex flex-col items-center justify-center py-20 text-center opacity-80">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" class="text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </div>
        <h3 class="text-2xl font-bold text-gray-700 mb-2 font-heading">
            '<?php echo htmlspecialchars($search); ?>' साठी काहीही सापडले नाही
        </h3>
        <p class="text-gray-500">कृपया दुसरे नाव शोधून पहा किंवा आमचे होम पेज पहा.</p>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="mt-6 text-kumkum font-bold hover:underline">View All Products</a>
    </div>
<?php endif; ?>

</section>

<footer class="text-center py-10 border-t border-gold/20 bg-white">
    <p class="text-gray-500 font-medium tracking-wide">
        © <?php echo date('Y'); ?> DAGINA. Handcrafted with ❤️ in India.
    </p>
</footer>

</body>
</html>

```