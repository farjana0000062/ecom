<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopper</title>
  <link rel="stylesheet" href="style/header.css">
</head>
<body>
  <header>
    <div class="navbar">
      <!-- Logo -->
      <div class="nav-logo">
        <a href="index.php"><img src="images/logo.png" alt="Logo"></a>
        <p><a href="index.php" class="logo-text">SHOPPER</a></p>
      </div>

      <!-- Menu -->
      <ul class="nav-menu">
        <li><a href="index.php">Shop</a></li>
        <li><a href="mens.php">Men</a></li>
        <li><a href="womens.php">Women</a></li>
        <li><a href="kids.php">Kids</a></li>
      </ul>

      <!-- Login / Signup / Cart -->
      <div class="nav-login-cart">
        <?php if(isset($_SESSION['user_email'])): ?>
          <span class="nav-welcome">
            Welcome, <?php echo htmlspecialchars($_SESSION['username']) ?>
          </span>

          <!-- Admin Panel button -->
          <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="admin/product.php"><button class="nav-btn admin-btn">Admin Panel</button></a>
          <?php endif; ?>

          <a href="logout.php"><button class="nav-btn">Logout</button></a>
        <?php else: ?>
          <a href="login.php"><button class="nav-btn">Login</button></a>
          <a href="signup.php"><button class="nav-btn">Sign Up</button></a>
        <?php endif; ?>

        <!-- Cart Icon -->
        <a href="cart.php"><img src="images/cart_icon.png" alt="Cart" class="nav-cart-icon"></a>
        <div class="nav-cart-count">0</div>
      </div>
    </div>
  </header>
</body>
</html>
