<?php
session_start();
include 'config/db.php';

$message = "";

if (isset($_POST['signup'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "<p class='error-msg'>Passwords do not match!</p>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "<p class='error-msg'>Username or Email already exists!</p>";
        } else {
            $role = 'user'; 
            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $firstname, $lastname, $username, $email, $hashed_password, $role);

            if ($stmt->execute()) {
                $_SESSION['user_email'] = $email;
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $role;
                header("Location: index.php");
                exit();
            } else {
                $message = "<p class='error-msg'>Signup failed. Try again.</p>";
            }
        }
        $stmt->close();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up</title>
  <link rel="stylesheet" href="style/auth.css">
</head>
<body>
<div class="auth-container">
  <h2>Sign Up</h2>

  <?php if (!empty($message)) echo $message; ?>

  <form method="POST" action="signup.php">
      <div class="name-row">
        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
      </div>
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit" name="signup">Sign Up</button>
  </form>

  <p>Already have an account? <a href="login.php">Login here</a></p>
</div>
</body>
</html>
