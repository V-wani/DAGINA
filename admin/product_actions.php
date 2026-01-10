<?php
require 'auth.php';
require 'db_connect.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $action = $_POST['action'];
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    
    // --- 1. HANDLE IMAGE UPLOAD ---
    $imagePath = $_POST['current_image'] ?? 'default.jpg'; // Keep old image by default
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "assets/products/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        // Generate unique name: product_12345.jpg
        $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
        $newFileName = "product_" . time() . "." . $extension;
        $targetFile = $targetDir . $newFileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $imagePath = $newFileName; // Save ONLY the filename to DB
        }
    }

    // --- 2. ADD NEW PRODUCT ---
    if ($action == 'add') {
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $name, $desc, $price, $imagePath);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Product added successfully!";
        } else {
            $_SESSION['error'] = "Error adding product.";
        }
    }

    // --- 3. EDIT EXISTING PRODUCT ---
    elseif ($action == 'edit') {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, image=? WHERE id=?");
        $stmt->bind_param("ssdsi", $name, $desc, $price, $imagePath, $id);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Product updated successfully!";
        } else {
            $_SESSION['error'] = "Error updating product.";
        }
    }
    
    header("Location: products.php");
    exit();
}

// --- 4. DELETE PRODUCT ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    
    // Optional: Delete the image file from folder
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row && $row['image'] != 'default.jpg') {
        if(file_exists("assets/products/" . $row['image'])) {
            unlink("assets/products/" . $row['image']);
        }
    }

    // Delete from DB
    $delStmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $delStmt->bind_param("i", $id);
    $delStmt->execute();

    $_SESSION['success'] = "Product removed.";
    header("Location: products.php");
    exit();
}
?>