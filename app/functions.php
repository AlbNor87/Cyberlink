<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect($path)
    {
        header("Location: ${path}");
        exit;
    }
}



function emailExistsInDB($email, $pdo) {

  $usersStatement = $pdo->prepare('SELECT COUNT(*) FROM Users WHERE email = :email');
  if (!$usersStatement) {
    die(var_dump($pdo->errorInfo()));
    }
  $usersStatement->bindParam(':email', $email, PDO::PARAM_STR);
  $usersStatement->execute();
  $thisEmailInDbCount = $usersStatement->fetch(PDO::FETCH_ASSOC);
  $emailExists = (int)$thisEmailInDbCount['COUNT(*)'];

  if ($emailExists > 0) {

    return true;

  } else {

    $_SESSION['message'] = "This email adress does not exist in the database!";

    return false;
  }

}



function login($email, $password, $pdo) {

    $statement = $pdo->prepare('SELECT * FROM Users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (password_verify ($password, $user['password'])) {

      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['authenticated'] = true;
      $_SESSION['message'] = "Welcome, ".$user['username']."!";
      $_SESSION['avatar'] = $user['avatar'];

      return true;

    }

    else {

      $_SESSION['message'] = "Whoops! The password you typed was incorrect. Please try again.";

      return false;

    }

}



function updateEmail($email, $id, $password, $pdo) {

    $statement = $pdo->prepare('SELECT * FROM Users WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify ($password, $user['password'])) {

          $statement = $pdo->prepare("UPDATE Users SET email = :email WHERE id = :id");

          $statement->bindParam(':id', $id, PDO::PARAM_STR);
          $statement->bindParam(':email', $email, PDO::PARAM_STR);
          $statement->execute();

          $_SESSION['email'] = $email;
          $_SESSION['message'] = "Your email adress was successfully updated!";

        }

        else {

            $_SESSION['message'] = "Whoops. Looks like you missed something. Please try again.";

    }

}



function updatePassword($id, $newPassword, $password, $pdo) {

      $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

      $statement = $pdo->prepare('SELECT * FROM Users WHERE id = :id');
      $statement->bindParam(':id', $id, PDO::PARAM_STR);
      $statement->execute();

      $user = $statement->fetch(PDO::FETCH_ASSOC);

          if (password_verify ($password, $user['password'])) {

            $statement = $pdo->prepare("UPDATE Users SET password = :newPassword WHERE id = :id");

            $statement->bindParam(':newPassword', $newPasswordHash, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_STR);
            $statement->execute();

            $_SESSION['message'] = "Your password was sucessfully updated!";

          }

          else {

              $_SESSION['message'] = "Whoops. Looks like you missed something. Please try again.";

          }

}
