<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['title'])) {
    $author_id = filter_var($_SESSION['id'], FILTER_SANITIZE_STRING);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $url = filter_var($_POST['url'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $timeOfSub = time();
    $image = 'img/post.jpg';


    $_SESSION['formTitle'] = $title;
    $_SESSION['formUrl'] = $url;
    $_SESSION['formDescription'] = $description;





    $statement = $pdo->prepare('SELECT COUNT(*) FROM posts WHERE title = :title');
    if (!$statement) {
      die(var_dump($pdo->errorInfo()));
      }
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->execute();
    $thisTitleInDbCount = $statement->fetch(PDO::FETCH_ASSOC);

    $titleExists = (int)$thisTitleInDbCount['COUNT(*)'];

    if ($titleExists === 0){

      if ($_FILES['image']['name'] !== "") {
        $image = $_FILES['image'];
        $name = $image['name'];
        $dir = 'uploads/';
        $filetype = pathinfo($name, PATHINFO_EXTENSION);
        $allowed = ['png', 'jpg', 'jpeg'];

        if (!in_array($filetype, $allowed)) {
          $_SESSION['message_postImage'] = "The uploaded file type is not allowed.";
          header("Location:/submit_post.php");
          exit;
        }
        elseif ($image["size"] > 3145728) {
          $_SESSION['message_postImage'] = "The uploaded file exceeded the file size limit, please choose an image of a smaller size.";
          header("Location:/submit_post.php");
          exit;
        }
        else {

          move_uploaded_file($image["tmp_name"], __DIR__.'/..'.'/..'.'/'.$dir.$author_id.$timeOfSub.'.'.$filetype);

          $image = $dir.$author_id.$timeOfSub.'.'.$filetype;

        }

      }

      $statement = $pdo->prepare('INSERT INTO posts(title, url, description, image, author_id, timeOfSub) VALUES(:title, :url, :description, :image, :author_id, :timeOfSub)');
      $statement->bindParam(':title', $title, PDO::PARAM_STR);
      $statement->bindParam(':url', $url, PDO::PARAM_STR);
      $statement->bindParam(':description', $description, PDO::PARAM_STR);
      $statement->bindParam(':image', $image, PDO::PARAM_STR);
      $statement->bindParam(':author_id', $author_id, PDO::PARAM_INT);
      $statement->bindParam(':timeOfSub', $timeOfSub, PDO::PARAM_INT);
      $statement->execute();

      unset($_SESSION['formTitle']);
      unset($_SESSION['formUrl']);
      unset($_SESSION['formDescription']);
      unset($_SESSION['message_post']);
      unset($_SESSION['message_postImage']);

      header("Location:/index.php");
    }
    else {

        $_SESSION['message_post'] = "A post with this exact title already exists, please choose another one!";
        header("Location:/submit_post.php");
        exit;

    }

};
