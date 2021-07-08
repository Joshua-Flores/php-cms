<?php include './includes/admin_header.php' ?>
<?php include './functions.php' ?>
    <div id="wrapper">
        <!-- navigation -->
    <?php include './includes/admin_navigation.php' ?>
     <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->

            <?php 
            
                if(isset($_GET['source'])){
                    $source = escape($_GET['source']);
                } else {
                    $source = '';
                }

                switch($source) {
                    case 'add_post':
                    include './includes/add_post.php';
                    break;

                    case 'edit_post':
                    include './includes/edit_post.php';
                    break;

                    default:
                    include './includes/view_all_comments.php';
                    break;
                }

            ?>
            
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include './includes/admin_footer.php' ?>