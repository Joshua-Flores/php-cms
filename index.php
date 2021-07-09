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
        <h1 class="mt-5 display-1">
        <i class="bi bi-droplet-half"></i> Drippple
          </h1>
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
            <!-- First Blog Post -->

        <div class="blog-post-section"> 
            <a href="post.php?p_id=<?php echo $post_id ?>"><img class="img-fluid" src="./images/<?php echo $post_image ?>" alt="" /></a>
            
            <h2>
                <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
              </h2>
                        
              
              <p><strong><a href="author_posts.php?author=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a></strong> <span class="text-secondary"><?php echo $post_date ?></span></p>
              
              
              <p>
              <?php echo $post_content ?>
              </p>
              <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>"
                >Read More <span class="glyphicon glyphicon-chevron-right"></span
              ></a>
              <hr>
        </div>         
          
          <?php
          } 

          ?>
          <?php }            
        ?>   
    </div>
       <!-- Blog Sidebar Widgets Column -->
      <div class="col-md-4">
          <!-- Blog Search Well -->
          <div class="my-3 p-3 border bg-light">
            <h5>Blog Search</h5>
            
            <form action="search.php" method="post">
            <div class="input-group mb-3">
              <input
                type="text"
                class="form-control"
                placeholder="Search"
                aria-label="Search"
                aria-describedby="search"
                name="search"
              />
              <button class="btn btn-secondary" type="submit" name="submit" id="search">
                <i class="bi bi-search"></i>
              </button>
            </div>
            </form>
            
            <!-- Login -->
          </div>

          <div class="my-3 p-3 border bg-light">
            <h5>Login</h5>
            
            <form action="includes/login.php" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input
                type="text"
                class="form-control"
                placeholder="username"
                aria-label="username"
                aria-describedby="username"
                name="username"
              />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input
                type="password"
                class="form-control"
                placeholder="password"
                aria-label="password"
                aria-describedby="password"
                name="password"
              />
            </div>
            <div class="d-grid gap-2">
              <button type="submit" name="login" class="btn btn-primary">Login</button>
            </div>
            </form>
            
            <!-- /.input-group -->
          </div>

          <!-- Blog Categories Well -->
          <div class="my-3 p-3 border bg-light">
          <h5>Blog Categories</h5>
          <ul class="list-unstyled">
          <?php 
      
            $query = "SELECT * FROM categories LIMIT 4";
            $select_categories_sidebar = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                echo "<li>
                        <a href='category.php?category={$cat_id}'>{$cat_title}</a>
                      </li>";
            }              
          ?>
          </ul>
            
            
            <!-- /.row -->
          </div>

        <?php include './includes/widget.php'?>
        </div>
      </div>

        <nav aria-label="Page navigation example">
          <ul class="pagination">
           
            <?php 
              for($i = 1; $i <= $count; $i++) {
                echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
              }

            ?>
           
          </ul>
        </nav>

<?php include "./includes/footer.php" ?>