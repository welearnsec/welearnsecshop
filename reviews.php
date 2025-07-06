<?php
require_once 'includes/config.php';

$product_id = $_GET['id'] ?? '';
$product_id = intval($product_id);

// get product info
$productRes = $conn->query("SELECT * FROM products WHERE id=$product_id");
$product = $productRes->fetch_assoc();
if (!$product) {
    die("Product not found.");
}


// handle new review submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['reviewer'] ?? 'Anonymous';
    $comment = $_POST['comment'] ?? '';

    // intentionally no sanitization
    $sql = "INSERT INTO reviews (product_id, reviewer, comment) VALUES ('$product_id', '$name', '$comment')";
    $conn->query($sql);
    header("Location: reviews.php?id=$product_id"); // simple redirect
    exit;
}

// get existing reviews
$reviewRes = $conn->query("SELECT * FROM reviews WHERE product_id=$product_id ORDER BY created_at DESC");
$reviews = $reviewRes->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?=htmlspecialchars($product['name'])?> - Reviews</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include 'includes/navbar.php'; ?>
  <div class="container mt-5">
    <h2>Reviews for <?=htmlspecialchars($product['name'])?></h2>
    <form method="post" class="mb-4">
      <div class="mb-3">
        <label for="reviewer" class="form-label">Your Name</label>
        <input type="text" name="reviewer" class="form-control" id="reviewer">
      </div>
      <div class="mb-3">
        <label for="comment" class="form-label">Your Review</label>
        <textarea name="comment" class="form-control" id="comment" rows="4"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
    <h4>All Reviews:</h4>
    <?php foreach($reviews as $review): ?>
      <div class="card mb-2">
        <div class="card-body">
          <h5 class="card-title"><?= $review['reviewer'] ?></h5>
          <p class="card-text"><?= $review['comment'] ?></p>
          <small class="text-muted"><?= $review['created_at'] ?></small>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <footer class="text-center mt-4">
    <?php include 'includes/footer.php'; ?>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
