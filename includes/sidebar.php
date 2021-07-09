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
      <!-- /.row -->