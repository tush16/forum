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
    
    <title>Forums - A student Community</title>
</head>

<body>
    <?php include 'partials/_dbconnect.php'; ?> 
    <?php include 'partials/_navbar.php'; ?>

    
     <!-- search results    -->
     <div class="container my-3">
         <h1 class="py-3">Search Results For "<?php echo $_GET['query']; ?>"</h1>
         <?php 
        $sql = "SELECT * FROM `threads` WHERE MATCH (`thread_title`,`thread_desc`) against ('".$_GET['query']."');";
        $result = mysqli_query($conn, $sql);
        $noResults = true;
    
        while ($row = mysqli_fetch_assoc($result)) {
            $noResults=false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_id = $row['thread_id'];
            $url = "thread.php?threadid=".$thread_id;


            echo ' <div class="result">
            <h3 ><a href="'.$url.'" class="text-info">'.$title.'</a></h3>
            <p>'.$desc.'</p>
        </div>';
    
        }
        if($noResults){
            echo ' <div class="jumbotron jumbotron-fluid">
            <div class="container">
              <h3 class="display-4">No Results Found.</h3>
              <p class="lead">Suggestions:
                 <ul>
              <li>Make sure that all words are spelled correctly.</li>
              <li>Try different keywords.</li>
              <li>Try more general keywords.</li>
              <li>Try fewer keywords.</li>
              </ul>
              </p>
            </div>
          </div>';
        }



     ?>
     </div>

    <?php include 'partials/_footer.php'; ?>





    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>