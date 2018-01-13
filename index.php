<?php

require __DIR__.'/views/header.php';
// $postsArray = getPostsAll($pdo);
$postsArray = getPostsAllWithUserId($pdo, $_SESSION['user_id']);

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
        <div class="up-vote<?php if ($post['userVote'] === "1"){echo " active";}?>" data-liked="<?php echo $post['id'];?>" >
          <div class="thumbs up" data-post-id="<?php echo $post['id'];?>" data-user-id="<?php echo $_SESSION['user_id'];?>" data-vote-dir="1"></div>
        </div>
        <div class="votes" data-vote-display-id="<?php echo $post['id'];?>"><p><?php echo $post['sum'];?><p></div>

        <div class="down-vote <?php if ($post['userVote'] === "-1"){echo " active";}?>" data-unliked="<?php echo $post['id'];?>">
          <div class="thumbs down" data-post-id="<?php echo $post['id'];?>" data-user-id="<?php echo $_SESSION['user_id'];?>" data-vote-dir="-1"></div>
        </div>
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

    // console.log(postId);
    // console.log(voteDir);
    // console.log(userId);

    const data = `postId=${postId}&voteDir=${voteDir}&userId=${userId}`;
    const url = "vote.php";

    fetch(url, {
                method: 'POST',
                headers: new Headers({"Content-Type": "application/x-www-form-urlencoded"}),
                body: data
            })

            .then((res) => res.json())
            .then((data) =>  {


              const display = document.querySelector(`[data-vote-display-id="${postId}"]`);
              const liked = document.querySelector(`[data-liked="${postId}"]`);
              const unliked = document.querySelector(`[data-unliked="${postId}"]`);

              display.innerText = data['sum(vote)'];

              if (voteDir === "-1" && !liked.classList.contains("active") && !unliked.classList.contains("active")) {

                unliked.classList.add("active");

              } else if (voteDir === "-1" && liked.classList.contains("active") && !unliked.classList.contains("active")) {

                liked.classList.remove("active");
                unliked.classList.add("active");

              } else if (voteDir === "-1" && !liked.classList.contains("active") && unliked.classList.contains("active")) {

                unliked.classList.remove("active");

              } else if (voteDir === "1" && !liked.classList.contains("active") && unliked.classList.contains("active")) {

                unliked.classList.remove("active");
                liked.classList.add("active");

              } else if (voteDir === "1" && liked.classList.contains("active") && !unliked.classList.contains("active")) {

              liked.classList.remove("active");

              } else if (voteDir === "1" && !liked.classList.contains("active") && !unliked.classList.contains("active")) {

              liked.classList.add("active");

              }



              // if (unliked.classList.contains("active") && voteDir === "-1") {
              //
              //   unliked.classList.remove("active");
              //
              // } else if (liked.classList.contains("active") && voteDir === "-1") {
              //
              //   liked.classList.remove("active");
              //   unliked.classList.add("active");
              //
              // } else if (liked.classList.contains("active") && voteDir === "1") {
              //
              //   liked.classList.remove("active");
              //
              // } else if (unliked.classList.contains("active") && voteDir === "1") {
              //
              //   unliked.classList.remove("active");
              //   liked.classList.add("active");
              //
              // }

              // if (liked.classList.contains("active")) {
              //
              //   liked.classList.remove("active");
              //
              // } else {
              //
              //   liked.classList.add("active");
              //
              // }


              // liked.classList.add("active");
              // unliked.classList.add("active");

              // console.log(display);
              // console.log(data);
              console.log(voteDir);
              // console.log(data['sum(vote)']);

            })
            .catch(console.error)

          }



</script>

<?php require __DIR__.'/views/footer.php'; ?>
