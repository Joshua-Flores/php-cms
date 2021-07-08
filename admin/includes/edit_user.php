<?php 
    if (isset($_GET['edit_user'])) {
        $user_id = $_GET['edit_user'];

        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $get_user = mysqli_query($connection, $query);
        confirm($query);
        
        while ($row = mysqli_fetch_assoc($get_user)) {
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_username = $row['user_username'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
        }
    }

    if (isset($_POST['submit'])) {

        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_username = escape($_POST['user_username']);
        $user_email = escape($_POST['user_email']);
        $user_image = escape($_FILES['user_image']['name']);
        $user_image_temp = escape($_FILES['user_image']['tmp_name']);
        $user_password = escape($_POST['user_password']);
        $user_role = escape($_POST['user_role']);

        move_uploaded_file($user_image_temp, "../images/$user_image");

        if (empty($user_image)) {
            $query = "SELECT * FROM users WHERE user_id = $user_id";
            $select_image = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_image)) {
                $user_image = $row['user_image'];
            }
        }

        $query = "SELECT user_randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);
        if (!$select_randsalt_query) {
            die("Query Failed" . mysqli_error($connection));
        }

        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['user_randSalt'];
        $hashed_password = crypt($user_password, $salt);

        $query = "UPDATE users SET user_username = '{$user_username}', user_password = '{$hashed_password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_image = '{$user_image}', user_role = '{$user_role}' WHERE user_id = $user_id "; 

        $update_user = mysqli_query($connection, $query);
        confirm($update_user);
    }
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Edit User                          
        </h1>                        
    </div>                
</div>
<div class="row">
    <div class="col-md-8">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="user_firstname" value='<?php echo $user_firstname; ?>'>
            </div> 
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="user_username" value="<?php echo $user_username ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="user_email" value="<?php echo $user_email ?>">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="user_password" value="<?php echo $user_password ?>"> 
            </div>
            <div class="mb-3">
                <label for="user_image" class="form-label" style="display:block;">Profile picture</label>
                <img src='../images/<?php echo $user_image ?>' alt="" style="max-width: 400px" class="mb-3">
                <input type="file" name="user_image" style="display:block;">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="user_role" class="form-select">
                    <?php 
                        echo "<option value='subscriber'>{$user_role}</option>";
                        if ($user_role == 'admin') {
                            echo "<option value='subscriber'>subscriber</option>";
                        } else {
                            echo "<option value='admin'>admin</option>";
                        }                    
                    ?>                    
                </select>
            </div>
            <div class="form-group">               
                <input type="submit" class="btn btn-primary" name="submit" value="Edit User">
            </div>
        </form>
    </div>
</div>