<?php
session_start();
include '../config/db.php';

// ✅ Optional: restrict access to admin only
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// ✅ Fetch all products
$query = "SELECT * FROM products ORDER BY id DESC";
$products_result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Products</title>
    <link rel="stylesheet" href="../style/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
        .product-container {
            width: 90%;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #222;
            color: #fff;
        }
        tr:hover {
            background-color: #f2f2f2;
        }
        img {
            border-radius: 5px;
        }
        a.btn {
            display: inline-block;
            background: #007bff;
            color: #fff;
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 4px;
        }
        a.btn:hover {
            background: #0056b3;
        }
        footer {
            text-align: center;
            padding: 15px;
            background: #222;
            color: #fff;
            margin-top: 50px;
        }
        .top-links {
            margin-bottom: 15px;
            text-align: right;
        }
        .top-links a {
            background: #28a745;
            color: #fff;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
        }
        .top-links a:hover {
            background: #218838;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="product-container">
    <h2>🛍️ Product Management</h2>

    <div class="top-links">
        <a href="add_product.php">+ Add New Product</a>
    </div>

    <?php if ($products_result && $products_result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>New Price</th>
                <th>Old Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            <?php while($product = $products_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($product['id']); ?></td>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td><img src="<?php echo htmlspecialchars($product['image']); ?>" width="60" alt="Product"></td>
                <td><?php echo htmlspecialchars($product['description']); ?></td>
                <td><?php echo $product['newPrice']; ?></td>
                <td><?php echo $product['oldPrice']; ?></td>
                <td><?php echo htmlspecialchars($product['category']); ?></td>
                <td>
                    <a href="edit_product.php?id=<?php echo $product['id']; ?>" class="btn">Edit</a>
                    <a href="delete_product.php?id=<?php echo $product['id']; ?>" class="btn" style="background:#dc3545;" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p style="text-align:center; color:#555;">No products found.</p>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; 2025 ShopEase. All rights reserved.</p>
</footer>

</body>
</html>
