<?php require __DIR__.'/views/header.php'; ?>

<div class="login-outer-container">
  <div class="login-inner-container">


    <div class="login-container">
        <h1>Login</h1>

        <form action="app/auth/login.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
            </div><!-- /form-group -->

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" required>

            </div><!-- /form-group -->

            <input type="submit" value="Login" class="btn"></input>
            <?php if (isset($_SESSION['message'])): ?>
              <p><?php echo $_SESSION['message']; ?></p>
            <?php endif; ?>

        </form>
    </div>

    <div class="register-container">
        <h1>Register</h1>

        <form action="app/auth/register.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Francis Darjeeling" required>

            </div><!-- /form-group -->

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>

            </div><!-- /form-group -->

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" required>

            </div><!-- /form-group -->

            <input type="submit" value="Register"class="btn"></input>
            <?php if (isset($_SESSION['message_register'])): ?>
              <p><?php echo $_SESSION['message_register']; ?></p>
            <?php endif; ?>
        </form>
    </div>


  </div><!-- /login-inner-container -->
</div><!-- /login-outer-container -->

<?php require __DIR__.'/views/footer.php'; ?>
