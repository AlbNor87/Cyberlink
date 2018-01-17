<?php require __DIR__.'/views/header.php'; ?>

<div class="form-outer-container">
  <div class="form-inner-container my-profile">

    <div class="login-container">

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

        <input type="submit" value="Submit"></input>
        <?php if (isset($_SESSION['message_updateEmail'])): ?>
          <p><?php echo $_SESSION['message_updateEmail']; ?></p>
        <?php endif; ?>
      </form>

    </div><!-- /login-container -->
    


    <div class="login-container my-profile">

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


        <input type="submit" value="Submit"></input>
        <?php if (isset($_SESSION['message_updatePassword'])): ?>
          <p><?php echo $_SESSION['message_updatePassword']; ?></p>
        <?php endif; ?>
      </form>

    </div><!-- /login-container -->


    <div class="login-container my-profile">

      <h1>Avatar</h1>

      <?php if (isset($_SESSION['avatar'])): $avatar = $_SESSION['avatar']; ?>

        <img class="edit-profile-avatar" src='<?php echo $avatar ?>'>

      <?php endif; ?>


      <form class="" action="app/auth/profile.php" method="post" enctype="multipart/form-data">
        <input type="file" name="avatar" accept=".png, .jpeg, .jpg" required>
        <br>
        <input type="submit" value="Upload" name="upload"></input>
        <?php if (isset($_SESSION['message_updateAvatar'])): ?>
          <p><?php echo $_SESSION['message_updateAvatar']; ?></p>
        <?php endif; ?>

      </form>

    </div><!-- /login-container -->


    <div class="login-container my-profile">

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

      </div><!-- /login-container -->


    </div><!-- /login-container -->
  </div><!-- /form-inner-container -->
</div><!-- /form-outer-container -->


<?php require __DIR__.'/views/footer.php'; ?>
