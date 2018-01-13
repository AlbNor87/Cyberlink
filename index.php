<?php

require __DIR__.'/views/header.php';
$postsArray = getPostsAll($pdo);
// die(var_dump($postsArray));

// $myPostsArray = getPosts($pdo);
// die(var_dump($myPostsArray));


?>

<?php if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true):?>

  <article>
    <h1>
      <?php echo "Welcome to ".$config['title']." ".$_SESSION['username'].", you are now successfully logged in and ready to join the discussion! "; ?><a href="/submit_post.php">Submit a new post!</a>
    </h1>
  </article>


<?php else: ?>

  <article>
    <h1>
      <?php echo "Welcome to ".$config['title']." (the worlds best Redditclone), "; ?>
      <a href="/login.php">login </a>
      <?php echo "to join the discussion!"; ?>
    </h1>
  </article>

<?php endif; ?>

<div class="feed">

<?php foreach ($postsArray as $post): ?>


  <div class="post-container">

    <div class="post" data-postId="<?php echo $post['id'];?>" >

      <div class="post-rank">
        <div class="rank"><h2><?php echo $post['rank'];?></h2></div>
      </div>

      <div class="post-votes">
        <div class="up-vote">
          <div class="thumbs up" data-post-id="<?php echo $post['id'];?>" data-user-id="<?php echo $_SESSION['id'];?>" data-vote-dir="up">
          </div>
        </div>
        <div class="votes" data-display-vote-id="<?php echo $post['id'];?>"><h2><?php echo $post['sum'];?></h2></div>

        <div class="down-vote"><div class="thumbs down" data-post-id="<?php echo $post['id'];?>" data-vote-dir="down"></div></div>
      </div>

      <div class="post-image">
        <img class="img-responsive" src="<?php echo $post['image'];?>">
      </div>

      <div class="post-content">

        <div class="post-header">

          <div class="title">
            <h2><?php echo strtoupper($post['title']); ?></h2>
          </div>

        </div>

        <div class="post-body">

          <div class="content">
            <?php echo $post['description']; ?>
          </div>

        </div> <!-- /post-body -->

        <div class="post-footer">

          <div class="author">
            <p>Submitted on <?php echo date("F j, Y, g:i a", $post['timeOfSub']); ?> by <?php echo $post['username']; ?></p>
          </div><!-- /author -->

        </div>

      </div><!-- /post-content -->

    </div> <!-- /post -->

  </div><!-- /post-container -->
   <?php endforeach; ?>

</div><!-- /feed -->

<script>

  const voteLinks = document.querySelectorAll('.up, .down');

    voteLinks.forEach(function(link) {

      link.addEventListener('click', vote);

    });

  function vote(event){

    const postId = event.target.dataset.postId;
    const voteDir = event.target.dataset.voteDir;
    const userId = event.target.dataset.userId;

    console.log(postId);
    console.log(voteDir);
    console.log(userId);

    const data = `postId=${postId}&voteDir=${voteDir}&userId=${userId}`;
    const url = "vote.php";

    fetch(url, {
                method: 'POST',
                headers: new Headers({"Content-Type": "application/x-www-form-urlencoded"}),
                body: data
            })

            .then((res) => res.json())
            .then((data) =>  {

              // const display = document.querySelector('.votes');
              // const
              // = document.querySelector(`.votes[data-id="${}"]`)

              console.log(data)
            })
            .catch(console.error)

          }



</script>

<?php require __DIR__.'/views/footer.php'; ?>
