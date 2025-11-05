<?php
include '../config/db.php';

$message = "";

// ✅ Handle form submission
if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $newPrice = $_POST['newPrice'];
    $oldPrice = $_POST['oldPrice'];
    $category = trim($_POST['category']);

    // ✅ Handle image upload
    $image = "";
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
    $image = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $image);

    }

    // ✅ Insert into database
    $stmt = $conn->prepare("INSERT INTO products (name, image, description, newPrice, oldPrice, category) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdds", $name, $image, $description, $newPrice, $oldPrice, $category);

    if ($stmt->execute()) {
        $message = "<p class='success-msg'>✅ Product added successfully!</p>";
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
  <title>Add Product</title>
  <link rel="stylesheet" href="../style/style.css">
  <link rel="stylesheet" href="../style/product_form.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="product-form-container">
  <h2>Add New Product</h2>

  <!-- Display messages -->
  <?php if (!empty($message)) echo $message; ?>

  <form method="POST" action="add_product.php" enctype="multipart/form-data">
    <label>Product Name:</label>
    <input type="text" name="name" required>

    <label>Description:</label>
    <textarea name="description" required></textarea>

    <label>New Price (৳):</label>
    <input type="number" name="newPrice" step="0.01" required>

    <label>Old Price (৳):</label>
    <input type="number" name="oldPrice" step="0.01">

    <label>Category:</label>
    <select name="category" required>
        <option value="">-- Select Category --</option>
        <option value="Men">Men</option>
        <option value="Women">Women</option>
        <option value="Kids">Kids</option>
    </select>

    <label>Image:</label>
    <input type="file" name="image" accept="image/*">

    <button type="submit" name="submit">Add Product</button>
</form>


  <br>
  <a href="product.php">← Back to Product List</a>
</div>


<!-- Footer -->
<footer>
  <p>&copy; 2025 ShopEase. All rights reserved.</p>
</footer>

</body>
</html>
