<?php
$text = $_GET['text'];
// $connection = mysqli_connect("localhost","root","");
// mysqli_query($connection,'SET NAMES UTF8');
// $db = mysqli_select_db($connection,"lms");
include "../asset/dbconnect.php";

echo '<div class="row d-flex justify-content-center mb-5">
<div class="col-md-8">
    <table class="table table-hover" style="margin:auto;">
        <thead class="sticky-top" style="background-color: #d9e2ff;">
            <tr>
                <th style="width:25%">एक्सेशन संख्या</th>
                <th>पुस्तक का नाम</th>
                <th style="width:30%">यूज़र आई डी</th>
                <th style="width:20%">जारी करने की दिनांक</th>
            </tr>
        </thead>';

if ($text !== "") {
	$query = "select * from issue_books where datediff(now(), issue_date)>30 and (return_date is null or return_date='') and (ac_no like '%$text%' or book_name like '%$text%' or user_id like '%$text%' or issue_date like '%$text%')";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        echo '<tbody style="background-color: #ffe4e4">';
        echo "<tr>";
		echo "<td>" . $row['ac_no'] . "</td>";
		echo "<td>" . $row['book_name'] . "</td>";
		echo "<td>" . $row['user_id'] . "</td>";
		echo "<td>" . $row['issue_date'] . "</td>";
        echo "<tr>";
        echo "</tbody>";
	}
}

elseif ($text == "") {
	$query = "select * from issue_books where datediff(now(), issue_date)>30 and (return_date is null or return_date='')";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        echo '<tbody style="background-color: #ffe4e4">';
        echo "<tr>";
		echo "<td>" . $row['ac_no'] . "</td>";
		echo "<td>" . $row['book_name'] . "</td>";
		echo "<td>" . $row['user_id'] . "</td>";
		echo "<td>" . $row['issue_date'] . "</td>";
        echo "<tr>";
        echo "</tbody>";
	}
}
echo "</table>
</div>
</div>";

?>