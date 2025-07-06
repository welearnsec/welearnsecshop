<?php
require_once '../includes/config.php';

$message = "";

// vulnerable XML upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_FILES['xml']['tmp_name'])) {
        $xmlData = file_get_contents($_FILES['xml']['tmp_name']);

        // intentionally vulnerable
        libxml_disable_entity_loader(false);
        $xml = simplexml_load_string($xmlData, "SimpleXMLElement", LIBXML_NOENT | LIBXML_DTDLOAD);

        if ($xml) {
            $message = "XML imported successfully: " . htmlspecialchars($xml->asXML());
        } else {
            $message = "Invalid XML file.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Import XML - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
   <?php require_once "../includes/admin_navbar.php";?>

  <div class="container mt-5">
    <h2>Admin XML Import</h2>
    <?php if($message): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="xml" class="form-label">Upload XML file</label>
        <input type="file" name="xml" class="form-control" id="xml">
      </div>
      <button type="submit" class="btn btn-primary">Import</button>
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
