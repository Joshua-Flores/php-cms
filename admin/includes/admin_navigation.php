  <div class="d-flex flex-column flex-shrink-0 p-3 pt-5 text-white bg-dark sidebar">
    <a href="./index.php" class="d-flex flex-row mb-md-0 me-md-auto text-white text-decoration-none" style="font-size:24px;padding-left:12px">
    <i class="bi bi-droplet-half"></i>
      <span>&nbsp; Drippple Admin</span>
    
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="./index.php" class="nav-link text-white" aria-current="page">
        <i class="bi me-2 bi-speedometer"></i>
          Dashboard
        </a>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link text-white dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi  me-2 bi-pencil-square"></i>
          Posts
        </a>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="./posts.php">View all posts</a></li>
    <li><a class="dropdown-item" href="./posts.php?source=add_post">Add post</a></li>
  </ul>
      </li>
      
      
      <li>
        <a href="./categories.php" class="nav-link text-white">
        <i class="bi me-2 bi-ui-checks-grid"></i>
          Categories
        </a>
      </li>
      <li>
        <a href="./comments.php" class="nav-link text-white">
        <i class="bi me-2 bi-chat-left-text-fill"></i>
          Comments
        </a>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link text-white dropdown-toggle" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi me-2 bi-people-fill"></i>
          Users
        </a>
        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
    <li><a class="dropdown-item" href="./users.php">View all users</a></li>
    <li><a class="dropdown-item" href="./users.php?source=add_user">Add user</a></li>
  </ul>
      </li>
      
      
      <li>
        <a href="../" class="nav-link text-white">
        <i class="bi me-2 bi-box-arrow-in-left"></i>
          Back to site
        </a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <img src='../images/<?php echo $_SESSION['user_image']; ?>' alt="" width="32" height="32" class="rounded-circle me-2">
        <strong><?php echo $_SESSION['firstname']; ?></strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="../admin/profile.php">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="../includes/logout.php">Sign out</a></li>
      </ul>
    </div>
  </div>

  

  





 

