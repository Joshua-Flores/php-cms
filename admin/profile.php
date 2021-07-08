<?php include './includes/admin_header.php' ?>
<?php include './functions.php' ?>


    <div id="wrapper">
        <!-- navigation -->
    <?php include './includes/admin_navigation.php' ?>
     <div id="page-wrapper">

        <div class="container-fluid">
            <h1>Profile</h1>
            <!-- Page Heading -->

            <?php 

                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];

                    $query = "SELECT * FROM users WHERE user_username = '{$username}'";
                    $select_user_profile = mysqli_query($connection, $query);
                    confirm($select_user_profile);

                    while($row = mysqli_fetch_array($select_user_profile)) {
                        $user_id = $row['user_id'];
                        $user_username = $row['user_username'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_password = $row['user_password'];
                        $user_image = $row['user_image'];
                        $user_email = $row['user_email'];
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

                    $query = "UPDATE users SET user_username = '{$user_username}', user_password = '{$user_password}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_image = '{$user_image}', user_role = '{$user_role}' WHERE user_username = '{$user_username}' "; 
                    $update_profile_query = mysqli_query($connection,$query);
                    confirm($update_profile_query);
                }

                

            ?>
            
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
                                    echo "<option value='subscriber'>Subscriber</option>";
                                } else {
                                    echo "<option value='admin'>Admin</option>";
                                }

                                
                                ?>
                                
                            </select>
                        </div>
                        <div class="form-group">               
                            <input type="submit" class="btn btn-primary" name="submit" value="Update">
                        </div>
                    </form>
                </div>
</div>

            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include './includes/admin_footer.php' ?>