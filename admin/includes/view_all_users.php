<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            View All Users                          
        </h1>                        
    </div>
                
</div>
<div class="row">
    <div class="col-md-12">
    <table class="table table-bordered table-hover posts-table">
        <thead class="table-secondary">
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
        <?php 
            $query = 'SELECT * FROM users';
            $select_posts = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_posts)) {
                $user_id = $row['user_id'];
                $user_username = $row['user_username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];

                echo "<tr>";
                echo "<td>{$user_id}</td>";
                echo "<td>{$user_username}</td>";
                echo "<td>{$user_firstname}</td>";
                echo "<td>{$user_lastname}</td>";
                echo "<td>{$user_email}</td>";
                echo "<td>{$user_role}</td>";      
                echo "<td>
                    <div class='dropdown'>
                        <button class='btn btn-outline-danger dropdown-toggle' type='button' id='dropdownMenu-{$user_id}' data-bs-toggle='dropdown' aria-expanded='false'>
                        Actions
                        </button>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenu{$user_id}'>
                        <li><a class='dropdown-item' type='button' href='./users.php?source=edit_user&edit_user={$user_id}'>Edit</a></li>
                        <li><a class='dropdown-item' type='button' href='./users.php?change_to_sub={$user_id}'>Change to subscriber</a></li>
                        <li><a class='dropdown-item' type='button' href='./users.php?change_to_admin={$user_id}'>Change to admin</a></li>
                        
                            <li><a class='dropdown-item' type='button' href='./users.php?delete={$user_id}'>Delete</a></li>
                        </ul>
                    </div>
                </td>";          
                echo "</tr>";
            }
        ?>
                
        </tbody>
    </table>

    <?php 
        if(isset($_GET['delete'])) {
            if (isset($_SESSION['user_role'])) {
                if($_SESSION['user_role'] == 'admin') {
                    $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
                    $query = "DELETE FROM users WHERE user_id = '{$user_id}'";
                    $delete_query = mysqli_query($connection, $query);
                    header("Location: ./users.php");
                }
            }           
        }    

        if(isset($_GET['change_to_admin'])) {
            if (isset($_SESSION['user_role'])) {
                if($_SESSION['user_role'] == 'admin') {
                    $user_id = escape($_GET['change_to_admin']);
                    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = '{$user_id}'";
                    $change_to_admin_query = mysqli_query($connection, $query);
                    confirm($change_to_admin_query);
                    header("Location: ./users.php");
                }
            }
        }

        if(isset($_GET['change_to_sub'])) {
            if (isset($_SESSION['user_role'])) {
                if($_SESSION['user_role'] == 'admin') {
                    $user_id = escape($_GET['change_to_sub']);
                    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = '{$user_id}'";
                    $change_to_sub_query = mysqli_query($connection, $query);
                    confirm($change_to_sub_query);
                    header("Location: ./users.php");
                }
            }
        }
       
    ?>

    
    </div>
</div>