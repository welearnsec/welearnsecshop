<?php
// intentionally vulnerable to RFD / arbitrary file download

$file = $_GET['file'] ?? '';

if ($file) {
    $path = "invoices/" . $file;  // invoices folder (but no validation!)
    if (file_exists($path)) {
        header("Content-Disposition: attachment; filename=" . basename($file));
        header("Content-Type: application/octet-stream");
        readfile($path);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "No file specified.";
}
?>
