<?php include './includes/admin_header.php' ?>
<?php include './functions.php' ?>
    <div id="wrapper">
        <!-- navigation -->
    <?php include './includes/admin_navigation.php' ?>
     <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Manage Categories
                          
                        </h1>
                        
                    </div>
                </div>
                                      
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        findAllCategories();  
                                        deleteCategories();
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    
                        <?php insert_categories(); ?>      
                            <?php 
                            //update and include query
                                if(isset($_GET['edit'])) {
                                    $cat_id = $_GET['edit'];
                                    include './includes/update_categories.php';
                                }
                        ?>

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="cat_title" class="form-label">Add Category</label>
                            <input class="form-control" type="text" name="cat_title">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="ADD CATEGORY">
                        </div>
                    </form>

                    

                </div>

                </div>
                            

                            
               
                            
                  

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include './includes/admin_footer.php' ?>