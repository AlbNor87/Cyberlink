
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a> -->


<div class="menu-container">

  <div class="cyberlink-logo">
    <h1>CYBERLINK</h1>
  </div>

  <div class="button">
      <a class="nav-link" href="/index.php">Home</a>
  </div>
  <div class="button">
      <a class="nav-link" href="/about.php">About</a>
  </div>

    <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true): ?>

  <div class="button">
        <a href="/my_profile.php">My Profile</a>
  </div>
  <div class="button">
      <a href="/my_posts.php">My Posts</a>
  </div>
  <div class="button">
    <a href="app/auth/logout.php">Log Out</a>
  </div>

    <?php else: ?>

  <div class="button">
    <a class="nav-link" href="/login.php">Login</a>
  </div>

    <?php endif; ?>

</div> <!-- /menu-container -->

</nav><!-- /navbar -->
