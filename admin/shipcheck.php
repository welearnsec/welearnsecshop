<?php
require_once '../includes/config.php';

// check user login
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$result = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetUrl = trim($_POST['url'] ?? '');
    if (!empty($targetUrl)) {
        $result = @file_get_contents($targetUrl);
    } else {
        $result = "Error: URL cannot be empty.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shipping Status Check - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php require_once "../includes/admin_navbar.php"; ?>
  <div class="container mt-5">
    <h2>Shipping Status Verification</h2>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Enter Shipping API URL</label>
        <input type="text" name="url" class="form-control" placeholder="http://127.0.0.1:8080/api/ship/12345">
      </div>
      <button type="submit" class="btn btn-primary">Check Status</button>
    </form>
    <?php if($result): ?>
      <div class="alert alert-secondary mt-3">
        <strong>Response:</strong><br>
        <pre><?= htmlspecialchars($result) ?></pre>
      </div>
    <?php endif; ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
