<?php include 'protect.php'?>
<?php

// Get the accession no.
$user = $_GET['user'];
// $connection = mysqli_connect("localhost", "root", "");
// mysqli_query($connection,'SET NAMES UTF8');
// $db = mysqli_select_db($connection,"lms");
include "../asset/dbconnect.php";

if ($user !== "") {
	$query = "select count(*) as `count` from users where user_id='$user'";
	$query_run = mysqli_query($connection,$query);
	$row = mysqli_fetch_assoc($query_run);
    $result = $row['count'];
	
	if($result==1){
		echo "User already exist";
	}
}
?>