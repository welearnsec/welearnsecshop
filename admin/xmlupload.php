<?php
session_start();




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xml = $_FILES['xml']['tmp_name'];
    $data = file_get_contents($xml);

    libxml_disable_entity_loader(false); // vulnerable
    $dom = new DOMDocument();
    $dom->loadXML($data, LIBXML_NOENT | LIBXML_DTDLOAD);

    $content = $dom->saveXML();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product XML Upload - WeLearnSec Shop</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require_once "../includes/admin_navbar.php";?>
  <div class="container mt-5">
    <h2>Upload Product XML</h2>
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <input type="file" name="xml" class="form-control">
      </div>
      <button class="btn btn-primary" type="submit">Upload</button>
    </form>
    <?php if(!empty($content)): ?>
      <h4>Parsed XML:</h4>
      <pre><?=htmlspecialchars($content)?></pre>
    <?php endif; ?>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>
