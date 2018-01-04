<?php

$postsStatement = $pdo->prepare('SELECT * FROM posts');
if (!$postsStatement) {
  die(var_dump($pdo->errorInfo()));
  }
$postsStatement->execute();
$postsArray = $postsStatement->fetchAll(PDO::FETCH_ASSOC);
