<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

if (isset($_POST['title'])) {
  $postId = filter_var($_POST['postId'], FILTER_SANITIZE_STRING);
  $postsArray = getPostsByPostId($pdo, $postId);
  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $oldTitle = $postsArray['title'];
  $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_STRING);
  $url = filter_var($_POST['url'], FILTER_SANITIZE_STRING);
  $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
  $timeOfSub = time();
  $image = filter_var($_POST['oldImage'], FILTER_SANITIZE_STRING);
  $oldImage = $postsArray['image'];


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

    $titleExistsInDB = (int)$thisTitleInDbCount['COUNT(*)'];

    if ($titleExistsInDB === 0 || $title === $oldTitle){

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

          if ($image !== $oldImage && $image !== 'img/post.jpg'){
          unlink( __DIR__.'/..'.'/..'.'/'.$oldImage );
          }

          move_uploaded_file($image["tmp_name"], __DIR__.'/..'.'/..'.'/'.$dir.$user_id.$timeOfSub.'.'.$filetype);

          $image2 = $dir.$user_id.$timeOfSub.'.'.$filetype;

          $_SESSION['message_updateImage'] = "The image was sucessfully moved to the upload directory!".$image2;

        }

      }

      $statement = $pdo->prepare('UPDATE posts SET title = :title, url = :url, description = :description, image = :image2, user_id = :user_id, timeOfSub = :timeOfSub WHERE id = :postId');
      $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
      $statement->bindParam(':title', $title, PDO::PARAM_STR);
      $statement->bindParam(':url', $url, PDO::PARAM_STR);
      $statement->bindParam(':description', $description, PDO::PARAM_STR);
      $statement->bindParam(':image2', $image2, PDO::PARAM_STR);
      $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
      $statement->bindParam(':timeOfSub', $timeOfSub, PDO::PARAM_INT);
      $statement->execute();

      unset($_SESSION['formTitle']);
      unset($_SESSION['formUrl']);
      unset($_SESSION['formDescription']);
      unset($_SESSION['message_post']);
      unset($_SESSION['message_postImage']);

      header("Location:/my_posts.php");
    }
    else {

        $_SESSION['message_post'] = "A post with this exact title already exists, please choose another one!";
        header("Location:/edit_post.php?id=".$postId);
        exit;

    }

};
