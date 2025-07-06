<?php
require_once '../includes/config.php';

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$message = "";

// handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPass = $_POST['newpass'] ?? '';
    $hashed = md5($newPass); // weak hash on purpose

    // intentionally missing verification of current password
    $username = $_SESSION['username'];
    $sql = "UPDATE users SET password='$hashed' WHERE username='$username'";
    $conn->query($sql);

    $message = "Password updated successfully.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Change Password - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/admin_navbar.php'; ?>
  <div class="container mt-5" style="max-width:500px;">
    <h2>Change Password</h2>
    <?php if($message): ?>
      <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label for="newpass" class="form-label">New Password</label>
        <input type="password" name="newpass" class="form-control" id="newpass" required>
      </div>
      <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
  </div>
      <?php include '../includes/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
