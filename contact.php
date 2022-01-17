<?php
session_start();
$newsletter = true;
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    $newsletter = false;
}
?>
<?php
$sent = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $concern = $_POST["concern"];

    $sql = "INSERT INTO `contact_us` (`concern_name`, `concern_email`, `concern_username`, `concern`, `concern_date`) VALUES ('$name', '$email', '$username', '$concern', current_timestamp());";
    $result = mysqli_query($conn,$sql);

    if($result){
      $sent = true;
    }
    else{
      $showError = "Some Error occured try again";
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

    <title>AiForums - A student Community</title>
</head>

<body>
    <?php include 'partials/_navbar.php'; ?>

    <!-- alerts on submission -->
    <?php
    if ($sent) {
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
            <strong>Success!</strong> Your concern has been sent. Please wait for a reply from our team.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> ';
    }
    ?>

<?php
if($newsletter){
  echo '
  <div class="container">
    <h1 class="text-center m-3 bg-light border p-3 shadow ">Get In Touch</h1>
  <form class="row g-3 border shadow p-3 mb-5 mt-5 bg-light rounded" action="/forum/contact.php" method="post">
  <div class="col-md-4">
    <label for="validationDefault01" class="form-label">Name</label>
    <input type="text" class="form-control" id="validationDefault01" name="name" required>
  </div>
  <div class="col-md-4">
    <label for="validationDefault02" class="form-label">Email</label>
    <input type="email" class="form-control" id="validationDefault02" name="email"  required>
  </div>
  <div class="col-md-4">
    <label for="validationDefaultUsername" class="form-label">Username</label>
    <div class="input-group">
      <span class="input-group-text" id="inputGroupPrepend2">@</span>
      <input type="text" class="form-control" id="validationDefaultUsername" name="username" required>
    </div>
  </div>
  <div class="col-12">
    <label for="validationDefault03" class="form-label">Your Concern</label>
    <textarea name="concern" class="form-control" id="validationDefault03" required cols="30" rows="10"></textarea>
  </div>
  
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
      <label class="form-check-label" for="invalidCheck2">
        Agree to terms and conditions
      </label>
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Send Mail</button>
  </div>
</form>
  </div>';
}
else{
  echo '
  <div class="container rounded bg-light d-flex justify-content-center p-2 my-3"><p class="pt-2" >Please Login to subscribe to our newsletter.</p>
  <a href="login.php" class="btn btn-success ml-3" role="button">login</a>
  </div>








  <div class="container">
    <h1 class="text-center m-3 bg-light border p-3 shadow ">Get In Touch</h1>
  <form class="row g-3 border shadow p-3 mb-5 mt-5 bg-light rounded" action="/forum/contact.php" method="post">
  <div class="col-md-4">
    <label for="validationDefault01" class="form-label">Name</label>
    <input type="text" class="form-control" id="validationDefault01" name="name" required disabled>
  </div>
  <div class="col-md-4">
    <label for="validationDefault02" class="form-label">Email</label>
    <input type="email" class="form-control" id="validationDefault02" name="email"  required disabled>
  </div>
  <div class="col-md-4">
    <label for="validationDefaultUsername" class="form-label">Username</label>
    <div class="input-group">
      <span class="input-group-text" id="inputGroupPrepend2">@</span>
      <input type="text" class="form-control" id="validationDefaultUsername" name="username" required disabled>
    </div>
  </div>
  <div class="col-12">
    <label for="validationDefault03" class="form-label">Your Concern</label>
    <textarea name="concern" class="form-control" id="validationDefault03" required disabled cols="30" rows="10"></textarea>
  </div>
  
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required disabled>
      <label class="form-check-label" for="invalidCheck2">
        Agree to terms and conditions
      </label>
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Send Mail</button>
  </div>
</form>
  </div>';
}
  ?>

    <?php include 'partials/_footer.php'; ?>





    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>