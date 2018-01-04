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

  $statement = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
    }
  $statement->bindParam(':email', $email, PDO::PARAM_STR);
  $statement->execute();
  $thisEmailInDbCount = $statement->fetch(PDO::FETCH_ASSOC);
  $emailExists = (int)$thisEmailInDbCount['COUNT(*)'];

  if ($emailExists > 0) {

    return true;

  } else {

    $_SESSION['message'] = "This email adress does not exist in the database!";

    return false;
  }

}



function login($email, $password, $pdo) {

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
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
      $_SESSION['bio'] = $user['bio'];

      return true;

    }

    else {

      $_SESSION['message'] = "Whoops! The password you typed was incorrect. Please try again.";

      return false;

    }

}



function updateEmail($email, $id, $password, $pdo) {

    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify ($password, $user['password'])) {

          $statement = $pdo->prepare("UPDATE users SET email = :email WHERE id = :id");

          $statement->bindParam(':id', $id, PDO::PARAM_STR);
          $statement->bindParam(':email', $email, PDO::PARAM_STR);
          $statement->execute();

          $_SESSION['email'] = $email;
          $_SESSION['message_updateEmail'] = "Your email adress was successfully updated!";

        }

        else {

            $_SESSION['message_updateEmail'] = "Whoops! The password you typed was incorrect. Please try again.";

    }

}



function updatePassword($id, $newPassword, $password, $pdo) {

      $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

      $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
      $statement->bindParam(':id', $id, PDO::PARAM_STR);
      $statement->execute();

      $user = $statement->fetch(PDO::FETCH_ASSOC);

          if (password_verify ($password, $user['password'])) {

            $statement = $pdo->prepare("UPDATE users SET password = :newPassword WHERE id = :id");

            $statement->bindParam(':newPassword', $newPasswordHash, PDO::PARAM_STR);
            $statement->bindParam(':id', $id, PDO::PARAM_STR);
            $statement->execute();

            $_SESSION['message_updatePassword'] = "Your password was sucessfully updated!";

          }

          else {

              $_SESSION['message_updatePassword'] = "Whoops! The password you typed was incorrect. Please try again.";

          }

}



function updateAvatar($avatar, $name, $id, $filetype, $allowed, $dir, $avatarInDB, $pdo) {

  //Upload new avatar
  if (!in_array($filetype, $allowed)) {
        $_SESSION['message_updateAvatar'] = "The uploaded file type is not allowed.";
      }
  elseif ($avatar["size"] > 3145728) {
      $_SESSION['message_updateAvatar'] = "The uploaded file exceeded the file size limit, please choose a picture of a smaller size. Your old avatar will remain until you replace it.";
  }
  else {

    //Remove existing avatar for this specific user
    if ($avatarInDB !== "img/user.png"){
    unlink( __DIR__.'/..'.'/..'.'/'.'/'.$avatarInDB );
    }

    move_uploaded_file($avatar["tmp_name"], __DIR__.'/..'.'/..'.'/'.$dir.$id.'.'.$filetype);

    //Update avatar in database
    $newAvatarInDB = $dir.$id.'.'.$filetype;

    $statement = $pdo->prepare("UPDATE users SET avatar = :newAvatarInDB WHERE id = :id");
    $statement->bindParam(':newAvatarInDB', $newAvatarInDB, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $_SESSION['message_updateAvatar'] = "Your avatar was successfully uploaded!";
    $_SESSION['avatar'] = $newAvatarInDB;

  }

}


function updateBio($newBio, $id, $pdo){

  $statement = $pdo->prepare("UPDATE users SET bio = :newBio WHERE id = :id");
  $statement->bindParam(':newBio', $newBio, PDO::PARAM_STR);
  $statement->bindParam(':id', $id, PDO::PARAM_STR);
  $statement->execute();

  $user = $statement->fetch(PDO::FETCH_ASSOC);

  $_SESSION['message_updateBio'] = "Your bio was successfully updated!";
  $_SESSION['bio'] = $newBio;

}
