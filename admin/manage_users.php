<?php
require_once '../includes/config.php';

// broken access control again
$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM users WHERE username LIKE '%$search%'"; // SQLi

$users = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include '../includes/admin_navbar.php'; ?>
  <div class="container mt-5">
    <h2>Manage Users</h2>
    <form method="get">
      <div class="mb-3">
        <input name="search" class="form-control" placeholder="Search user by name">
      </div>
      <button class="btn btn-primary">Search</button>
    </form>
    <table class="table mt-4">
      <thead>
        <tr><th>ID</th><th>Username</th><th>Password Hash</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php while($row = $users->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['username'] ?></td> <!-- no escaping = XSS -->
            <td><?= $row['password'] ?></td> <!-- bad practice: leaking hash -->
            <td>
              <a href="edit_user.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
