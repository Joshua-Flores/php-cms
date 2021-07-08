<?php 

    if (isset($_GET['p_id'])) {
        $post_id = $_GET['p_id'];    

    }

    $query = "SELECT * FROM posts WHERE post_id = $post_id";
    $select_posts_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_by_id)) {
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
        $post_date = $row['post_date'];

    }

    if (isset($_POST['update_post'])) {

        $post_author = escape($_POST['post_author']);
        $post_title = escape($_POST['post_title']);
        $post_category_id = escape($_POST['post_category']);
        $post_status = escape($_POST['post_status']);
        $post_image = escape($_FILES['image']['name']);
        $post_image_temp = escape($_FILES['image']['tmp_name']);
        $post_content = escape($_POST['post_content']);
        $post_tags = escape($_POST['post_tags']);

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $select_image = mysqli_query($connection,$query);

            while($row = mysqli_fetch_array($select_image)) {
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET post_title = '{$post_title}', post_category_id = '{$post_category_id}', post_date = now(), post_author = '{$post_author}', post_status = '{$post_status}', post_tags = '{$post_tags}', post_content = '{$post_content}', post_image = '{$post_image}' WHERE post_id = '{$post_id}' "; 

        $update_post = mysqli_query($connection, $query);
        confirm($query);

        echo "<div class='alert alert-success' role='alert'>
        Post Successfully updated! <a href='../post.php?p_id=$post_id'>View post</a>
      </div>";
    }
?>

<div class="row">
    <div class="col-lg-8">
        <h1 class="page-header">
            Edit Post                          
        </h1>                        
    </div>                
</div>
<div class="row">
    <div class="col-md-8">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" name="post_title" value="<?php echo $post_title ?>">
            </div>
            <div class="mb-3">
                <label for="post_category" class="form-label">Post Category Id</label>
                <select name="post_category" class="form-control" id="post_category">
                    <?php 
                    
                    $query = "SELECT * FROM categories";
                    $select_categories = mysqli_query($connection, $query);
                    confirm($query);

                    while ($row = mysqli_fetch_assoc($select_categories)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                    ?>
                </select>
                
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" name="post_author" value="<?php echo $post_author ?>">
     
            </div>
         <div class="mb-3">
            <label for="post_status" class="form-label">Post Status</label>
            <select name="post_status" id="" class="form-select" >
                <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
                <?php 
                if($post_status == 'published') {
                    echo "<option value='draft'>draft</option>";
                } else {
                    echo "<option value='published'>published</option>";
                }
                
                ?>
            </select>
            </div>


            <div class="mb-3">
            <label class="form-label">Image</label>
                <img src='../images/<?php echo $post_image; ?>' style="width:100%; display:block" alt="" class="mb-3">
                <input type="file" name="image">
            </div>
            <div class="mb-3">
                <label for="post_tags" class="form-label">Post Tags</label>
                <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
            </div>
            <div class="mb-3">
                <label for="post_content" class="form-label">Post Content</label>
                <textarea class="form-control" id="summernote" name="post_content" id="" cols="30" rows="10" ><?php echo $post_content ?></textarea>
            </div>
            <div class="mb-3">               
                <input type="submit" class="btn btn-primary" name="update_post" value="UPDATE">
            </div>
        </form>
    </div>
</div>

