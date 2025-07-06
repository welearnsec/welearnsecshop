<?php
require_once '../includes/config.php';

// no admin check
$id = $_GET['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $desc = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;

    $sql = "UPDATE products SET name='$name', description='$desc', price=$price, stock=$stock WHERE id=$id"; // SQLi
    $conn->query($sql);

    $message = "Product updated!";
}

$result = $conn->query("SELECT * FROM products WHERE id=$id");
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Product - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/admin_navbar.php'; ?>
  <div class="container mt-5">
    <h2>Edit Product</h2>
    <?php if (!empty($message)): ?>
      <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label>Name</label>
        <input name="name" value="<?= $row['name'] ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"><?= $row['description'] ?></textarea>
      </div>
      <div class="mb-3">
        <label>Price</label>
        <input name="price" value="<?= $row['price'] ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label>Stock</label>
        <input name="stock" value="<?= $row['stock'] ?>" class="form-control">
      </div>
      <button class="btn btn-primary">Update Product</button>
    </form>
  </div>
</body>
</html>
