<?php
session_start();

$requiredPassword = "thisisthepassword";

// check if already authenticated
if (!isset($_SESSION['vuln_auth'])) {
    // user is not yet authenticated
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $entered = $_POST['password'] ?? '';
        if ($entered === $requiredPassword) {
            $_SESSION['vuln_auth'] = true;
            header("Location: vuln.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Protected vuln.php</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container mt-5">
        <h2>Enter Password to Access vuln.php</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?=htmlspecialchars($error)?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Enter password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </body>
    </html>
    <?php
    exit; // stop further execution until correct password
}

// if authenticated, show the vuln matrix
function showVulnerabilitySummary() {
echo nl2br(htmlspecialchars(
<<<EOT
PROJECT: WeLearnSec vulnerable ecommerce Platform
=====================================

Technology: PHP + MySQL
Author: welearnsec@gmail.com
Purpose: Deliberately vulnerable lab for security training

Vulnerability Matrix
--------------------

#1 SQL Injection
  - Pages: login.php (username, password fields), search.php (query parameter), admin/manage_users.php (search field)
  - How to exploit:
    ' OR 1=1 --
    ' UNION SELECT null,null,version() --
  - Technique: inject raw SQL in login or search inputs

#2 Cross-Site Scripting (XSS)
  - Pages: search.php (query parameter), profile.php (name field)
  - How to exploit:
    <script>alert(1)</script>
  - Technique: inject JavaScript in fields rendered back to the page

#3 CSRF
  - Pages: changepass.php (new password form), admin/manage_invoices.php (approve invoice button)
  - How to exploit:
    Create an auto-submitting form that sends a POST request with victim's cookies
  - Technique: cross-origin POST with no CSRF token

#4 Local File Inclusion (LFI)
  - Page: admin/logs.php (file parameter)
  - How to exploit:
    ?file=../../../../etc/passwd
  - Technique: path traversal to include system files

#5 Reflected File Download (RFD)
  - Page: download.php (file parameter in Content-Disposition)
  - How to exploit:
    invoice.php%0AContent-Type:application/javascript
  - Technique: inject CRLF to change response headers, force malicious download

#6 Insecure Direct Object Reference (IDOR)
  - Page: download.php (file parameter)
  - How to exploit:
    change file name to another user’s invoice: invoice2.pdf
  - Technique: predict or enumerate valid invoice filenames

#7 Directory Traversal
  - Page: download.php (file parameter)
  - How to exploit:
    ?file=../../index.php
  - Technique: climb up directories to read arbitrary files

#8 Insecure File Upload
  - Page: admin/upload.php (file input)
  - How to exploit:
    upload evil.php disguised as .pdf
  - Technique: bypass MIME/type checks with double extensions

#9 Broken Access Control
  - Pages: admin/* (all pages)
  - How to exploit:
    directly browse to /admin/manage_users.php without login
  - Technique: missing or weak session/role check

#10 Error-based Enumeration
  - Pages: login.php (invalid user), register.php (duplicate username or email - forgot password)
  - How to exploit:
    guess users/email and see different error messages
  - Technique: test invalid vs valid user responses

#11 Default Credentials
  - Page: login.php (admin login)
  - How to exploit:
    admin / admin
  - Technique: try default or common passwords

#12 Server-Side Request Forgery (SSRF)
  - Pages: shipcheck.php, order-track.php (url parameter)
  - How to exploit:
    ?url=http://localhost/admin
  - Technique: call internal services from the server

#13 XML External Entity (XXE)
  - Pages: admin/xmlupload.php, import.php (XML file upload)
  - How to exploit:
    <!DOCTYPE foo [ <!ENTITY xxe SYSTEM "file:///etc/passwd"> ]>
  - Technique: include external entity in uploaded XML

#14 Race Condition
  - Pages: product.php (like button), checkout.php (purchase button)
  - How to exploit:
    Use a tool (e.g. Burp Intruder, Turbo Intruder) to rapidly submit the like or purchase request multiple times before server updates are atomic
  - Technique:
    exploit simultaneous requests to increment like count or duplicate purchases



EOT
));
}

showVulnerabilitySummary();
?>
