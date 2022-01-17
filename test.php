<?php

session_start();

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
   


    <!-- club container starts here  -->
    <div class="container my-4">
        <div class="bg-light p-5 rounded-lg m-3">
            <h1 class="display-4">Archieved Clubs</h1>
            <p class="lead">The Clubs that are archieved are present here.</p>
            <hr class="my-4">
            <p class="text-muted">It uses utility classes for typography and spacing to space content out within the larger container.</p>
        </div>
    </div>

    <div class="container mb-5" id="ques">
        
        <!-- Media object -->
        <?php
        $sql="CALL `getClubArchive`()";
        $result = mysqli_query($conn,$sql);
      //   echo $_SESSION['username'];
        

        while ($row = mysqli_fetch_assoc($result)) {
            $noResult=false;
            $clubname = $row['club_name'];
            $club_desc = $row['club_description'];
            $timestamp = $row['created'];
            

            echo '<!-- Media object -->
             <div class=" d-flex my-3 rounded bg-light shadow py-2 px-2 m-3 mb-3">
             <!-- Image -->
             <img src="images/avatardefault_92824.png" alt="John Doe" class="me-3 rounded-circle" style="width: 60px; height: 60px;" />
             <!-- Body -->
             <div>
                
                  <h5 class="fw-bold p-1">
                     <a>' . $clubname . '</a>
                    
                 </h5>
                 <p>
                    ' . $club_desc . '
                 </p>
                 <figcaption class="blockquote-footer fw-normal my-0">
                 was created on: <cite title="Source Title">' . $timestamp . '</cite>
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
    <?php include 'partials/_footer.php'; ?>





    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>