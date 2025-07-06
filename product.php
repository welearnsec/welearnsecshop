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
    
    // store directly in session
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
</head>
<body>
  <!-- Navbar -->
     <?php include 'includes/navbar.php'; ?>

  <div class="container mt-5">
    <h2><?=htmlspecialchars($product['name'])?></h2>
    <p><?=htmlspecialchars($product['description'])?></p>
    <p><strong>Price: $<?=number_format($product['price'],2)?></strong></p>
    
    <form method="post" class="mt-3">
      <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" name="quantity" class="form-control" id="quantity" min="1" value="1">
      </div>
      <!-- hidden price field, easily tamperable -->
      <input type="hidden" name="price" value="<?= $product['price'] ?>">
      <button type="submit" class="btn btn-primary">Add to Cart</button>
    </form>
  </div>

      <?php include 'includes/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
