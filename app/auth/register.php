<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'],$_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $passwordHash = password_hash("$password", PASSWORD_DEFAULT);
    $avatar = 'img/user.png';


    $statement = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
    if (!$statement) {
      die(var_dump($pdo->errorInfo()));
      }
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $thisEmailInDbCount = $statement->fetch(PDO::FETCH_ASSOC);

    $emailExists = (int)$thisEmailInDbCount['COUNT(*)'];

    if ($emailExists === 0){

      $statement = $pdo->prepare("INSERT INTO users(username, email, password, avatar) VALUES (:username, :email, :password, :avatar)");
      if (!$statement) {
        die(var_dump($pdo->errorInfo()));
      }
      $statement->bindParam(':username', $username, PDO::PARAM_STR);
      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->bindParam(':password', $passwordHash, PDO::PARAM_STR);
      $statement->bindParam(':avatar', $avatar, PDO::PARAM_STR);
      $statement->execute();

    }
    else {

        $_SESSION['message_register'] = "This email adress already exist in the database!";
        header("Location:/login.php");
        exit;

    }

    if (login($email, $password, $pdo)) {

        header("Location:/index.php");
    }
    else {

        header("Location:/login.php");
    }

};
