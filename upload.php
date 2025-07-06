<?php
require_once 'includes/config.php';

if (empty($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

$message = "";

// handle upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = "../uploads/"; // intentionally web-accessible
    $fileName = $_FILES['file']['name'];
    $fileTmp  = $_FILES['file']['tmp_name'];

    // no file extension or MIME type validation
    if (move_uploaded_file($fileTmp, $uploadDir . $fileName)) {
        $message = "File uploaded successfully to uploads/$fileName";
    } else {
        $message = "File upload failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Product Image - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php include 'includes/navbar.php'; ?>

  <div class="container mt-5" style="max-width:600px;">
    <h2>Upload Product Image</h2>
    <?php if($message): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="file" class="form-label">Select a file</label>
        <input type="file" name="file" class="form-control" id="file">
      </div>
      <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <div class="alert alert-warning mt-3">
      <strong>Please upload file</strong>
    </div>
  </div>
  <footer class="text-center mt-4">
   
      <?php include 'includes/footer.php'; ?>

   
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
