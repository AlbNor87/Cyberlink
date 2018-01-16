
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- <a class="navbar-brand" href="#"><?php echo $config['title']; ?></a> -->


<div class="menu-container-left">

  <div class="cyberlink-logo">
    <h1> <span class="blue">CYBER</span><span class="white">LiNK</span></h1>
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

    <?php else: ?>

  <div class="button">
    <a class="nav-link" href="/login.php">Login</a>
  </div>

    <?php endif; ?>

</div> <!-- /menu-container-left -->

<div class="menu-container-right">

    <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true): ?>

  <div class="logged-in-as">

    <div class="logged-in-as-info"> <p><nobr>You are currently logged in as <?php if (isset($_SESSION['username'])){echo $_SESSION['username'];} ?></nobr></p> </div>

    <?php if (isset($_SESSION['avatar'])): $avatar = $_SESSION['avatar']; ?>


        <img class="current-user-avatar" src='<?php echo $avatar ?>'>

    <?php endif; ?>

    <div class="button">
      <a href="app/auth/logout.php"><nobr>Log Out</nobr></a>
    </div>

  </div>


    <?php endif; ?>

</div> <!-- /menu-container-left -->

</nav><!-- /navbar -->
