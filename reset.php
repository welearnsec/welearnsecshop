<?php
require_once 'includes/config.php';

$message = "";

// handle reset request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    // intentionally vulnerable: no check if email actually exists
    // weak random token
    $token = md5(uniqid($email, true));

    // store token with no expiry
    $sql = "UPDATE users SET reset_token='$token' WHERE email='$email'";
    $conn->query($sql);

    // in real life, would send email — here we just show the link
    $message = "Password reset link: <a href='reset_confirm.php?token=$token'>Click here to reset</a>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
      <?php include 'includes/navbar.php'; ?>
  <div class="container mt-5" style="max-width:500px;">
    <h2>Reset Your Password</h2>
    <?php if($message): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Enter your email</label>
        <input type="email" required name="email" class="form-control" id="email">
      </div>
      <button type="submit" class="btn btn-primary">Send Reset Link</button>
    </form>
  </div>
     <?php include 'includes/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
