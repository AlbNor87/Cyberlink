<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['email'],$_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    var_dump($email);
    emailExistsInDB($email);
    var_dump(emailExistsInDB($email));

    // if (login($email, $password, $pdo)) {
    //
    //     header("Location:/index.php");
    // }
    // else {
    //
    //     header("Location:/login.php");
    // }

};

// In this file we login users.
