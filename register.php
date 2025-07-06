<?php
require_once 'includes/config.php';

// handle registration
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // intentionally weak: no password policy, no prepared statements, MD5 hashing
    $hashed = md5($password); 

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed')";
    if ($conn->query($sql)) {
        $message = "Account created successfully. <a href='login.php'>Login here</a>.";
    } else {
        $message = "Error: " . $conn->error;
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
