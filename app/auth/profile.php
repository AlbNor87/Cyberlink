<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';


if (isset($_POST['email'],$_POST['password'])) {
    $id = filter_var($_SESSION['id'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    updateEmail($email, $id, $password, $pdo);

    header("Location:/profile.php");

};


if (isset($_POST['newPassword'],$_POST['password'])) {
    $id = filter_var($_SESSION['id'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $newPassword = filter_var($_POST['newPassword'], FILTER_SANITIZE_STRING);
    $confirmPassword = filter_var($_POST['confirmPassword'], FILTER_SANITIZE_STRING);

    if ($confirmPassword === $newPassword) {

      updatePassword($id, $newPassword, $password, $pdo);

    }

    header("Location:/profile.php");

};


if (isset($_FILES['avatar'])) {
  $avatar = $_FILES['avatar'];
  $name = $avatar['name'];
  $id = filter_var($_SESSION['id'], FILTER_SANITIZE_STRING);
  $filetype = pathinfo($name, PATHINFO_EXTENSION);
  $allowed = ['png', 'jpg', 'jpeg'];
  $dir="uploads/";
  $avatarInDB = $_SESSION['avatar'];

  // updateAvatar($avatar, $name, $id, $filetype, $allowed, $dir, $avatarInDB, $pdo);

  //Upload new avatar
  if (!in_array($filetype, $allowed)) {
        $_SESSION['message_updateAvatar'] = "The uploaded file type is not allowed.";
      }
  elseif ($avatar["size"] > 3145728) {
      $_SESSION['message_updateAvatar'] = "The uploaded file exceeded the file size limit, please choose a picture of a smaller size. Your old avatar will remain until you replace it.";
  }
  else {

    //Remove existing avatar for this specific user
    if ($avatarInDB !== "img/default.png"){
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

  header("Location:/profile.php");

};


if (isset($_POST['bio'])) {
    $id = filter_var($_SESSION['id'], FILTER_SANITIZE_STRING);
    $newBio = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);

    updateBio($newBio, $id, $pdo);

    header("Location:/profile.php");

};
