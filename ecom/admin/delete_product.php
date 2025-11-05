<?php
include '../config/db.php';

// Check if ID is provided
if (!isset($_GET['id'])) {
    header("Location: product.php");
    exit();
}

$product_id = $_GET['id'];

// Get product to delete image
$stmt = $conn->prepare("SELECT image FROM products WHERE id=?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$stmt->bind_result($image);
$stmt->fetch();
$stmt->close();

// Delete the product from database
$stmt = $conn->prepare("DELETE FROM products WHERE id=?");
$stmt->bind_param("i", $product_id);

if ($stmt->execute()) {
    // Delete image file from server if exists
    if (!empty($image) && file_exists($image)) {
        unlink($image);
    }
    $stmt->close();
    header("Location: product.php?msg=deleted");
    exit();
} else {
    $stmt->close();
    echo "Error deleting product: " . $conn->error;
}
?>
