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
  $dir = 'uploads';
  $filename = __DIR__.'/'.$dir.'/'.$id.'.'.$filetype;
  $email = $_SESSION['email'];
  $avatarInDB = $_SESSION['avatar'];

  //Remove existing avatar for this specific user
  if ($avatarInDB !== "img/default.png"){
  unlink( __DIR__.'/..'.'/..'.'/'.'/'.$avatarInDB );
  }

  //Upload new avatar
  if (!in_array($filetype, $allowed)) {
        $_SESSION['message_updateAvatar'] = "The uploaded file type is not allowed.";
      }
  elseif ($_FILES['avatar']["size"] > 3145728) {
      $_SESSION['message_updateAvatar'] = "The uploaded file exceeded the file size limit. Please choose a picture of a smaller size.";
  }
  else {
    move_uploaded_file($avatar["tmp_name"], __DIR__.'/..'.'/..'.'/'.$dir.'/'.$id.'.'.$filetype);

    //Update avatar in database
    $target_path="uploads/";
    $target_path=$target_path.basename($filename);

    $statement = $pdo->prepare("UPDATE Users SET avatar = :target_path WHERE email = :email");
    $statement->bindParam(':target_path', $target_path, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $_SESSION['message_updateAvatar'] = "Your avatar was successfully uploaded!";
    $_SESSION['avatar'] = $target_path;

  }

  header("Location:/profile.php");

};
