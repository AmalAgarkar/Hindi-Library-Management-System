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
	if($result==0){
		echo "Book does not exist";
	}
	else{
		$query = "select issue_status from books where ac_no='$acno'";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$issue_status = $row['issue_status'];
		}

		if($issue_status=='Issued'){
			$query2 = "select book_name from books where ac_no='$acno'";
			$query_run = mysqli_query($connection,$query2);
			while ($row = mysqli_fetch_assoc($query_run)){
				$book_name = $row['book_name'];
				echo $book_name;
			}
		}
		elseif($issue_status=='Available'){
			echo "Book Already Available!";
		}
	}
}
?>