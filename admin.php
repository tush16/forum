<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
?>
<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $clubname = $_POST['clubname'];
    $clubdesc = $_POST['clubdesc'];
    $image = $_FILES['image']['name']; 
    $tmp_name = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp_name,"uploads/$image");


    $sql = "INSERT INTO `clubs` (`club_name`, `club_description`, `created`, `image`) VALUES ('$clubname', '$clubdesc', current_timestamp(), '$image')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $showAlert = true;
    } else {
        $showError = "Some Error has occured.Try again!";
    }
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

    <title>Forums - A student Community</title>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>
     
    <?php
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
            <strong>Success!</strong> The Club has been created and you can view it at the forums.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div> ';
    }
    ?>





    <form action="/forum/admin.php" method="post" enctype="multipart/form-data">
        <div class="container mb-3 mt-3">
            <h2 class="text-center mt-3 mb-3">Create a new club</h2>
            <div class="mb-3">
                <label for="clubname" class="form-label">Club Name</label>
                <input type="text" class="form-control" id="clubname" name="clubname">

            </div>
            <div class="mb-3">
                <label for="clubdesc" class="form-label">Club Description</label>
                <textarea class="form-control" id="clubdesc" name="clubdesc" rows="3"></textarea>
                <div id="emailHelp" class="form-text">Try to be precise and accurate.</div>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Select club poster</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
    </form>
    </div>


    <?php include 'partials/_footer.php'; ?>





    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>