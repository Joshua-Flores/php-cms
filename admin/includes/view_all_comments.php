<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            View All Comments                          
        </h1>                        
    </div>
                
</div>
<div class="row">
    <div class="col-md-12">
    <table class="table table-bordered table-hover posts-table">
        <thead class="table-secondary">
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Email</th>
                <th>Status</th>
                <th>In response to</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Delete</th>
                
            </tr>
        </thead>
        <tbody>
            
        <?php 
            $query = 'SELECT * FROM comments';
            $select_posts = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_posts)) {
                $comment_id = $row['comment_id'];
                $comment_author = $row['comment_author'];
                $comment_date = $row['comment_date'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_post_id = $row['comment_post_id'];
                $comment_content = $row['comment_content'];
                

                echo "<tr>";
                echo "<td>{$comment_id}</td>";
                echo "<td>{$comment_author}</td>";
                echo "<td>{$comment_content}</td>";
                echo "<td>{$comment_date}</td>";
                echo "<td>{$comment_email}</td>";
                echo "<td>{$comment_status}</td>";

                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                $get_comment_post = mysqli_query($connection, $query);
                confirm($query);

                while ($row = mysqli_fetch_assoc($get_comment_post)) {
                    $post_title = $row['post_title'];
                    echo "<td><a href='../post.php?p_id=$comment_post_id' target='_blank'>$post_title</a></td>";
                }

                echo "<td><a class='btn btn-success btn-sm' href='./comments.php?approve=$comment_id'>Approve</a></td>";
                echo "<td><a class='btn btn-warning btn-sm' href='./comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                echo "<td><a class='btn btn-danger btn-sm' href='./comments.php?delete=$comment_id'>Delete</a></td>";                
                echo "</tr>";
            }
        ?>
                
        </tbody>
    </table>

    <?php 
        if(isset($_GET['delete'])) {
            $comment_id = escape($_GET['delete']);
            $query = "DELETE FROM comments WHERE comment_id = '{$comment_id}'";
            $delete_query = mysqli_query($connection, $query);
            confirm($delete_query);
            header("Location: ./comments.php");
        }    

        if(isset($_GET['approve'])) {
            $comment_id = escape($_GET['approve']);
            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $comment_id";  
            $approve_query = mysqli_query($connection, $query);
            confirm($approve_query);
            header("Location: ./comments.php");
        }  

        if(isset($_GET['unapprove'])) {
            $comment_id = escape($_GET['unapprove']);
            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $comment_id";  
            $unapprove_query = mysqli_query($connection, $query);
            confirm($unapprove_query);
            header("Location: ./comments.php");
        }  
    ?>    
    </div>
</div>