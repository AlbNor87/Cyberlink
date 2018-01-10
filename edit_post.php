<?php

require __DIR__.'/views/header.php';

$postsArray = getPostsByPostId($pdo, $_GET['id']);

?>

<article>

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

      <img src='<?php echo $postsArray['image']?>' width='180' height='180' style="border-radius:100%;border:2px solid red;">

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

</article>


<?php require __DIR__.'/views/footer.php'; ?>
