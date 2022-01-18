<?php
session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//     header("location: login.php");
//     exit;
// }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        #ques {
            min-height: 433px;
        }
    </style>
    <title>AiForums - A student Community</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>

    <?php
    // for getting the club title and desc for jumbotron 
    $id = $_GET['clubid'];
    $sql = "SELECT * FROM `clubs` WHERE club_id =$id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $clubname = $row['club_name'];
        $clubdesc = $row['club_description'];
    }
    ?>
    <?php

    $method  = $_SERVER['REQUEST_METHOD'];
    $showAlert = false;
    if ($method == 'POST') {
        //Insert the thread into database
        $sno = $_POST['sno'];
        $th_title = $_POST['title'];
        $th_title =  str_replace("<",  "&lt;", "$th_title");
        $th_title =  str_replace(">",  "&gt;", "$th_title");

        $th_desc = $_POST['desc'];
        $th_desc =  str_replace("<",  "&lt;", "$th_desc");
        $th_desc =  str_replace(">",  "&gt;", "$th_desc");


        $sql  = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_club_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
        if ($showAlert) {
            echo '    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
        </svg>';
            echo '<div class="alert alert-success alert-dismissible fade show" 
            role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <strong>Success!</strong> Your Thread has been added wait for replies from others.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    }
    ?>

    <!-- club container starts here  -->
    <div class="container my-4">
        <div class="bg-light p-5 rounded-lg m-3">
            <h1 class="display-4">Welcome to <?php echo $clubname ?></h1>
            <p class="lead"><?php echo $clubdesc ?></p>
            <hr class="my-4">
            <p>Follow all the rules of the forum: No Spam, No Offensive Posts, Remain Respectful.</p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <?php

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

        echo ' <div class="container my-4">
            <!-- Form to submit new threads  -->
            <h1 class="py-2" style="margin-left: 15px;">Ask a Questions</h1>
            <form class="rounded bg-light shadow py-5 px-4" action=" ' . $_SERVER['REQUEST_URI'] . ' " method="POST" style="margin-left: 15px; margin-right: 15px;">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                    <div id="Help" class="form-text">Keep your title as short and precise as possible.</div>
                </div>
                <input type="hidden" name="sno" value="' . $_SESSION['sno'] . '">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Elaborate your problem</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            </div>';
    } else {

        echo '   <div class="container py-2 my-3">
        <div class="card border-info" style="margin-left: 15px; margin-right: 15px;">
            <h5 class="card-header">Ask a Question</h5>
            <div class="card-body">
                <h5 class="card-title">You are not logged in.</h5>
                <p class="card-text">Please! login to start a discussion.</p>
                <a href="login.php" class="btn btn-success">login</a>
            </div>
        </div>
        </div>';
    }
    ?>



    <div class="container mb-5" id="ques">
        <h1 class="py-2" style="margin-left: 15px;">Browse Questions</h1>
        <!-- Media object -->
        <?php
        $id = $_GET['clubid'];
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        else{
            $page = 1;
        }
        $limit = 5;

        $offset = ($page - 1) * $limit;
        $sql = "SELECT * FROM `threads` WHERE thread_club_id=$id LIMIT {$offset},{$limit}";
        $result = mysqli_query($conn, $sql);
        $noResult = true;

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['thread_id'];
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $timestamp = $row['timestamp'];
            $thread_user_id = $row['thread_user_id'];

            //to get the username from database to display on threadlist corresponding to questions
            $sql2 = "SELECT * FROM `users` WHERE sno ='$thread_user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $username = $row2['username'];

            echo '<!-- Media object -->
             <div class=" d-flex my-3 rounded bg-light shadow py-2 px-2 m-3 mb-3">
             <!-- Image -->
             <img src="images/avatardefault_92824.png" alt="John Doe" class="me-3 rounded-circle" style="width: 60px; height: 60px;" />
             <!-- Body -->
             <div>
                
                  <h5 class="fw-bold p-1">
                     <a href="thread.php?threadid=' . $id . '">' . $title . '</a>
                    
                 </h5>
                 <p>
                    ' . $desc . '
                 </p>
                 <figcaption class="blockquote-footer fw-normal my-0 text-capitalize">
                 Posted by ' . $username . ' <cite title="Source Title">at ' . $timestamp . '</cite>
                 </figcaption>
             </div>
         </div>
         <!-- Media object -->';
        }


        // if no questions are asked
        if ($noResult) {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h3 class="display-4">No Questions Asked yet.</h3>
              <p class="lead">Be the first one to ask a question?</p>
            </div>
          </div>';
        }
        ?>

    </div>


    <!-- pagination -->
    <?php
          $idclub = $_GET['clubid'];
        $result1 = $conn->query("SELECT count(thread_id) AS thread_id FROM threads WHERE thread_club_id=$idclub ");

        while($row=mysqli_fetch_assoc($result1)){
            $total=$row['thread_id'];
        }
        $pages = ceil( $total / $limit );
        // echo $pages;
        
   


        echo '<nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">';
        if($page > 1){
            echo '<li class="page-item"><a class="page-link" href="threadlist.php?clubid=' . $_GET['clubid'] . '&page=' .($page-1). '">Previous</a></li>';
        }
        else{
            echo '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
        }
       
        for ($i = 1; $i <= $pages; $i++) {
            if($i ==  $page){
                 $active = "active";
            }
            else{
                  $active = "";
            }
            echo '  <li class="page-item '.$active.'"><a class="page-link " href="threadlist.php?clubid=' . $_GET['clubid'] . '&page=' . $i . '">' . $i . '</a></li>';
        }
        if($pages > $page){
            echo '<li class="page-item"><a class="page-link" href="threadlist.php?clubid=' . $_GET['clubid'] . '&page=' .($page+1). '">Next</a></li>';
        }
        else{
            echo '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
        }
        echo '</ul>
        </nav>';

    ?>



    
  
   



    <?php include 'partials/_footer.php'; ?>





    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>