<?php

$postsStatement = $pdo->prepare('SELECT posts.id, posts.title, posts.description, posts.url, posts.image, posts.votes, posts.timeOfSub, users.username FROM posts, users WHERE posts.author_id = users.id ORDER BY posts.id');
if (!$postsStatement) {
  die(var_dump($pdo->errorInfo()));
  }
$postsStatement->execute();
$postsArray = $postsStatement->fetchAll(PDO::FETCH_ASSOC);

$usersStatement = $pdo->prepare('SELECT * FROM users');
if (!$postsStatement) {
  die(var_dump($pdo->errorInfo()));
  }
$usersStatement->execute();
$usersArray = $usersStatement->fetchAll(PDO::FETCH_ASSOC);
