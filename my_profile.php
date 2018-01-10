<?php require __DIR__.'/views/header.php'; ?>

<article>
  <h1>My Profile</h1>
  <h2>Here you can edit your profile settings!</h2>
</article>

<article>

    <h1>Email</h1>

    <form action="app/auth/profile.php" method="post">
        <div class="form-group">
            <div><?php echo "Your current email is: ".$_SESSION['email'];?></div>
            <label for="email">New email</label>
            <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Submit</button>
        <?php if (isset($_SESSION['message_updateEmail'])): ?>
          <p><?php echo $_SESSION['message_updateEmail']; ?></p>
        <?php endif; ?>
    </form>

</article>


<article>

    <h1>Password</h1>

    <form action="app/auth/profile.php" method="post">
        <div class="form-group">
            <label for="email">Current password</label>
            <input class="form-control" type="password" name="password" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">New password</label>
            <input class="form-control" type="password" name="newPassword" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Confirm new password</label>
            <input class="form-control" type="password" name="confirmPassword" required>
        </div><!-- /form-group -->


        <button type="submit" class="btn btn-primary">Submit</button>
        <?php if (isset($_SESSION['message_updatePassword'])): ?>
          <p><?php echo $_SESSION['message_updatePassword']; ?></p>
        <?php endif; ?>
    </form>

</article>


<article>

    <h1>Avatar</h1>

    <?php if (isset($_SESSION['avatar'])): $avatar = $_SESSION['avatar']; ?>

    <img src='<?php echo $avatar ?>' width='180' height='180' style="border-radius:100%;border:2px solid red;">

    <?php endif; ?>


    <form class="" action="app/auth/profile.php" method="post" enctype="multipart/form-data">
      <input type="file" name="avatar" accept=".png, .jpeg, .jpg" required>
      <br>
      <button type="submit" name="upload">Upload</button>
      <?php if (isset($_SESSION['message_updateAvatar'])): ?>
        <p><?php echo $_SESSION['message_updateAvatar']; ?></p>
      <?php endif; ?>

    </form>

</article>


<article>

    <h1>Biography</h1>

    <form action="app/auth/profile.php" id="bio" method="post">
        <div class="form-group">
            <textarea rows="4" cols="50" name="bio" form="bio" placeholder="Describe yourself here..."><?php
            if (isset($_SESSION['bio'])){
                echo $_SESSION['bio'];}?></textarea>
              <br>
            <input type="submit">
            <?php if (isset($_SESSION['message_updateBio'])): ?>
              <p><?php echo $_SESSION['message_updateBio']; ?></p>
            <?php endif; ?>
        </div><!-- /form-group -->

    </form>

</article>


<?php require __DIR__.'/views/footer.php'; ?>
