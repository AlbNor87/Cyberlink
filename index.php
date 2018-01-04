<?php require __DIR__.'/views/header.php'; ?>

<?php if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true):?>

  <article>
    <h1>
      <?php echo "Welcome to ".$config['title']." ".$_SESSION['username'].", you are now successfully logged in and ready to join the discussion!"; ?>
    </h1>
  </article>


<?php else: ?>

  <article>
    <h1>
      <?php echo "Welcome to ".$config['title']." (the worlds best Redditclone), "; ?>
      <a href="/login.php">login </a>
      <?php echo "to join the discussion!"; ?>
    </h1>
  </article>

<?php endif; ?>

<?php require __DIR__.'/app/posts/posts.php'; ?>

<div class="feed">

<?php foreach ($postsArray as $post): ?>


  <div class="post-container">

    <div class="post">

      <div class="post-image">
        <img class="img-responsive" src="<?php echo $post['image'];?>">
      </div>

      <div class="post-content">

        <div class="post-header">

          <div class="title">
            <h2><?php echo strtoupper($post['title']); ?></h2>
          </div>

        </div>

        <div class="post-body">

          <div class="content">
            <?php echo $post['description']; ?>
          </div>

        </div> <!-- /post-body -->

        <div class="post-footer">

          <div class="author">
            <p>Submitted on <?php echo date('Y-m-d', $post['date']); ?> by <?php echo $post['author']; ?></p>

          </div><!-- /author -->

          <div class="likes">
            <p><?php echo "Votes: " . $post['votes'];?></p>
          </div>

        </div>

      </div><!-- /post-content -->

    </div> <!-- /post -->

  </div><!-- /post-container -->
   <?php endforeach; ?>

</div><!-- /feed -->

<?php require __DIR__.'/views/footer.php'; ?>
