<?php
require_once 'includes/config.php';

// vulnerable search with SQLi
$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    footer {
      background-color: #f8f9fa;
      padding: 20px;
    }
    .product-card {
      height: 100%;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
      <?php include 'includes/navbar.php'; ?>

  <!-- Main container -->
  <div class="container mt-4">
    <h1 class="mb-4">Welcome to WeLearnSec Shop</h1>
    <form method="get" class="mb-4">
      <input type="text" name="search" class="form-control" placeholder="Search products..." value="<?=htmlspecialchars($search)?>">
    </form>
    <div class="row">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-3">
          <div class="card product-card">
            <div class="card-body d-flex flex-column justify-content-between">
              <h5 class="card-title"><?=htmlspecialchars($row['name'])?></h5>
              <p class="card-text"><?=htmlspecialchars($row['description'])?></p>
              <p class="card-text"><strong>$<?=number_format($row['price'],2)?></strong></p>
             <a href="product.php?id=<?=$row['id']?>" class="btn btn-primary mt-auto mb-2">View</a>
<a href="reviews.php?id=<?=$row['id']?>" class="btn btn-outline-secondary">Leave a Review</a>

            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <!-- Footer -->
     <?php include 'includes/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
