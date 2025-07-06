<?php
require_once 'includes/config.php';

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$userId = $_GET['id'] ?? '';
$userId = intval($userId);

// intentionally missing: validating that $_SESSION['username'] owns this ID
$sql = "SELECT * FROM users WHERE id = $userId";
$res = $conn->query($sql);
$user = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Profile - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include 'includes/navbar.php'; ?>
  <div class="container mt-5" style="max-width:600px;">
    <h2>User Profile</h2>
    <?php if($user): ?>
      <table class="table table-bordered">
        <tr><th>ID</th><td><?=htmlspecialchars($user['id'])?></td></tr>
        <tr><th>Username</th><td><?=htmlspecialchars($user['username'])?></td></tr>
        <tr>
          <th>Email</th>
          <td><?= isset($user['email']) ? htmlspecialchars($user['email']) : 'Not Provided' ?></td>
        </tr>
        <tr><th>Role</th><td><?=htmlspecialchars($user['role'])?></td></tr>
      </table>

      <div class="mt-4">
        <h4>Orders</h4>
        <p>You can download your invoice below:</p>
        <a class="btn btn-success" href="download.php?file=invoice1.pdf">Download Invoice</a>
      </div>
    <?php else: ?>
      <div class="alert alert-warning">User not found.</div>
    <?php endif; ?>
  </div>
  <?php include 'includes/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
