<?php

require __DIR__.'/views/header.php';

if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true){

  if (isset($_GET['sortBy']) && $_GET['sortBy'] === "date"){


    $postsArray = getPostsAllWithUserIdSortByDate($pdo, $_SESSION['user_id']);

  } else {

    $postsArray = getPostsAllWithUserIdSortByVotes($pdo, $_SESSION['user_id']);

  }

} else {

  if (isset($_GET['sortBy']) && $_GET['sortBy'] === "date"){


    $postsArray = getPostsAllSortByDate($pdo);

  } else {

    $postsArray = getPostsAllSortByVotes($pdo);

  }

}

// die(var_dump($postsArray));

$userId = isset ($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

?>

<div class="main-container">

  <div class="feed-header">

    <div class="feed-header-content">


      <?php if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true):?>

        <article class="feed-header-menu">

          <h1>
            <?php echo "Welcome ".$_SESSION['username'].", you are now successfully logged in and ready to join the discussion! "; ?><a href="/submit_post.php">Submit a new post!</a>
          </h1>
          <div class="sortButtons">
            <a class="btn sort" href="index.php?sortBy=date"><nobr>SORT BY DATE</nobr></a>
            <a class="btn sort" href="index.php?sortBy=votes"><nobr>SORT BY VOTES</nobr></a>
          </div>

        </article>

      <?php else: ?>

        <article class="feed-header-menu">
          <h1>
            <?php echo "Welcome to ".$config['title'].", "; ?>
            <a href="/login.php">login </a>
            <?php echo "to join the discussion!"; ?>
          </h1>
          <div class="sortButtons">
            <a class="btn sort" href="index.php?sortBy=date"><nobr>SORT BY DATE</nobr></a>
            <a class="btn sort" href="index.php?sortBy=votes"><nobr>SORT BY VOTES</nobr></a>
          </div>
        </article>

      <?php endif; ?>

    </div><!-- /feed-header-content -->

  </div><!-- /feed-header -->

  <div class="feed">


    <?php $rank = 1; foreach ($postsArray as $post): ?>



      <div class="post-container">

        <div class="post" data-postId="<?php echo $post['id'];?>">

          <div class="post-rank">
            <div class="rank"><h2><?php echo $rank; $rank++; ?></h2></div>
          </div>


          <div class="post-votes">


            <div class="up-vote" >

              <div class="thumbs up <?php if (isset($post['userVote']) && $post['userVote'] === "1"){echo " active";}?>" data-liked="<?php echo $post['id'];?>" data-post-id="<?php echo $post['id'];?>" data-user-id="<?php echo $userId;?>" data-vote-dir="1"></div>

            </div><!-- /up-vote -->


            <div class="votes" data-vote-display-id="<?php echo $post['id'];?>"><p><?php echo $post['sum'];?><p></div>


              <div class="down-vote">
                <div class="thumbs down <?php if ($post['userVote'] === "-1"){echo " active";}?>" data-unliked="<?php echo $post['id'];?>" data-post-id="<?php echo $post['id'];?>" data-user-id="<?php echo $userId;?>" data-vote-dir="-1"></div>
              </div>
            </div>

            <a href="<?php echo $post['url']; ?>" class="post-image" style="background-image: url(<?php echo $post['image'];?>)" ></a>


            <div class="post-content">

              <div class="post-header">

                <div class="title">
                  <a href="<?php echo $post['url']; ?>"><h2><?php echo strtoupper($post['title']); ?></h2></a>
                </div>

              </div>

              <div class="post-body">


                <p><?php echo $post['description']; ?></p>


              </div> <!-- /post-body -->

              <div class="post-footer">

                <div class="post-comments">
                  <h3>Comments</h3>
                </div>

                <div class="author">
                  <p><nobr>Submitted on <?php echo date("F j, Y, g:i a", $post['timeOfSub']); ?> by <?php echo $post['username']; ?><img class="userAvatar" src="<?php echo $post['avatar']; ?>" alt="users avatar"></nobr></p>


                </div><!-- /author -->

              </div><!-- /post-footer -->

            </div><!-- /post-content -->

          </div> <!-- /post -->

        </div><!-- /post-container -->

      <?php endforeach; ?>

      <div class="back-to-top">
        <a href="#top"><nobr>BACK TO TOP</nobr></a>
      </div>

    </div><!-- /feed -->

  </div><!-- /main-container -->


<script>

'use strict';

  const voteLinks = document.querySelectorAll('.up, .down');

    voteLinks.forEach(function(link) {

      link.addEventListener('click', vote);

    });

  function vote(event){

    const postId = event.target.dataset.postId;
    const voteDir = event.target.dataset.voteDir;
    const userId = event.target.dataset.userId;

    if (userId){

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

            })
            .catch(console.error)

          } else {

            if (confirm('You have to be logged in to participate in the voting. Press OK if you want to proceed to the login page where you can also sign up for a free account if you have not already!')) {
              window.location.href = "login.php";
              } else {
                // Do nothing!
              }

            }
          }


</script>

<?php require __DIR__.'/views/footer.php'; ?>
