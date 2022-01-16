<?php
session_start();
$newsletter = true;
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    $newsletter = false;
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>AiForums - A student Community</title>
    <style>
        div.headingabout {
            background-color: #5bc0de;
            /* Orange */
            color: #ffffff;
            padding: 100px 25px;
        }

        .bg-grey {
            background-color: #f6f6f6;
        }

        .second-container {
            padding: 60px 50px;
        }

        .logo-small {
            color: #f4511e;
            font-size: 50px;
        }

        .logo {
           width: 200px;

        }

        @media screen and (max-width: 768px) {
            .col-sm-4 {
                text-align: center;
                margin: 25px 0;
            }
        }

        .slideanim {
            visibility: hidden;
        }

        .slide {
            /* The name of the animation */
            animation-name: slide;
            -webkit-animation-name: slide;
            /* The duration of the animation */
            animation-duration: 1s;
            -webkit-animation-duration: 1s;
            /* Make the element visible */
            visibility: visible;
        }

        /* Go from 0% to 100% opacity (see-through) and specify the percentage from when to slide in the element along the Y-axis */
        @keyframes slide {
            0% {
                opacity: 0;
                transform: translateY(70%);
            }

            100% {
                opacity: 1;
                transform: translateY(0%);
            }
        }

        @-webkit-keyframes slide {
            0% {
                opacity: 0;
                -webkit-transform: translateY(70%);
            }

            100% {
                opacity: 1;
                -webkit-transform: translateY(0%);
            }
        }
    </style>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>


    <?php

    $method  = $_SERVER['REQUEST_METHOD'];
    $showAlert = false;
    if ($method == 'POST') {
        //Insert the email into database
        $email = $_POST['email'];


        $sql  = "INSERT INTO `newsletter` (`email`, `timestamp`) VALUES ('$email', current_timestamp())";
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
            <strong>Success!</strong> You have been subscribed to our newsletter.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    }
    ?>



    <!-- Add a Jumbotron -->
    <div class="jumbotron headingabout text-center">
        <h1>Acharya Forums</h1>
        <p>Where the world comes to learn</p>
        <p class="fw-bold text-dark">Subscribe to Our Newsletters</p>

        <!-- Add Form -->
        <?php
        if ($newsletter) {
            echo '<form class="form-inline d-flex justify-content-center" action="/forum/about.php" method="POST">
            <div class="input-group">
                <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" size="50" required>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-success">Subscribe</button>
                </div>
            </div>
        </form>';
        } else {
            echo ' <div class="rounded bg-dark d-inline-flex p-2 my-3"><p class="pt-2" >Please Login to subscribe to our newsletter.</p>
            <a href="login.php" class="btn btn-success ml-3" role="button">login</a>
            </div>
            <form class="form-inline d-flex justify-content-center">
            <div class="input-group">
                <input type="email" class="form-control" size="50" placeholder="Email Address" disabled>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-success disabled">Subscribe</button>
                </div>
            </div>
        </form> 
';
        }
        ?>
    </div>

    <!-- Add Containers -->
    <div class="container-fluid second-container">
        <div class="row">
            <div class="col-sm-8">
                <h2>About Acharya</h2>
                <h4>#30YearsofAcharya</h4>
                <p>The Sanskrit word "Acharya", which means "TEACHER", epitomizes the quintessential values of our institution</p>
                <form action="/forum/contact.php">
                <button class="btn btn-outline-success btn-lg">Get in Touch</button>
                </form>
            </div>
            <div class="col-sm-4">
                <span class=" logo"><img src="images/logo1.png" alt="logo community" class="logo"></span>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-grey second-container">
        <div class="row">
            <div class="col-sm-4">
            <span class=" logo"><img src="images/logo2.png" alt="logo Growth" class="logo"></span>
            </div>
            <div class="col-sm-8">
                <h2>The Acharya Story</h2>
                <h4><strong>Our Motto:</strong> "Nurturing Aspirations Supporting Growth"</h4>
                <p><strong>VISION:</strong> "Acharya Institutes, Committed to the cause of value-based education in all disciplines, envisions itself as a fountainhead of innovative human enterprise, with inspirational initiatives for Academic Excellence"</p>
            </div>
        </div>
    </div>

    <!-- Container (Services Section) -->
    <div class="container-fluid text-center second-container">
        <h2>Clubs & Forums</h2>
        <h4>Some of the top forums</h4>
        <br>
        <div class="row slideanim">
        <?php
          $sql = "SELECT * FROM `clubs` WHERE club_id BETWEEN 1 AND 3";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){
            $clubdesc = $row['club_description'];
                $image1 = $row['image'];
                $folder1 = "uploads/".$image1;
               echo '      
               <div class="col-sm-4">
                   <span class="logo-small"><img src="'.$folder1.'"  class="rounded-circle border border-info" alt="Image for this club" style="width: 80px"></span>
                   <h4><a class="link-info" href="threadlist.php?clubid='.$row['club_id'].'">'.$row['club_name'].'</a></h4>
                   <p>'.substr($clubdesc,0,26).'..</p>
               </div>
               ';
          }
        ?>
    </div>
        <br><br>
        <div class="row slideanim">
            
        <?php
          $sql = "SELECT * FROM `clubs` WHERE club_id BETWEEN 4 AND 6";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){
            $clubdesc = $row['club_description'];
                $image1 = $row['image'];
                $folder1 = "uploads/".$image1;
               echo '      
               <div class="col-sm-4">
                   <span class="logo-small"><img src="'.$folder1.'"  class="rounded-circle border border-info" alt="Image for this club" style="width: 80px"></span>
                   <h4><a class="link-info" href="threadlist.php?clubid='.$row['club_id'].'">'.$row['club_name'].'</a></h4>
                   <p>'.substr($clubdesc,0,26).'..</p>
               </div>
               ';
          }
        ?>
        </div>
    </div>



    <?php include 'partials/_footer.php'; ?>




    <script>$(window).scroll(function() {
  $(".slideanim").each(function(){
    var pos = $(this).offset().top;

    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) {
      $(this).addClass("slide");
    }
  });
});</script> 
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>