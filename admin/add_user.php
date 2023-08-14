<?php include 'protect.php'?>
<?php
	require("functions.php");
	#fetch data from database
	// $connection = mysqli_connect("localhost","root","");
	// mysqli_query($connection,'SET NAMES UTF8');
	// $db = mysqli_select_db($connection,"lms");
	include "../asset/dbconnect.php";
	$name = "";
	$admin_id = "";
	$designation = "";
	$query = "select * from admins where admin_id = '$_SESSION[admin_id]'";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$name = $row['name'];
		$admin_id = $row['admin_id'];
		$designation = $row['designation'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>नया यूज़र जोड़ें</title>
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
			<div class="text-white"><span>स्वागत है <?php echo $_SESSION['name'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>
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

	<!-- Navigation Bar 2 -->
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #6189f6">
		<div class="container-fluid">
			
		    <ul class="nav navbar-nav navbar-center font-weight-bold">
		      <li class="nav-item mr-2">
		        <a class="nav-link" href="admin_dashboard.php">डैशबोर्ड</a>
		      </li>
		      <li class="nav-item dropdown mr-1">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">पुस्तकें </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_book.php">नई पुस्तक जोड़ें</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_book.php">पुस्तकें प्रबंधित करें</a>
	        	</div>
		      </li>

		      <li class="nav-item dropdown mr-1">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">यूज़र्स</a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_user.php">नया यूज़र जोड़ें</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_user.php">यूज़र्स प्रबंधित करें</a>
	        	</div>
		      </li>
	          <li class="nav-item mr-2">
		        <a class="nav-link" href="issue_book.php">पुस्तक जारी करें</a>
		      </li>
			  <li class="nav-item">
		        <a class="nav-link" href="return_book.php">पुस्तक लौटाऐं</a>
		      </li>
		    </ul>
		</div>
	</nav>
	

	<!-- Add user form -->
	<div class="row d-flex justify-content-center my-5">
		<div class="col-md-4" id="main_content">
			<div class="text-center"><h3>नया यूज़र जोड़ें</h3><br></div>
			<form action="" method="post" autocomplete="off">
				<div class="form-group">
					<label for="user_id">यूज़र आई डी</label>
					<input type="text" class="form-control" name="user_id" id="user_id" onkeyup="CheckUser(this.value)" required><div class="text-danger" id="user_warning"></div>
				</div>
				<div class="form-group">
					<label for="user_name">यूज़र का नाम</label>
					<input type="text" class="form-control" name="user_name" id="user_name" required>
				</div>
				<div class="form-group">
					<label for="designation">पद</label>
					<input type="search" list="fetch_desig" class="form-control" name="designation" id="designation" required>
					<datalist id="fetch_desig">
					<?php 
					$query2 = "select distinct designation from users order by designation";
					$query_run = mysqli_query($connection,$query2);
					while ($row = mysqli_fetch_assoc($query_run)){
						$desig_distinct = $row['designation'];
					?>
							<option value="<?php echo $desig_distinct;?>"><?php echo $desig_distinct;?></option>
							<?php
					}
					?>
					</datalist>
				</div><br>
				<div class="text-center">
					<button id="myBtn" type="submit" name="add_user" class="btn btn-primary">यूज़र जोड़ें</button>
				</div>
			</form>
		</div>
	</div>


	<!-- Asynchronous call to check with user id that user already exist or not -->
	<script>
		function CheckUser(user) {

            		var xmlhttp = new XMLHttpRequest();
            		xmlhttp.onreadystatechange = function () {
			myUser = this.responseText;

                	if (this.readyState == 4 && this.status == 200) {
				if(myUser=="User already exist"){
					document.getElementById("user_warning").innerHTML = "यूज़र पहले से पंजीकृत है!";
					document.getElementById('myBtn').disabled = true;
				}
				else{
					document.getElementById('myBtn').disabled = false;
					document.getElementById("user_warning").innerHTML = "";
				}
                }
            };

            xmlhttp.open("GET", "add_user_ajax.php?user=" + user, true);
            xmlhttp.send();
        }
	</script>
</body>
</html>

<!-- Posting added new user information into database -->
<?php
	if(isset($_POST['add_user']))
	{
		// $connection = mysqli_connect("localhost","root","");
		// mysqli_query($connection,'SET NAMES UTF8');
		// $db = mysqli_select_db($connection,"lms");
		include "../asset/dbconnect.php";
		$query = "insert into users(user_id, user_name, designation) values('$_POST[user_id]','$_POST[user_name]','$_POST[designation]')";
		$query_run = mysqli_query($connection,$query);
?>
		<script type="text/javascript"> 
		window.location.replace("admin_dashboard.php"); 
		</script> 
<?php
	}
?>
