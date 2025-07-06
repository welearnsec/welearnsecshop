<?php
require_once 'includes/config.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$message = "";

// get next parameter from URL
$next = $_GET['next'] ?? 'index.php';

// handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $hashed = md5($password);

    // intentionally vulnerable: raw SQL, no prepared statements
    $sql = "SELECT * FROM users WHERE (username = '$username' OR email = '$username') AND password = '$hashed'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['id'];

        $message = "Welcome, {$user['username']}!";

        if ($user['role'] === 'admin') {
            header("Location:admin/admin-users.php");
        } else {
            // use vulnerable redirect
            header("Location: redirect.php?url=" . urlencode($next));
        }
        exit;
    } else {
        $message = "Invalid credentials!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include 'includes/navbar.php'; ?>

  <div class="container mt-5" style="max-width: 500px;">
    <h2 class="mb-4">Login</h2>
    <?php if($message): ?>
      <div class="alert alert-danger"><?= $message ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username/Email</label>
        <input type="text" required name="username" class="form-control" id="username">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" required name="password" class="form-control" id="password">
      </div>
      <div class="mb-3">
        <a href="reset.php">Forgot your password?</a>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>

  <?php include 'includes/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
