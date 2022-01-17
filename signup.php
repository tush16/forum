<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
   

    // check whether user already exists 
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn,$existSql);
    $numRows = mysqli_num_rows($result);

    if($numRows > 0){
        $showError = "Username already taken try another one.";
    }
    else{
         
    if (($password == $cpassword)) {
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`fname`, `lname`, `email`, `username`, `password`, `dt`) VALUES ('$fname', '$lname', '$email', '$username', '$hash', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $showAlert = true;
        }
    } else {
        $showError = "Passwords do not match";
    }
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
    <link rel="stylesheet" href="signup.css">
    <title>AiForums - Signup</title>
  </head>
  <body>
    <?php require 'partials/_navbar.php'?>
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
            <strong>Success!</strong> Your account has been created and you can login now.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($showError) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> ' . $showError . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            
        </button>
    </div> ';
    }
    ?>
  <section class="wrapper">
        <div class="container">
            <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
                <div class="logo">
                    <img src="images/acharyalogo.png" class="img-fluid" alt="logo">
                </div>
                <form class="rounded bg-white shadow p-5" action="/forum/signup.php" method="post">
                    <h3 class="text-dark fw-bolder fs-4 mb-2">Create an Account</h3>

                    <div class="fw-normal text-muted mb-2">
                        Already have an account? <a href="/forum/login.php" class="text-primary fw-bold text-decoration-none">Sign in here</a>
                    </div>



                    <div class="form-floating mb-3">
                        <input type="text" maxlength="20"  class="form-control" name="fname" id="fname" placeholder="name@example.com" required>
                        <label for="floatingFirstName">First Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" maxlength="20" class="form-control" id="lname" name="lname" placeholder="name@example.com" required>
                        <label for="floatingLastName">Last Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" maxlength="20"  class="form-control" id="username" name="username" placeholder="name@example.com" required>
                        <label for="floatingUsername">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" maxlength="40"  class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" maxlength="20" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                        <span class="password-info mt-2">Use 8 or more characters with a mix of letters, numbers & symbols.</span>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" maxlength="20" class="form-control" id="cpassword" name="cpassword" placeholder="Password" required>
                        <label for="floatingPassword">Confirm Password</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" id="gridCheck" checked required>
                        <label class="form-check-label ms-2" for="gridCheck">
                            I Agree <a href="#">Terms and conditions</a>.
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary submit_btn w-100 my-4">Continue</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>