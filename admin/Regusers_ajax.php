<?php include 'protect.php'?>
<?php

// Get the accession no.
$text = $_GET['text'];
// $connection = mysqli_connect("localhost","root","");
// mysqli_query($connection,'SET NAMES UTF8');
// $db = mysqli_select_db($connection,"lms");
include "../asset/dbconnect.php";

echo '<div class="row d-flex justify-content-center">
<div class="col-md-6">
<table class="table table-hover" style="margin:auto;">
<thead class="sticky-top" style="background-color: #d9e2ff">
    <tr>
        <th>यूज़र आई डी</th>
        <th style="width:50%">नाम</th>
        <th style="width:30%">पद</th>
    </tr>
</thead>';

if ($text == "") {
	$query = "select * from users where user_id like '%$text%' or user_name like '%$text%' or designation like '%$text%'";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        echo '<tbody class="bg-light">';
        echo "<tr>";
		echo "<td>" . $row['user_id'] . "</td>";
		echo "<td>" . $row['user_name'] . "</td>";
		echo "<td>" . $row['designation'] . "</td>";
        echo "<tr>";
        echo "</tbody>";
	}
}

elseif ($text !== "") {
	$query = "select * from users where user_id like '%$text%' or user_name like '%$text%' or designation like '%$text%'";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        echo '<tbody class="bg-light">';
        echo "<tr>";
		echo "<td>" . $row['user_id'] . "</td>";
		echo "<td>" . $row['user_name'] . "</td>";
		echo "<td>" . $row['designation'] . "</td>";
        echo "<tr>";
        echo "</tbody>";
	}
}
echo "</table>
</div>
</div>";

?>