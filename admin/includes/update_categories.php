<form action="" method="post"> 
    <div class="form-group mb-3">
        <label for="cat_title" class="form-label">Update Category</label>
        <?php 
            if (isset($_GET['edit'])) {
                $cat_id = escape($_GET['edit']);

                $query = "SELECT * FROM categories WHERE cat_id = '{$cat_id}'";
                $select_category = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_category)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                }
            ?>    
                <input  class="form-control" type="text" name="cat_title"value="<?php 
                    if (isset($cat_title)) {
                        echo $cat_title;
                    }
                ?>"
                >
        <?php } ?>
    </div>
    <div class="form-group mb-3">
        <input class="btn btn-warning" type="submit" value="UPDATE CATEGORY" name="update_category">
    </div>   
    <?php 
    // update category
        if (isset($_POST['update_category'])) {
            $cat_title = escape($_POST['cat_title']);
            $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = '{$cat_id}'";
            $update_query = mysqli_query($connection, $query);
            if (!$update_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
            header("Location: categories.php"); 

        }

    ?>

</form>