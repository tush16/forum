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
    <!-- <style>
         #ques{
             min-height: 433px;
         }
     </style> -->
    <title>AiForums - A student Community</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php include 'partials/_navbar.php'; ?>
   
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id =$id";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];

        //query the user table to find out the original poster username
        $sql2 = "SELECT username FROM `users` WHERE sno ='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['username'];

    }
    ?>

    <!-- to handle post request of a comment -->
    <?php

    $method  = $_SERVER['REQUEST_METHOD'];
    $showAlert = false;
    if ($method == 'POST') {
        //Insert the comment into database
       
        $sno = $_POST['sno'];
        $comment = $_POST['comment'];
        $comment =  str_replace("<",  "&lt;","$comment");
        $comment =  str_replace(">",  "&gt;","$comment");
    
        $sql  = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
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
           <strong>Success!</strong> Your comment has been added.
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>';
        }
    }
    ?>


    <!-- club container starts here  -->
    <div class="container my-4">
        <div class="bg-light p-5 rounded-lg m-3">
            <h1 class="display-4"><?php echo $title ?></h1>
            <p class="lead"><?php echo $desc ?></p>
            <hr class="my-4">
            <p class="text-muted">Follow all the rules of the forum: No Spam, No Offensive Posts, Remain Respectful.</p>
            <h5 class="fw-bold">
                <small >Posted By: <strong class="font-monospace text-capitalize"><?php echo $posted_by ?></strong></small>
            </h5>
        </div>
    </div>
    <!-- Form to comment on a thread  -->

    <?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    echo '  <div class="container my-4">
    <!-- Form to submit new threads  -->
    <h2 class="py-2 m-3">Post a Comment</h2>
    <form class="rounded bg-light shadow py-5 px-4 m-3" action=" ' . $_SERVER['REQUEST_URI'] . ' " method="POST">
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="pb-3">Type Your Comment</label>
            <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
            <input type="hidden" name="sno" value="'.$_SESSION['sno'] .'">
        </div>
        <button type="submit" class="btn btn-success mt-3">Post Comment</button>
    </form>
</div>';
} else {

    echo '   <div class="container py-2 my-3">
    <div class="card border-info" style="margin-left: 15px; margin-right: 15px;">
        <h5 class="card-header">Post a Comment</h5>
        <div class="card-body">
            <h5 class="card-title">You are not logged in.</h5>
            <p class="card-text">Please! login to post a comment.</p>
            <a href="login.php" class="btn btn-success">login</a>
        </div>
    </div>
    </div>';
}
?>


    <div class="container mb-5" id="ques">
        <h1 class="py-2" style="padding-left:15px;">Discussion</h1>
        <!-- Media object -->
        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult=false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $comment_by = $row['comment_by'];

            
            //to get the username from database to display on comment corresponding to questions
            $sql2 = "SELECT * FROM `users` WHERE sno ='$comment_by'";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $username = $row2['username'];


            echo '<!-- Media object -->
             <div class="d-flex my-3 rounded bg-light shadow py-2 px-2 m-3 mb-3">
             <!-- Image -->
             <img src="images/avatardefault_92824.png" alt="John Doe" class="me-3 rounded-circle" style="width: 60px; height: 60px;" />
             <!-- Body -->
             <div>
                <div class="d-flex bd-highlight">
                <div class="p-2 flex-fill bd-highlight"><p class="fw-bold my-0">'.$username.'</p></div>
                <div class="p-2 flex-fill bd-highlight"><small class="text-muted">' . $comment_time . '</small></div>
                 </div>
                 <p>
                    ' . $content . '
                 </p>
             </div>
         </div>
         <!-- Media object -->';
        }
         // if no comments are posted
         if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h3 class="display-4">No Comments Posted yet.</h3>
              <p class="lead">Be the first one to post a comment?</p>
            </div>
          </div>';
        }
        ?>
    </div>
    <?php include 'partials/_footer.php'; ?>





    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>