<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['title'])) {
    $id = filter_var($_SESSION['id'], FILTER_SANITIZE_STRING);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $url = filter_var($_POST['url'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $image = 'tjollahopp!';

    $statement = $pdo->prepare('SELECT COUNT(*) FROM posts WHERE title = :title');
    if (!$statement) {
      die(var_dump($pdo->errorInfo()));
      }
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->execute();
    $thisTitleInDbCount = $statement->fetch(PDO::FETCH_ASSOC);

    $titleExists = (int)$thisTitleInDbCount['COUNT(*)'];

    if ($titleExists === 0){

      $statement = $pdo->prepare('INSERT INTO posts(title, url, description, image) VALUES(:title, :url, :description, :image)');
      $statement->bindParam(':title', $title, PDO::PARAM_STR);
      $statement->bindParam(':url', $url, PDO::PARAM_STR);
      $statement->bindParam(':description', $description, PDO::PARAM_STR);
      $statement->bindParam(':image', $image, PDO::PARAM_STR);
      $statement->execute();

      unset($_SESSION['formTitle']);
      unset($_SESSION['formUrl']);
      unset($_SESSION['formDescription']);
      unset($_SESSION['message_post']);

      header("Location:/index.php");
    }
    else {

        $_SESSION['formTitle'] = $title;
        $_SESSION['formUrl'] = $url;
        $_SESSION['formDescription'] = $description;
        $_SESSION['message_post'] = "A post with this exact title already exists, please choose another one!";
        header("Location:/post.php");
        exit;

    }

};
