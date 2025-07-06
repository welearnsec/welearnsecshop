<?php
require_once 'includes/config.php';

$product_id = intval($_GET['product_id'] ?? 0);

if ($product_id > 0) {
    // vulnerable: no locking, no check per user
    $sql = "UPDATE products SET likes = likes + 1 WHERE id = $product_id";
    $conn->query($sql);
}

header("Location: product.php?id=$product_id");
exit;
?>
