<?php
$text = $_GET['text'];
// $connection = mysqli_connect("localhost","root","");
// mysqli_query($connection,'SET NAMES UTF8');
// $db = mysqli_select_db($connection,"lms");
include "../asset/dbconnect.php";

echo '<div class="row d-flex justify-content-center mb-5">
<div class="col-md-10">
    <table class="table table-hover" style="margin:auto;">
        <thead class="sticky-top" style="background-color: #d9e2ff;">
            <tr>
                <th style="width:15%">एक्सेशन संख्या</th>
                <th>पुस्तक का नाम</th>
                <th>यूज़र आई डी</th>
                <th style="width:15%">Name</th>
                <th style="width:18%">जारी करने की दिनांक</th>
                <th style="width:13%">लौटाने की दिनांक</th>
            </tr>
        </thead>';

if ($text == "") {
	$query = "select issue_books.ac_no, issue_books.book_name, issue_books.user_id, users.user_name, issue_books.issue_date, issue_books.return_date from issue_books left join users on issue_books.user_id = users.user_id order by return_date";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        echo '<tbody class="bg-light">';
        echo "<tr>";
		echo "<td>" . $row['ac_no'] . "</td>";
		echo "<td>" . $row['book_name'] . "</td>";
		echo "<td>" . $row['user_id'] . "</td>";
		echo "<td>" . $row['user_name'] . "</td>";
		echo "<td>" . $row['issue_date'] . "</td>";
		echo "<td>" . $row['return_date'] . "</td>";
        echo "<tr>";
        echo "</tbody>";
	}
}

if ($text !== "") {
	$query = "select issue_books.ac_no, issue_books.book_name, issue_books.user_id, users.user_name, issue_books.issue_date, issue_books.return_date from issue_books left join users on issue_books.user_id = users.user_id where issue_books.ac_no like '%$text%' or issue_books.book_name like '%$text%' or issue_books.user_id like '%$text%' or users.user_name like '%$text%' or issue_books.issue_date like '%$text%' or issue_books.return_date like '%$text%' order by return_date";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        echo '<tbody class="bg-light">';
        echo "<tr>";
		echo "<td>" . $row['ac_no'] . "</td>";
		echo "<td>" . $row['book_name'] . "</td>";
		echo "<td>" . $row['user_id'] . "</td>";
		echo "<td>" . $row['user_name'] . "</td>";
		echo "<td>" . $row['issue_date'] . "</td>";
		echo "<td>" . $row['return_date'] . "</td>";
        echo "<tr>";
        echo "</tbody>";
	}
}
echo "</table>
</div>
</div>";

?>