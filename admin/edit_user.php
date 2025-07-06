<?php
require_once '../includes/config.php';

// broken access control
$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $hashed = md5($password); // weak hash on purpose
    $sql = "UPDATE users SET username='$username', password='$hashed' WHERE id=$id"; // SQLi
    $conn->query($sql);

    $message = "User updated!";
}

$result = $conn->query("SELECT * FROM users WHERE id=$id"); // SQLi
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/admin_navbar.php'; ?>
  <div class="container mt-5">
    <h2>Edit User</h2>
    <?php if (!empty($message)): ?>
      <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label>Username</label>
        <input name="username" value="<?= $row['username'] ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label>Password (new)</label>
        <input name="password" class="form-control">
      </div>
      <button class="btn btn-primary">Update User</button>
    </form>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>
