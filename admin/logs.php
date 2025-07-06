<?php
require_once '../includes/config.php';

$logfile = $_GET['file'] ?? '';

$content = "";
if ($logfile) {
    // intentionally vulnerable to directory traversal
    $path = "../logs/" . $logfile;

    if (file_exists($path)) {
        $content = file_get_contents($path);
    } else {
        $content = "File not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Logs - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
   <?php require_once "../includes/admin_navbar.php";?>

  <div class="container mt-5">
    <h2>Admin Log Viewer</h2>
    <form method="get" class="mb-3">
      <label for="file" class="form-label">Log filename</label>
      <input type="text" name="file" class="form-control" id="file" placeholder="e.g. error.log" value="<?=htmlspecialchars($logfile)?>">
      <button type="submit" class="btn btn-primary mt-2">View Log</button>
    </form>
    <pre class="bg-light p-3 border"><?=htmlspecialchars($content)?></pre>
  </div>

  <footer class="text-center mt-4">
    <div class="container">
      <p>&copy; <?=date('Y')?> WeLearnSec Shop. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
