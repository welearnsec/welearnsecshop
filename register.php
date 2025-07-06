<?php
require_once 'includes/config.php';

// handle registration
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
$email = $_POST['email'] ?? '';

    // intentionally weak: no password policy, no prepared statements, MD5 hashing
    $hashed = md5($password); 

  // check if username exists

$checkUser = $conn->query("SELECT id FROM users WHERE username='$username'");
if ($checkUser->num_rows > 0) {
    $message = "Username already taken. Please choose another.";
} else {
    // check if email exists
    $checkEmail = $conn->query("SELECT id FROM users WHERE email='$email'");
    if ($checkEmail->num_rows > 0) {
        $message = "Email already registered. Please use another email.";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed')";
        if ($conn->query($sql)) {
            $message = "Account created successfully. <a href='login.php'>Login here</a>.";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
     <?php include 'includes/navbar.php'; ?>

  <div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4">Create an Account</h2>
    <?php if($message): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
   <form method="post">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" required name="username" class="form-control" id="username">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" required name="email" class="form-control" id="email">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" required name="password" class="form-control" id="password">
  </div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>

  </div>

    <?php include 'includes/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
