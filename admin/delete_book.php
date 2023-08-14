<?php include 'protect.php'?>
<?php
	// $connection = mysqli_connect("localhost","root","");
	// mysqli_query($connection,'SET NAMES UTF8');
	// $db = mysqli_select_db($connection,"lms");
	include "../asset/dbconnect.php";
	$query = "delete from books where ac_no = '$_GET[an]'";
	$query_run = mysqli_query($connection,$query);
?>
<script type="text/javascript">
	alert("पुस्तक सफलतापूर्वक हटा दी गई है...");
	window.location.href = "manage_book.php";
</script>
