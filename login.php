<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'partials/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"]; 

	// $sql = "Select * from users where username='$username' AND password='$password'";

	$sql = "Select * from users where username='$username' ";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);


	
if ($num == 1){
		while($row = mysqli_fetch_assoc($result)){
			if(password_verify($password,$row['password'])){
				if($row['user_type']=='user'){
					$login = true;
					session_start();
					$_SESSION['loggedin'] = true;
					$_SESSION['username'] = $username;
					$_SESSION['sno']=$row['sno'];
					header("location: index.php");
				}
				else{
					$login = true;
					session_start();
					$_SESSION['loggedin'] = true;
					$_SESSION['username'] = $username;
					$_SESSION['sno']=$row['sno'];
					header("location: admin.php");
				}
             
		}
		else{
			$showError="Invalid Credentials";
		}
       
	}

}
  else{
	$showError="Invalid Credentials";
   }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AiForums - Login</title>
	<!-- Bootstrap 5 CDN Link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS Link -->
	<link rel="stylesheet" href="login.css">
</head>
<body>
<?php
    require('partials/_navbar.php');
    ?>
	 <?php
    if ($login) {
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
            <strong>Success!</strong> You are logged in.
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
    <section class="wrapper">
		<div class="container">
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
				<div class="logo">
					<img src="images/acharyalogo.png" class="img-fluid" alt="Logo">
				</div>
				<form class="rounded bg-white shadow py-5 px-4" action="/forum/login.php" method="post">
					<h3 class="text-dark fw-bolder fs-4 mb-2">Sign In to Forum</h3>
					<div class="fw-normal text-muted mb-4"> New Here?
						<a href="/forum/signup.php" class="text-primary fw-bold text-decoration-none">Create an Account</a>
					</div>
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="username" name="username" placeholder="name@example.com" required>
						<label for="floatingInput">Username</label>
					</div>
					<div class="form-floating">
						<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
						<label for="floatingPassword">Password</label>
					</div>
					<!-- <div class="mt-2 text-end">
						<a href="#" class="text-primary fw-bold text-decoration-none">Forget Password?</a>
					</div> -->
					<button type="submit" class="btn btn-primary submit_btn w-100 my-4">Continue</button>
					<!-- <div class="text-center text-muted text-uppercase mb-3">or</div>
					<a href="#" class="btn btn-light login_with w-100 mb-3">
						<img alt="Logo" src="images/google-icon.svg" class="img-fluid me-3">Continue with Google
					</a>
					<a href="#" class="btn btn-light login_with w-100 mb-3">
						<img alt="Logo" src="images/facebook-icon.svg" class="img-fluid me-3">Continue with Facebook
					</a>
					<a href="#" class="btn btn-light login_with w-100 mb-3">
						<img alt="Logo" src="images/linkedin-icon.svg" class="img-fluid me-3">Continue with Linkedin
					</a> -->
				</form>
			</div>
		</div>
    
	</section>
    
</body>
</html>

