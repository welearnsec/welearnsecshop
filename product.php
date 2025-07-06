<?php
require_once 'includes/config.php';

$id = $_GET['id'] ?? 0;

// intentionally vulnerable: no validation, no prepared statement
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);

if (!$result || $result->num_rows !== 1) {
    die("Product not found.");
}
$product = $result->fetch_assoc();

// add to cart logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']); // hidden field!
    
    $_SESSION['cart'][] = [
        'product_id' => $product['id'],
        'name' => $product['name'],
        'price' => $price,
        'quantity' => $quantity
    ];
    
    header("Location: cart.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?=htmlspecialchars($product['name'])?> - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-img-top {
      height: 300px;
      object-fit: cover;
      background: #f8f8f8;
    }
  </style>
</head>
<body>
  <?php include 'includes/navbar.php'; ?>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-lg rounded-4">
          <div class="card-body">
            <h3 class="card-title"><?=htmlspecialchars($product['name'])?></h3>
            <p class="card-text"><?=htmlspecialchars($product['description'])?></p>
            <h5 class="text-success mb-3">Price: $<?=number_format($product['price'],2)?></h5>

            <div class="d-flex align-items-center mb-3">
              <strong>Likes: <?= $product['likes'] ?></strong>
              <a href="like.php?product_id=<?= $product['id'] ?>" class="btn btn-outline-success btn-sm ms-3">
                ❤️ Like
              </a>
            </div>

            <form method="post" class="mt-4 border-top pt-3">
              <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" name="quantity" class="form-control w-25" id="quantity" min="1" value="1">
              </div>
              <input type="hidden" name="price" value="<?= $product['price'] ?>">
              <button type="submit" class="btn btn-primary">Add to Cart 🛒</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
