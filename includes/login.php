<?php include "db.php"; ?>
<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users where user_username = '{$username}'";
    $select_user_query = mysqli_query($connection, $query);
    
    if (!$select_user_query) {
        die("somethings not right here... I can feel it." . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $db_user_id = $row['user_id'];
        $db_user_username = $row['user_username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
        $db_user_image = $row['user_image'];
    }

    $password = crypt($password, $db_user_password);

   if ($username === $db_user_username && $password === $db_user_password) {
        $_SESSION['username'] = $db_user_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_image'] = $db_user_image;        
        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }



}

?>

