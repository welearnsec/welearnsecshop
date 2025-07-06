<?php

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">WeLearnSec Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <!-- Shop Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="shopDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Shop
          </a>
          <ul class="dropdown-menu" aria-labelledby="shopDropdown">
            <li><a class="dropdown-item" href="index.php">All Products</a></li>
            <li><a class="dropdown-item" href="search.php">Search Products</a></li>
            <li><a class="dropdown-item" href="track-order.php">Track order</a></li>
            <li><a class="dropdown-item" href="contact.php">Contact Us</a></li>
            <li><a class="dropdown-item" href="cart.php">View Cart</a></li>
          </ul>
        </li>

        <?php if (!empty($_SESSION['username'])): ?>
          <!-- Account Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Account
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="profile.php<?php if (!empty($_SESSION['user_id'])) { echo '?id=' . $_SESSION['user_id']; } ?>">Profile</a>
              </li>
              <li><a class="dropdown-item" href="changepass.php">Change Password</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <!-- Guest Links -->
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
