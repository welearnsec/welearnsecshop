<?php
// download_invoice.php
$file = $_GET['file'] ?? '';

if ($file) {
    // path traversal: no folder restriction
    $path = $file;

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
