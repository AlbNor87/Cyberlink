<?php require __DIR__.'/views/header.php'; ?>

<div class="form-outer-container">
  <div class="form-inner-container">

<div class="login-container">


    <h1>Submit Post</h1>

    <form class="" action="app/posts/submit.php" method="post" enctype="multipart/form-data">

      <div class="form-group">
        <label for="url">Title</label><br>
        <input class="form-control" type="text" name="title" value="<?php
        if (isset($_SESSION['formTitle'])){
            echo $_SESSION['formTitle'];}?>" required>
      </div><!-- /form-group -->

      <br>

      <div class="form-group">
        <label for="url">Url</label><br>
        <input class="form-control" type="text" name="url" value="<?php
        if (isset($_SESSION['formUrl'])){
            echo $_SESSION['formUrl'];}?>"required>

        <?php if (isset($_SESSION['message_postUrl'])): ?>
          <p><?php echo $_SESSION['message_postUrl']; ?></p>
        <?php endif; ?>

      </div><!-- /form-group -->

      <br>

      <div class="form-group">
        <label for="image">Image</label><br>
        <input type="file" name="image" accept=".png, .jpeg, .jpg">
        <br>
        <?php if (isset($_SESSION['message_postImage'])): ?>
          <p><?php echo $_SESSION['message_postImage']; ?></p>
        <?php endif; ?>
      </div><!-- /form-group -->

      <br>

      <div class="form-group">
        <label for="description">Description</label><br>
        <textarea rows="4" cols="50" name="description" placeholder="Describe your submission here..."  required><?php
        if (isset($_SESSION['formDescription'])){
            echo $_SESSION['formDescription'];}?></textarea>
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
