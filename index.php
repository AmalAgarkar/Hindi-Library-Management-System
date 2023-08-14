<!DOCTYPE html>
<html>

<head>
	<title>पुस्तकालय</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/all.css">
  	<script type="text/javascript" src="bootstrap4/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap4/js/bootstrap.min.js"></script>
</head>


<style>
	body {
		background-image: url("asset/book22.jpg");
		background-repeat: no-repeat;
		background-size: cover;
	}
</style>


<body>
	
	<!-- Navigation Bar 1 -->
	<nav class="navbar navbar-expand-lg navbar-dark font-weight-bold" style="background-color:#101a32">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">हिंदी पुस्तकालय प्रबंधन प्रणाली</a>
			</div>
		</div>
	</nav>

	<!-- Rest body -->
	<div class="row d-flex justify-content-center" style="height:70vh">
		<div class="col-md-2 text-center align-self-center">
		<a href="admin/index.php"><button type="button" class="btn btn-danger">Admin Login</button></a>
		</div>
		<div class="col-md-2 text-center align-self-center">
		<a href="user/book_info.php"><button type="button" class="btn btn-info text-white">User Login</button></a>
		</div>
	</div>

</body>
</html>
