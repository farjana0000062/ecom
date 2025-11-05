<?php
session_start();
include 'config/db.php';

$message = "";

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $hashed_password, $role);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
    
        $_SESSION['user_email'] = $username;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role; 
        header("Location: index.php");
        exit();
    } else {
        $message = "<p class='error-msg'>Invalid username or password!</p>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="style/auth.css">
</head>
<body>
<div class="auth-container">
  <h2>Login</h2>

  <!-- Display message -->
  <?php if (!empty($message)) echo $message; ?>

  <form method="POST" action="login.php">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="login">Login</button>
  </form>

  <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
</div>
</body>
</html>
