<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="admin-users.php">WeLearnSec Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar"
      aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="adminNavbar">
      <ul class="navbar-nav mb-2 mb-lg-0">
       
        
        <!-- Manage Products -->
        <li class="nav-item">
          <a class="nav-link" href="manage_products.php">Manage Products</a>
        </li>
        <!-- Manage Users -->
        <li class="nav-item">
          <a class="nav-link" href="manage_users.php">Manage Users</a>
        </li>
        <!-- Vulnerability Tests -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="vulnDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Config
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="vulnDropdown">
            <li><a class="dropdown-item" href="xmlupload.php">XML Upload</a></li>
            <li><a class="dropdown-item" href="shipcheck.php">Ship Check</a></li>
            <li><a class="dropdown-item" href="upload.php">File Upload</a></li>
            <li><a class="dropdown-item" href="import.php">Import Product</a></li>
            <li><a class="dropdown-item" href="logs.php">logs</a></li>
          </ul>
        </li>
        <!-- Account -->
        <?php if (!empty($_SESSION['username'])): ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Admin
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
            <li><a class="dropdown-item" href="profile.php?id=<?= $_SESSION['user_id'] ?? '' ?>">Profile</a></li>
            <li><a class="dropdown-item" href="changepass.php">Change Password</a></li>
            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
          </ul>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
