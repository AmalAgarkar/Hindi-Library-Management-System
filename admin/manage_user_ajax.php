<?php include 'protect.php'?>
<?php
	#fetch data from database
	// $connection = mysqli_connect("localhost","root","");
	// mysqli_query($connection,'SET NAMES UTF8');
	// $db = mysqli_select_db($connection,"lms");
    include "../asset/dbconnect.php";
	$user_id = "";
	$user_name = "";
	$designation = "";
?>

<html>
<body>

<?php
// Get the accession no.
$text = $_GET['text'];
$connection = mysqli_connect("localhost","root","");
mysqli_query($connection,'SET NAMES UTF8');
$db = mysqli_select_db($connection,"lms");

echo '<div class="row d-flex justify-content-center mb-5">
<div class="col-md-8">
    <table class="table table-hover">
        <thead class="sticky-top" style="background-color: #d9e2ff">
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Designation</th>
                <th colspan="2" style="width:15%">Actions</th>
            </tr>
        </thead>';

if ($text == "") {
	$query = "select * from users";
    $query_run = mysqli_query($connection,$query);
    while ($row = mysqli_fetch_assoc($query_run)){
        echo '<tbody class="bg-light">';
        echo "<tr>";
		echo "<td>" . $row['user_id'] . "</td>";
		echo "<td>" . $row['user_name'] . "</td>";
		echo "<td>" . $row['designation'] . "</td>";
        $ui = $row['user_id'];
		echo "<td><a href='edit_user.php?ui=$ui'>Edit</a></td>";
		echo "<td><a href='delete_user.php?ui=$ui'>Delete</a></td>";
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
        $ui = $row['user_id'];
		echo "<td><a href='edit_user.php?ui=$ui'>Edit</a></td>";
		echo "<td><a href='delete_user.php?ui=$ui'>Delete</a></td>";
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