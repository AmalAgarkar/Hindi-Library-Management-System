<?php include 'protect.php'?>
<?php
	// $connection = mysqli_connect("localhost","root","");
	// mysqli_query($connection,'SET NAMES UTF8');
	// $db = mysqli_select_db($connection,"lms");
	include "../asset/dbconnect.php";
	$query = "delete from users where user_id = '$_GET[ui]'";
	$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	alert("यूज़र सफलतापूर्वक हटा दिये गए हैं...");
	window.location.href = "manage_user.php";
</script>