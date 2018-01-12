<?php

declare(strict_types=1);

require __DIR__.'/app/autoload.php';

// die(var_dump($_POST));

if (isset($_POST['postId'])) {

  $postId = $_POST['postId'];
  $vote = $_POST['voteDir'];
  $userId = $_POST['userId'];

  $statement = $pdo->prepare('SELECT COUNT(*) FROM votes WHERE user_id = :userId AND post_id = :postId');
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
    }
  $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  // $statement->bindParam(':voteDir', $voteDir, PDO::PARAM_INT);
  $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
  $statement->execute();
  $votesOnPost = $statement->fetch(PDO::FETCH_ASSOC);

  // die(var_dump($votesOnPost));

  $statement = $pdo->prepare("INSERT INTO votes(user_id, post_id, vote) VALUES (:userId, :postId, :vote)");
  if (!$statement) {
    die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
  $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  $statement->bindParam(':vote', $vote, PDO::PARAM_INT);
  $statement->execute();

  $statement = $pdo->prepare('SELECT sum(vote) FROM votes WHERE post_id = :postId');
  $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  $statement->execute();

  $votesOnPost = $statement->fetch(PDO::FETCH_ASSOC);

  echo json_encode($votesOnPost);









  // if ($votesOnPost < 100){
  //
  //
  // }
  // else {
  //
  //     $_SESSION['message_register'] = "This email adress already exist in the database!";
  //
  // }
  // //
  // $newVotesOnPost = ++$votesOnPost['total'];




  //
  // if
  //
  // $statement = $pdo->prepare('UPDATE votes SET total = :newVotesOnPost WHERE post_id = :postId');
  // $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  // $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  // $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  // $statement->bindParam(':newVotesOnPost', $newVotesOnPost, PDO::PARAM_INT);
  // $statement->execute();
  //
  //
  // $statement = $pdo->prepare('UPDATE votes SET total = :newVotesOnPost WHERE post_id = :postId');
  // $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  // $statement->bindParam(':newVotesOnPost', $newVotesOnPost, PDO::PARAM_INT);
  // $statement->execute();
  //
  //




};
