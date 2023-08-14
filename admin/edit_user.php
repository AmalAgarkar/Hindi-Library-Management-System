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
	$query = "select * from users where user_id = '$_GET[ui]'";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$user_id = $row['user_id'];
		$user_name = $row['user_name'];
		$designation = $row['designation'];
	}
?>


<!DOCTYPE html>
<html>

<head>
	<title>डैशबोर्ड</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/all.css">
  	<script type="text/javascript" src="../bootstrap4/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap4/js/bootstrap.min.js"></script>
</head>

<style type="text/css">
	#main_content{
		padding: 50px;
		background-color: #d9e2ff;
		border-radius: 15px;
	}
</style>

<body>
	<!-- Navigation Bar 1 -->
	<nav class="navbar navbar-expand-lg navbar-dark font-weight-bold" style="background-color:#101a32">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php"><i class="fas fa-house"></i>&nbsp;&nbsp;हिंदी पुस्तकालय प्रबंधन प्रणाली</a>
			</div>
			<div class="text-white"><span>स्वागत है <?php echo $_SESSION['name'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">मेरी प्रोफाइल </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="view_profile.php">प्रोफ़ाइल देखें</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="edit_profile.php">एडिट प्रोफ़ाइल</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="change_password.php">पासवर्ड बदलें</a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="logout.php">लॉग आउट</a>
		      </li>
		    </ul>
		</div>
	</nav>
	
	<div class="row d-flex justify-content-center my-5">
		<div class="col-md-4" id="main_content">
			<div class="text-center"><h3>यूज़र एडिट करें</h3></div>
			<form action="" method="post">
				<div class="form-group">
					<label for="user_id">यूज़र आई डी</label>
					<input type="text" name="user_id" id="user_id" value="<?php echo $user_id;?>" class="form-control" disabled required>
				</div>
				<div class="form-group">
					<label for="user_name">यूज़र का नाम</label>
					<input type="text" class="form-control" name="user_name" id="user_name" value="<?php echo $user_name; ?>" required>
				</div>
				<div class="form-group">
					<label for="designation">पद</label>
					<input type="text" class="form-control" name="designation" id="designation" value="<?php echo $designation; ?>" required>
				</div>
				<div class="text-center">
					<button type="submit" name="update_user" class="btn btn-primary">यूज़र अपडेट करें</button>
				</div>
			</form>
		</div>
	</div>

</body>
</html>

<?php
	if(isset($_POST['update_user'])){
		// $connection = mysqli_connect("localhost","root","");
		// mysqli_query($connection,'SET NAMES UTF8');
		// $db = mysqli_select_db($connection,"lms");
		include "../asset/dbconnect.php";
		$query = "update users set user_name = '$_POST[user_name]', designation = '$_POST[designation]' where user_id = '$_GET[ui]'";
		$query_run = mysqli_query($connection,$query);
		header("location:manage_user.php");
	}
?>