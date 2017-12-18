<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'],$_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $usersStatement = $pdo->prepare('SELECT * FROM users');
    if (!$usersStatement) {
      die(var_dump($pdo->errorInfo()));
    }
    $usersStatement->execute();
    $usersArray = $usersStatement->fetchAll(PDO::FETCH_ASSOC);

    $emailExists = false;
    //check if email already exists in database
    foreach ($usersArray as $user) {

      if ($user['email'] === $email){

        echo "$email already exists in the database";
        $emailExists = true;
        break;
      }

    }

    if (!$emailExists){

      $statement = $pdo->prepare("INSERT INTO users(username, email, password) VALUES (:username, :email, :password)");
      if (!$statement) {
        die(var_dump($pdo->errorInfo()));
      }
      $statement->bindParam(':username', $username, PDO::PARAM_STR);
      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->bindParam(':password', $password, PDO::PARAM_STR);

      $statement->execute();

    }

    // if (login($email, $password, $pdo)) {
    //
    //     header("Location:/index.php");
    // }
    // else {
    //
    //     header("Location:/login.php");
    // }

};
