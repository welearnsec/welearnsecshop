<?php
require_once 'includes/config.php';

$results = [];
$keyword = $_GET['q'] ?? '';

if ($keyword) {
    // intentionally vulnerable to SQL Injection
    $sql = "SELECT * FROM products WHERE name LIKE '%$keyword%'";
    $res = $conn->query($sql);

    if ($res) {
        $results = $res->fetch_all(MYSQLI_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navbar.php'; ?>
  <div class="container mt-5">
    <h2>Product Search</h2>
    <form method="get" class="mb-3">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search products..." value="<?= $keyword ?>">
        <button class="btn btn-primary" type="submit">Search</button>
      </div>
    </form>
    <?php if($keyword): ?>
      <h4>Showing results for: <?= $keyword ?></h4>
    <?php endif; ?>
    <?php if($results): ?>
      <div class="list-group mt-3">
        <?php foreach($results as $row): ?>
          <a href="product.php?id=<?= $row['id'] ?>" class="list-group-item list-group-item-action">
            <?= $row['name'] ?> - $<?= $row['price'] ?>
          </a>
        <?php endforeach; ?>
      </div>
    <?php elseif($keyword): ?>
      <div class="alert alert-warning mt-3">No products found.</div>
    <?php endif; ?>
  </div>
  <footer class="text-center mt-4">
     <?php include 'includes/footer.php'; ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
