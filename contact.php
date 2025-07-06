<?php
require_once 'includes/config.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $body    = $_POST['message'] ?? '';

    // intentionally vulnerable to email header injection
    $to = "support@welearnsec-shop.local";
    $headers = "From: $email\r\n";

    $fullMessage = "Name: $name\nEmail: $email\nMessage:\n$body";

    $sent = mail($to, $subject, $fullMessage, $headers);

    if ($sent) {
        $message = "Message sent successfully.";
    } else {
        $message = "Failed to send your message.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - WeLearnSec Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
     <?php include 'includes/navbar.php'; ?>
  <div class="container mt-5" style="max-width:600px;">
    <h2>Contact Support</h2>
    <?php if($message): ?>
      <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <form method="post">
      <div class="mb-3">
        <label for="name" class="form-label">Your Name</label>
        <input type="text" name="name" required class="form-control" id="name">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Your Email</label>
        <input type="email" name="email" required class="form-control" id="email">
      </div>
      <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input type="text" name="subject" required class="form-control" id="subject">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Your Message</label>
        <textarea name="message" required class="form-control" id="message" rows="4"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
  </div>
     <?php include 'includes/footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
