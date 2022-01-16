<?php

 include '_dbconnect.php';
if(isset($_SESSION['username']) && $_SESSION['username']==true){
  $loggedin = true;
}
else{
  $loggedin = false;
}


echo ' <nav class="navbar navbar-expand-lg navbar-light"  style="background-color: #e3f2fd";>
<div class="container-fluid">
  <a class="navbar-brand" href="/forum">AiForums</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Clubs
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown"> ';
          $sql = "SELECT club_name,club_id FROM `clubs`";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){
          echo '<li><a class="dropdown-item" href="threadlist.php?clubid='.$row['club_id'].'">'.$row['club_name'].'</a></li> ';
          }
         echo ' </ul>
      </li>
  
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>
      <!-- Search -->
      <form class="d-flex" action="search.php" method="get">
      <input class="form-control me-2" type="search" placeholder="Search" name="query">
      <button class="btn btn-success" type="submit">Search</button>
    </form>';
    
    if(!$loggedin){
      echo '
    <ul class="navbar-nav d-flex flex-row me-1">
      <li class="nav-item me-3 me-lg-0">
      <a href="login.php" class="btn btn-outline-info ms-2 me-2 mt-2 mt-lg-0">login</a>
      </li>
      <li class="nav-item me-3 me-lg-0 ">
      <a href="signup.php" class="btn btn-outline-info ms-2 me-2 mt-2 mt-lg-0">signup</a>
      </li>
    </ul>';
    }
    if($loggedin){
      echo '
    <ul class="navbar-nav d-flex flex-row me-1 ml-2 mt-2 mt-md-0">

    <div class="dropdown">
    <button class="btn btn-outline-info dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Welcome ' .$_SESSION['username'] . '
    </button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="/forum/logout.php">logout</a></li>
    </ul>
  </div>
    </ul>';
    }


  echo '
  </div>
</div>
</nav>';


?>