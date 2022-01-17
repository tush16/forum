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
    

       <!-- club container starts here  -->
       <div class="container my-4">
        <div class="bg-light p-5 rounded-lg m-3">
            <h1 class="display-4">Delete Clubs</h1>
            <p class="lead">Hello admin, You can delete clubs here.</p>
            <hr class="my-4">
            <p class="text-muted">It uses utility classes for typography and spacing to space content out within the larger container.</p>
        </div>
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
                        <a href="delete.php?clubid=' . $id . '" class="btn btn-danger">Delete</a>
                        

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