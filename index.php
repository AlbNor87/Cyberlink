<?php require __DIR__.'/views/header.php'; ?>


<!-- <?php session_destroy(); var_dump($_SESSION); ?> -->

<?php if (isset($_SESSION['message'])): ?>
  <article>
    <h1><?php echo "Welcome to ".$config['title']." ".$_SESSION['username'].", "."you are now succefully logged in!" ; ?></h1>
  </article>
<?php endif; ?>

<p>This is the home page.</p>

<?php require __DIR__.'/views/footer.php'; ?>
