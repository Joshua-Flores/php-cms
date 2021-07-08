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
                            Dashboard
                        </h1>
                        
                    </div>
                </div>

                <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary dashboard-card">
                <div class="panel-heading">
                    <h6>Posts</h6>
                    <span class="dashboard-number">
                    <?php 
                        $query = "SELECT * FROM posts";
                        $select_posts_query = mysqli_query($connection, $query);
                        $post_count = mysqli_num_rows($select_posts_query);
                        echo $post_count
                    ?>

                    </span>
                </div>
                <a href="./posts.php">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="bi bi-arrow-right-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary dashboard-card">
                <div class="panel-heading">
                    <h6>Comments</h6>
                    <span class="dashboard-number">

                    <?php 
                        $query = "SELECT * FROM comments";
                        $select_comments_query = mysqli_query($connection, $query);
                        $comment_count = mysqli_num_rows($select_comments_query);
                        echo $comment_count;
                    ?>

                    </span>
                </div>
                <a href="./comments.php">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="bi bi-arrow-right-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-primary dashboard-card">
                <div class="panel-heading">
                    <h6>Users</h6>
                    <span class="dashboard-number">
                    <?php 
                        $query = "SELECT * FROM users";
                        $select_users_query = mysqli_query($connection, $query);
                        $user_count = mysqli_num_rows($select_users_query);
                        echo $user_count;
                    ?>
                    </span>
                </div>
                <a href="./users.php">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="bi bi-arrow-right-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-primary dashboard-card">
                <div class="panel-heading">
                    <h6>Users Online</h6>
                    <span class="dashboard-number" id="users_online_number">
                   
                    </span>
                </div>
                <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="bi bi-arrow-right-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="panel panel-primary dashboard-card ">
                <div class="panel-heading">
                    <h6>Categories</h6>
                    <span class="dashboard-number">
                    <?php 
                        $query = "SELECT * FROM categories";
                        $select_categories_query = mysqli_query($connection, $query);
                        $category_count = mysqli_num_rows($select_categories_query);
                        echo $category_count;
                    ?>

                    </span>
                </div>
                <a href="./categories.php">
                    <div class="panel-footer">
                        <span class="pull-left">Details</span>
                        <span class="pull-right"><i class="bi bi-arrow-right-circle"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    
    </div>



    <?php 
        $query = "SELECT * FROM posts WHERE post_status = 'draft'";
        $select_all_draft_posts = mysqli_query($connection, $query);
        $post_draft_count = mysqli_num_rows($select_all_draft_posts);
    
        $query = "SELECT * FROM posts WHERE post_status = 'published'";
        $select_all_published_posts = mysqli_query($connection, $query);
        $post_published_count = mysqli_num_rows($select_all_published_posts);
       
        $query = "SELECT * FROM users WHERE user_role = 'admin'";
        $select_admins = mysqli_query($connection, $query);
        $admin_count = mysqli_num_rows($select_admins);
   
        $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
        $select_subscribers = mysqli_query($connection, $query);
        $subscriber_count = mysqli_num_rows($select_subscribers);
       ?>



    <div class="row row-dashboard">
    <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary dashboard-card dashboard-card-main">
                
                <h6>Post Publishing Status</h6>
                <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Type", "Count", { role: "style" } ],
        ["Total",<?php echo $post_count ?>, "lightgray"],
        ["Published",<?php echo $post_published_count ?>, "#0D6EFD"],
        ["Pending", <?php echo $post_draft_count ?>, "lightgray"],
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        // title: "Density of Precious Metals, in g/cm^3",
        width: '100%',
        height: '100%',
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
        fontSize: 16
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
<div id="columnchart_values" style="width: 100%; height: 100%;"></div>          
</div>
                
    </div>
    
    <div class="col-lg-6 col-md-6">
            <div class="panel panel-primary dashboard-card dashboard-card-main">
                
                    <h6>User Roles</h6>
                    <div id="donutchart" style="width:100%;height: 100%"></div>
                    
                    <script type="text/javascript">
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['User type', 'Number'],
                        ['Admin',     <?php echo $admin_count ?>],
                        ['Subscriber',      <?php echo $subscriber_count ?>],
                        ]);

                        var options = {
                            legend: { position: "none" },
                        title: '',
                        pieHole: 0.3,
                        pieSliceText:'label',
                        slices: {
                            0: {color: '#0D6EFD'},
                            1: {color: 'lightgray'}
                        },
                        
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                        chart.draw(data, options);
                    }
                    </script>
               
               </div>
            </div>
        </div>
    </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include './includes/admin_footer.php' ?>