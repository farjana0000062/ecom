<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopper</title>
  <link rel="stylesheet" href="../style/header.css">
</head>
<body>
  <header>
    <div class="navbar">
      <!-- Logo -->
      <div class="nav-logo">
        <a href="index.php"><img src="../images/logo.png" alt="Logo"></a>
        <p><a href="index.php" class="logo-text">SHOPPER</a></p>
      </div>

      <!-- Menu -->
      <ul class="nav-menu">
        <li><a href="user.php">User List</a></li>
        <li><a href="product.php">Product List</a></li>
      </ul>

      <!-- Login / Logout -->
      <div class="nav-login-cart">
        <span class="nav-welcome">
          Admin: <?php echo htmlspecialchars($_SESSION['username']); ?>
        </span>
        <a href="logout.php"><button class="nav-btn">Logout</button></a>
      </div>
    </div>
  </header>
</body>
</html>
