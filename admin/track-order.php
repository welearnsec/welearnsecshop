<?php
require_once '../includes/config.php';

$message = "";
$response = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trackingUrl = $_POST['tracking_url'] ?? '';

    // intentionally vulnerable to SSRF
    $response = @file_get_contents($trackingUrl);

    if ($response !== false) {
        $message = "Tracking data fetched successfully!";
    } else {
        $message = "Could not fetch tracking data.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Track Order - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
    <?php require_once "../includes/admin_navbar.php";?>

  <div class="container mt-5">
    <h2>Track Customer Order</h2>
    <?php if($message): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label for="tracking_url" class="form-label">Tracking API URL</label>
        <input type="text" name="tracking_url" class="form-control" id="tracking_url" placeholder="https://shippingapi.com/track/12345">
      </div>
      <button type="submit" class="btn btn-primary">Fetch Tracking Data</button>
    </form>
    <?php if($response): ?>
      <div class="mt-4">
        <h4>API Response:</h4>
        <pre class="bg-light p-3 border"><?=htmlspecialchars($response)?></pre>
      </div>
    <?php endif; ?>
  </div>

  <footer class="text-center mt-4">
    <div class="container">
      <p>&copy; <?=date('Y')?> WeLearnSec Shop. All rights reserved.</p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
