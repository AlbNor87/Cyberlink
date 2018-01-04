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

<p>This is the home page.</p>

<?php require __DIR__.'/app/posts/posts.php'; ?>

<div class="feed"><h1>This is the feed</h1></div>

<?php var_dump($postsArray)?>


<?php foreach ($postsArray as $post): ?>

     <div class="post">

       <div class="post-header">

         <div class="title">
           <?php echo strtoupper($post['title']); ?>
         </div>

         <div class="date">
           <?php echo date('Y-m-d', $post['date']); ?>
         </div>
       </div>

       <div class="post-body">

         <div class="author">
           <div class="avatar">
             <a href="<?php echo $post['url'];?>"><img src="<?php echo $post['avatar'];?>"></a>
           </div>
           <?php echo $post['author']; ?>
         </div><!-- /author -->

         <br>

         <div class="content">
           <?php echo $post['description']; ?>
         </div>
       </div> <!-- /post-body -->

       <div class="post-footer">

         <div class="likes">
           <?php echo "Likes: " . $post['url'];?>
         </div>

       </div>

     </div> <!-- /post -->
   <?php endforeach; ?>



<?php require __DIR__.'/views/footer.php'; ?>
