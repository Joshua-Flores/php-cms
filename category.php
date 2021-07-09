<?php 

  include "./includes/db.php";
  include './includes/header.php'; 

  
?>
<!-- Navigation -->
<?php include './includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">
      <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
        <h1 class="mt-5">
            Page Heading
            <small class="text-muted">Secondary Text</small>
          </h1>
          <hr />
        <?php 

        if(isset($_GET['category'])) {
            $post_category_id = mysqli_real_escape_string($connection, $_GET['category']);
        }
      
          $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id";
          $select_all_posts_query = mysqli_query($connection, $query);

          while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];
              $post_content = substr($row['post_content'], 0, 300) . "...";
          
         ?>

          
          <!-- Render Blog Post -->
          <h2>
            <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
          </h2>
          <p class="lead">by <a href="index.php"><?php echo $post_author ?></a></p>
          <p>
            <i class="bi bi-clock"></i> Posted on <?php echo $post_date ?>
          </p>
          <hr />
          <img class="img-fluid" src="./images/<?php echo $post_image ?>" alt="" />
          <hr />
          <p>
          <?php echo $post_content ?>
          </p>
          <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>"
            >Read More <span class="glyphicon glyphicon-chevron-right"></span
          ></a>
          <hr>


          <?php }            
        ?>

          
        </div>
        

        <!-- Blog Sidebar Widgets Column -->
        <?php include './includes/sidebar.php' ?>

      <hr />

<?php include "./includes/footer.php" ?>