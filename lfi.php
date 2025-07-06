<?php
// intentionally vulnerable LFI
$page = $_GET['page'] ?? 'default.php';

// no whitelist or validation
include($page);
