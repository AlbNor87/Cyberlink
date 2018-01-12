<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

$postsArray = getPostsByPostId($pdo, $_GET['id']);

$postId = $postsArray['id'];

    $statement = $pdo->prepare("DELETE FROM posts
      WHERE id = :postId");
    $statement->bindParam(':postId', $postId, PDO::PARAM_STR);
    $statement->execute();

header("Location:/my_posts.php");
