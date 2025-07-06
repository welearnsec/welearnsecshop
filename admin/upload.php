<?php
require_once '../includes/config.php';

// file upload
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['file']['name'])) {
        $targetDir = "../uploads/";

        // auto-create folder if missing
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            $message = "File uploaded successfully to: <a href='$targetFile' target='_blank'>$targetFile</a>";
        } else {
            $message = "Error uploading file. Please check folder permissions.";
        }
    } else {
        $message = "No file selected.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin File Upload - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require_once "../includes/admin_navbar.php"; ?>

  <div class="container mt-5">
    <h2>Admin File Upload</h2>
    <?php if($message): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="file" class="form-label">Select file to upload</label>
        <input type="file" name="file" class="form-control" id="file" required>
      </div>
      <button type="submit" class="btn btn-primary">Upload</button>
    </form>
  </div>

  <footer class="text-center mt-4">
    <div class="container">
      <p>&copy; <?=date('Y')?> WeLearnSec Shop. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
