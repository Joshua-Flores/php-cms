<?php 

    if(isset($_POST['create_post'])) {
        $post_title = escape($_POST['title']);
        $post_author = escape($_POST['author']);
        $post_category_id = escape($_POST['post_category_id']);
        $post_status = escape($_POST['post_status']);
        $post_image = escape($_FILES['image']['name']);
        $post_image_temp = escape($_FILES['image']['tmp_name']);
        $post_tags = escape($_POST['post_tags']);
        $post_content = escape($_POST['post_content']);
        $post_date = date('d-m-y');
        // $post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../images/{$post_image}");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' )";

        $add_post = mysqli_query($connection, $query);
        confirm($add_post);

        $post_id = mysqli_insert_id($connection);

        echo "<div class='alert alert-success' role='alert'>
        Post successfully created! <a href='../post.php?p_id=$post_id'>View post</a>
      </div>";
        
        
    }    

?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Add Post                          
        </h1>                        
    </div>                
</div>
<div class="row">
    <div class="col-md-8">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
                <label for="post_category" class="form-label">Post Category Id</label>
                <select name="post_category_id" class="form-control" id="post_category_id">
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
                <label for="autor" class="form-label">Author</label>
                <input type="text" class="form-control" name="author">
            </div>


            <div class="mb-3">
                <label for="post_status" class="form-label">Post Status</label>
                <select class="form-select" name="post_status">
                    <option value="">- Select -</option>
                    <option value="draft">draft</option>
                    <option value="published">published</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="post_image" class="form-label">Post Image</label>
                <input type="file" name="image" style="display:block;">
            </div>
            <div class="mb-3">
                <label for="post_tags" class="form-label" >Post Tags</label>
                <input type="text" class="form-control" name="post_tags" >
            </div>
            <div class="mb-3" >
                <label for="post_content" class="form-label">Post Content</label>
                <textarea class="form-control" id="summernote" name="post_content" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="mb-3">               
                <input type="submit" class="btn btn-primary" name="create_post" value="Post">
            </div>
        </form>
    </div>
</div>

