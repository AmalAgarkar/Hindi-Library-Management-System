<?php
	session_start();
	#fetch data from database
	// $connection = mysqli_connect("localhost","root","");
	// mysqli_query($connection,'SET NAMES UTF8');
	// $db = mysqli_select_db($connection,"lms");
    include "../asset/dbconnect.php";
	$book_name = "";
	$author = "";
	$category = "";
	$book_no = "";
	$price = "";

?>

<html>

<style>
	.Available {
		color: #009104;
	}
	.Issued {
		color: #ad0000;
	}
    @supports ((position: -webkit-sticky) or (position: sticky)) {
		.sticky-top-2 {
			position: -webkit-sticky;
			position: sticky;
			top: 55px;
			z-index: 1019;
		}
	}
</style>

<body>    


<?php
$text = $_GET['text'];
$connection = mysqli_connect("localhost","root","");
mysqli_query($connection,'SET NAMES UTF8');
$db = mysqli_select_db($connection,"lms");

echo '<div class="row d-flex justify-content-center mb-5">
<div class="col-md-10">
    <table class="table table-hover">
        <thead style="background-color: #d9e2ff;" class="sticky-top-2">
            <tr>
            <th style="width:12%">Accession No</th>
            <th style="width:19%">Book Title</th>
            <th style="width:19%">Author</th>
            <th style="width:19%">Publisher</th>
            <th style="width:11%">Issue Status</th>
            </tr>
        </thead>';

if ($text == "") {
    $query = "select ac_no, book_name, author, publisher, issue_status from books order by substr(ac_no from 1 for 2), cast(substr(ac_no from 1) AS UNSIGNED)";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        echo '<tbody class="bg-light">';
        echo "<tr>";
        echo "<td>" . $row['ac_no'] . "</td>";
        echo "<td>" . $row['book_name'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "<td>" . $row['publisher'] . "</td>";
        $is = $row['issue_status'];
		echo "<td class='$is'>" . $row['issue_status'] . "</td>";
        echo "<tr>";
        echo "</tbody>";
    }
}

elseif ($text !== "") {
	$query = "select ac_no, book_name, author, publisher, issue_status from books where ac_no like '%$text%' or book_name like '%$text%' or author like '%$text%' or publisher like '%$text%' or category like '%$text%' or purchase_year like '%$text%' or book_price like '%$text%' or issue_status like '%$text%' order by substr(ac_no from 1 for 2), cast(substr(ac_no from 1) AS UNSIGNED)";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        echo '<tbody class="bg-light">';
        echo "<tr>";
		echo "<td>" . $row['ac_no'] . "</td>";
		echo "<td>" . $row['book_name'] . "</td>";
		echo "<td>" . $row['author'] . "</td>";
		echo "<td>" . $row['publisher'] . "</td>";
        $is = $row['issue_status'];
		echo "<td class='$is'>" . $row['issue_status'] . "</td>";
        echo "<tr>";
        echo "</tbody>";
	}
}
echo "</table>
</div>
</div>";
?>


</body>
</html>