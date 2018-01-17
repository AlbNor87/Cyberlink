<?php

require __DIR__.'/views/header.php';

$postsArray = getPostsByPostId($pdo, $_GET['id']);

?>

<div class="form-outer-container">
  <div class="form-inner-container edit-profile">

<div class="login-container">

    <h1>Edit Post</h1>
    <h2>Post id: <?php
    if (isset($postsArray['id'])){
        echo $postsArray['id'];}?>

      </h2>

    <form class="" action="app/posts/update.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="postId" value="<?php
          echo $postsArray['id']; ?>">

      <div class="form-group">
        <label for="url">Title</label><br>
        <input class="form-control" type="text" name="title" value="<?php
            echo $postsArray['title']; ?>" required>
      </div><!-- /form-group -->

      <br>

      <div class="form-group">
        <label for="url">Url</label><br>
        <input class="form-control" type="text" name="url" value="<?php
            echo $postsArray['url']; ?>"required>
      </div><!-- /form-group -->

      <br>









      <?php if (isset($postsArray['image'])):?>

    <img class="edit-profile-avatar" src='<?php echo $postsArray['image']?>'>

      <?php endif; ?>

      <div class="form-group">
        <label for="image">Image</label><br>
        <input type="file" name="image" accept=".png, .jpeg, .jpg">
        <input type="hidden" name="oldImage" value="<?php
            echo $postsArray['image']; ?>">
        <br>
        <?php if (isset($_SESSION['message_postImage'])): ?>
          <p><?php echo $_SESSION['message_postImage']; ?></p>
        <?php endif; ?>
      </div><!-- /form-group -->

      <br>

      <div class="form-group">
        <label for="description">Description</label><br>
        <textarea rows="4" cols="50" name="description" placeholder="Describe your submission here..."  required><?php
            echo $postsArray['description']; ?></textarea>
          <br>
          <input type="submit">
          <?php if (isset($_SESSION['message_post'])): ?>
            <p><?php echo $_SESSION['message_post']; ?></p>
          <?php endif; ?>

          <?php if (isset($_SESSION['vad'])): ?>
            <p><?php echo $_SESSION['vad']; ?></p>
          <?php endif; ?>
        </div><!-- /form-group -->

      </form>

</div><!-- /login-container -->

</div><!-- /form-inner-container -->
</div><!-- /form-outer-container -->


<?php require __DIR__.'/views/footer.php'; ?>
