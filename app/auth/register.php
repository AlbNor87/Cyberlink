<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'],$_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $passwordHash = password_hash("$password", PASSWORD_DEFAULT);


    $usersStatement = $pdo->prepare('SELECT COUNT(*) FROM Users WHERE email = :email');
    if (!$usersStatement) {
      die(var_dump($pdo->errorInfo()));
      }
    $usersStatement->bindParam(':email', $email, PDO::PARAM_STR);
    $usersStatement->execute();
    $thisEmailInDbCount = $usersStatement->fetch(PDO::FETCH_ASSOC);

    $emailExists = (int)$thisEmailInDbCount['COUNT(*)'];

    if ($emailExists === 0){

      $statement = $pdo->prepare("INSERT INTO users(username, email, password) VALUES (:username, :email, :password)");
      if (!$statement) {
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':username', $username, PDO::PARAM_STR);
      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->bindParam(':password', $passwordHash, PDO::PARAM_STR);
      $statement->execute();

    }

    if (login($email, $password, $pdo)) {

        header("Location:/index.php");
    }
    else {

        header("Location:/login.php");
    }

};
