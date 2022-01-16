<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "forum";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Oops! Some Error Occured.Try Reloading?" . mysqli_connect_error($conn));
}



?>