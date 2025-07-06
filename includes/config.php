<?php
// includes/config.php

// intentionally weak DB connection with hard-coded credentials
$servername = "localhost";
$username = "root";
$password = ""; // empty password on purpose
$dbname = "welearnsec_shop";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// session start with no secure flags
session_start();
?>
