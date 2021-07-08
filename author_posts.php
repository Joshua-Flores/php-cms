<?php 

  include "./includes/db.php";
  include './includes/header.php'; 
  session_start();
  
?>
<!-- Navigation -->
<?php include './includes/navigation.php'; ?>

<?php 

  if (isset($_GET['author'])) {
    $post_author = $_GET['author'];
  }

?>
    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
        <p class="lead mt-5" >All posts by <?php echo $post_author; ?></p>
        <?php 
          $query = "SELECT * FROM posts WHERE post_author = '{$post_author}'";
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
          <p class="lead">by <a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a></p>
          <p>
            <i class="bi bi-clock"></i> Posted on <?php echo $post_date ?>
          </p>
          <img class="img-fluid" src="./images/<?php echo $post_image ?>" alt="" />
          <p>
          <?php echo $post_content ?>
          </p>
          
   
          </div>

          <?php }            
        ?>

            


          <!-- Render Comments -->
          
          
          
        </div>
        

        <!-- Blog Sidebar Widgets Column -->
        <?php include './includes/sidebar.php' ?>

<?php include "./includes/footer.php" ?>