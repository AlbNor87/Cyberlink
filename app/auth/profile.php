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
