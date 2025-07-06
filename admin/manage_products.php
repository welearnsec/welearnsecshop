<?php
require_once '../includes/config.php';

// NO admin check on purpose (broken access control)

// deletion (vulnerable to SQLi + CSRF)
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; // no escaping
    $conn->query("DELETE FROM products WHERE id=$id"); // SQLi
    $message = "Product deleted!";
}

// product adding (no validation)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $desc = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;

    $sql = "INSERT INTO products (name, description, price, stock) VALUES ('$name', '$desc', $price, $stock)";
    $conn->query($sql); // SQLi
    $message = "Product added!";
}

$products = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Products - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include '../includes/admin_navbar.php'; ?>
  <div class="container mt-5">
    <h2>Manage Products</h2>
    <?php if (!empty($message)): ?>
      <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>

    <h4>Add New Product</h4>
    <form method="post">
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control"></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Price</label>
        <input name="price" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Stock</label>
        <input name="stock" class="form-control">
      </div>
      <button class="btn btn-primary">Add Product</button>
    </form>

    <h4 class="mt-5">Product List</h4>
    <table class="table">
      <thead>
        <tr><th>ID</th><th>Name</th><th>Price</th><th>Stock</th><th>Actions</th></tr>
      </thead>
      <tbody>
        <?php while($row = $products->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td> <!-- no escaping = XSS -->
            <td><?= $row['price'] ?></td>
            <td><?= $row['stock'] ?></td>
            <td>
              <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
              <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
