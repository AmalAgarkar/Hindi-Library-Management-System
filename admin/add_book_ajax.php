<?php include 'protect.php'?>
<?php

// Get the accession no.
$acno = $_GET['acno'];
// $connection = mysqli_connect("localhost", "root", "");
// mysqli_query($connection,'SET NAMES UTF8');
// $db = mysqli_select_db($connection,"lms");
include "../asset/dbconnect.php";
$book_name = "";
$issue_status = "";

if ($acno !== "") {
	$query = "select count(*) as `count` from books where ac_no='$acno'";
	$query_run = mysqli_query($connection,$query);
	$row = mysqli_fetch_assoc($query_run);
    $result = $row['count'];
	if($result==1){
		echo "Book already exist";
	}
}
?>