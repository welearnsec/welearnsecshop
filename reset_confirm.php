<?php
require_once 'includes/config.php';

$message = "";
$token = $_GET['token'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['password'] ?? '';
    $hashed = md5($newPassword); // weak hash

    // no validation if token expired
    $sql = "UPDATE users SET password='$hashed', reset_token=NULL WHERE reset_token='$token'";
    $conn->query($sql);

    $message = "Password changed successfully. You may <a href='login.php'>login</a> now.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Confirm Password Reset - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <?php include 'includes/navbar.php'; ?>
  <div class="container mt-5" style="max-width:500px;">
    <h2>Set New Password</h2>
    <?php if($message): ?>
      <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" required name="password" class="form-control" id="password">
      </div>
      <button type="submit" class="btn btn-success">Reset Password</button>
    </form>
  </div>
  
    <?php include 'includes/footer.php'; ?>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
