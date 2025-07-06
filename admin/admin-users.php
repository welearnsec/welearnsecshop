<?php
require_once '../includes/config.php';

// only checks login, not admin role
if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

// load all users
$sql = "SELECT * FROM users";
$res = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin User Management - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php require_once "../includes/admin_navbar.php";?>


  <div class="container mt-5">
    <h2>Admin User Management</h2>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $res->fetch_assoc()): ?>
          <tr>
            <td><?=htmlspecialchars($row['id'])?></td>
            <td><?=htmlspecialchars($row['username'])?></td>
            <td><?=htmlspecialchars($row['email'])?></td>
            <td><?=htmlspecialchars($row['role'])?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    <a href="../index.php" class="btn btn-secondary mt-3">Back to Shop</a>
  </div>
  <footer class="text-center mt-4">
    <div class="container">
      <p>&copy; <?=date('Y')?> WeLearnSec Shop. All rights reserved.</p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
