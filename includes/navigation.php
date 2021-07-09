<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="./"
          ><i class="bi bi-droplet-half"></i> Drippple</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <?php 
      
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    echo "<li class='nav-item'>
                    <a class='nav-link' aria-current='page' href='category.php?category={$cat_id}'>{$cat_title}</a>
                  </li>";
                }              
              ?>
              <li class="nav-item">
              <a class='nav-link' aria-current='page' href='./admin'>Admin</a>
              </li>
              <li class="nav-item">
              <a class='nav-link' aria-current='page' href='./registration.php'>Registration</a>
              </li>
              <?php 
                if(isset($_SESSION['user_role'])){
                  if (isset($_GET['p_id'])) {
                    $post_id = $_GET['p_id'];
                    echo "<li class='nav-item'>
                    <a class='nav-link' aria-current='page' href='./admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a>
                    </li>";
                  }
              }

              ?>
          </ul>
        </div>
      </div>
    </nav>