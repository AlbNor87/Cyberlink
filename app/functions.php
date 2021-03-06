<?php

declare(strict_types=1);

// require __DIR__.'/autoload.php';

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect($path)
    {
        header("Location: ${path}");
        exit;
    }
}



function emailExistsInDB($email, $pdo) {

  $statement = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }
  $statement->bindParam(':email', $email, PDO::PARAM_STR);
  $statement->execute();
  $thisEmailInDbCount = $statement->fetch(PDO::FETCH_ASSOC);
  $emailExists = (int)$thisEmailInDbCount['COUNT(*)'];

  if ($emailExists > 0) {

    return true;

  } else {

    $_SESSION['message'] = "This email adress does not exist in the database!";

    return false;
  }

}



function login($email, $password, $pdo) {

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (password_verify ($password, $user['password'])) {

      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['username'] = $user['username'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['authenticated'] = true;
      $_SESSION['message'] = "Welcome, ".$user['username']."!";
      $_SESSION['avatar'] = $user['avatar'];
      $_SESSION['bio'] = $user['bio'];

      return true;

    }

    else {

      $_SESSION['message'] = "Whoops! The password you typed was incorrect. Please try again.";

      return false;

    }

}



function updateEmail($email, $user_id, $password, $pdo) {

    $statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify ($password, $user['password'])) {

          $statement = $pdo->prepare("UPDATE users SET email = :email WHERE user_id = :user_id");

          $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
          $statement->bindParam(':email', $email, PDO::PARAM_STR);
          $statement->execute();

          $_SESSION['email'] = $email;
          $_SESSION['message_updateEmail'] = "Your email adress was successfully updated!";

        }

        else {

            $_SESSION['message_updateEmail'] = "Whoops! The password you typed was incorrect. Please try again.";

    }

}



function updatePassword($user_id, $newPassword, $password, $pdo) {

  $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

  $statement = $pdo->prepare('SELECT * FROM users WHERE user_id = :user_id');
  $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
  $statement->execute();

  $user = $statement->fetch(PDO::FETCH_ASSOC);

      if (password_verify ($password, $user['password'])) {

        $statement = $pdo->prepare("UPDATE users SET password = :newPassword WHERE user_id = :user_id");

        $statement->bindParam(':newPassword', $newPasswordHash, PDO::PARAM_STR);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $statement->execute();

        $_SESSION['message_updatePassword'] = "Your password was sucessfully updated!";

      }

      else {

          $_SESSION['message_updatePassword'] = "Whoops! The password you typed was incorrect. Please try again.";

      }

}



function updateBio($newBio, $user_id, $pdo){

  $statement = $pdo->prepare("UPDATE users SET bio = :newBio WHERE user_id = :user_id");
  $statement->bindParam(':newBio', $newBio, PDO::PARAM_STR);
  $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
  $statement->execute();

  $user = $statement->fetch(PDO::FETCH_ASSOC);

  $_SESSION['message_updateBio'] = "Your bio was successfully updated!";
  $_SESSION['bio'] = $newBio;

}



function getPostsAllSortByVotes($pdo) {

  $postsStatement = $pdo->prepare("SELECT posts.*, users.*, votes.*, (SELECT sum(vote) FROM votes WHERE posts.id = votes.post_id) AS sum, (SELECT count() FROM votes WHERE votes.post_id = posts.id) AS voteCount FROM posts JOIN votes ON posts.id=votes.post_id JOIN users ON posts.user_id = users.user_id GROUP BY posts.id ORDER BY voteCount DESC");
  if (!$postsStatement) {
    die(var_dump($pdo->errorInfo()));
    }
  $postsStatement->execute();
  return $postsStatement->fetchAll(PDO::FETCH_ASSOC);

}



function getPostsAllSortByDate($pdo) {

  $postsStatement = $pdo->prepare("SELECT posts.*, users.*, votes.*, (SELECT sum(vote) FROM votes WHERE posts.id = votes.post_id) AS sum, (SELECT count() FROM votes WHERE votes.post_id = posts.id) AS voteCount FROM posts JOIN votes ON posts.id=votes.post_id JOIN users ON posts.user_id = users.user_id GROUP BY posts.id ORDER BY timeOfSub DESC");
  if (!$postsStatement) {
    die(var_dump($pdo->errorInfo()));
    }
  $postsStatement->execute();
  return $postsStatement->fetchAll(PDO::FETCH_ASSOC);

}



function getPostsAllWithUserIdSortByDate($pdo, $userId) {

$postsStatement = $pdo->prepare("SELECT posts.*, users.*, votes.*, (SELECT sum(vote) FROM votes WHERE posts.id = votes.post_id) AS sum, (SELECT sum(vote) FROM votes WHERE votes.user_id = :userId AND votes.post_id = posts.id) AS userVote, (SELECT count() FROM votes WHERE votes.post_id = posts.id) AS voteCount FROM posts JOIN votes ON posts.id=votes.post_id JOIN users ON posts.user_id = users.user_id GROUP BY posts.id ORDER BY timeOfSub DESC");
  if (!$postsStatement) {
    die(var_dump($pdo->errorInfo()));
    }
  $postsStatement->bindParam(':userId', $userId, PDO::PARAM_STR);
  $postsStatement->execute();
  return $postsStatement->fetchAll(PDO::FETCH_ASSOC);

}



function getPostsAllWithUserIdSortByVotes($pdo, $userId) {

$postsStatement = $pdo->prepare("SELECT posts.*, users.*, votes.*, (SELECT sum(vote) FROM votes WHERE posts.id = votes.post_id) AS sum, (SELECT sum(vote) FROM votes WHERE votes.user_id = :userId AND votes.post_id = posts.id) AS userVote, (SELECT count() FROM votes WHERE votes.post_id = posts.id) AS voteCount FROM posts JOIN votes ON posts.id=votes.post_id JOIN users ON posts.user_id = users.user_id GROUP BY posts.id ORDER BY voteCount DESC");
  if (!$postsStatement) {
    die(var_dump($pdo->errorInfo()));
    }
  $postsStatement->bindParam(':userId', $userId, PDO::PARAM_STR);
  $postsStatement->execute();
  return $postsStatement->fetchAll(PDO::FETCH_ASSOC);

}



function getPostsByUserId($pdo, $userId) {

  $postsStatement = $pdo->prepare('SELECT posts.id, posts.title, posts.description, posts.url, posts.image, posts.votes_id, posts.timeOfSub, users.username FROM posts JOIN users WHERE posts.user_id = users.user_id AND posts.user_id = :userId ORDER BY timeOfSub DESC');
  if (!$postsStatement) {
    die(var_dump($pdo->errorInfo()));
    }

  $postsStatement->bindParam(':userId', $userId, PDO::PARAM_STR);

  $postsStatement->execute();
  return $postsStatement->fetchAll(PDO::FETCH_ASSOC);

}



function getPostsByPostId($pdo, $postId) {

  $postsStatement = $pdo->prepare('SELECT posts.id, posts.title, posts.description, posts.url, posts.image, posts.votes_id, posts.timeOfSub, users.username FROM posts JOIN users WHERE posts.user_id = users.user_id AND posts.id = :postId ORDER BY posts.id');
  if (!$postsStatement) {
    die(var_dump($pdo->errorInfo()));
    }

  $postsStatement->bindParam(':postId', $postId, PDO::PARAM_STR);

  $postsStatement->execute();
  return $postsStatement->fetch(PDO::FETCH_ASSOC);

}
