<?php
include 'partials/_dbconnect.php';
$id = $_GET['clubid'];
$sql = "DELETE FROM `clubs` WHERE `clubs`.`club_id` = $id";
$result = mysqli_query($conn,$sql);
if($result){
    header("location: index.php");
}
else{
    header("location: errorpage.php");
}

?>