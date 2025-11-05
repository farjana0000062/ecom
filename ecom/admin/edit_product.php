<?php
include '../config/db.php';

$message = "";

// Get product ID from query
if (!isset($_GET['id'])) {
    header("Location: product.php");
    exit();
}

$product_id = $_GET['id'];

// Fetch product details
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    header("Location: product.php");
    exit();
}

// Handle form submission
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $newPrice = $_POST['newPrice'];
    $oldPrice = $_POST['oldPrice'];
    $category = trim($_POST['category']);

    $image = $product['image']; // existing image

    // Handle new image upload
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../assets/images/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $image = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    }

    // Update product in DB
    $stmt = $conn->prepare("UPDATE products SET name=?, image=?, description=?, newPrice=?, oldPrice=?, category=? WHERE id=?");
    $stmt->bind_param("sssddsi", $name, $image, $description, $newPrice, $oldPrice, $category, $product_id);

    if ($stmt->execute()) {
        $message = "<p class='success-msg'>✅ Product updated successfully!</p>";
        // Refresh product info
        $product['name'] = $name;
        $product['description'] = $description;
        $product['newPrice'] = $newPrice;
        $product['oldPrice'] = $oldPrice;
        $product['category'] = $category;
        $product['image'] = $image;
    } else {
        $message = "<p class='error-msg'>❌ Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/product_form-form.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="product-form-container">
    <h2>Edit Product</h2>

    <?php if (!empty($message)) echo $message; ?>

    <form method="POST" action="edit_product.php?id=<?php echo $product_id; ?>" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

        <label>Description:</label>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>

        <label>New Price (৳):</label>
        <input type="number" name="newPrice" step="0.01" value="<?php echo $product['newPrice']; ?>" required>

        <label>Old Price (৳):</label>
        <input type="number" name="oldPrice" step="0.01" value="<?php echo $product['oldPrice']; ?>">

        <label>Category:</label>
        <select name="category" required>
            <option value="Men" <?php if($product['category']=='Men') echo 'selected'; ?>>Men</option>
            <option value="Women" <?php if($product['category']=='Women') echo 'selected'; ?>>Women</option>
            <option value="Kids" <?php if($product['category']=='Kids') echo 'selected'; ?>>Kids</option>
        </select>

        <label>Current Image:</label>
        <br>
        <?php if (!empty($product['image'])): ?>
            <img src="<?php echo $product['image']; ?>" width="100" alt="Product Image">
        <?php else: ?>
            <p>No image uploaded</p>
        <?php endif; ?>

        <label>Change Image:</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit" name="submit">Update Product</button>
    </form>

    <br>
    <a href="product.php">← Back to Product List</a>
</div>

<footer>
    <p>&copy; 2025 ShopEase. All rights reserved.</p>
</footer>

</body>
</html>
