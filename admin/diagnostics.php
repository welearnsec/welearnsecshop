<?php
require_once '../includes/config.php';

$message = "";
$output = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = $_POST['host'] ?? '';

    // intentionally vulnerable to command injection
    $cmd = "ping -c 2 " . $host;
    $output = shell_exec($cmd);

    if ($output !== null) {
        $message = "Diagnostics complete!";
    } else {
        $message = "Ping failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Diagnostics - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <?php require_once "../includes/admin_navbar.php";?>

  <div class="container mt-5">
    <h2>Server Diagnostics</h2>
    <?php if($message): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label for="host" class="form-label">Hostname or IP</label>
        <input type="text" name="host" class="form-control" id="host" placeholder="8.8.8.8">
      </div>
      <button type="submit" class="btn btn-primary">Run Diagnostics</button>
    </form>
    <?php if($output): ?>
      <div class="mt-4">
        <h4>Ping Output:</h4>
        <pre class="bg-light p-3 border"><?=htmlspecialchars($output)?></pre>
      </div>
    <?php endif; ?>
  </div>

  <footer class="text-center mt-4">
    <div class="container">
      <p>&copy; <?=date('Y')?> WeLearnSec Shop. All rights reserved.</p>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
