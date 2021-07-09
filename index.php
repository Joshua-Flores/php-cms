<?php 
  include "./includes/db.php";
  include './includes/header.php'; 
?>
<!-- Navigation -->
<?php include './includes/navigation.php'; ?>

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h1 class="mt-5 display-1"><i class="bi bi-droplet-half"></i>Drippple</h1>
      <hr />
      <?php 
        $per_page = 5;
          if (isset($_GET['page'])) {
            $page = escape($_GET['page']);
          } else {
            $page = "";
          }

          if ($page == "" || $page == 1) {
            $page_1 = 0;
          } else {
            $page_1 = ($page * $per_page) - $per_page;
          }

          $post_query_count = "SELECT * FROM posts";
          $find_count = mysqli_query($connection, $post_query_count); 
          $count = mysqli_num_rows($find_count);
          $count = ceil($count / $per_page);
          
      
          $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT {$page_1}, {$per_page}";
          $select_all_posts_query = mysqli_query($connection, $query);

          while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];
              $post_date = $row['post_date'];
              $post_date = date("F j, Y, g:i a");
              $post_image = $row['post_image'];
              $post_content = substr($row['post_content'], 0, 300) . "...";
              $post_status = $row['post_status'];
          
          if ($post_status == 'published') {
            ?>
            <div class="blog-post-section"> 
              <a href="post.php?p_id=<?php echo $post_id ?>"><img class="img-fluid" src="./images/<?php echo $post_image ?>" alt=""/></a>            
              <h2><a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></h2>
              <p><strong><a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a></strong> <span class="text-secondary"><?php echo $post_date ?></span></p>
              <p><?php echo $post_content ?></p>
              <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>
              <hr>
            </div>         
          
          <?php
          } 
          ?>
          <?php }            
        ?>   
        <nav aria-label="Page navigation example">
          <ul class="pagination">          
            <?php 
              for($i = 1; $i <= $count; $i++) {
                echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
              }
            ?>           
          </ul>
        </nav>
    </div>
    <?php include './includes/sidebar.php' ?>
  </div>      
</div>
<?php include "./includes/footer.php" ?>