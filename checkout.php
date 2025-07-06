<?php
require_once 'includes/config.php';

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// on POST confirm order
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $user = $_SESSION['username'];
            
            // look up user ID (intentionally vulnerable to SQLi)
            $sqlUser = "SELECT id FROM users WHERE username = '$user'";
            $resUser = $conn->query($sqlUser);
            $rowUser = $resUser->fetch_assoc();
            $userId = $rowUser['id'];
            
            // intentionally trusting user-supplied price from session!
            $productId = $item['product_id'];
            $quantity = $item['quantity'];
            $total = $item['price'] * $quantity;

            $sqlOrder = "INSERT INTO orders (user_id, product_id, quantity, total, status)
                         VALUES ($userId, $productId, $quantity, $total, 'pending')";
            $conn->query($sqlOrder);
        }

        unset($_SESSION['cart']);
        $message = "Order placed successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

  <div class="container mt-5">
    <h2>Checkout</h2>
    <?php if($message): ?>
      <div class="alert alert-success"><?= $message ?></div>
      <a href="index.php" class="btn btn-primary">Return to Shop</a>
    <?php else: ?>
      <?php if(empty($_SESSION['cart'])): ?>
        <div class="alert alert-info">Your cart is empty.</div>
        <a href="index.php" class="btn btn-secondary">Back to Shop</a>
      <?php else: ?>
        <h4>Order Summary</h4>
        <ul class="list-group mb-3">
          <?php foreach($_SESSION['cart'] as $item): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?=htmlspecialchars($item['name'])?> x <?=intval($item['quantity'])?>
              <span>$<?=number_format($item['price'] * $item['quantity'], 2)?></span>
            </li>
          <?php endforeach; ?>
        </ul>
        <form method="post">
          <button type="submit" class="btn btn-success">Confirm Order</button>
        </form>
      <?php endif; ?>
    <?php endif; ?>
  </div>

      <?php include 'includes/footer.php'; ?>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
