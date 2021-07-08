<?php 

// escape user input
function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

// validate if query went through
function confirm($query) {
    global $connection;
    if (!$query) {
        die("Add post failed. " . mysqli_error($connection));
    }  
}

function users_online() {

    if (isset($_GET['onlineusers'])) {


    global $connection;

    if (!$connection) {
        session_start();
        include("../includes/db.php");


    }


    $session = session_id();
    $time = time();
    $time_out_in_seconds = 30;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM users_online WHERE session = '{$session}'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if ($count == NULL) {
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
    } else {
        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
    }
    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
    confirm($users_online_query);
    echo $count_user_online = mysqli_num_rows($users_online_query);
} // get request isset()
}
users_online();


// create new category
function insert_categories(){
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = escape($_POST['cat_title']);    
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty.";
        }  else {
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
            $create_category_query = mysqli_query($connection, $query);
            if (!$create_category_query) {
                die('Query failed' . mysqli_error($connection));
            }
            header("Location: categories.php"); 
        }                         
     }
}

// render all categories
function findAllCategories() {
    global $connection;
     $query = "SELECT * FROM categories";
     $select_categories = mysqli_query($connection, $query);

     while ($row = mysqli_fetch_assoc($select_categories)) {
         $cat_id = $row['cat_id'];
         $cat_title = $row['cat_title'];
         echo "<tr>";
         echo "<td>{$cat_id}</td>";
         echo "<td>{$cat_title}";
         echo "<td><div class='dropdown'>
         <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenu-{$cat_id}' data-bs-toggle='dropdown' aria-expanded='false'>
           Actions
         </button>
         <ul class='dropdown-menu' aria-labelledby='dropdownMenu{$cat_id}'>
           <li><a class='dropdown-item' type='button' href='./categories.php?edit={$cat_id}'>Edit</a></li>
           <li><a class='dropdown-item' type='button' href='./categories.php?delete={$cat_id}'>Delete</a></li>
         </ul>
       </div></td>";
         echo "</tr>";
     }          
}

function deleteCategories() {
    // delete categories
    if (isset($_GET['delete'])) {
        global $connection;
        $cat_id = escape($_GET['delete']);
        $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php"); 
    }
}

?>