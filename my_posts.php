<?php

require __DIR__.'/views/header.php';

$postsArray = getPostsByUserId($pdo, $_SESSION['user_id']);

?>




<div class="main-container">

  <div class="feed-header">

    <div class="feed-header-content">

      <?php if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true):?>

        <article>
          <h2>Here you can find, edit and/or delete all of the posts you have submitted!</h2>
        </article>

      <?php endif; ?>

    </div><!-- /feed-header-content -->

  </div><!-- /feed-header -->

<div class="feed">

  <?php $rank = 1; foreach ($postsArray as $post): ?>


    <div class="post-container">

      <div class="post" data-id="<?php echo $post['id'];?>" >

        <div class="post-rank">
          <div class="rank"><h2><?php echo $rank; $rank++; ?></h2></div>
        </div>

      <a href="<?php echo $post['url']; ?>" class="post-image" style="background-image: url(<?php echo $post['image'];?>)" ></a>

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

          <div class="post-footer my-posts">

            <div class="post-options">
              <div class="btn"><a href="/edit_post.php?id=<?php echo $post['id'];?>">EDIT</a></div>
              <div class="btn"><a href="/app/posts/delete.php?id=<?php echo $post['id'];?>">DELETE</a></div>
            </div>

            <div class="author my-posts">
              <p><nobr>Submitted on <?php echo date("F j, Y, g:i a", $post['timeOfSub']);?></nobr></p>
            </div><!-- /author -->

          </div>

        </div><!-- /post-content -->

      </div> <!-- /post -->

    </div><!-- /post-container -->
     <?php endforeach; ?>

  </div><!-- /feed -->

  </div><!-- /main-container -->

<?php require __DIR__.'/views/footer.php'; ?>
