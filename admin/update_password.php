<?php include 'protect.php'?>
<?php
	// $connection = mysqli_connect("localhost","root","");
	// mysqli_query($connection,'SET NAMES UTF8');
	// $db = mysqli_select_db($connection,"lms");
	include "../asset/dbconnect.php";
	$password = "";
	$query = "select * from admins where admin_id = '$_SESSION[admin_id]'";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$password = $row['password'];
	}
	// Posting updated password information into the database
	if($password == $_POST['old_password']){
		$query = "update admins set password = '$_POST[new_password]' where admin_id = '$_SESSION[admin_id]'";
		$query_run = mysqli_query($connection,$query);
		?>
		<script type="text/javascript">
			alert("Updated successfully...");
			window.location.href = "admin_dashboard.php";
		</script>
		<?php
	}
	else{
		?>
		<script type="text/javascript">
			alert("Wrong Admin Password...");
			window.location.href = "change_password.php";
		</script>
		<?php
	}
?>
