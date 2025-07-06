<?php
require_once 'includes/config.php';

// handle remove
if (isset($_GET['remove'])) {
    $removeIndex = intval($_GET['remove']);
    if (isset($_SESSION['cart'][$removeIndex])) {
        unset($_SESSION['cart'][$removeIndex]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // reindex
    }
}

// calculate total
$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cart - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
    <?php include 'includes/navbar.php'; ?>

  <div class="container mt-5">
    <h2>Your Shopping Cart</h2>
    <?php if(empty($_SESSION['cart'])): ?>
      <p>Your cart is empty. <a href="index.php">Go shopping</a>.</p>
    <?php else: ?>
      <table class="table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($_SESSION['cart'] as $index => $item): ?>
            <tr>
              <td><?=htmlspecialchars($item['name'])?></td>
              <td>$<?=number_format($item['price'],2)?></td>
              <td><?=intval($item['quantity'])?></td>
              <td>$<?=number_format($item['price'] * $item['quantity'],2)?></td>
              <td>
                <a href="cart.php?remove=<?=$index?>" class="btn btn-danger btn-sm">Remove</a>
              </td>
            </tr>
          <?php endforeach; ?>
          <tr>
            <td colspan="3" class="text-end"><strong>Total:</strong></td>
            <td><strong>$<?=number_format($total,2)?></strong></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    <?php endif; ?>
  </div>

     <?php include 'includes/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
