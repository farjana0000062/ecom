<?php
// Include DB connection
include 'config/db.php';

// Fetch all products ordered by newest first
$sql = "SELECT id, name, image, description, newPrice, oldPrice, category FROM products ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="style/product.css">
</head>
<body>

<h2>Products</h2>

<!-- Product Cards Section -->
<section class="product-card-container">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($product = $result->fetch_assoc()): ?>
            <div class="product-card">
                <img src="admin/<?php echo htmlspecialchars($product['image']); ?>" 
     alt="<?php echo htmlspecialchars($product['name']); ?>" 
     width="150">

                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p class="product-desc"><?php echo htmlspecialchars($product['description']); ?></p>
                <div class="product-category">Category: <?php echo $product['category']; ?></div>
                <div class="product-price">
                    <?php if (!empty($product['oldPrice'])): ?>
                        <span class="old-price">$<?php echo number_format($product['oldPrice'], 2); ?></span>
                    <?php endif; ?>
                    <span class="new-price">$<?php echo number_format($product['newPrice'], 2); ?></span>
                </div>
                <button>Add to Cart</button>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</section>

</body>
</html>
