# WeLearnSec Vulnerable E-commerce Shop

This project is a purposely vulnerable PHP + MySQL e-commerce web application built for **educational** and **security testing** purposes.  

**⚠️ Warning: Do NOT deploy this on a public-facing server. It is intentionally insecure.**

---

## 📌 Features

- User registration & login
- Product search and shopping cart
- Admin panel for managing products and users
- Vulnerable file upload
- Vulnerable XML upload
- Diagnostics & log viewing
- Order shipping and tracking
- Reviews and contact forms

---

## 📌 Vulnerabilities intentionally included

This site includes common OWASP Top 10 vulnerabilities and other business logic flaws:

- SQL Injection
- Cross-Site Scripting (XSS)
- Cross-Site Request Forgery (CSRF)
- Local File Inclusion (LFI)
- Remote File Inclusion (RFI)
- Directory Traversal
- Reflected File Download (RFD)
- Broken Access Control
- Weak session handling
- Insecure direct object references (IDOR)
- XML External Entity Injection (XXE)
- Server-Side Request Forgery (SSRF)
- Security misconfiguration
- Sensitive data exposure (e.g. plaintext passwords)
- Error-based user enumeration
- Default credentials
- Missing clickjacking protection
- Insufficient logging & monitoring
- Insecure file upload
- Business logic flaws (e.g. missing verification, price tampering)
- Race condition

---

## 📌 Requirements

- XAMPP / LAMP / MAMP or similar local PHP environment
- PHP 8.x recommended
- MySQL (e.g. MariaDB)  
- Composer (optional, but no external dependencies needed)
- Git

---

## 📌 Legal Disclaimer

> This application is for **security training** and **educational** use only. Do not deploy it in a production environment. The maintainers assume **no liability** for misuse or damages.

---

## 📌 Quick Start

```bash
git clone https://github.com/welearnsec/welearnsecshop.git
# import the database from /sql/welearnsec_shop.sql in phpMyAdmin
# dont forget to configure the /includes/config.php