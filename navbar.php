[file name]: navbar.php
[file content begin]
<?php 
session_start();
include_once "data.php";
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0B0B2E;">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php" style="color: #F0B13B; font-weight: bold;">
      <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Logo" width="40" height="40" class="d-inline-block align-text-top me-2">
      AnimeWorld
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'home.php') ? 'active' : ''; ?>" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'films.php') ? 'active' : ''; ?>" href="films.php">Films</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'characters.php') ? 'active' : ''; ?>" href="characters.php">Characters</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'category.php') ? 'active' : ''; ?>" href="category.php">Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>" href="about.php">About</a>
        </li>
      </ul>
      
      <!-- Search Form -->
      <form class="d-flex me-3" action="search.php" method="GET">
        <input class="form-control me-2" type="search" name="query" placeholder="Search anime..." aria-label="Search" style="background-color: #1a1a4a; color: white; border: 1px solid #F0B13B;">
        <button class="btn btn-outline-warning" type="submit">Search</button>
      </form>
      
      <!-- User Menu -->
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['user_id'])) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              👤 <?php echo $_SESSION['username']; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" style="background-color: #1a1a4a;">
              <li><a class="dropdown-item text-light" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item text-light" href="myaccount.php">My Account</a></li>
              <li><a class="dropdown-item text-light" href="cart.php">Cart</a></li>
              <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) { ?>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-warning" href="account.php">👑 Manage Users</a></li>
                <li><a class="dropdown-item text-warning" href="Admin_Panel.php">📊 Admin Panel</a></li>
              <?php } ?>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-light" href="logout.php">Logout</a></li>
            </ul>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-warning me-2" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-warning" href="register.php">Register</a>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</nav>
[file content end]