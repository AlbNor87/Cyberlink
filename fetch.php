<?php

declare(strict_types=1);

require __DIR__.'/app/autoload.php';

die(var_dump($_POST));

  $postId = 61;

  $statement = $pdo->prepare('SELECT total FROM votes WHERE post_id = :postId');
  $statement->bindParam(':postId', $postId, PDO::PARAM_INT);
  $statement->execute();

  $votesOnPost = $statement->fetch(PDO::FETCH_ASSOC);

  echo json_encode($votesOnPost);
