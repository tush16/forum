<?php
session_start();
// if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
//   header("location: login.php");
//   exit;
// }
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <title>AiForums - A student Community</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?> 
    <?php include 'partials/_navbar.php'; ?>
    

    <!-- slider starts here -->
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
            <img src="images/photographyboard.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Acharya Photography Club</h5>
                    <p>Explore more about the club in the forum.</p>
                </div>
                
            </div>
            <div class="carousel-item" data-bs-interval="2000">
                <img src="images/techmindsboard1.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Acharya Tech Minds</h5>
                    <p>Explore more about the club in the forum.</p>
                </div>
            </div>
            <div class="carousel-item">
            <img src="images/natureboard.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Acharya Nature Club</h5>
                    <p>Explore more about the club in the forum.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- club container starts here  -->
    <div class="container my-4" >
        <h2 class="text-center my-4">Forum - Explore Clubs</h2>
        <div class="row my-4">
            <!-- fetch all the clubs from database -->
             <!-- use loop to iterate through the clubs from database -->
            <?php  

             $sql = "SELECT * FROM `clubs`";
             $result = mysqli_query($conn,$sql);
             while($row = mysqli_fetch_assoc($result)){
                //  echo $row['club_id'];
                //  echo $row['club_name'];
                $id = $row['club_id'];
                $clubname = $row['club_name'];
                $clubdesc = $row['club_description'];
                $image = $row['image'];
                $folder = "uploads/".$image;
                echo '<div class="col-md-4 my-2">
                <div class="card" style="width: 18rem;">
                    <img src="'.$folder.'"  class="card-img-top" alt="Image for this club">
                    <div class="card-body">
                        <h5 class="card-title">' . $clubname . '</h5>
                        <p class="card-text">' . substr($clubdesc,0,120) . '...</p>
                        <a href="threadlist.php?clubid=' . $id . '" class="btn btn-primary">Explore this club</a>
                    </div>
                </div>
            </div> ';
             }
               

             ?>
           

        </div>
    </div>
    <?php include 'partials/_footer.php'; ?>





    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>