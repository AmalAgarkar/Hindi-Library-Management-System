<!DOCTYPE html>
<html>

<head>
	<title>लॉग इन</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/all.css">
  	<script type="text/javascript" src="./bootstrap4/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="./bootstrap4/js/bootstrap.min.js"></script>
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
				<a class="navbar-brand" href="../index.php"><i class="fas fa-house"></i>&nbsp;&nbsp;हिंदी पुस्तकालय प्रबंधन प्रणाली</a>
			</div>
		</div>
	</nav>

	<!-- Login form -->
	<div class="row d-flex justify-content-center my-5">
		<div class="col-md-4" id="main_content">
			<div class="text-center"><h3>एडमिन लॉगिन</h3></div><br>
			<form action="" method="post">
				<div class="form-group">
					<label for="admin_id">एडमिन आई डी</label>
					<input type="text" name="admin_id" id="admin_id" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password">पासवर्ड</label>
					<input type="password" name="password" id="password" class="form-control" required>
				</div><br>
				<div class="text-center">
					<button type="submit" name="login" class="btn btn-primary">लॉग इन</button>	
				</div>
			</form>
			<?php 
				if(isset($_POST['login'])){
					// $connection = mysqli_connect("localhost","root","");
					// mysqli_query($connection,'SET NAMES UTF8');
					// $db = mysqli_select_db($connection,"lms");
					include "../asset/dbconnect.php";
					$query = "select * from admins where admin_id = '$_POST[admin_id]'";
					$query_run = mysqli_query($connection,$query);
					while ($row = mysqli_fetch_assoc($query_run)) {
						if($row['admin_id'] == $_POST['admin_id']){
							if($row['password'] == $_POST['password']){
								session_start();
								$_SESSION['name'] =  $row['name'];
								$_SESSION['admin_id'] =  $row['admin_id'];
								$_SESSION['logged_in'] =  true;
								header("Location: admin_dashboard.php");
							}
							else{
								?>
								<br><div class="text-center"><span class="text-danger">गलत पासवर्ड !!</span></div>
								<?php
							}
						}
					}
				}
			?>
		</div>
	</div>
	
</body>
</html>
