<?php
// Sample products array
$products = [
    ["id"=>1,"name"=>"Red T-Shirt","image"=>"images/product1.png","old_price"=>50,"new_price"=>35,"reviews"=>122],
    ["id"=>2,"name"=>"Blue Hoodie","image"=>"images/product2.png","old_price"=>70,"new_price"=>50,"reviews"=>80],
    ["id"=>3,"name"=>"Black Jeans","image"=>"images/product3.png","old_price"=>90,"new_price"=>60,"reviews"=>45],
    ["id"=>4,"name"=>"White Sneakers","image"=>"images/product4.png","old_price"=>120,"new_price"=>85,"reviews"=>210],
    ["id"=>5,"name"=>"Green Jacket","image"=>"images/product5.png","old_price"=>150,"new_price"=>120,"reviews"=>95]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="product.css">
</head>
<body>

<!-- Product Cards Section -->
<section class="product-card-container">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            <h3><?php echo $product['name']; ?></h3>
            <div class="product-price">
                <span class="old-price">$<?php echo $product['old_price']; ?></span>
                <span class="new-price">$<?php echo $product['new_price']; ?></span>
            </div>
            <div class="product-stars">
                <img src="images/star_icon.png" alt="">
                <img src="images/star_icon.png" alt="">
                <img src="images/star_icon.png" alt="">
                <img src="images/star_icon.png" alt="">
                <img src="images/star_dull_icon.png" alt="">
                <span>(<?php echo $product['reviews']; ?>)</span>
            </div>
            <button>Add to Cart</button>
        </div>
    <?php endforeach; ?>
</section>

</body>
</html>
