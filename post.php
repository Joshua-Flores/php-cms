<?php 

  include "./includes/db.php";
  include './includes/header.php'; 
  session_start();
  
?>
<!-- Navigation -->
<?php include './includes/navigation.php'; ?>

<?php 

  if (isset($_GET['p_id'])) {
    $post_id = escape($_GET['p_id']);
  
  $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = '{$post_id}'";
  $send_query = mysqli_query($connection, $view_query);

  if (!$send_query) {
    die("QUERY FAILED" . mysqli_error($connection));
  }
?>
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
        
        <?php 
          $query = "SELECT * FROM posts WHERE post_id = $post_id";
          $select_all_posts_query = mysqli_query($connection, $query);

          while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = $row['post_content'];
          
         ?>

          
          <!-- First Blog Post -->
          <div class="blog-post-section">
          <h1>
            <?php echo $post_title ?>
          </h1>
          <hr>
          <p class="lead">by <a href="index.php"><?php echo $post_author ?></a></p>
          <p>
            <i class="bi bi-clock"></i> Posted on <?php echo $post_date ?>
          </p>
          <img class="img-fluid" src="./images/<?php echo $post_image ?>" alt="" />
          <p>
          <?php echo $post_content ?>
          </p>
          
   
          </div>

          <?php } 
          
        } else {
          header("Location: index.php");
        }          
        ?>

            

             <!-- Comments Form -->
          <div class="p-4 border bg-light">
            <h5>Comment on this post</h5>
            <form role="form" action="" method="post">
            <div class="mb-3">
                <label for="comment_author" class="form-label">Author</label>
                <input class="form-control" type="text" name="comment_author" required>
              </div>
              <div class="mb-3">
              <label for="comment_author" class="form-label">Email</label>
                <input class="form-control" type="email" name="comment_email" required>
              </div>
              <div class="mb-3">
              <label for="comment_author" class="form-label">Comment</label>
                <textarea class="form-control mb-3" rows="3" name="comment_content" required></textarea>
              </div>
              <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
            </form>
          </div>

          <hr />

          <?php 
            
            if (isset($_POST['create_comment'])) {              
              $comment_author = $_POST['comment_author'];
              $comment_email = $_POST['comment_email'];
              $comment_content = $_POST['comment_content'];

              if (!empty($comment_author && $comment_email && $comment_content)) {
                $submit_comment_query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES('{$post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}', 'pending', now())";
                $submit_comment = mysqli_query($connection, $submit_comment_query);  
                $comment_count_query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
                $increment_comment_count = mysqli_query($connection, $comment_count_query);
              } 
            }
            ?>

          <!-- Render Comments -->
          <?php 
          $query = "SELECT * FROM comments WHERE comment_status = 'approved'";
          $select_approved_comments_query = mysqli_query($connection, $query);

          while ($row = mysqli_fetch_assoc($select_approved_comments_query)) {
              $comment_author = $row['comment_author'];
              $comment_date = $row['comment_date'];
              $comment_content = $row['comment_content']          
            ?>          
          <!-- First Blog Post -->
          <div class="d-flex my-3">
            <a href="#">
              <div class="flex-shrink-0">
                <img src="http://placehold.it/64x64" alt="" />
              </div>
            </a>
            <div class="flex-grow-1 ms-3">
              <h5 class="media-heading">
                <?php echo $comment_author ?>
                <small class="text-secondary"><?php echo $comment_date ?></small>
              </h5>
              <?php echo $comment_content ?>
            </div>
          </div>


          <?php }            
        ?>
          

          
          
        </div>
        

        <!-- Blog Sidebar Widgets Column -->
        <?php include './includes/sidebar.php' ?>

<?php include "./includes/footer.php" ?>