<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Add User                          
        </h1>                        
    </div>                
</div>
<div class="row">
    <div class="col-md-8">
    
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="firstname" class="form-label">First name</label>
                <input type="text" class="form-control" name="firstname">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last name</label>
                <input type="text" class="form-control" name="lastname">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="user_email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label for="user_image" class="form-label">Profile picture</label>
                <input type="file" name="user_image" style="display:block;">
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select name="role" class="form-select">
                    <option selected value="subscriber">Select role</option>
                    <option value="subscriber">Subscriber</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group mb-3">               
                <input type="submit" class="btn btn-primary" name="submit" value="Add User">
            </div>
        </form>
        <?php 
    if (isset($_POST['submit'])) {
        $user_firstname = escape($_POST['firstname']);
        $user_lastname = escape($_POST['lastname']);
        $user_username = escape($_POST['username']);
        $user_email = escape($_POST['user_email']);
        $user_password = escape($_POST['password']);
        $user_image = escape($_FILES['user_image']['name']);
        $user_image_temp = escape($_FILES['user_image']['tmp_name']);
        $user_role = escape($_POST['role']);

        $query = "INSERT INTO users(user_firstname, user_lastname, user_username, user_email, user_password, user_image, user_role) VALUES('{$user_firstname}', '{$user_lastname}', '{$user_username}', '{$user_email}', '{$user_password}', '{$user_image}', '{$user_role}')";
        $add_user = mysqli_query($connection, $query);
        confirm($add_user);
        echo "<div class='alert alert-success' role='alert'>
        <h4 class='alert-heading'>User created!</h4>
        <p>You can make changes to this user from the <a href='./users.php'>View All Users</a> dashboard page.</p>
        
      </div>";
    }
?>
    </div>
</div>

