<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>



    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 mb-5" style="margin:auto;">
                <div class="form-wrap mb-3">
                    <h1 style="text-align:center">Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off" >
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="username" required>
                        </div>
                         <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="email" required>
                        </div>
                         <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                    <div class="d-grid">
                    <input type="submit" name="submit" id="btn-login" class="btn btn-primary btn-lg" value="Register">
                    </div>
                       
                    </form>                 
                </div>
                <?php 
                
                    if (isset($_POST['submit'])) {
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $username = mysqli_real_escape_string($connection, $username);
                        $email = mysqli_real_escape_string($connection, $email);
                        $password = mysqli_real_escape_string($connection, $password);

                        $query = "SELECT user_randSalt FROM users";
                        $select_randsalt_query = mysqli_query($connection, $query);

                        if(!$select_randsalt_query) {
                            die('Query Failed' . mysqli_error($connection));
                        }

                        $row = mysqli_fetch_array($select_randsalt_query);
                        $salt = $row['user_randSalt'];
                        $password = crypt($password, $salt);

                        $query = "INSERT INTO users (user_username, user_email, user_password, user_role)";
                        $query .= "VALUES('{$username}','{$email}','{$password}', 'subscriber')";
                        $register_user_query = mysqli_query($connection, $query);
                        if (!$register_user_query) {
                            die("QUERY FAILED" . mysqli_error($connection) . ' ') . mysqli_errno($connection);
                        }

                        echo "<div class='alert alert-success' role='alert'>
                        Registration successfully submitted! <a href='./'>Back to login</a>.
                    </div>";
                    }

                ?>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>






<?php include "includes/footer.php";?>
