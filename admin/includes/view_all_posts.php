<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            View All Posts                          
        </h1>                        
    </div>
                
</div>
<div class="row">
    <div class="col-md-12">
    
    <?php 
        if(isset($_POST['checkBoxArray'])){
            foreach($_POST['checkBoxArray'] as $post_id){
               $bulk_options = escape($_POST['bulk_options']);
               switch($bulk_options) {
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$post_id}'";
                    $update_to_published = mysqli_query($connection, $query);
                    confirm($update_to_published);
                    break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = '{$post_id}'";
                    $update_to_draft = mysqli_query($connection, $query);
                    confirm($update_to_draft);
                    break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = '{$post_id}'";
                    $delete = mysqli_query($connection, $query);
                    confirm($delete);
                    break;
                case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = '{$post_id}'";
                    $select_post_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($select_post_query)) {
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_date = $row['post_date'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];

                    }

                    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' )";

                    $copy_query = mysqli_query($connection, $query);
                    if (!$copy_query) {
                        die("Query Failed" . mysqli_error($connection));
                    }

                    break;
               }

            }
        }
    
    ?>
    
    <form action="" method="POST">
    <table class="table table-bordered posts-table">

        <div class="row">
            <div class="col-md-6">
            <div class="bulkOptionsContainer">
                <select class="form-select" name="bulk_options" id="">
                    <option value="">Select Options</option>
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                </select>
                <button type="submit" name="apply" class="btn btn-primary">Apply</button>
                <a class="btn btn-success" href="./posts.php?source=add_post">Add New</a>
            </div>
            </div>
            
            
        </div>

       

        <thead class="table-secondary">
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Views</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
        <?php 
            $query = 'SELECT * FROM posts ORDER BY post_id DESC';
            $select_posts = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];
            
                echo "<tr>";
                ?>

                <td><input id='' class='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $post_id; ?>"></td>

                <?php
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";

                $query = "SELECT * FROM categories WHERE cat_id = '{$post_category_id}'";
                $select_category = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_category)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<td>$cat_title</td>";

                }
                echo "<td>{$post_status}</td>";
                echo "<td><img src='../images/{$post_image}' alt=''></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comment_count}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td>{$post_views_count}</td>";
                echo "<td><div class='dropdown'>
                <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenu-{$post_id}' data-bs-toggle='dropdown' aria-expanded='false'>
                  Actions
                </button>
                <ul class='dropdown-menu' aria-labelledby='dropdownMenu{$post_id}'>
                  <li><a class='dropdown-item' type='button' href='./posts.php?source=edit_post&p_id={$post_id}'>Edit</a></li>
                  <li><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" class='dropdown-item' type='button' href='./posts.php?delete={$post_id}'>Delete</a></li>
                </ul>
              </div></td>";
                
                echo "</tr>";
            }
        ?>


                
        </tbody>
    </table>
    </form>
    <?php 

        if(isset($_GET['delete'])) {
            $post_id = $_GET['delete'];
            $query = "DELETE FROM posts WHERE post_id = '{$post_id}'";
            $delete_query = mysqli_query($connection, $query);
            confirm($delete_query);
            header("Location: ./posts.php");
        }    
    ?>
    </div>
</div>