<?php require __DIR__.'/views/header.php'; ?>


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
        <?php if (isset($_SESSION['message'])): ?>
          <p><?php echo $_SESSION['message']; ?></p>
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
        <?php if (isset($_SESSION['newPassword'])): ?>
          <p><?php echo $_SESSION['newPassword']; ?></p>
        <?php endif; ?>

    </form>
</article>

<article>
    <h1>Avatar</h1>

    <form action="app/auth/login.php" method="post">
        <div class="form-group">
            <div><?php echo "Your current email is: ".$_SESSION['email'];?></div>
            <label for="email">New email</label>
            <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
            <small class="form-text text-muted">Please provide your new email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</article>

<article>
    <h1>Biography</h1>

    <form action="app/auth/login.php" method="post">
        <div class="form-group">
            <div><?php echo "Your current email is: ".$_SESSION['email'];?></div>
            <label for="email">New email</label>
            <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
            <small class="form-text text-muted">Please provide your new email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide your password (passphrase).</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</article>


<?php require __DIR__.'/views/footer.php'; ?>
