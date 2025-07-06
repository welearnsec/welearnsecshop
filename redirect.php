<?php
// no validation at all (INTENTIONALLY VULNERABLE)
$url = $_GET['url'] ?? 'index.php';

header("Location: $url");
exit;
?>
